<?php

namespace App\Controllers;

use App\Controller;
use App\Services\EventService;
use App\Validation\ValidationManager;
use Exception;

class EventController extends Controller
{
    public static $validationManager;
    public static $eventService;

    public function __construct()
    {
        $this->validationManager = new ValidationManager();
        $this->eventService = new EventService();
    }

    public function index()
    {
        $getEvents = $this->eventService->getAllEvents();

        // echo "<pre>";
        // print_r($getEvents);
        // echo "</pre>";
        // return;

        $this->render('events/index', ['getEvents' => $getEvents]);
    }

    public function store()
    {
        $this->setAjaxHeaders();

        try {
            $this->validationManager->eventStoreValidation($_POST);

            $this->eventService->dataStore($_POST);

            echo json_encode(["message" => "Event created successfully"]);
            http_response_code(200); // HTTP 200: OK
            exit;

        } catch (Exception $exception) {

            http_response_code(400); // HTTP 400: Bad Request
            echo json_encode(["error" => $exception->getMessage()]);
            exit;
            
        }
    }

    private function setAjaxHeaders()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
    }
}
