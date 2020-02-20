<?php
    class Connection
    {
        public $conn;
        
        public function __construct(){
            // Connect to MySQL database
            $this->conn = new PDO("mysql:host=localhost;dbname=base_account", "root", "");
        }

        public function requiredValidation($feild){
            $count = 0;
            foreach ($feild as $key => $value) {
                if (empty($value)) {
                    $count++;
                    $this->error .= "<p>" . $key . " is required</p>";
                }
            }
            if ($count == 0) {
                return true;
            }
        }
        
    }
?>