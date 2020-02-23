<?php
    include_once "models/Connection.php";

    class Author
    {
        public $author_conn;

        public function __construct(){
            $author_conn = new Connection;
            $this->author_conn = $author_conn->conn;
        }

        public function findByEmail($email){
            $stmt = $this->author_conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }
    }
?>