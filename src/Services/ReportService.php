<?php 

declare(strict_types=1);

namespace App\Services;

use App\Models\Event;
use App\Models\EventAttendeeRegistration;
use App\Models\User;

class ReportService 
{
    public static $eventModel;
    public static $userModel;
    public static $evenAttendeeRegistrationtModel;

    public function __construct()
    {
        $this->eventModel = new Event();
        $this->userModel = new User();
        $this->evenAttendeeRegistrationtModel = new EventAttendeeRegistration();
    }

    public function CSVDownload(int $eventId)
    {
        $getAttendeesList = $this->evenAttendeeRegistrationtModel->getAttendeesByEventId($eventId);
        $filename = "event_$eventId" . '.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['Id', 'Name', 'Email', 'Phone', 'Address']);
        foreach ($getAttendeesList as $eventAttendee) {
            fputcsv($handle, [$eventAttendee['id'], $eventAttendee['name'], $eventAttendee['email'], $eventAttendee['phone'], $eventAttendee['address']]);
        }

        fclose($handle);

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        readfile($filename);
        unlink($filename);
    }
}