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
        foreach ($rules as $i => $j) {
            foreach ($j as $k) {

                if (is_callable($k)) {
                    $passes    = $k($data[$i]);
                    $k = 'custom validation';
                } else {
                    $method_name = $this->callable_prefix . join(
                            '',
                            array_map(
                                'ucfirst',
                                explode('_', $k)
                            )
                        );
                    if (!method_exists($this, $method_name)) {
                        throw new InvalidArgumentException("{$k} validation message does not exist");
                    }
                    $passes = $this->$method_name($data[$i]);
                }

                if (!$passes) {
                    $this->failed_fields[$i] = "Failed the " . str_replace('_', ' ', $k) . " validation";
                }
            }
        }
        return $this;
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
}