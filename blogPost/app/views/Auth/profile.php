<?php

session_start();

include "../../../config/database.php";
include "../../models/User.php";

if(
!isset($_SESSION["userId"])
)
{
header(
"Location:login.php"
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

$user=
new User();

$result=
$user->getProfile(
$_SESSION["userId"]
);

$row=
mysqli_fetch_assoc(
$result
);


if(
isset($_POST["update"])
){

$name=
trim($_POST["name"]);

$bio=
trim($_POST["bio"]);


if(
empty($name)
)
{
die(
"Name cannot be empty"
);
}


if(
strlen($bio)<5
)
{
die(
"Bio must contain at least 5 characters"
);
}


$user->updateProfile(

$_SESSION["userId"],
$name,
$bio

);

header(
"Location:profile.php"
);

}

?>

<h2>

Editor Profile

</h2>

<form method="POST">

<table>

<tr>

<td>Name :</td>

<td>

<input
type="text"
name="name"
value="<?php echo $row["name"]; ?>"
>

</td>

</tr>


<tr>

<td>Bio :</td>

<td>

<textarea
name="bio"
rows="4"
cols="22"
><?php echo $row["bio"]; ?></textarea>

</td>

</tr>


<tr>

<td></td>

<td>

<input
type="submit"
name="update"
value="Update Profile"
>

</td>

</tr>

</table>

</form>

<br>

<a href="../editor/dashboard.php">

Dashboard

</a>