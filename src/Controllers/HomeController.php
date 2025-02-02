<?php

namespace App\Controllers;

use App\Controller;
use Exception;

class HomeController extends Controller
{

    public function __construct()
    {
        session_start(); 
        self::isAuthenticated();
    }

    private function isAuthenticated()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
    }

    public function index()
    {
        $this->render('home/index');
    }
}
