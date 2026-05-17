<?php

class ReportQueue{


function getReports(){

global $conn;

$sql="SELECT

cr.id,

cr.reason,

cr.status,

c.body AS commentBody,

a.title AS articleTitle,

u.name AS reporter

FROM comment_reports cr

JOIN comments c
ON cr.comment_id=c.id

JOIN users u
ON cr.reporter_id=u.id

JOIN articles a
ON c.article_id=a.id

WHERE cr.status='pending'";

return mysqli_query(
$conn,
$sql
);

}



function deleteComment(
$reportId
){

global $conn;


$sql="DELETE c
FROM comments c

JOIN comment_reports cr
ON c.id=cr.comment_id

WHERE cr.id=?";


$stmt=
mysqli_prepare(
$conn,
$sql
);

mysqli_stmt_bind_param(

$stmt,
"i",
$reportId

);

return
mysqli_stmt_execute(
$stmt
);

}



function dismissReport(
$reportId
){

global $conn;

$sql="UPDATE comment_reports

SET

status='resolved'

WHERE id=?";


$stmt=
mysqli_prepare(
$conn,
$sql
);

mysqli_stmt_bind_param(

$stmt,
"i",
$reportId

);

return
mysqli_stmt_execute(
$stmt
);

}

}

?>