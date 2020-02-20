<?php
    include_once('models/Connection.php');

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
                    return 'empty feild';
                } elseif( !preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $_POST['email'])) {
                    return 'special characters';
                } else {    
                    $email = trim($_POST['email']);
                    $password = trim($_POST['password']);
                    try {
                        $user = $this->author_conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
                        $user->bindParam('email', $email, PDO::PARAM_STR);
                        $user->bindParam('password', $password, PDO::PARAM_STR);
                        $user->execute();

                        $count = $user->rowCount();
                        $row   = $user->fetch(PDO::FETCH_ASSOC);

                        if ($count == 1 && !empty($row)) {
                            return 'accept';
                        } else {
                            return 'invalid user';
                        }

                    } catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                }
            }
        }



    }
?>