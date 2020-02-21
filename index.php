<?php
    // Include controllers
    // include_once 'controllers/UserController.php';
    include_once 'controllers/AuthorController.php';

    // Default date
    date_default_timezone_set("Asia/Ho_Chi_Minh");

    // Start session
    session_start();

    // Index
    $author = new AuthorController();

    if (isset($_GET["act"])) {
        $act = $_GET["act"];
    } else {
        $act = "login";
    }

    if (isset($_GET['view'])){
        $view = $_GET['view'];
        switch ($view) {
            case 'register':
                $author->registerView();
                break;
            case 'login':
                $author->loginView();
                break;
            case 'author':
                // $user = new UserController();
                // $user->index();
                break;
            default:
                break;
        }
    }

    switch ($act) {
        case 'register':
            $author->register();
            break;
        default:
            $author->login();
            break;
    }
    
?>