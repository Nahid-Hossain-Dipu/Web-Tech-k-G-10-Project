<?php

include "../../../config/database.php";

include "../../models/revisionModel.php";


if(

    !isset($_GET["articleId"])

){

    die(

    "Article ID Missing"

    );

}


$articleId =

(int)$_GET["articleId"];


$revision =

new RevisionModel($conn);


$result =

$revision->getRevisions(

    $articleId

);

?>

<!DOCTYPE html>

<html>

<head>

<title>

Revision History

</title>

<style>

table{

width:100%;
border-collapse:collapse;

}

th,
td{

padding:10px;
border:1px solid black;

}

</style>

</head>

<body>

<h2>

Revision History

</h2>


<table>

<tr>

<th>

Revision ID

</th>

<th>

Saved Time

</th>

<th>

Action

</th>

</tr>


<?php

while(

$row=

$result->fetch_assoc()

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

echo $row["saved_at"];

?>

</td>


<td>

<a href="../../controllers/revisionController.php?restore=<?php echo $row["id"]; ?>">

Restore

</a>

</td>

</tr>

<?php

}

?>

</table>

</body>

</html>