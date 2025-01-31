<?php

namespace App\Models;

class User extends Model
{
    public $table = 'users';

    public function mysqliRealEscapeString($value)
    {
        return mysqli_real_escape_string($this->db->link, $value);
    }
}