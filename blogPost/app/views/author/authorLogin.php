<?php

session_start();

?>

<!DOCTYPE html>

<html>

<head>

<title>Author Login</title>

<style>

body{

    font-family:Arial;
    margin:40px;

}

input{

    width:300px;
    padding:10px;
    margin-bottom:20px;

}

button{

    padding:10px 20px;

}

</style>

</head>

<body>

<h1>

Author Login

</h1>

<form
action="../../controllers/authController.php"
method="POST"
>

<label>

Username

</label>

<br>

<input
type="text"
name="username"
required
>

<br>

<label>

Password

</label>

<br>

<input
type="password"
name="password"
required
>

<br>

<button type="submit">

Login

</button>

</form>

</body>

</html>