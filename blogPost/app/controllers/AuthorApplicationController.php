<?php

class AuthorApplicationController{


function getAll(){

$app=
new AuthorApplication();

return
$app
->getApplications();

}



function approve(
$id
){

$app=
new AuthorApplication();

return
$app
->approve(
$id
);

}



function reject(
$id
){

$app=
new AuthorApplication();

return
$app
->reject(
$id
);

}

}

?>