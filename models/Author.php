<?php
    include_once "models/Connection.php";

    class Author
    {
        public $author_conn;

        public function __construct(){
            $author_conn = new Connection;
            $this->author_conn = $author_conn->conn;
        }

        public function login(){
            if (isset($_POST['login'])) {
                if($_POST['email'] == "" || $_POST['password'] == ""){
                    return "empty feild";
                } elseif(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $_POST['email'])) {
                    return "invalid email";
                } else {    
                    $email = trim($_POST['email']);
                    $password = trim($_POST['password']);
                    try {
                        $stmt = $this->author_conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
                        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                        $stmt->execute();

                        $count = $stmt->rowCount();
                        $row   = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($count == 1 && !empty($row)) {
                            $_SESSION['isLogin'] = true;
                            // if (password_verify($password, $row['password'])) {
                                return "accept";
                            // } else {
                                // return "invalid user";
                            // }
                        } else {
                            return "invalid user";
                        }
                    } catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                }
            }
        }

        public function register(){
            if (isset($_POST['register'])) {
                $flag = true;
                if ($_POST['username'] == "" || $_POST['first-name'] == "" || $_POST['last-name'] == "" || $_POST['email'] == "" || $_POST['password'] == "" || $_POST['confirm-password'] == "") {
                    $flag = false;
                    return "empty feild";
                } elseif (!preg_match("/^[a-zA-Z]*$/", $_POST['first-name']) || !preg_match("/^[a-zA-Z]*$/", $_POST['last-name'])) {
                    $flag = false;
                    return "invalid fullname";
                } elseif (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $_POST['email'])) {
                    $flag = false;
                    return "invalid email";
                } elseif ($_POST['password'] !== $_POST['confirm-password']) {
                    $flag = false;
                    return "password not match";
                } elseif (strlen($_POST['password']) < 8) {
                    $flag = false;
                    return "invalid password";
                } else {
                    $username = trim($_POST['username']);
                    $email = trim($_POST['email']);
                    try {
                        $stmt = $this->author_conn->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
                        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                        $stmt->execute();

                        $count = $stmt->rowCount();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($count > 0 && !empty($row)) {
                            $flag = false;
                            return "already exists";
                        }
                    } catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                } 
                if ($flag) {
                    $username = trim($_POST['username']);
                    $last_name = trim($_POST['last-name']);
                    $first_name = trim($_POST['first-name']);
                    $email = trim($_POST['email']);
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $job_title = isset($_POST['job_title'])?$_POST['job_title']:"";
                    $company_name = isset($_POST['company_name'])?$_POST['company_name']:"";
                    try {
                        $stmt = $this->author_conn->prepare("INSERT INTO users (username, first_name, last_name, email, password, job_title, company_name) VALUES (?, ?, ?, ?, ?, ?, ?)");
                        $data = [ $username, $first_name, $last_name, $email, $password, $job_title, $company_name ];
                        $result = $stmt->execute($data);
                        // Result
                        if ($result) {
                            return "success";
                        }
                    } catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                }
            }
        }

    }
?>