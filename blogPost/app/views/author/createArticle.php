<!DOCTYPE html>

<html>

<head>

<title>Create Article</title>

<style>

body{
font-family:Arial;
margin:40px;
}

input,
textarea,
select{

width:100%;
padding:10px;
margin-top:10px;
margin-bottom:20px;

}

textarea{
height:200px;
}

.success{
color:green;
}

.error{
color:red;
}

</style>

</head>

<body>

<h1>Create Article</h1>


<?php

if(isset($_GET["success"])){

echo "<p class='success'>
Article Created Successfully
</p>";

}

if(isset($_GET["error"])){

echo "<p class='error'>
Failed To Create Article
</p>";

}

?>


<form

action="../../controllers/articleController.php"

method="POST"

enctype="multipart/form-data"

>

<label>Category</label>

<select name="categoryId">

<option value="1">Technology</option>

<option value="2">Sports</option>

<option value="3">News</option>

</select>



<label>Series (Optional)</label>

<select name="seriesId">

<option value="">None</option>

<option value="1">Web Development</option>

<option value="2">Programming</option>

</select>



<label>Title</label>

<input
type="text"
name="title"
required
>



<label>Excerpt</label>

<textarea
name="excerpt"
></textarea>



<label>Body</label>

<textarea
name="body"
required
></textarea>



<label>Tags</label>

<input
type="text"
name="tags"
placeholder="php,mysql,ajax"
>



<label>Featured Image</label>

<input
type="file"
name="featuredImage"
>



<label>Status</label>

<select
name="status"
>

<option value="draft">
Draft
</option>

<option value="submitted">
Submitted
</option>

</select>


<button type="submit">

Create Article

</button>

</form>

</body>

</html>