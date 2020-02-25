<?php
    include_once PROJECT_ROOT_PATH . "/models/Author.php";

    class AuthorController
    {
        public $author;

        public function __construct() 
        {
            $this->author = new Author();
        }

        public function index() 
        {
            include PROJECT_ROOT_PATH . "/views/users/profile.php";
        }

        public function checkSpecialChar($data) 
        {
            if (preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $data)) {
                return true;
            } else {
                return false;
            }
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
                        $stmt = $this->author->author_conn->prepare("SELECT * FROM users WHERE email = :email");
                        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                        $stmt->execute();

                        $count = $stmt->rowCount();
                        $row  = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($count == 1 && !empty($row)) {
                            if (password_verify($password, $row['password'])) {
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
                $_SESSION['user_login'] = $this->author->findByEmail($row['email']);
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
                } elseif ($this->checkSpecialChar($_POST['first-name']) || $this->checkSpecialChar($_POST['last-name'])) {
                    $flag = false;
                    $msg = "Fist name and last name mustn't have special characters. Please try again.";
                } elseif ($this->checkSpecialChar($_POST['username'])) {
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

        public function edit() 
        {
            if (isset($_POST['edit-profile'])) {
                // Get data
                $id = $_GET['id'];
                $data = array(
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'job_title' => $_POST['job_title'],
                    'company_name' => $_POST['company_name'],
                );
                
                if ($this->checkSpecialChar($data['first_name']) || $this->checkSpecialChar($data['last_name']) || $this->checkSpecialChar($data['job_title']) 
                || $this->checkSpecialChar($data['company_name'])) {
                    $msg = "Special characters not allowed. Please try again.";
                    print_r($msg);
                } else {
                    // Check file type
                    if ($_FILES['avatar']['error'] <= 0) {
                        // print_r($_FILES['avatar']);
                        $allowed = array('png', 'jpg');
                        $file = $_FILES['avatar'];
                        $filename = time().'_'.rand(100,999).'.png';
                        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                        
                        if (!in_array($ext, $allowed)) {
                            $msg = 'Only allow .jpg and .png files only';
                        } else {
                            // Save image to upload
                            move_uploaded_file($file['tmp_name'], "upload/avatars/".$filename);
                            $data['avatar'] = $filename;
                        }
                    }
                    // Update data to database
                    $result = $this->author->update($id, $data);
                    if ($result) {
                        $_SESSION['user_login'] = $this->author->findByEmail($result['email']);
                        header('location: ?mod=account&act=index');
                    } else {
                        $msg = "Some things went wrong. Please try again.";
                    }
                }
                
            }
        }
    }
?>