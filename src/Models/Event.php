<?php

namespace App\Models;

class Event extends Model
{
    public $table = 'events';

    public function mysqliRealEscapeString($value)
    {
        return mysqli_real_escape_string($this->db->link, $value);
    }

    // public function getAttendeesByEventId($eventId)
    // {
    //     $query = "
    //         SELECT users.id, users.name, users.email, users.phone, users.address
    //         FROM $this->table 
    //         JOIN users ON users.id = $this->table.user_id
    //         WHERE $this->table.event_id = ?
    //     ";

    //     $result = $this->db->select($query, [$eventId], "i");

    //     return $result;
    // }

    public function totalAttendees($eventId)
    {
        $query = "
            SELECT COUNT(*) as attendee_count
            FROM event_attendee_registrations
            JOIN users ON users.id = event_attendee_registrations.user_id
            WHERE event_attendee_registrations.event_id = ?
        ";

        $result = $this->db->select($query, [$eventId], "i");

        $attendeeCount = $result[0]['attendee_count'] ?? 0;

        return $attendeeCount;
    }
}