<?php

include "../config/database.php";
include "../model/userModel.php";

$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if(createUser($conn, $name, $username, $email, $password)){
        $message = "Registration Successful";
    }else{
        $message = "Registration Failed";
    }
}
?>