<?php 

namespace App\Validation\Login;

use App\Traits\CommonValidationTrait;
use Exception;

class LoginRequest
{
    use CommonValidationTrait;

    public function validate(array $data)
    {
        $this->isRequired('email', $data['email']);
        $this->isWordLimit('email', $data['email'], 50);
        $this->isValidEmail($data['email']);

        $this->isRequired('password', $data['password']);
        $this->isWordLimit('password', $data['password'], 50);
    }
}