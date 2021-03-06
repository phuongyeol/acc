<?php
    include_once "models/Model.php";

    class User extends Model
    {
        /**
         * @desc Store user register data to database
         * @param array $data
         * @return object $user
         */
        public function store($data)
        {
            $stmt = $this->conn->prepare("INSERT INTO users (username, first_name, last_name, email, password, job_title, company_name) 
            VALUES (:username, :first_name, :last_name, :email, :password, :job_title, :company_name)");
            $stmt->execute($data);
            
            $user = $this->findByUsername($data["username"]);
            return $user;
        }
        
        /**
         * @desc Update user edit data to database 
         * @param array $data
         * @return object $user
         */
        public function update($id, $data) 
        {
            $stmt = $this->conn->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name,
            job_title = :job_title, company_name = :company_name WHERE id = :id");
            print_r($data);
            $stmt->bindParam(':first_name', $data['first_name'], PDO::PARAM_STR);
            $stmt->bindParam(':last_name', $data['last_name'], PDO::PARAM_STR);
            $stmt->bindParam(':job_title', $data['job_title'], PDO::PARAM_STR);
            $stmt->bindParam(':company_name', $data['company_name'], PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            if (isset($data['avatar'])) {
                $stmt = $this->conn->prepare("UPDATE users SET avatar = :avatar WHERE  id = :id");
                $stmt->bindParam(':avatar', $data['avatar'], PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                $stmt->execute();
            }
            $user = $this->findById($id);
            return $user;
        }
    }
?>