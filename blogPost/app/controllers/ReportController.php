<?php

class ReportController{


function getQueue(){

$report=
new ReportQueue();

return
$report
->getReports();

}



function delete(
$id
){

$report=
new ReportQueue();

return
$report
->deleteComment(
$id
);

}



function dismiss(
$id
){

$report=
new ReportQueue();

return
$report
->dismissReport(
$id
);

}

}

?>