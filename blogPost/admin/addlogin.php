<?php

session_start();

include("../config/db.php");

if(isset($_POST['login'])){

    $email = $_POST['email'];

    $password = md5($_POST['password']);

    $stmt = $conn->prepare(

        "SELECT * FROM users
         WHERE email=?
         AND password_hash=?
         AND role='admin'"

    );

    $stmt->bind_param(
        "ss",
        $email,
        $password
    );

    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $user = $result->fetch_assoc();

        $_SESSION['admin_id'] = $user['id'];

        header("Location: dashboard.php");

    }else{

        echo "Wrong Email or Password";

    }
}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Admin Login</title>

</head>

<body>

<h1>Admin Login</h1>

<form method="POST">

    <input
        type="email"
        name="email"
        placeholder="Enter Email"
    >

    <br><br>

    <input
        type="password"
        name="password"
        placeholder="Enter Password"
    >

    <br><br>

    <button
        type="submit"
        name="login"
    >
        Login
    </button>

</form>

</body>

</html>