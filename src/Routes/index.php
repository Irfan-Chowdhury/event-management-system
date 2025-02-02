<?php

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\EventController;
use App\Router;

$router = new Router();

$router->get('/registration', AuthController::class, 'registrationForm');
$router->post('/registration', AuthController::class, 'registration');

$router->get('/login', AuthController::class, 'loginForm');
$router->post('/login', AuthController::class, 'login');


$router->get('/events', EventController::class, 'index');
$router->post('/events/store', EventController::class, 'store');
$router->get('/events/edit', EventController::class, 'edit');
$router->post('/events/update', EventController::class, 'update');
$router->get('/events/delete', EventController::class, 'delete');


$router->get('/', HomeController::class, 'index');
$router->get('/create', HomeController::class, 'create');
$router->post('/store', HomeController::class, 'store');
$router->get('/filter-by-date', HomeController::class, 'filterByDate');

$router->dispatch();