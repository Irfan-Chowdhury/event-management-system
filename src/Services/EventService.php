<?php 

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
        return $this->eventModel->getAll();
    }

    public function dataStore(array $data)
    {
        $dataArr = self::regRequestDataManage($data);

        $dbArr = self::escapeString($dataArr);

        $this->eventModel->insert($dbArr);
    }

    private function regRequestDataManage(array $data): array
    {
        return [
            'title'  => self::requestSanitize($data['title']),
            'user_id'  => 1,
            'description'  => self::requestSanitize($data['description']),
            'date'  => date('Y-m-d', strtotime($data['date'])),
            'venue'  => self::requestSanitize($data['venue']),
            'created_at' => date('Y-m-d H:i:s'),
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