<?php
    class Connection
    {
        var $conn;
        function __construct(){
            // Default date
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            // Database default setting
            define('DB_SERVER', 'localhost');
            define('DB_USERNAME', 'root');
            define('DB_PASSWORD', '');
            define('DB_NAME', 'base_account');

            // Connect to MySQL database
            $this->conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $this->conn->set_charset("utf8");

            // Check connection
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }
    }
?>