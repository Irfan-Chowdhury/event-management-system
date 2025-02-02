<?php

namespace App\Controllers;

use App\Controller;
use Exception;

class HomeController extends Controller
{


    public function landingPage()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
    }

    public function index()
    {
        session_start(); 
        self::isAuthenticated();

        $this->render('home/index');
    }

    private function isAuthenticated()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
    }
}
