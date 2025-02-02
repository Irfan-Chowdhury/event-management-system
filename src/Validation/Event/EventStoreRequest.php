<?php 

declare(strict_types=1);

namespace App\Validation\Event;

use App\Models\Event;
use App\Traits\CommonValidationTrait;
use Exception;

class EventStoreRequest
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
        $this->isTitleUnique($data['title']);

        $this->isRequired('description', $data['description']);
        $this->isWordLimit('description', $data['description'], 500);

        $this->isRequired('date', $data['date']);

        $this->isRequired('venue', $data['venue']);
        $this->isStringWithSpace('venue', $data['venue']);

        $this->isRequired('capacity', $data['capacity']);
        $this->isValidNumber('capacity', (int)$data['capacity']);

    }

    public function isTitleUnique($title)
    {
        $user = $this->eventModel->findDataByAttribute('title', $title);
        if ($user) {
            throw new Exception("Title already exist", 400);
        }
    }
}