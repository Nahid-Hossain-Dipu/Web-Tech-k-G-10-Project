<?php
include "../../middleware/authorOnly.php";
include "../../../config/database.php";

include "../../models/articleModel.php";


if(!isset($_GET["articleId"])){

    die("Article ID Missing");

}


$articleId =
(int)$_GET["articleId"];


$article =
new ArticleModel($conn);


$result =
$article->getArticle($articleId);


$row =
$result->fetch_assoc();

?>


<!DOCTYPE html>

<html>

<head>

<title>

<?php echo $row["title"]; ?>

</title>

<style>

body{

font-family:Arial;
margin:40px;

}

img{

max-width:500px;

}

</style>

</head>

<body>

<h1>

<?php echo $row["title"]; ?>

</h1>


<p>

<b>Status:</b>

<?php echo $row["status"]; ?>

</p>


<p>

<b>Excerpt:</b>

<?php echo $row["excerpt"]; ?>

</p>


<?php

if(!empty($row["featured_image_path"])){

?>

<img

src="../../../<?php echo $row["featured_image_path"]; ?>"

>

<?php

}

?>


<h3>

Article Body

</h3>


<p>

<?php echo nl2br($row["body"]); ?>

</p>


<br>

<a href="articleList.php">

Back

</a>

</body>

</html>

