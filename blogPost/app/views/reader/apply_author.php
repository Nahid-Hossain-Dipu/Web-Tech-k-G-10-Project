<?php

session_start();

include "config/database.php";

$success = "";
$error = "";

$user_id = $_SESSION["user_id"];

/* CHECK EXISTING APPLICATION */
$check = "
SELECT * FROM author_applications
WHERE user_id=?
";

$check_stmt = mysqli_prepare($conn,$check);

mysqli_stmt_bind_param(
    $check_stmt,
    "i",
    $user_id
);

mysqli_stmt_execute($check_stmt);

$check_result = mysqli_stmt_get_result($check_stmt);

$application = mysqli_fetch_assoc($check_result);


/* APPLY */

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $motivation = $_POST["motivation"];

    $writing_sample = $_POST["writing_sample"];

    if(empty($motivation) || empty($writing_sample)){

        $error = "Please Fill All Fields";

    }else{

        if(mysqli_num_rows($check_result)>0){

            $error = "Application Already Submitted";

        }else{

            $sql = "
            INSERT INTO author_applications
            (user_id,motivation,writing_sample)

            VALUES(?,?,?)
            ";

            $stmt = mysqli_prepare($conn,$sql);

            mysqli_stmt_bind_param(
                $stmt,
                "iss",
                $user_id,
                $motivation,
                $writing_sample
            );

            if(mysqli_stmt_execute($stmt)){

             header("Location: index.php");
             exit();
            }else{
              $error = "Submission Failed";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply For Author</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<a href="index.php">Back</a>

<hr>
<h2>Apply To Become Author</h2>

<p style="color:green;"><?php echo $success; ?></p>
<p style="color:red;"><?php echo $error; ?></p>

<?php
if($application){
?>

<h3>Application Status :<?php echo $application["status"]; ?></h3>

<?php
}else{
?>

<form method="POST"> <label>Motivation Text</label><br><br>
<textarea name="motivation" rows="6" cols="60"></textarea> <br><br>
<label> Writing Sample</label><br><br>
<textarea name="writing_sample" rows="10"cols="60"></textarea><br><br>
<input type="submit" value="Submit Application">
</form>

<?php
}
?>

</body>
</html>