<?php 

namespace App\Validation\Event;

use App\Models\Event;
use App\Traits\CommonValidationTrait;
use Exception;

class EventUpdateRequest
{
    use CommonValidationTrait;

    public static $eventModel;

    public function __construct()
    {
        $this->eventModel = new Event();
    }

    public function validate(array $data)
    {
        $this->isRequired('title', $data['title']);
        $this->isWordLimit('title', $data['title'], 50);
        $this->isStringWithSpace('title', $data['title']);
        // $this->isTitleUnique( $data['id'], $data['title']);

        $this->isRequired('description', $data['description']);
        $this->isWordLimit('description', $data['description'], 500);
        $this->isStringWithSpace('description', $data['description']);

        $this->isRequired('date', $data['date']);

        $this->isRequired('venue', $data['venue']);
        $this->isStringWithSpace('venue', $data['venue']);
    }

    public function isTitleUnique($id, $title)
    {
        $user = $this->eventModel->getById($id);
        if (!$user && $user['title'] !== $title) {
            $checkOnOther = $this->eventModel->fetchDataByAttribute('title', $title);
            if ($checkOnOther) {
                throw new Exception("Title already exist", 400);
            }
        }
    }
}