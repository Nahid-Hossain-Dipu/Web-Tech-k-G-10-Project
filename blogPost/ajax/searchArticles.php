<?php

session_start();

include "../config/database.php";

include "../app/models/articleModel.php";


$authorId =
$_SESSION["userId"] ?? 1;

$keyword =
$_GET["keyword"] ?? "";


$article =
new ArticleModel($conn);


$result =
$article->searchArticles(

    $authorId,
    $keyword

);


while(

$row =
$result->fetch_assoc()

){

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

<?php

if(

$row["status"]=="revision_requested"

){

echo $row["editor_feedback"];

}

else{

echo "-";

}

?>

</td>


<td>

<?php echo $row["created_at"]; ?>

</td>


<td>

<?php

if(

$row["status"]=="draft"

||

$row["status"]=="revision_requested"

){

?>

<a href="editArticle.php?articleId=<?php echo $row["id"]; ?>">

Edit

</a>


<a href="../../controllers/articleController.php?submit=<?php echo $row["id"]; ?>">

<?php

if(

$row["status"]=="revision_requested"

){

echo "Resubmit";

}

else{

echo "Submit";

}

?>

</a>

<?php

}

?>


<a href="revisionHistory.php?articleId=<?php echo $row["id"]; ?>">

Revisions

</a>


<?php

if(

$row["status"]=="published"

){

?>

<a href="../../controllers/articleController.php?unpublish=<?php echo $row["id"]; ?>">

Unpublish

</a>

<?php

}

?>

</td>

</tr>

<?php

}

?>