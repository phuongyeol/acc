<?php
    include_once "models/Connection.php";

    class Author
    {
        public $author_conn;

        public function __construct(){
            $author_conn = new Connection;
            $this->author_conn = $author_conn->conn;
        }

        public function findByEmail($email){
            $stmt = $this->author_conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }

        public function findById($id){
            $stmt = $this->author_conn->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }

        public function update($id, $data){
            $stmt = $this->author_conn->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name,
            job_title = :job_title, company_name = :company_name WHERE id = :id");
            print_r($data);
            $stmt->bindParam(':first_name', $data['first_name'], PDO::PARAM_STR);
            $stmt->bindParam(':last_name', $data['last_name'], PDO::PARAM_STR);
            $stmt->bindParam(':job_title', $data['job_title'], PDO::PARAM_STR);
            $stmt->bindParam(':company_name', $data['company_name'], PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            if (isset($data['avatar'])) {
                $stmt = $this->author_conn->prepare("UPDATE users SET avatar = :avatar WHERE  id = :id");
                $stmt->bindParam(':avatar', $data['avatar'], PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                $stmt->execute();
            }
            $user = $this->findById($id);
            return $user;
        }
    }
?>