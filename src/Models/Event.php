<?php

namespace App\Models;

class Event extends Model
{
    public $table = 'events';

    public function mysqliRealEscapeString($value)
    {
        return mysqli_real_escape_string($this->db->link, $value);
    }
}