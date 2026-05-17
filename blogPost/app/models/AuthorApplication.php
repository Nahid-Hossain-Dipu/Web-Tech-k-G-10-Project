<?php

class AuthorApplication{


function getApplications(){

global $conn;

$sql="SELECT
id,
name,
email

FROM users

WHERE role='reader'

AND is_author_approved=0";

return mysqli_query(
$conn,
$sql
);

}



function approve(
$id
){

global $conn;

$sql="UPDATE users

SET

role='author',

is_author_approved=1

WHERE id=?";


$stmt=
mysqli_prepare(
$conn,
$sql
);

mysqli_stmt_bind_param(
$stmt,
"i",
$id
);

return mysqli_stmt_execute(
$stmt
);

}



function reject(
$id
){

global $conn;

$sql="UPDATE users

SET

is_author_approved=-1

WHERE id=?";


$stmt=
mysqli_prepare(
$conn,
$sql
);

mysqli_stmt_bind_param(
$stmt,
"i",
$id
);

return mysqli_stmt_execute(
$stmt
);

}

}

?>