<?php
    include_once("models/User.php");

    class LoginController
    {
        public $user;
        public function __construct(){
            $this->user = new User();
        }
        public function login(){
            $reslt = $this->user->login();
            if ($reslt == 'login') {
                include "views/users/account.php";
            } else {
                include "views/auth/login.php";
            }
        }
    }
?>