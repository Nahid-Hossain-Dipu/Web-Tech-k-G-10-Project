<?php

class Article{

function getQueueArticles(){

    global $conn;

    $status = "submitted";

    $sql = "SELECT

            a.id,
            a.title,
            a.status,
            a.created_at,

            u.name
            AS authorName,

            c.name
            AS categoryName

            FROM articles a

            JOIN users u
            ON a.author_id=u.id

            JOIN categories c
            ON a.category_id=c.id

            WHERE a.status=?

            ORDER BY a.created_at DESC";

    $stmt =
    mysqli_prepare(
        $conn,
        $sql
    );

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $status
    );

    mysqli_stmt_execute(
        $stmt
    );

    return
    mysqli_stmt_get_result(
        $stmt
    );

}
function getSubmittedCount(){

global $conn;

return mysqli_query(
$conn,
"SELECT COUNT(*) AS total
FROM articles
WHERE status='submitted'"
);

}


function getApprovedCount(){

global $conn;

return mysqli_query(
$conn,
"SELECT COUNT(*) AS total
FROM articles
WHERE status='approved'"
);

}


function getScheduledCount(){

global $conn;

return mysqli_query(
$conn,
"SELECT COUNT(*) AS total
FROM editorial_calendar
WHERE scheduled_date=CURDATE()"
);

}


function getPublishedCount(){

global $conn;

return mysqli_query(
$conn,
"SELECT COUNT(*) AS total
FROM articles
WHERE status='published'
AND WEEK(published_at)=WEEK(CURDATE())"
);

}




function updateArticleStatus(
    $id,
    $status,
    $feedback
){

    global $conn;

    $sql = "UPDATE articles
            SET
            status=?,
            editor_feedback=?
            WHERE id=?";

    $stmt =
    mysqli_prepare(
        $conn,
        $sql
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssi",
        $status,
        $feedback,
        $id
    );

    return
    mysqli_stmt_execute(
        $stmt
    );

}
function getArticleById($id){

    global $conn;

    $sql="SELECT

            a.*,

            u.name AS authorName,

            c.name AS categoryName

            FROM articles a

            JOIN users u
            ON a.author_id=u.id

            JOIN categories c
            ON a.category_id=c.id

            WHERE a.id=?";

    $stmt=mysqli_prepare(
                $conn,
                $sql
            );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $id
    );

    mysqli_stmt_execute(
        $stmt
    );

    return mysqli_stmt_get_result(
            $stmt
    );

}



function getTags($id){

    global $conn;

    $sql="SELECT
            tags.name

          FROM tags

          JOIN article_tags

          ON tags.id=
          article_tags.tag_id

          WHERE
          article_tags.article_id=?";

    $stmt=mysqli_prepare(
                $conn,
                $sql
            );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $id
    );

    mysqli_stmt_execute(
        $stmt
    );

    return mysqli_stmt_get_result(
            $stmt
    );

}


function getApprovedArticles(){

    global $conn;

    $status =
    "approved";

    $sql = "SELECT

            a.id,
            a.title,
            c.name AS categoryName

            FROM articles a

            JOIN categories c
            ON a.category_id=c.id

            WHERE a.status=?";

    $stmt =
    mysqli_prepare(
        $conn,
        $sql
    );

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $status
    );

    mysqli_stmt_execute(
        $stmt
    );

    return
    mysqli_stmt_get_result(
        $stmt
    );

}



function updateArticle(

    $id,
    $title,
    $body,
    $category

){

    global $conn;

    $sql = "UPDATE articles

            SET

            title=?,
            body=?,
            category_id=?

            WHERE id=?";

    $stmt =
    mysqli_prepare(
        $conn,
        $sql
    );

    mysqli_stmt_bind_param(

        $stmt,

        "ssii",

        $title,

        $body,

        $category,

        $id
    );

    return
    mysqli_stmt_execute(
        $stmt
    );

}
}

?>