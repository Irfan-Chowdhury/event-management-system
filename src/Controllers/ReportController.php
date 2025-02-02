<?php

namespace App\Controllers;

use App\Controller;
use App\Services\EventService;
use App\Services\ReportService;

class ReportController extends Controller
{

    public static $eventService;

    public static $reportService;

    public function __construct()
    {
        $this->eventService = new EventService();
        $this->reportService = new ReportService();
    }

    public function index()
    {
        $getEvents = $this->eventService->getAllEvents();

        $this->render('report/index', ['getEvents' => $getEvents]);
    }

    public function downloadCSV()
    {
        $this->reportService->CSVDownload((int) $_POST['event_id']);
    }

}
