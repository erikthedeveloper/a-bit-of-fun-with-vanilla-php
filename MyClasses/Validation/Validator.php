<?php

namespace MyClasses\Validation;

/**
 * Class Validator
 * @package MyClasses\Validation
 * @author  Erik Aybar
 */
class Validator {

    /**
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
                $this->failed_fields[] = $key;
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
            redirect_user($destination, "Whoops. Looks like you forgot to fill in " . implode(', ', $this->failed_fields) . "!");
        }
    }

}