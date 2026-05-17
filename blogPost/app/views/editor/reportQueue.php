<?php

session_start();

include "../../../config/database.php";

include "../../models/ReportQueue.php";

include "../../controllers/ReportController.php";


if(
!isset($_SESSION["userId"])
){

header(
"Location:../auth/login.php"
);

exit();

}


if(
$_SESSION["role"]!="editor"
){

die(
"Access Denied"
);

}


$controller=
new ReportController();


if(
isset($_POST["delete"])
){

$controller
->delete(
$_POST["reportId"]
);

}


if(
isset($_POST["dismiss"])
){

$controller
->dismiss(
$_POST["reportId"]
);

}


$reports=
$controller
->getQueue();

?>


<!DOCTYPE html>

<html>

<head>

<title>

Report Queue

</title>

</head>

<body>

<h2>

Flagged Comment Queue

</h2>

<table border="1">

<tr>

<th>Article</th>

<th>Comment</th>

<th>Reporter</th>

<th>Reason</th>

<th>Action</th>

</tr>


<?php

while(
$row=
mysqli_fetch_assoc(
$reports
)
){

?>

<tr>

<td>

<?php
echo $row["articleTitle"];
?>

</td>

<td>

<?php
echo $row["commentBody"];
?>

</td>

<td>

<?php
echo $row["reporter"];
?>

</td>

<td>

<?php
echo $row["reason"];
?>

</td>

<td>

<form
method="POST"
>

<input
type="hidden"
name="reportId"
value="<?php echo $row["id"]; ?>"
>

<input
type="submit"
name="delete"
value="Delete Comment"
>

<input
type="submit"
name="dismiss"
value="Dismiss"
>

</form>

</td>

</tr>

<?php

}

?>

</table>

</body>

</html>