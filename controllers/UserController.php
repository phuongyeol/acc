<?php
    include_once PROJECT_ROOT_PATH . "/models/User.php";

    class UserController
    {
        public $user;
        public function __construct() 
        {
            $this->user = new User();
        }

        public function index() 
        {
            include PROJECT_ROOT_PATH . "/views/users/profile.php";
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
                
                if ($this->user->checkSpecialChar($data['first_name']) || $this->user->checkSpecialChar($data['last_name']) || $this->user->checkSpecialChar($data['job_title']) 
                || $this->user->checkSpecialChar($data['company_name'])) {
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
                    $result = $this->user->update($id, $data);
                    if ($result) {
                        $_SESSION['user_login'] = $this->user->findByEmail($result['email']);
                        header('location: ?mod=account&act=index');
                    } else {
                        $msg = "Some things went wrong. Please try again.";
                    }
                }
            }
        }
    }
?>