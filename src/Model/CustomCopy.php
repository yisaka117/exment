<?php

namespace Exceedone\Exment\Model;

use Illuminate\Support\Facades\DB;
use Exceedone\Exment\Enums\CopyColumnType;
use Exceedone\Exment\Enums\SystemColumn;
use Exceedone\Exment\Enums\ViewColumnType;

class CustomCopy extends ModelBase implements Interfaces\TemplateImporterInterface
{
    use Traits\UseRequestSessionTrait;
    use Traits\AutoSUuidTrait;
    use Traits\DatabaseJsonTrait;
    use Traits\TemplateTrait;
    
    protected $casts = ['options' => 'json'];

    public static $templateItems = [
        'excepts' => ['from_custom_table', 'to_custom_table', 'target_copy_name'],
        'langs' => [
            'keys' => ['suuid'],
            'values' => ['options.label'],
        ],
        'uniqueKeys' => ['suuid'],
        'uniqueKeyReplaces' => [
            [
                'replaceNames' => [
                    [
                        'replacingName' => 'from_custom_table_id',
                        'replacedName' => [
                            'table_name' => 'from_custom_table_name',
                        ]
                    ],
                    [
                        'replacingName' => 'to_custom_table_id',
                        'replacedName' => [
                            'table_name' => 'to_custom_table_name',
                        ]
                    ],
                ],
                'uniqueKeyClassName' => CustomTable::class,
            ],
        ],
        'children' =>[
            'custom_copy_columns' => CustomCopyColumn::class,
            'custom_copy_input_columns' => CustomCopyColumn::class,
        ],
    ];
    
    public function from_custom_table()
    {
        return $this->belongsTo(CustomTable::class, 'from_custom_table_id');
    }

    public function to_custom_table()
    {
        return $this->belongsTo(CustomTable::class, 'to_custom_table_id');
    }

    public function custom_copy_columns()
    {
        return $this->hasMany(CustomCopyColumn::class, 'custom_copy_id')
        ->where('copy_column_type', CopyColumnType::DEFAULT);
    }

    public function custom_copy_input_columns()
    {
        return $this->hasMany(CustomCopyColumn::class, 'custom_copy_id')
        ->where('copy_column_type', CopyColumnType::INPUT);
    }

    public function getOption($key, $default = null)
    {
        return $this->getJson('options', $key, $default);
    }
    public function setOption($key, $val = null, $forgetIfNull = false)
    {
        return $this->setJson('options', $key, $val, $forgetIfNull);
    }
    public function forgetOption($key)
    {
        return $this->forgetJson('options', $key);
    }
    public function clearOption()
    {
        return $this->clearJson('options');
    }
    
    /**
     * execute data copy
     */
    public function execute($from_custom_value, $request = null)
    {
        $to_custom_value = null;
        DB::transaction(function () use (&$to_custom_value, $from_custom_value, $request) {
            $to_custom_value = static::saveCopyModel(
                $this->custom_copy_columns,
                $this->custom_copy_input_columns,
                $this->to_custom_table,
                $from_custom_value,
                $request
            );

            $child_copy_id = $this->getOption('child_copy');
            if (isset($child_copy_id)) {
                $child_copy = static::find($child_copy_id);

                // get from-children values
                $from_child_custom_values = $from_custom_value->getChildrenValues($child_copy->from_custom_table_id) ?? [];

                // loop children values
                foreach ($from_child_custom_values as $from_child_custom_value) {
                    // update parent_id to $to_custom_value->id
                    $from_child_custom_value->parent_id = $to_custom_value->id;
                    $from_child_custom_value->parent_type = $this->to_custom_table->table_name;
                    // execute copy
                    static::saveCopyModel(
                        $child_copy->custom_copy_columns,
                        $child_copy->custom_copy_input_columns,
                        $child_copy->to_custom_table,
                        $from_child_custom_value,
                        null,
                        true
                    );
                }
            }

            return true;
        });
        
        return [
            'result'  => true,
            'toastr' => sprintf(exmtrans('common.message.success_execute')),
            // set redirect url
            'redirect' => admin_urls('data', $this->to_custom_table->table_name, $to_custom_value->id)
        ];
    }

    protected static function saveCopyModel(
        $custom_copy_columns,
        $custom_copy_input_columns,
        $to_custom_table,
        $from_custom_value,
        $request = null,
        $skipParent = false
    ) {
        // get to_custom_value model
        $to_modelname = getModelName($to_custom_table);
        $to_custom_value = new $to_modelname;

        // set system column
        $to_custom_value->parent_id = $from_custom_value->parent_id;
        $to_custom_value->parent_type = $from_custom_value->parent_type;

        // loop for custom_copy_columns
        foreach ($custom_copy_columns as $custom_copy_column) {
            $fromkey = static::getColumnKey(
                $custom_copy_column->from_column_type,
                $custom_copy_column->from_column_target_id,
                $custom_copy_column->from_custom_column
            );
            $val = array_get($from_custom_value, $fromkey);

            $tokeys = static::getColumnKey(
                $custom_copy_column->to_column_type,
                $custom_copy_column->to_column_target_id,
                $custom_copy_column->to_custom_column
            );

            if ($skipParent && $tokeys == Define::PARENT_ID_NAME) {
                continue;
            }
    
            $tokeys = explode('.', $tokeys);
            if (count($tokeys) > 1 && $tokeys[0] == 'value') {
                $to_custom_value->setValue($tokeys[1], $val);
            } else {
                $to_custom_value->{$tokeys[0]} = $val;
            }
        }

        // has request, set value from input
        if (isset($request)) {
            foreach ($custom_copy_input_columns as $custom_copy_input_column) {
                $custom_column = $custom_copy_input_column->to_custom_column;
                // get input value
                $val = $request->input($custom_column->column_name ?? null);
                if (isset($val)) {
                    $to_custom_value->setValue($custom_column->column_name, $val);
                }
            }
        }
        // save
        $to_custom_value->saveOrFail();
        return $to_custom_value;
    }
    
    protected static function getColumnKey($column_type, $column_type_target, $custom_column)
    {
        // check column_type
        if ($column_type == ViewColumnType::SYSTEM) {
            // get VIEW_COLUMN_SYSTEM_OPTIONS and get name.
            return SystemColumn::getOption(['id' => $column_type_target])['name'] ?? null;
        } elseif ($column_type == ViewColumnType::PARENT_ID) {
            return Define::PARENT_ID_NAME;
        } else {
            return "value.{$custom_column->column_name}";
        }
    }
    /**
     * get eloquent using request settion.
     * now only support only id.
     */
    public static function getEloquent($id, $withs = [])
    {
        return static::getEloquentDefault($id, $withs);
    }
        
    public function deletingChildren()
    {
        $this->custom_copy_columns()->delete();
        $this->custom_copy_input_columns()->delete();
    }

    protected static function boot()
    {
        parent::boot();
        
        static::deleting(function ($model) {
            $model->deletingChildren();
        });
    }
}
