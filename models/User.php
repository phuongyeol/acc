<?php
    include_once('models/connection.php');

    class User
    {
        var $user_conn;

        function __construct(){
            $user_conn = new Connection();
            $this->user_conn = $user_conn->conn;
        }
        function find($id){
            $query = "SELECT * FROM users WHERE id = " . $id;
            $result = $this->user_conn->query($jquery->fectch_assoce());

            return $result;
        }

        function insert($data){
            // Get data
            $username = trim($_POST['username']);
            $first_name = trim($_POST['first-name']);
            $last_name = trim($_POST['last-name']);
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $confirm_password = $_POST['confirm-password'];
            $job_title = trim($_POST['job-title']); 
            $company_name = trim($_POST['company-name']);
            // Insert to database
            $query = "INSERT INTO users(email, username, first_name, last_name, job_title, company_name, password, since, last_update) 
                    VALUES ('".$username."', '".$first_name."', '".$last_name."', '".$job_title."', '".$company_name."', '".$password."', '".timestamp()."', '".timestamp()."')";

            $result = $this->user_conn->query($query);

            return $result;
        }
    }
?>