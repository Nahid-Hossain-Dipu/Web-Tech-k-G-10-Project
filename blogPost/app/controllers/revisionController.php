<?php

include "../../config/database.php";

include "../models/revisionModel.php";

include "../models/articleModel.php";


$revision =
new RevisionModel($conn);

$article =
new ArticleModel($conn);


if(isset($_GET["restore"])){

    $revisionId =
    (int)$_GET["restore"];


    $result =
    $revision->getRevision(
        $revisionId
    );


    $row =
    $result->fetch_assoc();


    if($row){

        $article->updateArticleBody(

            $row["article_id"],
            $row["body_snapshot"]

        );


        header(

        "Location:../views/author/revisionHistory.php?articleId="

        .

        $row["article_id"]

        );

        exit();

    }

}

?>