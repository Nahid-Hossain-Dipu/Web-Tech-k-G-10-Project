<?php

class ScheduleArticle{


function getApprovedArticles(){

global $conn;

$sql="SELECT
      id,
      title

      FROM articles

      WHERE status='approved'";


return mysqli_query(
$conn,
$sql
);

}



function scheduleArticle(

$articleId,
$editorId,
$date,
$note

){

global $conn;

$sql="INSERT INTO
      editorial_calendar(

      article_id,
      editor_id,
      scheduled_date,
      note

      )

      VALUES(?,?,?,?)";

$stmt=
mysqli_prepare(
$conn,
$sql
);

mysqli_stmt_bind_param(

$stmt,

"iiss",

$articleId,
$editorId,
$date,
$note

);

return
mysqli_stmt_execute(
$stmt
);

}

}

?>