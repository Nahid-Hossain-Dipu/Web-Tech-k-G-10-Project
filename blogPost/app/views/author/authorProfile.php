<?php

session_start();

include "../../../config/database.php";

include "../../models/authorUserModel.php";


$userId =
$_SESSION["userId"] ?? 1;


$user =
new AuthorUserModel($conn);


$result =
$user->getUser(
    $userId
);


$row =
$result->fetch_assoc();


$social =
json_decode(

$row["social_links"],

true

);

?>

<!DOCTYPE html>

<html>

<head>

<title>

Author Profile

</title>

<style>

body{

font-family:Arial;
margin:40px;

}

input,
textarea{

width:100%;
padding:10px;
margin-bottom:20px;

}

img{

width:150px;

}

.success{

color:green;

}

</style>

</head>

<body>

<h1>

Manage Profile

</h1>


<?php

if(isset($_GET["success"])){

echo
"<p class='success'>
Profile Updated Successfully
</p>";

}

?>


<form

action="../../controllers/authorProfileController.php"

method="POST"

enctype="multipart/form-data"

>


<label>

Display Name

</label>

<input

type="text"

name="name"

value="<?php echo $row["name"]; ?>"

>


<label>

Bio

</label>

<textarea

name="bio"

><?php echo $row["bio"]; ?></textarea>


<label>

Twitter

</label>

<input

type="text"

name="twitter"

value="<?php echo $social["twitter"] ?? ""; ?>"

>


<label>

LinkedIn

</label>

<input

type="text"

name="linkedin"

value="<?php echo $social["linkedin"] ?? ""; ?>"

>


<label>

GitHub

</label>

<input

type="text"

name="github"

value="<?php echo $social["github"] ?? ""; ?>"

>


<?php

if(

!empty(
$row["profile_pic"]
)

){

?>

<img

src="../../../<?php echo $row["profile_pic"]; ?>"

>

<br><br>

<?php

}

?>


<label>

Profile Picture

</label>

<input

type="file"

name="profilePic"

>


<button type="submit">

Update Profile

</button>

</form>

</body>

</html>