<?php

session_start();

include "config/database.php";

 if(isset($_POST['removeBookmark'])){

    $user_id = $_SESSION['user_id'];

    $article_id = $_POST['bookmark_id'];

    $sql_delete = "
    DELETE FROM bookmarks
    WHERE user_id=? AND article_id=?
    ";

    $stmt_delete = mysqli_prepare($conn, $sql_delete);

    mysqli_stmt_bind_param(
        $stmt_delete,
        "ii",
        $user_id,
        $article_id
    );

    mysqli_stmt_execute($stmt_delete);

    header("Location: reading-list.php");

    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "
SELECT articles.*
FROM bookmarks
JOIN articles
ON bookmarks.article_id = articles.id
WHERE bookmarks.user_id=?
ORDER BY bookmarks.id DESC
";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $user_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Reading List</title>
      <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<h2>My Reading List</h2>

<a href="index.php">Back</a>

<hr>

<?php

while($article = mysqli_fetch_assoc($result)){

?>

<div style="border:1px solid black; padding:15px; margin-bottom:20px;">

    <h3>
        <?php echo $article['title']; ?>
    </h3>
    <p>
        <?php echo substr($article['body'],0,100); ?>
    </p>
    <a href="article.php?id=<?php echo $article['id']; ?>">Read More </a>
    <form method="POST">

    <input type="hidden" name="bookmark_id" value="<?php echo $article['id']; ?>"><br>

    <button type="submit" name="removeBookmark">Remove </button>
</form>

</div>


<?php
}
?>

</body>
</html>