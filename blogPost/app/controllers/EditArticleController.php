<?php

class EditArticleController{


function getArticle($id){

$article=
new EditArticle();

return
$article
->getArticleById(
$id
);

}



function saveArticle(

$id,
$title,
$body,
$category

){

$article=
new EditArticle();

return
$article
->updateArticle(

$id,
$title,
$body,
$category

);

}



function saveTags(

$id,
$tags

){

$article=
new EditArticle();

return
$article
->updateTags(

$id,
$tags

);

}

}

?>