<?php

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Router;

$router = new Router();

$router->get('/registration', AuthController::class, 'registrationForm');
$router->post('/registration', AuthController::class, 'registration');

$router->get('/login', AuthController::class, 'loginForm');
$router->post('/login', AuthController::class, 'login');

$router->get('/', HomeController::class, 'index');
$router->get('/create', HomeController::class, 'create');
$router->post('/store', HomeController::class, 'store');
$router->get('/filter-by-date', HomeController::class, 'filterByDate');

$router->dispatch();