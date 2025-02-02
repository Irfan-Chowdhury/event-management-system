<?php

namespace App\Models;

class EventAttendeeRegistration extends Model
{
    public $table = 'event_attendee_registrations';   

    public function mysqliRealEscapeString($value)
    {
        return mysqli_real_escape_string($this->db->link, $value);
    }
}