<?php
    include_once PROJECT_ROOT_PATH . "/models/Author.php";

    class AuthorController
    {
        public $author;
        public $user;

        public function __construct() 
        {
            $this->author = new Author();
            $this->user = new User();
        }
        
        public function login() 
        {
            $flag = false;
            if (isset($_POST['login'])) {
                if($_POST['email'] == "" || $_POST['password'] == "") {
                    $msg = "Empty email or password. Please try again!";
                } elseif(!filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $msg = "Email special characters not allowed";
                } else {    
                    $email = trim($_POST['email']);
                    $password = trim($_POST['password']);
                    try {
                        $user = $this->author->findByEmail($email);

                        if (!empty($user)) {
                            if (password_verify($password, $user['password'])) {
                                $flag = true;
                            } else {
                                $msg = "Email or password is incorrect. Plese try again!";
                            }
                        } else {
                            $msg = "Email or password is incorrect. Plese try again!";
                        }
                    } catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                }
            }

            if ($flag) {
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $this->author->findByEmail($user['email']);
                header('location: ?mod=account&act=index');
            } else {
                include "views/auth/login.php";
            }
        }

        public function logout() 
        {
            session_destroy();
            header('location: ?view=login');
        }

        public function register() 
        {
            if (isset($_POST['register'])) {
                $flag = true;
                if ($_POST['username'] == "" || $_POST['first-name'] == "" || $_POST['last-name'] == "" || $_POST['email'] == "" || $_POST['password'] == "" || $_POST['confirm-password'] == "") {
                    $flag = false;
                    $msg = "Empty some required feilds. Please try again!";
                } elseif ($this->author->checkSpecialChar($_POST['first-name']) || $this->author->checkSpecialChar($_POST['last-name'])) {
                    $flag = false;
                    $msg = "Fist name and last name mustn't have special characters. Please try again.";
                } elseif ($this->author->checkSpecialChar($_POST['username'])) {
                    $flag = false;
                    $msg = "Username mustn't habe special character. Please try again.";
                } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $flag = false;
                    $msg = "Email special characters not allowed. Please try again.";
                } elseif ($_POST['password'] !== $_POST['confirm-password']) {
                    $flag = false;
                    $msg = "Password and confirm password not match. Please try again.";
                } elseif (strlen($_POST['password']) < 8) {
                    $flag = false;
                    $msg = "Password must have at least 8 characters. Please try again.";
                } else {
                    $username = trim($_POST['username']);
                    $email = trim($_POST['email']);
                    try {
                        $user1 = $this->author->findByUsername($username);
                        $user2 = $this->author->findByEmail($email); 

                        if (!empty($user1) || !empty($user2)) {
                            $flag = false;
                            $msg = "Username or Email already exists. Please try again!";
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
                    // $password = $_POST['password'];
                    $job_title = isset($_POST['job_title'])?$_POST['job_title']:"";
                    $company_name = isset($_POST['company_name'])?$_POST['company_name']:"";
                    try {
                        $stmt = $this->author->conn->prepare("INSERT INTO users (username, first_name, last_name, email, password, job_title, company_name) VALUES (?, ?, ?, ?, ?, ?, ?)");
                        $data = [$username, $first_name, $last_name, $email, $password, $job_title, $company_name];
                        $result = $stmt->execute($data);
                        // Result
                        if ($result) {
                            $notice_success = "Registration successfully completed! Login to start working.";
                            include "views/auth/login.php";
                        }
                    } catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                } else {
                    include "views/auth/register.php";
                }
            }
        }

       
    }
?>