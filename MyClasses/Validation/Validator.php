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
     * @param array $rules
     * @param array $data
     * @return $this
     * @author Erik Aybar
     */
    public function validate(array $rules, array $data)
    {
        foreach ($rules as $field_name => $rule_names) {
            foreach ($rule_names as $rule_name) {
                /* @throws InvalidArgumentException */
                $this->validateFieldUsingRuleNameOrClosure($data, $rule_name, $field_name);
            }
        }
        return $this;
    }

    /**
     * @param array $data
     * @param       $rule_name
     * @param       $field_name
     * @throws InvalidArgumentException
     * @author Erik Aybar
     */
    public function validateFieldUsingRuleNameOrClosure(array $data, $rule_name, $field_name)
    {
        if (is_callable($rule_name)) {
            $passes    = $rule_name($data[$field_name]);
            $rule_name = 'custom validation';
        } else {
            /* @throws InvalidArgumentException */
            $method_name = $this->getCallableMethodFromRuleName($rule_name);
            $passes      = $this->$method_name($data[$field_name]);
        }

        if (!$passes) {
            $this->addFailedFieldValidation($rule_name, $field_name);
        }
    }

    /**
     * @param $rule_name
     * @return string
     * @throws InvalidArgumentException
     * @author Erik Aybar
     */
    public function getCallableMethodFromRuleName($rule_name)
    {
        $method_name = $this->translateRuleNameToMethodName($rule_name);
        if (!method_exists($this, $method_name)) {
            throw new InvalidArgumentException("{$rule_name} validation message does not exist");
        }
        return $method_name;
    }

    /**
     * @param $rule_name
     * @return string
     * @author Erik Aybar
     */
    public function translateRuleNameToMethodName($rule_name)
    {
        $method_name = $this->callable_prefix . join(
                '',
                array_map(
                    'ucfirst',
                    explode('_', $rule_name)
                )
            );
        return $method_name;
    }

    /**
     * @param $rule_name
     * @param $field_name
     * @author Erik Aybar
     */
    public function addFailedFieldValidation($rule_name, $field_name, $message = null)
    {
        $this->failed_fields[$field_name] = $message ? $message : "Failed the " . str_replace('_', ' ', $rule_name) . " validation";
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
     * @return bool
     * @author Erik Aybar
     */
    public function hasErrors()
    {
        return count($this->failed_fields) > 0;
    }

    public function getError($field_name)
    {
        if (!array_key_exists($field_name, $this->failed_fields)) {
            return false;
        }
        return $this->failed_fields[$field_name];
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
        return (bool)preg_match('/\w+@\w+\.\w+/', $data);
    }

    public function validateImageUploadFile(array $file)
    {
        $file_validation_message = 'File validation failed.';

        if (!in_array($file['type'], ['image/png', 'image/jpg', 'image/jpeg'])) {
            $file_validation_message .= ' Invalid file type.';
        }
        if ($file['size'] > 2000000) {
            $file_validation_message .= " File too large.";
        }

        if (
            !in_array($file['type'], ['image/png', 'image/jpg', 'image/jpeg'])
            ||
            $file['size'] > 2000000
        ) {
            $this->addFailedFieldValidation('image_upload_file', 'upload_image', $file_validation_message);
            return false;
        };
        return true;
    }
}