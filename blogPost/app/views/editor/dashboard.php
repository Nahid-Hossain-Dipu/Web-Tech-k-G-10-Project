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

$editor=
new EditorController();

$data=
$editor->dashboard();

?>

<h2>

Editorial Dashboard

</h2>

<table border="1">

<tr>

<th>Feature</th>
<th>Total</th>

</tr>

<tr>

<td>Submitted Articles</td>

<td>

<?php
echo $data["submitted"]["total"];
?>

</td>

</tr>

<tr>

<td>Approved Pending Schedule</td>

<td>

<?php
echo $data["approved"]["total"];
?>

</td>

</tr>

<tr>

<td>Scheduled Today</td>

<td>

<?php
echo $data["scheduled"]["total"];
?>

</td>

</tr>

<tr>

<td>Published This Week</td>

<td>

<?php
echo $data["published"]["total"];
?>

</td>

</tr>

</table>
<form action="queue.php">

<input
type="submit"
value="Open Editorial Queue"
>

</form>