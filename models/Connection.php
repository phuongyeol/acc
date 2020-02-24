<?php
    class Connection
    {
        public $conn;
        
        public function __construct() 
        {
            // Connect to MySQL database
            try {
                $this->conn = new PDO("mysql:host=localhost;dbname=base_account", "root", "");
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
    }
?>