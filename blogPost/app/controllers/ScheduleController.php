<?php

class ScheduleController{


function getArticles(){

$article=
new ScheduleArticle();

return
$article
->getApprovedArticles();

}



function saveSchedule(

$articleId,
$editorId,
$date,
$note

){

$article=
new ScheduleArticle();

return
$article
->scheduleArticle(

$articleId,
$editorId,
$date,
$note

);

}

}

?>