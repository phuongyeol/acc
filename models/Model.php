<?php 
    include_once 'models/Connection.php';
    
    class Model{
        public $conn;

        public function __construct()
        {
            $connection = new Connection();
            $this->conn = $connection->conn;
        }

        /**
         * @desc Check some special characters in input feild
         * @param string $feild
         * @return boolean
         */
        public function checkSpecialChar($feild)
        {
            if (preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $feild)) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * @desc Search a user by id
         * @param int $id
         * @return object 
         */
        public function findById($id) 
        {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }
        
        /**
         * @desc Search a user by email
         * @param string $email
         * @return object 
         */
        public function findByEmail($email) 
        {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }
        
        /**
         * @desc Search a user by username
         * @param string $username
         * @return object 
         */
        public function findByUsername($username) 
        {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }
    }
?>