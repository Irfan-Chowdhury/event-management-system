<?php

namespace App\Controllers;

use App\Controller;
use App\Services\AuthService;
use App\Services\EventAttendeeService;
use App\Services\EventService;
use App\Validation\ValidationManager;
use Exception;

class EventAttendeeController extends Controller
{

    public static $eventService;

    public static $validationManager;

    public static $eventAttendeeService;

    public function __construct()
    {
        $this->eventService = new EventService();
        $this->validationManager = new ValidationManager();
        $this->eventAttendeeService = new EventAttendeeService();
    }

    public function index()
    {
        $getEvents = $this->eventService->getAllEvents();

        $this->render('event-attendee/index', ['getEvents' => $getEvents]);
    }

    public function store()
    {
        session_start(); 

        try {
            $this->validationManager->eventAttendeeRegValidation($_POST);

            $this->eventAttendeeService->eventAttendeeRegister($_POST);

            $_SESSION['success_message'] = 'Data submitted successfully';

        } catch (Exception $exception) {

            $_SESSION['error_message'] = $exception->getMessage();
        }


        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); // Prevent caching issues
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
