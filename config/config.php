<?php

error_reporting(0);

/* DECLARING DATABASE PARAMETERS */
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','user_auth');

class  config{
    protected $conn;

    function db_connection(){
        $this->conn  = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if($this->conn->connect_error) die("Error");
        return $this->conn;

    }
    function quit_connection(){
        $end = $this->conn;
        mysqli_close($end);
        return;
    }
}

?>