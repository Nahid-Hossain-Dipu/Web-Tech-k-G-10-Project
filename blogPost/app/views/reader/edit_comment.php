<?php

session_start();

include "config/database.php";

$success = "";
$id = $_GET["id"];
$user_id = $_SESSION["user_id"];

$article_id = $_GET["article_id"];

/* FETCH COMMENT */
$sql = "
SELECT * FROM comments
WHERE id=? AND user_id=?
";

$stmt = mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param(
    $stmt,
    "ii",
    $id,
    $user_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($result);


/* UPDATE COMMENT */
if($_SERVER["REQUEST_METHOD"]=="POST"){

    $comment = $_POST["comment"];

    $update = "
    UPDATE comments

    SET body=?

    WHERE id=? AND user_id=?
    ";

    $update_stmt = mysqli_prepare($conn,$update);

    mysqli_stmt_bind_param(
        $update_stmt,
        "sii",
        $comment,
        $id,
        $user_id
    );

    if(mysqli_stmt_execute($update_stmt)){
         header("Location: article.php?id=$article_id");
         exit();
     }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Comment</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<h2>Edit Comment</h2>

<form method="POST">
<textarea name="comment"rows="5"cols="50"><?php echo $row["body"]; ?></textarea><br><br>
<input type="submit" value="Update Comment">
</form>

<p style="color:green;"><?php echo $success; ?></p>

</body>
</html>