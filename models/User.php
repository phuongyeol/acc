<?php
    include_once "models/Connection.php";

    class User
    {
        public $user_conn;

        public function __construct()
        {
            $user_conn = new Connection;
            $this->user_conn = $user_conn->conn;
        }

        // public function findByEmail($email) 
        // {
        //     $stmt = $this->user_conn->prepare("SELECT * FROM users WHERE email = :email");
        //     $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        //     $stmt->execute();

        //     $user = $stmt->fetch(PDO::FETCH_ASSOC);
        //     $user[] = $user;
        //     return $user;
        // }
    }
?>