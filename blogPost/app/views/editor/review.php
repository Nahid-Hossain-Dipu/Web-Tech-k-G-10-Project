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


$id =
$_GET["id"];


$result =
$editor->review(
$id
);

$row =
mysqli_fetch_assoc(
$result);


$tags =
$editor->tags(
$id
);



if(
isset($_POST["approve"])
){

$editor
->updateStatus(

$id,

"approved",

""

);

header(
"Location:queue.php"
);

}



if(
isset($_POST["revision"])
){

$feedback =
trim(
$_POST["feedback"]
);


if(
empty($feedback)
)
{

die(
"Feedback is required"
);

}


$editor
->updateStatus(

$id,

"revision_requested",

$feedback

);

header(
"Location:queue.php"
);

}

?>

<!DOCTYPE html>

<html>

<head>

<title>

Review Article

</title>

</head>

<body>

<h2>

Review Article

</h2>

Title :

<?php

echo
$row["title"];

?>

<br><br>


Author :

<?php

echo
$row["authorName"];

?>

<br><br>


Category :

<?php

echo
$row["categoryName"];

?>

<br><br>


Featured Image :

<br><br>

<img
src="../../../public/uploads/<?php echo $row["featured_image_path"]; ?>"
width="200"
>

<br><br>


Tags :

<?php

while(
$tag=
mysqli_fetch_assoc(
$tags
)
){

echo
$tag["name"];

echo
", ";

}

?>

<br><br>


Body :

<p>

<?php

echo
$row["body"];

?>

</p>


<form method="POST">

Editor Feedback :

<br>

<textarea
name="feedback"
rows="5"
cols="30"
></textarea>

<br><br>


<input
type="submit"
name="approve"
value="Approve"
>


<input
type="submit"
name="revision"
value="Request Revision"
>

</form>

</body>

</html>