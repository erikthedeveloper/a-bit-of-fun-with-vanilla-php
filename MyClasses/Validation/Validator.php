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
        return "Whoops. Looks like " . implode(', ', array_keys($this->failed_fields)) . " were not valid!";
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
        return (bool) preg_match('/\w+@\w+\.\w+/', $data);
    }

    /**
     * @param $callable_rule_name
     * @param $field_name
     * @param $data
     * @author Erik Aybar
     */
    public function validateFieldUsingRule($callable_rule_name, $field_name, $data)
    {
        $callable_method = $this->getCallableMethodFromRule($callable_rule_name);
        $passes = $this->$callable_method($data);
        if (!$passes) {
            $this->setFieldValidationFailed($field_name, $callable_rule_name);
        }
    }

    /**
     * @param $callable_rule_name
     * @return string
     * @author Erik Aybar
     */
    public function getCallableMethodFromRule($callable_rule_name)
    {
        $callable_method = $this->translateRuleNameToMethodName($callable_rule_name);
        if (!method_exists($this, $callable_method)) {
            throw new InvalidArgumentException("{$callable_rule_name} validation message does not exist");
        }
        return $callable_method;
    }

    public function translateRuleNameToMethodName($rule_name)
    {
        $method_name = $this->callable_prefix . join('',
            array_map('ucfirst',
                explode('_', $rule_name)
            )
        );
        return $method_name;
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