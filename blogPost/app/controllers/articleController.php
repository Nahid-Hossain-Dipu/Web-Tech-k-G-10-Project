<?php

session_start();

include "../../config/database.php";

include "../models/articleModel.php";

include "../models/revisionModel.php";


$article =
new ArticleModel($conn);

$revision =
new RevisionModel($conn);



/* CREATE ARTICLE */

if(

$_SERVER["REQUEST_METHOD"]=="POST"

&&

!isset($_POST["updateArticle"])

){

    $authorId =
    $_SESSION["userId"] ?? 1;

    $categoryId =
    $_POST["categoryId"];

    $seriesId =
    !empty($_POST["seriesId"])
    ?
    $_POST["seriesId"]
    :
    NULL;

    $title =
    $_POST["title"];

    $body =
    $_POST["body"];

    $excerpt =
    $_POST["excerpt"];

    $status =
    $_POST["status"];


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
    "uploads/articleImages/"
    .
    $imageName;


    $uploadPath =
    __DIR__
    .
    "/../../"
    .
    $featuredImagePath;


    move_uploaded_file(

        $tempName,
        $uploadPath

    );


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

}



/* UPDATE ARTICLE */

if(

isset($_POST["updateArticle"])

){

    $authorId =
    $_SESSION["userId"] ?? 1;

    $articleId =
    $_POST["articleId"];

    $title =
    $_POST["title"];

    $body =
    $_POST["body"];

    $excerpt =
    $_POST["excerpt"];

    $status =
    $_POST["status"];



    // Get current article

    $oldArticle =

    $article->getArticle(
        $articleId
    );


    $row =

    $oldArticle->fetch_assoc();



    // Save old version

    $revision->saveRevision(

        $articleId,
        $authorId,
        $row["body"]

    );



    // Update article

    $article->updateArticle(

        $articleId,
        $title,
        $body,
        $excerpt,
        $status

    );



    header(

"Location:../views/author/articleList.php"

    );

    exit();

}

?>