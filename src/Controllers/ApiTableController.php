<?php

namespace Exceedone\Exment\Controllers;

use Illuminate\Http\Request;
use Exceedone\Exment\Model\CustomTable;
use Exceedone\Exment\Model\CustomColumn;
use Exceedone\Exment\Model\CustomView;
use Exceedone\Exment\Enums\Permission;
use Exceedone\Exment\Enums\SystemColumn;
use Exceedone\Exment\Enums\ColumnType;
use Exceedone\Exment\Enums\ViewColumnType;
use Exceedone\Exment\Services\FormHelper;
use Carbon\Carbon;
use Validator;

/**
 * Api about target table
 */
class ApiTableController extends AdminControllerTableBase
{
    protected $custom_table;

    // custom_value --------------------------------------------------
    
    /**
     * list all data
     * @return mixed
     */
    public function dataList(Request $request)
    {
        if (!$this->custom_table->hasPermission(Permission::AVAILABLE_EDIT_CUSTOM_VALUE)) {
            return abortJson(403, trans('admin.deny'));
        }

        // get and check query parameter
        $count = null;
        if ($request->has('count')) {
            $count = $request->get('count');
            if (!preg_match('/^[0-9]+$/', $count) || intval($count) < 1 || intval($count) > 100) {
                return abortJson(400, exmtrans('api.errors.over_maxcount'));
            }
        }
      
        $orderby = null;
        $orderby_list = [];
        if ($request->has('orderby')) {
            $orderby = $request->get('orderby');
            $params = explode(',', $orderby);
            $orderby_list = [];
            foreach ($params as $param) {
                $values = preg_split("/\s+/", trim($param));
                $column_name = $values[0];
                if (count($values) > 1 && !preg_match('/^asc|desc$/i', $values[1])) {
                    return abortJson(400, exmtrans('api.errors.invalid_params'));
                }
                if (SystemColumn::isValid($column_name)) {
                } else {
                    $column = $this->custom_table->custom_columns()->where('column_name', $column_name)->indexEnabled()->first();
                    if (isset($column)) {
                        $column_name = $column->getIndexColumnName();
                    } else {
                        return abortJson(400, exmtrans('api.errors.invalid_params'));
                    }
                }
                $orderby_list[] = [$column_name, count($values) > 1? $values[1]: 'asc'];
            }
        }

        // get paginate
        $model = $this->custom_table->getValueModel()->query();

        // set order by
        if (isset($orderby_list)) {
            foreach ($orderby_list as $item) {
                $model->orderBy($item[0], $item[1]);
            }
        }
        $paginator = $model->paginate($count ?? config('exment.api_default_data_count', 100));

        // execute makehidden
        $value = $paginator->makeHidden($this->custom_table->getMakeHiddenArray());
        $paginator->value = $value;

        // set appends
        $paginator->appends([
            'count' => $count,
            'orderBy' => $orderby,
        ]);

        return $paginator;
    }

    /**
     * find match data for select ajax
     * @param mixed $id
     * @return mixed
     */
    public function dataSelect(Request $request)
    {
        $paginator = $this->dataQuery($request);
        if (!isset($paginator)) {
            return [];
        }
        
        if (!($paginator instanceof \Illuminate\Pagination\LengthAwarePaginator)) {
            return $paginator;
        }
        // if call as select ajax, return id and text array
        $paginator->getCollection()->transform(function ($value) {
            return [
                'id' => $value->id,
                'text' => $value->label,
            ];
        });

        return $paginator;
    }
    
    /**
     * find match data by query
     * use form select ajax
     * @param mixed $id
     * @return mixed
     */
    public function dataQuery(Request $request)
    {
        if (!$this->custom_table->hasPermission(Permission::AVAILABLE_ACCESS_CUSTOM_VALUE)) {
            return abortJson(403, trans('admin.deny'));
        }

        // get model filtered using role
        $model = getModelName($this->custom_table)::query();
        $model = \Exment::user()->filterModel($model);

        // filtered query
        $q = $request->get('q');
        if (!isset($q)) {
            return [];
        }

        // get custom_view
        $custom_view = null;
        if ($request->has('target_view_id')) {
            $custom_view = CustomView::getEloquent($request->get('target_view_id'));
        }

        $paginator = $this->custom_table->searchValue($q, [
            'paginate' => true,
            'makeHidden' => true,
            'target_view' => $custom_view,
            'maxCount' => 10,
        ]);

        return $paginator;
    }
    
    /**
     * find data by id
     * use select Changedata
     * @param mixed $id
     * @return mixed
     */
    public function dataFind(Request $request, $tableKey, $id)
    {
        if (!$this->custom_table->hasPermission(Permission::AVAILABLE_EDIT_CUSTOM_VALUE)) {
            return abortJson(403, trans('admin.deny'));
        }

        $model = getModelName($this->custom_table->table_name)::find($id);
        // not contains data, return empty data.
        if (!isset($model)) {
            return [];
        }

        if (!$this->custom_table->hasPermissionData($model)) {
            return abortJson(403, trans('admin.deny'));
        }

        $result = $model->makeHidden($this->custom_table->getMakeHiddenArray())
                    ->toArray();
        if ($request->has('dot') && boolval($request->get('dot'))) {
            $result = array_dot($result);
        }
        return $result;
    }

    /**
     * create data
     * @return mixed
     */
    public function dataCreate(Request $request)
    {
        if (!$this->custom_table->hasPermission(Permission::AVAILABLE_EDIT_CUSTOM_VALUE)) {
            return abortJson(403, trans('admin.deny'));
        }

        return $this->saveData($request);
    }

    /**
     * update data
     * @return mixed
     */
    public function dataUpdate(Request $request, $tableKey, $id)
    {
        if (!$this->custom_table->hasPermission(Permission::AVAILABLE_EDIT_CUSTOM_VALUE)) {
            return abortJson(403, trans('admin.deny'));
        }

        $custom_value = getModelName($this->custom_table)::find($id);
        if (!isset($custom_value)) {
            abort(400);
        }

        if (!$this->custom_table->hasPermissionData($custom_value, Permission::AVAILABLE_EDIT_CUSTOM_VALUE)) {
            return abortJson(403, trans('admin.deny'));
        }

        return $this->saveData($request, $custom_value);
    }

    /**
     * delete data
     * @return mixed
     */
    public function dataDelete(Request $request, $tableKey, $id)
    {
        if (!$this->custom_table->hasPermission(Permission::AVAILABLE_EDIT_CUSTOM_VALUE)) {
            return abortJson(403, trans('admin.deny'));
        }

        $custom_value = getModelName($this->custom_table)::find($id);
        if (!isset($custom_value)) {
            abort(400);
        }

        if (!$this->custom_table->hasPermissionData($custom_value, Permission::AVAILABLE_EDIT_CUSTOM_VALUE)) {
            return abortJson(403, trans('admin.deny'));
        }

        $custom_value->delete();

        if (boolval($request->input('webresponse'))) {
            return response([
                'result'  => true,
                'message' => trans('admin.delete_succeeded'),
            ], 200);
        }
        return response(null, 204);
    }

    /**
     * get selected id's children values
     */
    public function relatedLinkage(Request $request)
    {
        if (!$this->custom_table->hasPermission(Permission::AVAILABLE_EDIT_CUSTOM_VALUE)) {
            return abortJson(403, trans('admin.deny'));
        }

        // get children table id
        $child_table_id = $request->get('child_table_id');
        $child_table = CustomTable::getEloquent($child_table_id);
        // get selected custom_value id(q)
        $q = $request->get('q');

        // get children items
        $options = [
            'paginate' => false,
            'maxCount' => null,
        ];
        $datalist = $this->custom_table->searchRelationValue($request->get('search_type'), $q, $child_table, $options);
        return collect($datalist)->map(function ($data) {
            return ['id' => $data->id, 'text' => $data->label];
        });
    }

    // CustomColumn --------------------------------------------------
    /**
     * get table columns
     */
    public function tableColumns(Request $request)
    {
        if (!$this->custom_table->hasPermission(Permission::AVAILABLE_ACCESS_CUSTOM_VALUE)) {
            return abortJson(403, trans('admin.deny'));
        }

        return $this->custom_columns;
    }

    /**
     * get table columns data
     */
    public function columnData(Request $request, $tableKey, $column_name)
    {
        if (!$this->custom_table->hasPermission(Permission::AVAILABLE_ACCESS_CUSTOM_VALUE)) {
            return abortJson(403, trans('admin.deny'));
        }

        $query = $request->get('query');
        $custom_column = CustomColumn::getEloquent($column_name, $this->custom_table->table_name);

        $list = [];

        if ($custom_column->index_enabled) {
            $column_name = $custom_column->getIndexColumnName();
            $list = $this->custom_table->searchValue($query, [
                'searchColumns' => collect([$column_name]),
            ])->pluck($column_name)->unique()->toArray();
        }
        return json_encode($list);
    }

    
    protected function saveData($request, $custom_value = null)
    {
        $is_single = false;

        $validator = Validator::make($request->all(), [
            'value' => 'required',
        ]);
        if ($validator->fails()) {
            return abortJson(400, [
                'errors' => $this->getErrorMessages($validator)
            ]);
        }

        $values = $request->get('value');

        if (!is_vector($values)) {
            $values = [$values];
            $is_single = true;
        }

        $max_create_count = config('exment.api_max_create_count', 100);
        if(count($values) > $max_create_count){
            return abortJson(400, exmtrans('api.errors.over_createlength', $max_create_count));
        }

        $this->convertFindKeys($values, $request);

        $validates = [];
        foreach ($values as $index => $value) {
            if (!isset($custom_value)) {
                $value = $this->setDefaultData($value);
                // // get fields for validation
                $validate = $this->validateData($value);
            } else {
                // // get fields for validation
                $validate = $this->validateData($value, $custom_value->id);
            }
            if ($validate !== true) {
                if ($is_single) {
                    $validates[] = $validate;
                } else {
                    $validates[] = [
                        'line_no' => $index,
                        'error' => $validate
                    ];
                }
            }
        }
        if (count($validates) > 0) {
            return abortJson(400, [
                'errors' => $validates
            ]);
        }

        $response = [];
        foreach ($values as &$value) {
            // set default value if new
            if (!isset($custom_value)) {
                $model = $this->custom_table->getValueModel();
            } else {
                $model = $custom_value;
            }

            $model->setValue($value);
            $model->saveOrFail();

            $response[] = getModelName($this->custom_table)::find($model->id)->makeHidden($this->custom_table->getMakeHiddenArray());
        }

        if ($is_single && count($response) > 0) {
            return $response[0];
        } else {
            return $response;
        }
    }

    protected function convertFindKeys(&$values, $request)
    {
        if (is_null($findKeys = $request->get('findKeys'))) {
            return;
        }

        foreach ($findKeys as $findKey => $findValue) {
            // find column
            $custom_column = CustomColumn::getEloquent($findKey, $this->custom_table);
            if (!isset($custom_column)) {
                continue;
            }

            if ($custom_column->column_type != ColumnType::SELECT_TABLE) {
                continue;
            }

            // get target custom table
            $findCustomTable = $custom_column->select_target_table;
            if (!isset($findCustomTable)) {
                continue;
            }

            // get target column for getting index
            $findCustomColumn = CustomColumn::getEloquent($findValue, $findCustomTable);
            if (!isset($findCustomColumn)) {
                continue;
            }

            if (!$findCustomColumn->index_enabled) {
                //TODO:show error
                continue;
            }
            $indexColumnName = $findCustomColumn->getIndexColumnName();

            foreach ($values as &$value) {
                $findCustomValue = $findCustomTable->getValueModel()
                    ->where($indexColumnName, array_get($value, $findKey))
                    ->first();

                if (!isset($findCustomValue)) {
                    //TODO:show error
                    continue;
                }
                array_set($value, $findKey, array_get($findCustomValue, 'id'));
            }
        }
    }

    /**
     * validate requested data
     */
    protected function validateData($value, $id = null)
    {
        // get fields for validation
        $fields = [];
        $customAttributes = [];
        foreach ($this->custom_table->custom_columns as $custom_column) {
            $fields[] = FormHelper::getFormField($this->custom_table, $custom_column, $id);
            $customAttributes[$custom_column->column_name] = "{$custom_column->column_view_name}({$custom_column->column_name})";

            // if not contains $value[$custom_column->column_name], set as null.
            // if not set, we cannot validate null check because $field->getValidator returns false.
            if (!array_has($value, $custom_column->column_name)) {
                $value[$custom_column->column_name] = null;
            }
        }
        // foreach for field validation rules
        $rules = [];
        foreach ($fields as $field) {
            // get field validator
            $field_validator = $field->getValidator($value);
            if (!$field_validator) {
                continue;
            }
            // get field rules
            $field_rules = $field_validator->getRules();

            // merge rules
            $rules = array_merge($field_rules, $rules);
        }
        
        // execute validation
        $validator = Validator::make(array_dot_reverse($value), $rules, [], $customAttributes);
        if ($validator->fails()) {
            // create error message
            return $this->getErrorMessages($validator);
        }
        return true;
    }

    /**
     * Get error message from validator
     *
     * @param [type] $validator
     * @return array error messages
     */
    protected function getErrorMessages($validator)
    {
        $errors = [];
        foreach ($validator->errors()->messages() as $key => $message) {
            if (is_array($message)) {
                $errors[$key] = $message[0];
            } else {
                $errors[$key] = $message;
            }
        }
        return $errors;
    }

    /**
     * set Default Data from custom column info
     */
    protected function setDefaultData($value)
    {
        // get fields for validation
        $fields = [];
        foreach ($this->custom_table->custom_columns as $custom_column) {
            // get default value
            $default = $custom_column->getOption('default');

            // if not key in value, set default value
            if (!array_has($value, $custom_column->column_name) && isset($default)) {
                $value[$custom_column->column_name] = $default;
            }
        }

        return $value;
    }
    
    /**
     * get calendar data
     * @return mixed
     */
    public function calendarList(Request $request)
    {
        if (!$this->custom_table->hasPermission(Permission::AVAILABLE_ACCESS_CUSTOM_VALUE)) {
            return abortJson(403, trans('admin.deny'));
        }

        // filtered query
        if ($request->has('dashboard')) {
            $is_dashboard = boolval($request->get('dashboard'));
        } else {
            $is_dashboard = false;
        }
        $custom_view = CustomView::getDefault($this->custom_table, true, $is_dashboard);
        $start = $request->get('start');
        $end = $request->get('end');
        if (!isset($start) || !isset($end)) {
            return [];
        }

        $start = Carbon::parse($start);
        $end = Carbon::parse($end);

        $table_name = $this->custom_table->table_name;
        // get paginate
        $model = $this->custom_table->getValueModel();
        // filter model
        $model = \Exment::user()->filterModel($model, $custom_view);

        $tasks = [];
        foreach ($custom_view->custom_view_columns as $custom_view_column) {
            if ($custom_view_column->view_column_type == ViewColumnType::COLUMN) {
                $target_start_column = $custom_view_column->custom_column->getIndexColumnName();
            } else {
                $target_start_column = SystemColumn::getOption(['id' => $custom_view_column->view_column_target_id])['name'];
            }

            if (isset($custom_view_column->view_column_end_date)) {
                $end_date_target = $custom_view_column->getOption('end_date_target');
                if ($custom_view_column->view_column_end_date_type == ViewColumnType::COLUMN) {
                    $target_end_custom_column = CustomColumn::getEloquent($end_date_target);
                    $target_end_column = $target_end_custom_column->getIndexColumnName();
                } else {
                    $target_end_column = SystemColumn::getOption(['id' => $end_date_target])['name'];
                }
            } else {
                $target_end_column = null;
            }

            // clone model for re use
            $query = $this->getCalendarQuery($model, $start, $end, $target_start_column, $target_end_column ?? null);
            $data = $query->get();

            foreach ($data as $row) {
                $task = [
                    'title' => $row->getLabel(),
                    'url' => admin_url('data', [$table_name, $row->id]),
                    'color' => $custom_view_column->view_column_color,
                    'textColor' => $custom_view_column->view_column_font_color,
                ];
                $this->setCalendarDate($task, $row, $target_start_column, $target_end_column);
                
                $tasks[] = $task;
            }
        }
        return json_encode($tasks);
    }

    /**
     * Get calendar query
     * ex. display: 4/1 - 4/30
     *
     * @param mixed $query
     * @return void
     */
    protected function getCalendarQuery($model, $start, $end, $target_start_column, $target_end_column)
    {
        $query = clone $model;
        // filter end data
        if (isset($target_end_column)) {
            // filter enddate.
            // ex. 4/1 - endDate - 4/30
            $endQuery = (clone $query);
            $endQuery = $endQuery->where((function ($query) use ($target_end_column, $start, $end) {
                $query->where($target_end_column, '>=', $start->toDateString())
                ->where($target_end_column, '<', $end->toDateString());
            }))->select('id');

            // filter start and enddate.
            // ex. startDate - 4/1 - 4/30 - endDate
            $startEndQuery = (clone $query);
            $startEndQuery = $startEndQuery->where((function ($query) use ($target_start_column, $target_end_column, $start, $end) {
                $query->where($target_start_column, '<=', $start->toDateString())
                ->where($target_end_column, '>=', $end->toDateString());
            }))->select('id');
        }

        if ($query instanceof \Illuminate\Database\Eloquent\Model) {
            $query = $query->getQuery();
        }

        // filter startDate
        // ex. 4/1 - startDate - 4/30
        $query->where(function ($query) use ($target_start_column, $start, $end) {
            $query->where($target_start_column, '>=', $start->toDateString())
            ->where($target_start_column, '<', $end->toDateString());
        })->select('id');

        // union queries
        if (isset($endQuery)) {
            $query->union($endQuery);
        }
        if (isset($startEndQuery)) {
            $query->union($startEndQuery);
        }

        // get target ids
        $ids = \DB::query()->fromSub($query, 'sub')->pluck('id');

        // return as eloquent
        return $model->whereIn('id', $ids);
    }

    /**
     * Set calendar date. check date or datetime
     *
     * @param array $task
     * @param mixed $row
     * @return void
     */
    protected function setCalendarDate(&$task, $row, $target_start_column, $target_end_column)
    {
        $dt = $row->{$target_start_column};
        if (isset($target_end_column)) {
            $dtEnd = $row->{$target_end_column};
        } else {
            $dtEnd = null;
        }

        if ($dt instanceof Carbon) {
            $dt = $dt->toDateTimeString();
        }
        if (isset($dtEnd) && $dtEnd instanceof Carbon) {
            $dtEnd = $dtEnd->toDateTimeString();
        }
        
        // get columnType
        $dtType = ColumnType::getDateType($dt);
        $dtEndType = ColumnType::getDateType($dtEnd);

        // set
        $allDayBetween = $dtType == ColumnType::DATE && $dtEndType == ColumnType::DATE;
        
        $task['start'] = $dt;
        if (isset($dtEnd)) {
            $task['end'] = $dtEnd;
        }
        $task['allDayBetween'] = $allDayBetween;
    }
}
