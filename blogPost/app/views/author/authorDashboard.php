<?php

session_start();

include "../../../config/database.php";

include "../../models/articleModel.php";


$authorId =
$_SESSION["userId"] ?? 1;


$sql = "SELECT

title,
status

FROM articles

WHERE author_id=?";


$stmt =
$conn->prepare($sql);

$stmt->bind_param(

    "i",

    $authorId

);

$stmt->execute();

$result =
$stmt->get_result();

?>

<h1>

Author Dashboard

</h1>


<table border="1">

<tr>

<th>

Article

</th>

<th>

Submission Status

</th>

</tr>


<?php

while(

$row=$result->fetch_assoc()

){

?>

<tr>

<td>

<?php echo $row["title"]; ?>

</td>

<td>

<?php echo $row["status"]; ?>

</td>

</tr>

<?php } ?>

</table>