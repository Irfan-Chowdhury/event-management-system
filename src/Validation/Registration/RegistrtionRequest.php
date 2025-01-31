<?php 

namespace App\Validation\Registration;

use App\Models\User;
use App\Traits\CommonValidationTrait;
use Exception;

class RegistrtionRequest
{
    use CommonValidationTrait;

    public static $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function validate(array $data)
    {
        $this->isRequired('name', $data['name']);
        $this->isWordLimit('name', $data['name'], 50);
        $this->isStringWithSpace('name', $data['name']);

        $this->isRequired('email', $data['email']);
        $this->isWordLimit('email', $data['email'], 50);
        $this->isValidEmail($data['email']);
        $this->isEmailExist($data['email']);

        $this->isRequired('password', $data['password']);
        $this->isWordLimit('password', $data['password'], 50);


        $this->isRequired('confirm_password', $data['confirm_password']);
        $this->isWordLimit('confirm_password', $data['confirm_password'], 50);

        $this->isPasswordMatch($data['password'], $data['confirm_password']);
    }

    public function isPasswordMatch($password, $confirmPassword)
    {
        if ($password !== $confirmPassword) {
            throw new Exception("Password does not match", 400);
        }
    }

    public function isEmailExist($email)
    {
        $user = $this->userModel->fetchDataByAttribute('email', $email);
        if ($user) {
            throw new Exception("Email already exist", 400);
        }
    }
}