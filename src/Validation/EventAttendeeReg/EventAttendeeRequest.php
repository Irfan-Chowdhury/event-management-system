<?php 

namespace App\Validation\EventAttendeeReg;

use App\Models\User;
use App\Traits\CommonValidationTrait;
use Exception;

class EventAttendeeRequest
{
    use CommonValidationTrait;

    public static $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function validate(array $data)
    {
        $this->isRequired('name', $data['name']);
        $this->isWordLimit('name', $data['name'], 50);

        $this->isRequired('email', $data['email']);
        $this->isValidEmail($data['email']);
        // $this->isEmailExist($data['email']);

        $this->isRequired('event_id', $data['event_id']);
    
        $this->isRequired('phone', $data['phone']);
    
        $this->isRequired('address', $data['address']);
        $this->isWordLimit('address', $data['address'], 500);
    }

    public function isEmailExist($email)
    {
        $user = $this->userModel->findDataByAttribute('email', $email);
        if ($user) {
            throw new Exception("Email already exist", 400);
        }
    }
}