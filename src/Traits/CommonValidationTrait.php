<?php

declare(strict_types=1);

namespace App\Traits;

use Exception;

trait CommonValidationTrait
{
    public function isRequired(string $key, $value)
    {
        if (empty($value)) {
            throw new Exception("$key field is Required", 400);
        }
    }

    public function isRequiredArray(string $key, $value)
    {
        if (!isset($_POST['items']) || !is_array($_POST['items']) || count(array_filter($_POST['items'], 'strlen')) === 0) {            
            throw new Exception("$key field is Required", 400);
        }
    }

    public function isTextSpaceNumberCheck(string $key, string $value)
    {
        $pattern = '/^[a-zA-Z0-9 ]+$/';

        if (!preg_match($pattern, $value)) {
            throw new Exception("$key invalid data input", 400);
        }
    }

    public function isWordLimit(string $key, string $value, $wordLimitMax)
    {
        if (strlen($value) > $wordLimitMax) {
            throw new Exception("$key data must be $wordLimitMax characters or less.", 400);
        }
    }

    public function isStringWithSpace(string $key, $value)
    {
        if (!preg_match('/^[a-zA-Z\s]+$/', $value)) { 
            throw new Exception("$key must be text", 400);
        }
    }

    public function isValidEmail(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email", 400);
        }
    }

    public function isValidNumber(string $key, int $value)
    {
        if (!is_numeric($value)) {
            throw new Exception("$key must be number", 400);
        }
    }


}
