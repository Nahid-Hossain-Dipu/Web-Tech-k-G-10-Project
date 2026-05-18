<?php

include "../../middleware/authorOnly.php";
include "../../../config/database.php";

?>

<!DOCTYPE html>

<html>

<head>

<title>

Create Article

</title>

<style>

body{

    font-family:Arial;
    margin:40px;
    background-color:#f5f5f5;

}

.container{

    width:70%;
    margin:auto;
    background:white;
    padding:20px;
    border:1px solid lightgray;

}

h1{
    text-align: center;

    color:black;

}

input,
textarea,
select{

    width:100%;
    padding:10px;
    margin-top:10px;
    margin-bottom:20px;
    border:1px solid gray;

}

textarea{

    height:200px;

}

button{

    padding:10px 20px;
    background-color:grey;
    color:white;
    border:none;
    cursor:pointer;

}

button:hover{

    background-color:black;

}

.success{

    color:green;
    font-weight:bold;

}

.error{

    color:red;
    font-weight:bold;

}

.backButton{

    margin-bottom:20px;

}

label{

    font-weight:bold;

}

</style>

</head>

<body>

<div class="container">

<h1>

Create Article

</h1>


<a href="authorDashboard.php">

<button class="backButton">

Back To Dashboard

</button>

</a>

<br><br>


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


<label>

Category

</label>

<select name="categoryId">

<?php

$result =
$conn->query(
"SELECT * FROM categories"
);

while($row=$result->fetch_assoc()){

?>

<option
value="<?php echo $row['id']; ?>">

<?php echo $row['name']; ?>

</option>

<?php

}

?>

</select>



<label>

Series (Optional)

</label>

<select name="seriesId">

<option value="">

None

</option>

<?php

$result =
$conn->query(
"SELECT * FROM series"
);

while($row=$result->fetch_assoc()){

?>

<option
value="<?php echo $row['id']; ?>">

<?php echo $row['title']; ?>

</option>

<?php

}

?>

</select>



<label>

Title

</label>

<input
type="text"
name="title"
required
>



<label>

Excerpt

</label>

<textarea
name="excerpt"
></textarea>



<label>

Body

</label>

<textarea
name="body"
required
></textarea>



<label>

Tags

</label>

<input
type="text"
name="tags"
placeholder="php,mysql,ajax"
>



<label>

Featured Image

</label>

<input
type="file"
name="featuredImage"
>



<label>

Status

</label>

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

</div>

</body>

</html>