<?php

session_start();

include "../config/database.php";
include "../app/models/articleModel.php";

$article = new ArticleModel($conn);


if ($_POST["action"] == "reply") {

    $commentId = $_POST["commentId"];
    $reply = $_POST["reply"];

    $article->replyComment(
        $commentId,
        $reply
    );

    echo "Reply Added";
}


if ($_POST["action"] == "delete") {

    $commentId = $_POST["commentId"];

    $article->deleteComment(
        $commentId
    );

    echo "Deleted";
}
