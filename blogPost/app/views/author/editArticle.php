<?php

session_start();

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
$article->getArticle(
    $articleId
);


$row =
$result->fetch_assoc();

?>


<!DOCTYPE html>

<html>

<head>

<title>Edit Article</title>

<style>

body{

font-family:Arial;
margin:40px;

}

input,
textarea,
select{

width:100%;
padding:10px;
margin-bottom:20px;

}

textarea{

height:200px;

}

</style>

</head>

<body>

<h1>Edit Article</h1>


<form

action="../../controllers/articleController.php"

method="POST"

>

<input
type="hidden"
name="articleId"
value="<?php echo $row["id"]; ?>"
>


<label>

Title

</label>

<input

type="text"

name="title"

value="<?php echo $row["title"]; ?>"

required

>


<label>

Excerpt

</label>

<textarea

name="excerpt"

><?php echo $row["excerpt"]; ?></textarea>



<label>

Body

</label>

<textarea

name="body"

required

><?php echo $row["body"]; ?></textarea>



<label>

Status

</label>

<select

name="status"

>

<option value="draft"

<?php

if(
$row["status"]=="draft"
)

echo "selected";

?>

>

Draft

</option>



<option value="submitted"

<?php

if(
$row["status"]=="submitted"
)

echo "selected";

?>

>

Submitted

</option>

</select>


<button
type="submit"
name="updateArticle"
>

Update Article

</button>

</form>

</body>

</html>