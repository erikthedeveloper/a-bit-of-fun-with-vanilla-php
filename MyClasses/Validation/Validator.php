<?php

namespace MyClasses\Validation;

use \InvalidArgumentException;

/**
 * Class Validator
 * @package MyClasses\Validation
 * @author  Erik Aybar
 */
class Validator
{

    protected $failed_fields = [];

    /**
     * @param $rules
     * @param $data
     * @return bool
     * @author Erik Aybar
     */
    public function validate($rules, $data)
    {
        foreach ($rules as $field_name => $callable_rules) {
            foreach ($callable_rules as $callable_rule) {
                if (method_exists($this, $callable_rule)) {
                    $passes = $this->$callable_rule($data[$field_name]);
                    if (!$passes) {
                        $this->failed_fields[$field_name] = ucfirst(str_replace('_', ' ', $field_name)) . " failed!";
                    }
                } else {
                    throw new InvalidArgumentException("{$callable_rule} method does not exist to validate the {$field_name} field");
                }
            }
        }

        $is_valid = count($this->failed_fields) == 0;
        return $is_valid;
    }

    /**
     * @param $destination
     * @author Erik Aybar
     */
    public function redirectIfFailed($destination)
    {
        if (count($this->failed_fields)) {
            redirect_with_message($destination, $this->getValidationSummaryMessage());
        }
    }

    /**
     * @return string
     * @author Erik Aybar
     */
    public function getValidationSummaryMessage()
    {
        return "Whoops. Looks like " . implode(', ', $this->failed_fields) . " were not valid!";
    }

    /**
     * @param $destination
     * @author Erik Aybar
     */
    public function redirectWithErrorsIfFailed($destination)
    {
        if (count($this->failed_fields)) {
            $flash = [
                'message' => $this->getValidationSummaryMessage(),
                'errors'  => $this->failed_fields,
                'input'   => $_POST // TODO: bad!!!!
            ];
            redirect_with_flash_array($destination, $flash);
        }
    }

    protected function not_empty($data)
    {
        return !empty($data);
    }

    protected function email($data)
    {
        return preg_match('/\w+@\w+\.\w+/', $data);
    }
}