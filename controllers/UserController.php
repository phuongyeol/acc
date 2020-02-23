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
    }
?>