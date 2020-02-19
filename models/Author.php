<?php
    include_once('models/Connection.php');

    class Author
    {
        var $conn;

        function __construct(){
            $object = new Connection();
            $this->conn = $object->conn;
        }

        function login($email, $password){
            $query = "SELECT * FROM users WHERE email = '" .$email."' AND password = '" .$password. "'";
            $result = $this->conn->query($query)->fetch_assoc();

            if ($result != null) {
                $_SESSION['is_login'] = true;
                $_SESSION['user'] = $result;
                return true;
            } else {
                return false;
            }
        }
    }
?>