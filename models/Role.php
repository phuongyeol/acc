<?php
    include_once('models/Connection.php');

    class Role
    {
        var $role_conn;

        function __construct(){
            $role_conn = new Connection();
            $this->conn = $role_conn->conn;
        }
    }
?>