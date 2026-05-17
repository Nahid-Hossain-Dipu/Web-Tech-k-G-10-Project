<?php

class EditArticle{


function getArticleById($id){

global $conn;

$sql="SELECT *
      FROM articles
      WHERE id=?";

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



function updateArticle(
$id,
$title,
$body,
$category
){

global $conn;

$sql="UPDATE articles
      SET
      title=?,
      body=?,
      category_id=?
      WHERE id=?";

$stmt=mysqli_prepare(
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

return mysqli_stmt_execute(
$stmt
);

}



function updateTags(
$articleId,
$tags
){

global $conn;


mysqli_query(

$conn,

"DELETE FROM article_tags
WHERE article_id=$articleId"

);


if(!empty($tags)){

foreach($tags as $tagId){

mysqli_query(

$conn,

"INSERT INTO article_tags(
article_id,
tag_id
)

VALUES(
$articleId,
$tagId
)"

);

}

}

}

}

?>