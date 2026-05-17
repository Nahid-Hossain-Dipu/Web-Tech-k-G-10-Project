<?php

session_start();

include "config/database.php";

$id = $_GET["id"];

$user_id = $_SESSION["user_id"];

$sql = "
DELETE FROM comments
WHERE id=? AND user_id=?
";

$stmt = mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param(
    $stmt,
    "ii",
    $id,
    $user_id
);

if(mysqli_stmt_execute($stmt)){

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();

}else{

    echo "Delete Failed";
}

?>