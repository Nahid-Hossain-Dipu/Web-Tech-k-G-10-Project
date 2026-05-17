<?php

session_start();

include "config/database.php";

$success = "";
$error = "";

$comment_id = $_GET["id"];

$user_id = $_SESSION["user_id"];


/* CHECK EXISTING REPORT */

$check = "
SELECT * FROM comment_reports
WHERE comment_id=? AND user_id=?
";

$check_stmt = mysqli_prepare($conn,$check);

mysqli_stmt_bind_param(
    $check_stmt,
    "ii",
    $comment_id,
    $user_id
);

mysqli_stmt_execute($check_stmt);

$check_result = mysqli_stmt_get_result($check_stmt);


/* REPORT SUBMIT */

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $reason = $_POST["reason"];

    if(empty($reason)){

        $error = "Please Write Reason";

    }else{

        if(mysqli_num_rows($check_result)>0){

            $error = "Already Reported";

        }else{

            $sql = "
            INSERT INTO comment_reports
            (comment_id,user_id,reason)

            VALUES(?,?,?)
            ";

            $stmt = mysqli_prepare($conn,$sql);

            mysqli_stmt_bind_param(
                $stmt,
                "iis",
                $comment_id,
                $user_id,
                $reason
            );

            if(mysqli_stmt_execute($stmt)){

                header("Location: index.php");
                exit();

            }else{

                $error = "Report Failed";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Report Comment</title>

    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<h2>Report Comment</h2>

<p style="color:red;">

    <?php echo $error; ?>

</p>

<form method="POST">

    <textarea
    name="reason"
    rows="6"
    cols="50"
    placeholder="Write report reason"></textarea>

    <br><br>

    <input type="submit" value="Submit Report">

</form>

</body>
</html>