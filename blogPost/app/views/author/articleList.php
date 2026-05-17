<?php

session_start();

include "../../../config/database.php";

include "../../models/articleModel.php";


$authorId = $_SESSION["userId"] ?? 1;


$article = new ArticleModel($conn);

$result = $article->getAllArticles($authorId);

?>

<!DOCTYPE html>

<html>

<head>

<title>My Articles</title>

<style>

table{

width:100%;
border-collapse:collapse;

}

th,
td{

border:1px solid black;
padding:10px;

}

a{

text-decoration:none;
margin-right:10px;

}

</style>

</head>

<body>

<h1>My Articles</h1>

<table>

<tr>

<th>ID</th>

<th>Title</th>

<th>Status</th>

<th>Created</th>

<th>Action</th>

</tr>

<?php

while($row = $result->fetch_assoc()){

?>

<tr>

<td>

<?php echo $row["id"]; ?>

</td>

<td>

<a href="viewArticle.php?articleId=<?php echo $row["id"]; ?>">

<?php echo $row["title"]; ?>

</a>

</td>

<td>

<?php echo $row["status"]; ?>

</td>

<td>

<?php echo $row["created_at"]; ?>

</td>

<td>

<a href="editArticle.php?articleId=<?php echo $row["id"]; ?>">

Edit

</a>

<a href="revisionHistory.php?articleId=<?php echo $row["id"]; ?>">

Revisions

</a>

</td>

</tr>

<?php

}

?>

</table>

</body>

</html>