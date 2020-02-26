<?php
    // Default date
    date_default_timezone_set("Asia/Ho_Chi_Minh");

    // Start session
    session_start();

    define('PROJECT_ROOT_PATH', __DIR__);
    include_once PROJECT_ROOT_PATH . "/controllers/AuthorController.php";
    include_once PROJECT_ROOT_PATH . "/controllers/UserController.php";

    $author = new AuthorController();
    $user = new UserController();

    if (isset($_SESSION['is_login'])) {
        if (isset($_GET['mod'])) {
            $mod = $_GET['mod'];
        } else {
            $mod = 'account';
        }
        if (isset($_GET['act'])) {
            $act = $_GET['act'];
        } else {
            $act = 'profile';
        }

        switch ($mod) {
            case 'account':
                switch ($act) {
                    case 'index':
                        $user->index();
                        break;
                    case 'edit':
                        $user->edit();
                        break;
                    case 'logout':
                        $author->logout();
                        break;
                    default:
                        break;
                }
                break;
            case 'company':
                break;
            case 'units':
                # code...
                break;
            case 'guests':
                # code...
                break;
            case 'baseapp':
                # code...
                break;
            default:
                # code...
                break;
        }
    } else {
        if (isset($_GET["act"])) {
            $act = $_GET["act"];
        } else {
            $act = "login";
        }
        if (isset($_GET['view'])){
            $view = $_GET['view'];
            switch ($view) {
                case 'register':
                    include_once "views/auth/register.php";
                    break;
                case 'login':
                    include_once "views/auth/login.php";
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
    }
?>