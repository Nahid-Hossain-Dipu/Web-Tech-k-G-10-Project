 <?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include "config/database.php";

$sql = "SELECT * FROM articles WHERE status='published' ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<h2>Welcome <?php echo $_SESSION['name']; ?></h2>
<a href="profile.php">My Profile</a>
<a href="logout.php">Logout</a>
<a href="reading-list.php"> My Reading List</a>
<a href="apply_author.php">Apply For Author</a>
<hr>


<!-- SEARCH SECTION HERE -->

<input type="text" id="search" placeholder="Search articles...">

<hr>
<h2>Latest Articles</h2>

<!-- ARTICLE CONTAINER -->
<div id="articleContainer">

<?php

while($article = mysqli_fetch_assoc($result)){

?>

<div class="article-card">
    <h3><?php echo $article['title']; ?></h3>
    <p><?php echo substr($article['body'],0,100); ?></p>
    <small>Author: <?php echo $article['author_name']; ?></small>
    <br><br>
    <a href="article.php?id=<?php echo $article['id']; ?>">Read More</a>
</div>

<?php
}
?>
</div>


<!-- SEARCH JAVASCRIPT -->

<script>
document.getElementById("search").addEventListener("keyup", function(){
    let keyword = this.value;
    fetch("ajaxs/search.php?keyword=" + encodeURIComponent(keyword))

    .then(function(response){
        return response.text();
    })
    .then(function(data){
        document.getElementById("articleContainer").innerHTML = data;
    })
    .catch(function(error){
        console.log(error);
    });
});

</script>

</body>
</html>