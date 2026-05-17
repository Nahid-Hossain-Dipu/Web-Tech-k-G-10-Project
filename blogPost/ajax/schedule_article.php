<?php

session_start();

include "../config/database.php";

include "../app/models/ScheduleArticle.php";

include "../app/controllers/ScheduleController.php";


$articleId=
$_POST["article"];

$date=
$_POST["date"];

$note=
trim(
$_POST["note"]
);


if(
empty($date)
){

die(
"Publication date required"
);

}


$controller=
new ScheduleController();


$result=
$controller
->saveSchedule(

$articleId,

$_SESSION["userId"],

$date,

$note

);


if($result){

echo
"Article scheduled successfully";

}
else{

echo
"Failed";

}

?>