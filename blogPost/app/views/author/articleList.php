<?php

session_start();

include "../../../config/database.php";

include "../../models/articleModel.php";


<<<<<<< HEAD
<<<<<<< HEAD
$authorId = $_SESSION["userId"] ?? 1;


$article = new ArticleModel($conn);

$result = $article->getAllArticles($authorId);
=======
=======
>>>>>>> origin/main
$authorId =
$_SESSION["userId"] ?? 1;


$article =
new ArticleModel($conn);


if(

isset($_GET["status"])

&&

$_GET["status"]!="all"

){

    $status =
    $_GET["status"];


    $result =
    $article->filterArticles(

        $authorId,
        $status

    );

}

else{

    $result =
    $article->getAllArticles(

        $authorId

    );

}
<<<<<<< HEAD
>>>>>>> a5488371d680df4dd16c0dd7963996abab588316
=======
>>>>>>> origin/main

?>

<!DOCTYPE html>

<html>

<head>

<title>My Articles</title>

<style>

table{

width:100%;
border-collapse:collapse;

}

th,
td{

border:1px solid black;
padding:10px;

}

a{

text-decoration:none;
margin-right:10px;

}

</style>

</head>

<body>

<h1>My Articles</h1>

<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> origin/main
<a href="articleList.php?status=all">All</a> |

<a href="articleList.php?status=draft">Draft</a> |

<a href="articleList.php?status=submitted">Submitted</a> |

<a href="articleList.php?status=revision_requested">

Revision Requested

</a> |

<a href="articleList.php?status=published">

Published

</a> |

<a href="articleList.php?status=unpublished">

Unpublished

</a>

<br><br>

<br><br>

<<<<<<< HEAD
>>>>>>> a5488371d680df4dd16c0dd7963996abab588316
=======
>>>>>>> origin/main
<table>

<tr>

<th>ID</th>

<th>Title</th>

<th>Status</th>

<th>Created</th>

<th>Action</th>

</tr>

<?php

while($row = $result->fetch_assoc()){

?>

<tr>

<td>

<?php echo $row["id"]; ?>

</td>

<td>

<a href="viewArticle.php?articleId=<?php echo $row["id"]; ?>">

<?php echo $row["title"]; ?>

</a>

</td>

<td>

<?php echo $row["status"]; ?>

</td>

<td>

<?php echo $row["created_at"]; ?>

</td>

<td>

<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> origin/main
<?php

if($row["status"]=="draft"){

?>

<<<<<<< HEAD
>>>>>>> a5488371d680df4dd16c0dd7963996abab588316
=======
>>>>>>> origin/main
<a href="editArticle.php?articleId=<?php echo $row["id"]; ?>">

Edit

</a>

<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
<a href="../../controllers/articleController.php?submit=<?php echo $row["id"]; ?>">

Submit

</a>

>>>>>>> origin/main
<?php

}

?>


<<<<<<< HEAD
>>>>>>> a5488371d680df4dd16c0dd7963996abab588316
=======
>>>>>>> origin/main
<a href="revisionHistory.php?articleId=<?php echo $row["id"]; ?>">

Revisions

</a>

<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> origin/main

<?php

if($row["status"]=="published"){

?>

<a href="../../controllers/articleController.php?unpublish=<?php echo $row["id"]; ?>">

Unpublish

</a>

<?php

}

?>

<<<<<<< HEAD
>>>>>>> a5488371d680df4dd16c0dd7963996abab588316
</td>

=======
</td>
>>>>>>> origin/main
</tr>

<?php

}

?>

</table>

</body>

</html>