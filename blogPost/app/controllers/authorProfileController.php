<?php

session_start();

include "../../config/database.php";

include "../models/authorUserModel.php";


$userId =
$_SESSION["userId"] ?? 1;


$user =
new AuthorUserModel($conn);


if($_SERVER["REQUEST_METHOD"]=="POST"){

    $name =
    $_POST["name"];

    $bio =
    $_POST["bio"];


    $twitter =
    $_POST["twitter"];

    $linkedin =
    $_POST["linkedin"];

    $github =
    $_POST["github"];



    $socialLinks =
    json_encode([

        "twitter"=>$twitter,
        "linkedin"=>$linkedin,
        "github"=>$github

    ]);



    // Existing image from DB

    $oldUser =
    $user->getUser($userId);

    $row =
    $oldUser->fetch_assoc();


    $profilePic =
    $row["profile_pic"];



    // Upload new image

    if(

    !empty($_FILES["profilePic"]["name"])

    ){

        $imageName =
        $_FILES["profilePic"]["name"];

        $tempName =
        $_FILES["profilePic"]["tmp_name"];


        // Save path for database

        $profilePic =
        "uploads/profileImages/" .
        $imageName;


        // Actual folder path

        $uploadPath =
        __DIR__ .
        "/../../" .
        $profilePic;


        move_uploaded_file(

            $tempName,
            $uploadPath

        );

    }



    $user->updateProfile(

        $userId,
        $name,
        $bio,
        $profilePic,
        $socialLinks

    );


    header(

"Location:../views/author/authorProfile.php?success=1"

    );

    exit();

}

?>