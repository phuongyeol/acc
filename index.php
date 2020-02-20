<?php
    // Default date
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    include_once("controllers/Auth/LoginController.php");
    $controller = new LoginController();
    $controller->login();
?>