<?php

declare(strict_types=1);

namespace App\Validation;

use App\Validation\Event\EventStoreRequest;
use App\Validation\Event\EventUpdateRequest;
use App\Validation\EventAttendeeReg\EventAttendeeRequest;
use App\Validation\Login\LoginRequest;
use App\Validation\Registration\RegistrtionRequest;
use Exception;

class ValidationManager
{

    public $registrtionRequest;
    public $loginRequest;
    public $eventStoreRequest;
    public $eventUpdateRequest;
    public $eventAttendeeRequest;

    public function __construct()
    {
        $this->registrtionRequest = new RegistrtionRequest();
        $this->loginRequest = new LoginRequest();
        $this->eventStoreRequest = new EventStoreRequest();
        $this->eventUpdateRequest = new EventUpdateRequest();
        $this->eventAttendeeRequest = new EventAttendeeRequest();
    }

    public function registrationValidation(array $data)
    {
        $this->registrtionRequest->validate($data);
    }

    public function loginValidation(array $data)
    {
        $this->loginRequest->validate($data);
    }

    public function eventStoreValidation(array $data)
    {
        $this->eventStoreRequest->validate($data);
    }

    public function eventUpdateValidation(array $data)
    {
        $this->eventUpdateRequest->validate($data);
    }

    public function eventAttendeeRegValidation(array $data)
    {
        $this->eventAttendeeRequest->validate($data);
    }
}