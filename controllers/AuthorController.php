<?php
    include_once('models/Author.php');

    class AuthorController
    {
        var $author;

        function __construct(){
            $this->author = new Author();
        }

        function login(){
            require_once('views/auth/login.php');
        }

        function author(){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $status = $this->author->login($email, $password);

            if ($status == true) {
                die("Login successfull!");
            } else {
                setcookie('message', 'Invalid or empty a feild. Please try again');
                header('location: index.php');
            }
        }
    }
?>