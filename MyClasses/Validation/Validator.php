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

    /**
     * @var array
     */
    protected $failed_fields = [];
    /**
     * @var string
     */
    protected $callable_prefix = 'validate';

    /**
     * @param $rules
     * @param $data
     * @return bool
     * @author Erik Aybar
     */
    public function validate(array $rules, array $data)
    {
        foreach ($rules as $field_name => $callable_rules) {
            foreach ($callable_rules as $callable_rule) {
                $this->validateFieldUsingRule($callable_rule, $field_name, $data[$field_name]);
            }
        }
        return $this;
    }

    /**
     * @return bool
     * @author Erik Aybar
     */
    public function hasErrors()
    {
        return count($this->failed_fields) > 0;
    }

    /**
     * @return bool
     * @author Erik Aybar
     */
    public function hasValidData()
    {
        return (!$this->hasErrors());
    }

    /**
     * @author Erik Aybar
     */
    public function clearValidations()
    {
        $this->failed_fields = [];
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

    /**
     * @param $data
     * @return bool
     * @author Erik Aybar
     */
    public function validateNotEmpty($data)
    {
        return !empty($data);
    }

    /**
     * @param $data
     * @return int
     * @author Erik Aybar
     */
    public function validateEmail($data)
    {
        return preg_match('/\w+@\w+\.\w+/', $data);
    }

    /**
     * @param $callable_rule_name
     * @param $field_name
     * @param $data
     * @author Erik Aybar
     */
    public function validateFieldUsingRule($callable_rule_name, $field_name, $data)
    {
        $callable_method = $this->getCallableRuleFromName($callable_rule_name);
        if (!$this->$callable_method($data)) {
            $this->setFieldValidationFailed($field_name, $callable_method);
        }
    }

    /**
     * @param $callable_rule_name
     * @return string
     * @author Erik Aybar
     */
    public function getCallableRuleFromName($callable_rule_name)
    {
        $callable_method = $this->callable_prefix . join('',
            array_map('ucfirst',
                explode('_', $callable_rule_name)
            )
        );

        if (!method_exists($this, $callable_method)) {
            throw new InvalidArgumentException("{$callable_rule_name} method does not exist to validate the {$field_name} field");
        }

        return $callable_method;
    }

    /**
     * @param $field_name
     * @param $callable_method
     * @author Erik Aybar
     */
    public function setFieldValidationFailed($field_name, $callable_method)
    {
        $this->failed_fields[$field_name] = "Failed the " . str_replace('_', ' ', $callable_method) . " validation";
    }
}