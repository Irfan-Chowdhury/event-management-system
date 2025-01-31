<?php

namespace App\Models;

class Order extends Model
{
    public $table = 'orders';   

    public function mysqliRealEscapeString($value)
    {
        return mysqli_real_escape_string($this->db->link, $value);
    }
}