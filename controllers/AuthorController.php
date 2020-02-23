<?php
    include_once PROJECT_ROOT_PATH . "/models/Author.php";

    class AuthorController
    {
        public $author;

        public function __construct(){
            $this->author = new Author();
        }

        public function index(){
            include PROJECT_ROOT_PATH . "/views/users/profile.php";
        }

        public function login(){
            $flag = false;
            if (isset($_POST['login'])) {
                if($_POST['email'] == "" || $_POST['password'] == ""){
                    $msg = "Empty email or password. Please try again!";
                } elseif(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $_POST['email'])) {
                    $msg = "Email special characters not allowed";
                } else {    
                    $email = trim($_POST['email']);
                    $password = trim($_POST['password']);
                    try {
                        $stmt = $this->author->author_conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
                        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                        $stmt->execute();

                        $count = $stmt->rowCount();
                        $row  = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($count == 1 && !empty($row)) {
                            // if (password_verify($password, $row['password'])) {
                                $flag = true;
                            // } else {
                                // $msg = "Email or password is incorrect. Plese try again!";
                            // }
                        } else {
                            $msg = "Email or password is incorrect. Plese try again!";
                        }
                    } catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                }
            }

            if ($flag) {
                $profile = $this->author->findByEmail($row['email']);
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $profile;
                header('location: ?mod=account&act=profile');
            } else {
                include "views/auth/login.php";
            }
        }

        public function logout(){
            session_destroy();
            header('location: ?view=login');
        }

        public function register(){
            if (isset($_POST['register'])) {
                $flag = true;
                if ($_POST['username'] == "" || $_POST['first-name'] == "" || $_POST['last-name'] == "" || $_POST['email'] == "" || $_POST['password'] == "" || $_POST['confirm-password'] == "") {
                    $flag = false;
                    $msg = "Empty some required feilds. Please try again!";
                } elseif (!preg_match("/^[a-zA-Z]*$/", trim($_POST['first-name'])) || !preg_match("/^[a-zA-Z]*$/", trim($_POST['last-name']))) {
                    $flag = false;
                    $msg = "Fist name and last name mustn't have special characters. Please try again.";
                } elseif (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $_POST['email'])) {
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
                        $stmt = $this->author->author_conn->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
                        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                        $stmt->execute();

                        $count = $stmt->rowCount();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($count > 0 && !empty($row)) {
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
                        $stmt = $this->author->author_conn->prepare("INSERT INTO users (username, first_name, last_name, email, password, job_title, company_name) VALUES (?, ?, ?, ?, ?, ?, ?)");
                        $data = [ $username, $first_name, $last_name, $email, $password, $job_title, $company_name ];
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