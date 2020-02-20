<?php
    include_once("models/Connection.php");

    class User
    {
        public $user_conn;

        public function __construct(){
            $user_conn = new Connection;
            $this->user_conn = $user_conn->conn;
        }
    }
?>