<?php

namespace MyClasses\Validation;

/**
 * Class Validator
 * @package MyClasses\Validation
 * @author  Erik Aybar
 */
class Validator {

    protected $failed_fields = [];

    /**
     * @param $rules
     * @param $data
     * @return bool
     * @author Erik Aybar
     */
    public function validate($rules, $data) {
        foreach ($rules as $key => $pattern) {
            if (!preg_match($pattern, $data[$key])) {
                $this->failed_fields[$key] = ucfirst(str_replace('_', ' ', $key)) . " failed!";
            }
        }

        $is_valid = count($this->failed_fields) == 0;
        return $is_valid;
    }

    /**
     * @param $destination
     * @author Erik Aybar
     */
    public function redirectIfFailed($destination){
        if (count($this->failed_fields)) {
            redirect_with_message($destination, $this->getValidationSummaryMessage());
        }
    }

    /**
     * @param $destination
     * @author Erik Aybar
     */
    public function redirectWithErrorsIfFailed($destination){
        if (count($this->failed_fields)) {
            $flash = [
                'message' => $this->getValidationSummaryMessage(),
                'errors' => $this->failed_fields,
                'input' => $_POST // TODO: bad!!!!
            ];
            redirect_with_flash_array($destination, $flash);
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
}