<?php

namespace App\Services;

use App\Models\User;

class AuthService 
{
    public static $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login(array $data): array|bool
    {
        $email = self::requestSanitize($data['email']);
        $password = $data['password'];

        $user = $this->userModel->fetchDataByAttribute('email',$email);
        
        // echo "<pre>";
        // print_r($user);
        // echo "</pre>";
        // return;

        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }

    private function regRequestDataManage(array $data)
    {
        return [
            'name'  => self::requestSanitize($_POST['name']),
            'email'  => self::requestSanitize($_POST['email']),
            'password'  => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ];
    }

    private function requestSanitize(string $value) 
    {
        // Step 1: Trim whitespace from the beginning and end
        $inputData = trim($value);
        
        // Step 2: Remove backslashes
        $inputData = stripcslashes($inputData);
        
        // Step 3: Convert special characters to HTML entities
        $result = htmlspecialchars($inputData);
        
        return $result;
    }

    private function escapeString(array $data) : array
    {
        $dbArr = [];
        foreach ($data as $key => $value) {
            $dbArr[$key] = $this->userModel->mysqliRealEscapeString($value);
        }

        return $dbArr;
    }

}