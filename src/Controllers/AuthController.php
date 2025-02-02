<?php

namespace App\Controllers;

use App\Controller;
use App\Services\AuthService;
use App\Validation\ValidationManager;
use Exception;

class AuthController extends Controller
{
    public static $validationManager;

    public static $authService;

    public function __construct()
    {

        $this->validationManager = new ValidationManager();
        $this->authService = new AuthService();
    }

    private function isAuthenticated()
    {
        if (isset($_SESSION['user'])) {
            header("Location: /home");
            exit;
        }
    }

    public function registrationForm()
    {
        session_start(); 
        self::isAuthenticated(); 

        return $this->render('auth/registration');
    }

    public function registration()
    {
        session_start(); 

        try {
            $this->validationManager->registrationValidation($_POST);

            $this->authService->register($_POST);

            $_SESSION['success_message'] = 'Data submitted successfully';

        } catch (Exception $exception) {
            $_SESSION['error_message'] = $exception->getMessage();
        }


        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); // Prevent caching issues
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function loginForm()
    {
        session_start(); 
        self::isAuthenticated(); 

        return $this->render('auth/login');
    }

    public function login()
    {
        session_start();

        try {
            $this->validationManager->loginValidation($_POST);

            $user = $this->authService->login($_POST);

            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: /home");
                exit;
            } else {
                throw new Exception("Invalid email or password");
            }
        } catch (Exception $exception) {
            $_SESSION['error_message'] = $exception->getMessage();
        }

        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); // Prevent caching issues
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: /login");
        exit;
    }
}