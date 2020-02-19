<?php
    // Database default setting
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'base_account');

    // Connect to MySQL database
    $connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    if ($connect === false) {
        die("ERROR: Could not connect. ". mysqli_connect_error());
    }
?>