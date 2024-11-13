<?php

namespace App\Core;

class Vaildation
{
    private const DEFAULT_VALIDATION_ERRORS = [
        'required' => 'Please Enter the %s',
        'email' => 'The %s is not a valid Email address',
        'min' => 'The %s must have at least %s characters',
        'max' => 'The %s must have at most %s characters',
        'between' => 'The %s must have between %d and %d characters',
        'same' => 'The %s must match with %s',
        'alphanumeric' => 'The %s should have only letters and numbers',
        'secure' => 'The %s must have between 8 and 64 characters and contain at least one number, one upper case letter, one lower case letter and one special character',
        'unique' => 'The %s already exists',

        'required_file' => 'Please upload a %s',
        'image' => 'The uploaded %s must be an image file (e.g., .jpg, .png)',
        'max_size' => 'The %s exceeds the maximum allowed size of %d MB',
        'allowed_types' => 'The %s must be of type: %s'

    ];

    public function validate($fields, $data)
    {
        $errors = [];
        $split = fn($str, $separator) => array_map('trim', explode($separator, $str));

        foreach ($fields as $field => $option) {
            $rules = $split($option, '|');
            foreach ($rules as $rule) {
                $params = [];
                if (strpos($rule, ':')) {
                    [$rule_name, $param_str] = $split($rule, ":");
                    $params = $split($param_str, ',');
                } else {
                    $rule_name = trim($rule);
                }
                $fn = 'is_' . $rule_name;

                if (is_callable([$this, $fn])) {
                    $pass = $this->$fn($data, $field, ...$params);
                    if (!$pass) {
                        $errors[$field] = sprintf(self::DEFAULT_VALIDATION_ERRORS[$rule_name], $field, ...$params);
                    }
                }
            }
        }
        if (!empty($errors)) {
            $this->sendErrorsToView($errors);
            return null;
        }
        return $data;
    }
    // validate files

    public function validateFiles($fields, $data)
    {

        $errors = [];
        $split = fn($str, $separator) => array_map('trim', explode($separator, $str));

        foreach ($fields as $field => $option) {
            $rules = $split($option, '|');
            foreach ($rules as $rule) {
                $params = [];
                if (strpos($rule, ':')) {
                    [$rule_name, $param_str] = $split($rule, ":");
                    $params = $split($param_str, ',');
                } else {
                    $rule_name = trim($rule);
                }
                $fn = 'is_' . $rule_name;

                if (is_callable([$this, $fn])) {
                    $pass = $this->$fn($data, $field, ...$params);
                    if (!$pass) {
                        $errors[$field] = sprintf(self::DEFAULT_VALIDATION_ERRORS[$rule_name], $field, ...$params);
                    }
                }
            }
        }
        if (!empty($errors)) {
            $this->sendErrorsToView($errors);
            return null;
        }
        return $data;
    }
    //rules 

    public function is_required(array $data, string $field): bool
    {
        if (isset($_FILES[$field])) {
            $file = $_FILES[$field];
            return isset($file['name']) && !empty($file['name']);
        }
        return isset($data[$field]) && trim($data[$field]) !== '';
    }

    public function is_email(array $data, string $field): bool
    {
        if (empty($data[$field])) {
            return true;
        }
        return filter_var($data[$field], FILTER_VALIDATE_EMAIL);
    }
    public function is_min(array $data, string $field, int $min): bool
    {
        if (!isset($data[$field])) {
            return true;
        }
        return strlen($data[$field]) >= $min;
    }
    public function is_max(array $data, string $field, int $max): bool
    {
        if (!isset($data[$field])) {
            return true;
        }
        return strlen($data[$field]) <= $max;
    }
    public function is_alphanumeric(array $data, string $field): bool
    {
        if (!isset($data[$field])) {
            return true;
        }
        return ctype_alnum($data[$field]);
    }

    public function is_same(array $data, string $field, string $other): bool
    {
        if (isset($data[$field], $data[$other])) {
            return $data[$field] === $data[$other];
        }

        if (!isset($data[$field]) && !isset($data[$other])) {
            return true;
        }

        return false;
    }
    public function is_secure(array $data, string $field): bool
    {
        if (!isset($data[$field])) {
            return false;
        }

        $pattern = "#.*^(?=.{8,64})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#";
        return preg_match($pattern, $data[$field]);
    }
    // rules files
    public function is_image(array $data, string $field): bool
    {
        if (isset($data[$field]) && isset($data[$field]['tmp_name']) && !empty($data[$field]['tmp_name'])) {
            $file = $data[$field];
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $fileMiemType = mime_content_type($file['tmp_name']);
            if (in_array($fileMiemType, $allowedMimeTypes)) {
                return true;
            }
        }
        return false;
    }

    private function sendErrorsToView($errors)
    {
        $_SESSION['errors'] = $errors;
    }
}
