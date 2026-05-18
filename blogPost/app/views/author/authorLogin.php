<?php

session_start();

$username = $_COOKIE["username"] ?? "";
$password = $_COOKIE["password"] ?? "";

?>

<!DOCTYPE html>

<html>

<head>

    <title>Author Login</title>

    <style>
        body {
            font-family: Arial;
            background-color: #f5f5f5;
            margin: 0;
        }

        .loginBox {
            width: 350px;
            margin: 100px auto;
            background: white;
            padding: 30px;
            border: 1px solid lightgray;
        }

        h1 {
            color: black;
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid gray;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: grey;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: black;
        }

        .remember {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .remember input {
            width: auto;
        }
    </style>

</head>

<body>

    <div class="loginBox">

        <h1>Author Login</h1>

        <form action="../../controllers/authController.php" method="POST">

            <label>Username</label>

            <input
                type="text"
                name="username"
                value="<?php echo $username; ?>"
                required>

            <label>Password</label>

            <input
                type="password"
                name="password"
                value="<?php echo $password; ?>"
                required>

            <div class="remember">

                <input type="checkbox" name="remember">

                Remember Me

            </div>

            <button type="submit">

                Login

            </button>

        </form>

    </div>

</body>

</html>