 <?php

include "../config/database.php";

$keyword = $_GET['keyword'];

$search = "%" . $keyword . "%";

$sql = "
SELECT * FROM articles
WHERE title LIKE ?
OR body LIKE ?
ORDER BY id DESC
";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ss",
    $search,
    $search
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

while($article = mysqli_fetch_assoc($result)){

?>
<div style="border:1px solid black; padding:15px; margin-bottom:20px;">

    <h3>
        <?php echo $article['title']; ?>
    </h3>

    <p>
        <?php echo substr($article['body'],0,100); ?>
    </p>

    <small>
        Author: <?php echo $article['author_name']; ?>
    </small>

    <br><br>

    <a href="../article.php?id=<?php echo $article['id']; ?>">
        Read More
    </a>

</div>

<?php
}
?>