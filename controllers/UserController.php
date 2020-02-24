<?php
    include_once PROJECT_ROOT_PATH . "/models/User.php";

    class UserController
    {
        public $user;
        public function __construct(){
            $this->user = new User();
        }
    }
?>