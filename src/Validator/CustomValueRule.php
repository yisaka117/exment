<?php
namespace Exceedone\Exment\Validator;

use Illuminate\Contracts\Validation\Rule;
use Exceedone\Exment\Model\CustomTable;

/**
 * CustomValueRule.
 * Check contains target table
 */
class CustomValueRule implements Rule
{
    protected $custom_table;
    public function __construct($parameters)
    {
        $this->custom_table = CustomTable::getEloquent($parameters);
    }
    /**
    * Check Validation
    *
    * @param  string  $attribute
    * @param  mixed  $value
    * @return bool
    */
    public function passes($attribute, $value)
    {
        if (is_null($value)) {
            return true;
        }
        if (!isset($this->custom_table)) {
            return true;
        }


        if (!is_array($value)) {
            $value = [$value];
        }

        $value = array_filter($value);

        foreach ($value as $v) {
            // get target table's value (use request session)
            $model = $this->custom_table->getValueModel($v);
            if (!isset($model)) {
                return false;
            }
        }

        return true;
    }
    
    /**
     * get validation error message
     *
     * @return string
     */
    public function message()
    {
        return str_replace(':table_view_name', $this->custom_table->table_view_name, exmtrans('validation.not_has_custom_value'));
    }
}
