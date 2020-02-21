<?php
    include_once("models/User.php");

    class UserController
    {
        public $user;
        public function __construct(){
            $this->user = new User();
        }
        public function index(){
            include_once 'views/users/account.php';
        }
        public function register(){
            $result = $this->user->register();
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