<?php

session_start();

include "../../config/database.php";
include "../models/authorUserModel.php";

$userId = $_SESSION["userId"];

$user = new AuthorUserModel($conn);

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $name = $_POST["name"];
    $bio = $_POST["bio"];

    $twitter = $_POST["twitter"];
    $linkedin = $_POST["linkedin"];
    $github = $_POST["github"];

    $socialLinks = json_encode([

        "twitter"=>$twitter,
        "linkedin"=>$linkedin,
        "github"=>$github

    ]);


    $oldUser = $user->getUser($userId);

    $row = $oldUser->fetch_assoc();

    $profilePic = $row["profile_pic"];


if(!empty($_FILES["profilePic"]["name"])){

    $imageName = time()."_".$_FILES["profilePic"]["name"];

    $tempName = $_FILES["profilePic"]["tmp_name"];

    $profilePic = "uploads/profileImages/".$imageName;

    $uploadPath = $_SERVER["DOCUMENT_ROOT"] .
    "/project/blogPost/" .
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