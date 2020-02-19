<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    session_start();

    if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
        include_once 'views/users/show.php';
    } else {
        include_once 'views/auth/register.php';
    }
?>