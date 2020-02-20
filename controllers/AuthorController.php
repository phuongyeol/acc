<?php
    include_once("models/Author.php");

    class AuthorController
    {
        public $author;
        public function __construct(){
            $this->author = new Author();
        }

        public function login(){
            $result = $this->author->login();
            if ($result == 'accept') {
                include "views/users/account.php";
            } else {
                $msg = "";
                if ($result == 'empty feild') {
                    $msg = "Empty email or password. Please try again!";
                } elseif ($result == 'special characters'){
                    $msg = 'Email special characters not allowed';
                } elseif ($result == 'invalid user') {
                    $msg = "Invalid email and password. Plese try again!";
                }
                // setcookie('msg', $msg);
                include "views/auth/login.php";
            }
        }

        public function insert(){
            $result = $this->author->insert();
            if ($result = 'accept') {
                include "views/auth/login.php";
            } else {

            }
        }
    }
?>