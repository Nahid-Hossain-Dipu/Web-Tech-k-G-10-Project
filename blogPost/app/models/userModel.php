<!--register-->
<?php
function createUser($conn, $name, $username, $email, $password){
    $sql = "INSERT INTO users(name, username, email, password_hash)
            VALUES(?,?,?,?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $name,
        $username,
        $email,
        $password
    );
    return mysqli_stmt_execute($stmt);
}
?>
<!--login-->
<?php

function getUserByEmail($conn, $email) {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($result);
}
?>