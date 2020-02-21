<?php
    include_once PROJECT_ROOT_PATH . "/models/User.php";

    class UserController
    {
        public $user;
        public function __construct(){
            $this->user = new User();
        }
        public function index(){
            // $profile = $this->user->findByEmail();
            include PROJECT_ROOT_PATH . "/views/users/profile.php";
        }
        public function logout(){
            session_destroy();
            header('Location: ?act=login');
        }
        public function register(){
            $result = $this->user->register();
            if ($result == "success") {
                include "views/auth/login.php";
            } else {
                $msg = "";

                if ($result == "empty feild") {
                    $msg = "Empty email or password. Please try again!";
                } elseif ($result == "invalid fullname") {
                    $msg = "Fist name and last name mustn't have special characters. Please tray again.";
                } elseif ($result == "invalid email") {
                    $msg = "Email special characters not allowed. Please tray again.";
                } elseif ($result == "password not match") {
                    $msg = "Password and confirm password not match. Please tray again.";
                } elseif ($result == "already exists") {
                    $msg = "Username or Email already exists. Please try again!";
                }

                include "views/auth/register.php";
            }
        }
    }
?>