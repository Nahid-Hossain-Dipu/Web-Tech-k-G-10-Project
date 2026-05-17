<?php

session_start();

include "../../../config/database.php";

include "../../models/ScheduleArticle.php";

include "../../controllers/ScheduleController.php";


if(
!isset($_SESSION["userId"])
){

header(
"Location:../auth/login.php"
);

exit();

}


if(
$_SESSION["role"]
!="editor"
){

die(
"Access Denied"
);

}


$controller=
new ScheduleController();

$articles=
$controller
->getArticles();

?>

<!DOCTYPE html>

<html>

<head>

<title>

Schedule Article

</title>

</head>

<body>

<h2>

Schedule Article Publication

</h2>

<form
id="scheduleForm"
>

Approved Article:

<br>

<select
name="article"
>

<?php

while(

$row=
mysqli_fetch_assoc(
$articles
)

){

?>

<option
value="<?php echo $row["id"]; ?>">

<?php
echo $row["title"];
?>

</option>

<?php

}

?>

</select>

<br><br>


Publication Date:

<br>

<input
type="date"
name="date"
>

<br><br>


Note:

<br>

<textarea
name="note"
></textarea>

<br><br>


<input
type="submit"
value="Schedule"
>

</form>

<br>

<div id="result"></div>

<script src="../../../public/assets/js/schedule.js"></script>

</body>

</html>