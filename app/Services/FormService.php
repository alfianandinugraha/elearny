<?php

namespace App\Services;

class FormService
{
    private $errors;

    public function __construct($errors) {
        $this->errors = $errors;
    }

    /**
     * Get initial value from session or default value
     */
    public function value(string $name, $defaultValue) {
        return $this->errors->first($name) || old($name) ? old($name) : $defaultValue;
    }
}
