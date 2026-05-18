<?php

include "../../middleware/authorOnly.php";

include "../../../config/database.php";
include "../../models/articleModel.php";

$articleId = $_GET["articleId"];

$article = new ArticleModel($conn);

$result = $article->getAnalytics(
    $articleId
);

$row = $result->fetch_assoc();

?>

<!DOCTYPE html>

<html>

<head>

<title>

Article Analytics

</title>

<style>

body{

    font-family:Arial;
    margin:40px;

}

.card{

    border:1px solid black;
    padding:20px;
    width:300px;

}

</style>

</head>

<body>

<a href="articleList.php">

<button>

Back To Articles

</button>

</a>

<br><br>


<div class="card">

<h2>

Article Analytics

</h2>


<p>

<b>Total Views:</b>

<?php echo $row["view_count"]; ?>

</p>


<p>

<b>Total Likes:</b>

<?php echo $row["totalLikes"]; ?>

</p>


<p>

<b>Total Comments:</b>

<?php echo $row["totalComments"]; ?>

</p>

</div>

</body>

</html>