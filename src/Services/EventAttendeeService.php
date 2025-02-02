<?php 

declare(strict_types=1);

namespace App\Services;

use App\Models\Event;
use App\Models\EventAttendeeRegistration;
use App\Models\User;
use Exception;

class EventAttendeeService 
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

    public function eventAttendeeRegister(array $data)
    {
        $this->isEventCapacityFull($data);

        $getUserId = self::userSaveAndReturnId($data);

        self::isUserApplyForSameEvent( $data['event_id'], $getUserId);

        self::dataSaveForInEventAttendeeRegistration((int) $data['event_id'], (int) $getUserId);   
    }

    private function isEventCapacityFull(array $data)
    {
        $getEventAttendees = $this->evenAttendeeRegistrationtModel->getAllBySingleAttribute('event_id', $data['event_id']);
        
        $getSingleEventData = $this->eventModel->getById($data['event_id']);
        
        if ($getEventAttendees && ($getSingleEventData['capacity'] === count($getEventAttendees))) {
            throw new Exception("This event capacity is full", 400);
        }
    }

    private function userSaveAndReturnId(array $data): int
    {
        $existUser = $this->userModel->findDataByAttribute('email', $data['email']);
        
        if (!$existUser) {
            $userDataArr = self::userRequestManage($data);        
            $userDbArr = self::escapeString($userDataArr, $this->userModel);
            $getUserId = $this->userModel->insert($userDbArr);   
        } 
        else{
            $getUserId = $existUser['id'];
        }

        return $getUserId;
    }

    private function isUserApplyForSameEvent($eventId, $userId)
    {
        $isUserApplyForSameEvent = $this->evenAttendeeRegistrationtModel->findDataByTwoAttributes('event_id', 'user_id', $eventId, $userId);
        
        if ($isUserApplyForSameEvent) {
            throw new Exception("You have already applied for this event", 400);
        }
    }

    private function dataSaveForInEventAttendeeRegistration(int $eventId, int $getUserId)
    {
        $eventDataArr = self::eventRequestManage($eventId, $getUserId);        
        $eventDbArr = self::escapeString($eventDataArr, $this->evenAttendeeRegistrationtModel);
        $this->evenAttendeeRegistrationtModel->insert($eventDbArr);   
    }

    private function eventRequestManage(int $eventId, int $userId)
    {
        return [
            'event_id'  => $eventId,
            'user_id'  => $userId,
            'created_at' => date('Y-m-d H:i:s'),
        ];
    }

    private function userRequestManage(array $data)
    {
        return [
            'name'  => self::requestSanitize($_POST['name']),
            'email'  => self::requestSanitize($_POST['email']),
            'phone'  => self::requestSanitize($_POST['phone']),
            'address'  => self::requestSanitize($_POST['address']),
            'role'  => 'attendee',
        ];
    }

    private function requestSanitize(string $value) 
    {
        $inputData = trim($value);
        
        $inputData = stripcslashes($inputData);
        
        $result = htmlspecialchars($inputData);
        
        return $result;
    }

    private function escapeString(array $data, $getModel) : array
    {
        $dbArr = [];
        foreach ($data as $key => $value) {
            $dbArr[$key] = $getModel->mysqliRealEscapeString($value);
        }

        return $dbArr;
    }
}