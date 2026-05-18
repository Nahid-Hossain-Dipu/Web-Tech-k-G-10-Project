<?php

session_start();

include "../../config/database.php";
include "../models/authModel.php";

$auth = new AuthModel($conn);

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = $auth->login(
        $username
    );

    $user = $result->fetch_assoc();

    if(
        $user &&
        password_verify(
            $password,
            $user["password_hash"]
        )
    ){

        if(
            $user["role"]=="author" &&
            $user["is_author_approved"]==0
        ){

            die(
                "Author account is not approved yet"
            );

        }

        $_SESSION["userId"] = $user["id"];
        $_SESSION["role"] = $user["role"];
        $_SESSION["name"] = $user["name"];

        if($user["role"]=="author"){

            header(
                "Location:../views/author/authorDashboard.php"
            );

        }elseif($user["role"]=="editor"){

            header(
                "Location:../views/editor/editorDashboard.php"
            );

        }else{

            header(
                "Location:../views/admin/adminDashboard.php"
            );

        }

        exit();

    }else{

        echo "Invalid Username or Password";

    }

}

?>