<?php

session_start();

include "../../config/database.php";

include "../models/articleModel.php";


if($_SERVER["REQUEST_METHOD"]=="POST"){


    $authorId = $_SESSION["userId"] ?? 1;

    $categoryId = $_POST["categoryId"];

    $seriesId = !empty($_POST["seriesId"])
    ? $_POST["seriesId"]
    : NULL;

    $title = $_POST["title"];

    $body = $_POST["body"];

    $excerpt = $_POST["excerpt"];

    $tags = $_POST["tags"];

    $status = $_POST["status"];


    $slug = strtolower(
        str_replace(
            " ",
            "-",
            $title
        )
    );


    // IMAGE UPLOAD

    $imageName =
    $_FILES["featuredImage"]["name"];

    $tempName =
    $_FILES["featuredImage"]["tmp_name"];


    $featuredImagePath =
    "uploads/articleImages/" .
    $imageName;


    $uploadPath =
    __DIR__ .
    "/../../" .
    $featuredImagePath;


    move_uploaded_file(
        $tempName,
        $uploadPath
    );



    $article =
    new ArticleModel($conn);


    if(

        $article->createArticle(

            $authorId,
            $categoryId,
            $seriesId,
            $title,
            $slug,
            $body,
            $excerpt,
            $featuredImagePath,
            $status
        )

    ){

        header(
"Location:../views/author/createArticle.php?success=1"
        );

        exit();

    }

    else{

        header(
"Location:../views/author/createArticle.php?error=1"
        );

        exit();

    }

}

?>