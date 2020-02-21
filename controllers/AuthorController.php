<?php
    include_once PROJECT_ROOT_PATH . "/models/Author.php";

    class AuthorController
    {
        public $author;
        public function __construct(){
            $this->author = new Author();
        }
        public function loginView(){
            include_once "views/auth/login.php";
        }
        public function registerVIew(){
            include_once "views/auth/register.php";
        }
        public function login(){
            $result = $this->author->login();
            if ($result == "accept") {
                header('Location: ?mod=account&act=index');
            } else {
                $msg = "";
                if ($result == "empty feild") {
                    $msg = "Empty email or password. Please try again!";
                } elseif ($result == "invalid email") {
                    $msg = "Email special characters not allowed";
                } elseif ($result == "invalid user") {
                    $msg = "Email or password is incorrect. Plese try again!";
                }
                include "views/auth/login.php";
            }
        }
        
        public function store(){
            $result = $this->author->register();
            if ($result == "success") {
                $notice_success = "Registration successfully completed! Login to start working.";
                include "views/auth/login.php";
            } else {
                $msg = "";

                if ($result == "empty feild") {
                    $msg = "Empty email or password. Please try again!";
                } elseif ($result == "invalid fullname") {
                    $msg = "Fist name and last name mustn't have special characters. Please try again.";
                } elseif ($result == "invalid email") {
                    $msg = "Email special characters not allowed. Please try again.";
                } elseif ($result == "password not match") {
                    $msg = "Password and confirm password not match. Please try again.";
                } elseif ($result == "invalid password") {
                    $msg = "Password must have at least 8 characters. Please try again.";
                } elseif ($result == "already exists") {
                    $msg = "Username or Email already exists. Please try again!";
                }

                include "views/auth/register.php";
            }
        }
    }
?>