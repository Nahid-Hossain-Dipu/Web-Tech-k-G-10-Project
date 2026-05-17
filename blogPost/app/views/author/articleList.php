<?php

session_start();

include "../../../config/database.php";

include "../../models/articleModel.php";


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

<?php

if($row["status"]=="draft"){

?>

<a href="editArticle.php?articleId=<?php echo $row["id"]; ?>">

Edit

</a>

<?php

}

?>


<a href="revisionHistory.php?articleId=<?php echo $row["id"]; ?>">

Revisions

</a>


<?php

if($row["status"]=="published"){

?>

<a href="../../controllers/articleController.php?unpublish=<?php echo $row["id"]; ?>">

Unpublish

</a>

<?php

}

?>

</td>

</tr>

<?php

}

?>

</table>

</body>

</html>