<?php
    // Default date
    date_default_timezone_set("Asia/Ho_Chi_Minh");

    // Include controllers
    include_once("controllers/AuthorController.php");
    include_once("controllers/UserController.php");

    // Start session
    session_start();

    if (isset($_GET['mod'])) {
        $mod = $_GET['mod'];

        if (isset($_GET['act'])) {
            $act = $_GET['act'];
            $act = 'login';
        }
    }
    
    $author = new AuthorController();

    if (isset($_GET["act"])) {
        $act = $_GET["act"];
    } else {
        $act = "login";
    }

    switch ($act) {
        case "register":
            $author->register();
            break;
        case "logout":
            $author->logout();
        break;
        default:
            $author->login();
            break;
    }
    
?>