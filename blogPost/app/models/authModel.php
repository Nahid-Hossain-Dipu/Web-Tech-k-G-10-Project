<?php

class AuthModel{

    private $conn;

    public function __construct($db){

        $this->conn = $db;

    }

    public function login($username){

        $sql = "SELECT *
                FROM users
                WHERE username=?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("s",$username);

        $stmt->execute();

        return $stmt->get_result();

    }

}

?>