<?php

session_start();

include "../../../config/database.php";

include "../../models/AuthorApplication.php";

include "../../controllers/AuthorApplicationController.php";


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
new AuthorApplicationController();


if(
isset($_POST["approve"])
){

$controller
->approve(
$_POST["userId"]
);

}


if(
isset($_POST["reject"])
){

$controller
->reject(
$_POST["userId"]
);

}


$users=
$controller
->getAll();

?>

<!DOCTYPE html>

<html>

<head>

<title>

Author Applications

</title>

</head>

<body>

<h2>

Author Applications

</h2>

<table border="1">

<tr>

<th>Name</th>

<th>Email</th>

<th>Action</th>

</tr>


<?php

while(
$row=
mysqli_fetch_assoc(
$users
)
){

?>

<tr>

<td>

<?php
echo $row["name"];
?>

</td>

<td>

<?php
echo $row["email"];
?>

</td>

<td>

<form method="POST">

<input
type="hidden"
name="userId"
value="<?php echo $row["id"]; ?>"
>

<input
type="submit"
name="approve"
value="Approve"
>

<input
type="submit"
name="reject"
value="Reject"
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