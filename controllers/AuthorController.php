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
            if ($result == "accept") {
                include "views/users/account.php";
            } else {
                $msg = "";
                if ($result == 'empty feild') {
                    $msg = "Empty email or password. Please try again!";
                } elseif ($result == 'invalid email'){
                    $msg = "Email special characters not allowed";
                } elseif ($result == 'invalid user') {
                    $msg = "Invalid email and password. Plese try again!";
                }
                // setcookie('msg', $msg);
                include "views/auth/login.php";
            }
        }
        public function register(){
            $result = $this->author->register();
            if ($result == "success") {
                include "views/auth/login.php";
            } else {
                $msg = "";

                if ($result == 'empty feild') {
                    $msg = "Empty email or password. Please try again!";
                } elseif ($result == 'invalid fullname'){
                    $msg = "Fist name and last name mustn't have special characters. Please tray again.";
                } elseif ($result == 'nvalid email') {
                    $msg = "Email special characters not allowed. Please tray again.";
                } elseif ($result == 'password not match') {
                    $msg = "Password and confirm password not match. Please tray again.";
                } elseif ($result == 'already exists') {
                    $msg = "Username or Email already exists. Please try again!";
                }

                include "views/auth/register.php";
            }
        }
    }
?>