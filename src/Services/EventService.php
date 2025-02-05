<?php 

declare(strict_types=1);

namespace App\Services;

use App\Models\Event;

class EventService 
{
    public static $eventModel;

    public function __construct()
    {
        $this->eventModel = new Event();
    }

    public function getAllEvents(): array|bool
    {
        $allEvents = $this->eventModel->getAll();

        foreach ($allEvents as &$event) {
            $event['total_attendee'] = $this->eventModel->totalAttendees($event['id']);
        }

        return $allEvents;
    }

    public function dataStore(array $data)
    {
        $dataArr = self::regRequestDataManage($data);

        $dbArr = self::escapeString($dataArr);

        $this->eventModel->insert($dbArr);
    }
    public function getEventDataById(int $id)
    {
        return $this->eventModel->getById($id);
    }

    public function dataUpdate(array $data)
    {
        $dataArr = self::regRequestDataManage($data);

        unset($data['created_at']);

        $dbArr = self::escapeString($dataArr);

        $this->eventModel->update($dbArr, $data['id']);
    }

    public function dataDelete(int $id)
    {
        $this->eventModel->delete($id);
    }

    private function regRequestDataManage(array $data): array
    {
        return [
            'title'  => self::requestSanitize($data['title']),
            'user_id'  => $_SESSION['user']['id'],
            'description'  => self::requestSanitize($data['description']),
            'date'  => date('Y-m-d', strtotime($data['date'])),
            'venue'  => self::requestSanitize($data['venue']),
            'created_at' => date('Y-m-d H:i:s'),
            'capacity' => (int) $data['capacity'],
        ];
    }

    private function requestSanitize(string $value) 
    {
        $inputData = trim($value);
        
        $inputData = stripcslashes($inputData);
        
        $result = htmlspecialchars($inputData);
        
        return $result;
    }

    private function escapeString(array $data) : array
    {
        $dbArr = [];
        foreach ($data as $key => $value) {
            $dbArr[$key] = $this->eventModel->mysqliRealEscapeString($value);
        }

        return $dbArr;
    }
}