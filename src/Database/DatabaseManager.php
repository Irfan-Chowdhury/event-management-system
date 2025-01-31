<?php

namespace App\Database;

use mysqli;

$filepath = realpath(dirname(__FILE__));

include_once ($filepath.'/../../config/config.php');

class DatabaseManager
{
    public $host   = DB_HOST;
    public $user   = DB_USER;
    public $pass   = DB_PASS;
    public $dbname = DB_NAME;

    
    public $link;
    public $error;
    
    public function __construct(){
      $this->connectDB();
    }
    
    private function connectDB()
    {
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if(!$this->link) {
          $this->error ="Connection fail".$this->link->connect_error;
          return false;
        }
    }
  
    public function select($query, $params = [], $types = "")
  {
      $stmt = $this->link->prepare($query);
      
      if ($params) {
          $stmt->bind_param($types, ...$params);
      }
      
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
          $data = [];
          while ($row = $result->fetch_assoc()) {
              $data[] = $row;
          }
          return $data;
      } else {
          return false;
      }
  }
   

    public function insert($query, $params = [], $types = "")
    {
        $stmt = $this->link->prepare($query);
        
        if ($params) {
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}