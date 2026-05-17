<?php

session_start();

include "../../../config/database.php";

include "../../models/Article.php";

include "../../controllers/EditorController.php";


if(
!isset($_SESSION["userId"])
)
{

header(
"Location:../auth/login.php"
);

}


if(
$_SESSION["role"]
!="editor"
)
{

die(
"Access Denied"
);

}


$editor =
new EditorController();

$articles =
$editor->queue();

?>

<!DOCTYPE html>

<html>

<head>

<title>

Editorial Queue

</title>

</head>

<body>

<h2>

Submitted Articles Queue

</h2>

<table border="1">

<tr>

<th>ID</th>

<th>Title</th>

<th>Author</th>

<th>Category</th>

<th>Status</th>

<th>Date</th>

<th>Action</th>

</tr>

<?php

while(
$row=
mysqli_fetch_assoc(
$articles
)
){

?>

<tr>

<td>

<?php
echo $row["id"];
?>

</td>

<td>

<?php
echo $row["title"];
?>

</td>

<td>

<?php
echo $row["authorName"];
?>

</td>

<td>

<?php
echo $row["categoryName"];
?>

</td>

<td>

<?php
echo $row["status"];
?>

</td>

<td>

<?php
echo $row["created_at"];
?>

</td>

<td>

<a href="review.php?id=<?php echo $row["id"]; ?>">

Review

</a>

</td>

</tr>

<?php

}

?>

</table>

</body>

</html>