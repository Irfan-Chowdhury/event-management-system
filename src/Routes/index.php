<?php

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\EventAttendeeController;
use App\Controllers\EventController;
use App\Controllers\ReportController;
use App\Router;

$router = new Router();

$router->get('/registration', AuthController::class, 'registrationForm');
$router->post('/registration', AuthController::class, 'registration');

$router->get('/login', AuthController::class, 'loginForm');
$router->post('/login', AuthController::class, 'login');
$router->get('/logout', AuthController::class, 'logout');

$router->get('/home', HomeController::class, 'index');

$router->get('/events', EventController::class, 'index');
$router->post('/events/store', EventController::class, 'store');
$router->get('/events/edit', EventController::class, 'edit');
$router->post('/events/update', EventController::class, 'update');
$router->get('/events/delete', EventController::class, 'delete');

$router->get('/event-attendee-reg-form', EventAttendeeController::class, 'index');
$router->post('/event-attendee-reg-store', EventAttendeeController::class, 'store');

$router->get('/reports', ReportController::class, 'index');
$router->post('/reports/download-csv', ReportController::class, 'downloadCSV');


$router->dispatch();