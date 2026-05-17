<?php

session_start();

include "../../../config/database.php";

include "../../models/EditArticle.php";

include "../../controllers/EditArticleController.php";


if(
!isset($_SESSION["userId"])
)
{

header(
"Location:../auth/login.php"
);

exit();

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


$editor=
new EditArticleController();


$id=
$_GET["id"];


$result=
$editor->getArticle(
$id
);

$row=
mysqli_fetch_assoc(
$result
);


$categories=
mysqli_query(
$conn,
"SELECT * FROM categories"
);


$tags=
mysqli_query(
$conn,
"SELECT * FROM tags"
);



if(
isset($_POST["save"])
){

$title=
trim(
$_POST["title"]
);

$body=
trim(
$_POST["body"]
);

$category=
$_POST["category"];

$selectedTags=
$_POST["tags"] ?? [];


if(empty($title))
{
die(
"Title required"
);
}


if(empty($body))
{
die(
"Body required"
);
}


$editor
->saveArticle(

$id,
$title,
$body,
$category

);


$editor
->saveTags(

$id,
$selectedTags

);


header(
"Location:editApprovedArticle.php?id=$id"
);

}

?>

<h2>

Edit Approved Article

</h2>

<form method="POST">

Title:

<br>

<input
type="text"
name="title"
value="<?php echo $row["title"]; ?>"
>

<br><br>


Body:

<br>

<textarea
name="body"
rows="10"
cols="50"
><?php echo $row["body"]; ?></textarea>

<br><br>


Category:

<select name="category">

<?php

while(
$cat=
mysqli_fetch_assoc(
$categories
)
){

?>

<option
value="<?php echo $cat["id"]; ?>">

<?php
echo $cat["name"];
?>

</option>

<?php

}

?>

</select>

<br><br>


Tags:

<br>

<?php

while(
$tag=
mysqli_fetch_assoc(
$tags
)
){

?>

<input
type="checkbox"
name="tags[]"
value="<?php echo $tag["id"]; ?>"
>

<?php
echo $tag["name"]; ?>

<br>

<?php

}

?>

<br>

<input
type="submit"
name="save"
value="Save Changes"
>

</form>