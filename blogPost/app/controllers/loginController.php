<?php
session_start();
include "../config/database.php";
include "../model/UserModel.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = getUserByEmail($conn, $email);

    if ($user) {

        if (password_verify($password, $user['password_hash'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            header("Location: ../index.php");
            exit();

        } else {
            $error = "Wrong Password";
        }

    } else {
        $error = "Email Not Found";
    }
}
?>