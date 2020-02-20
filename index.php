<?php
    session_start();
    // Default date
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    include_once("controllers/AuthorController.php");

    $author = new AuthorController();

    if (isset($_GET["act"])) {
        $act = $_GET["act"];
    } else {
        $act = "login";
    }

    switch ($act) {
        case "register":
            $author->insert();
            break;
        case "logout":
            $author->logout();
        break;
        default:
            $author->login();
            break;
    }
    
?>