<?php

session_start();

include "../../../config/database.php";
include "../../models/articleModel.php";

$authorId = $_SESSION["userId"] ?? 1;

$article = new ArticleModel($conn);


// Filter articles

if (
    isset($_GET["status"]) &&
    $_GET["status"] != "all"
) {

    $status = $_GET["status"];

    $result = $article->filterArticles(
        $authorId,
        $status
    );

} else {

    $result = $article->getAllArticles(
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

        button{

            padding:10px 20px;
            cursor:pointer;

        }

        input{

            padding:10px;
            width:300px;
            margin-bottom:20px;

        }

    </style>

</head>

<body>

<h1>My Articles</h1>


<a href="authorDashboard.php">

    <button>

        Back To Dashboard

    </button>

</a>

<br><br>


<input
    type="text"
    id="searchBox"
    placeholder="Search article..."
    onkeyup="searchArticle()"
>

<br><br>


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


<table>

<tr>

    <th>ID</th>

    <th>Title</th>

    <th>Status</th>

    <th>Editor Feedback</th>

    <th>Created</th>

    <th>Action</th>

</tr>


<tbody id="articleTable">

<?php

while(
    $row = $result->fetch_assoc()
){

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

<?php

if(
    $row["status"] == "revision_requested"
){

    echo $row["editor_feedback"];

}else{

    echo "-";

}

?>

</td>


<td>

    <?php echo $row["created_at"]; ?>

</td>


<td>

<?php

if(
    $row["status"] == "draft"
    ||
    $row["status"] == "revision_requested"
){

?>

<a href="editArticle.php?articleId=<?php echo $row["id"]; ?>">

    Edit

</a>


<a href="../../controllers/articleController.php?submit=<?php echo $row["id"]; ?>">

<?php

if(
    $row["status"] == "revision_requested"
){

    echo "Resubmit";

}else{

    echo "Submit";

}

?>

</a>

<?php

}

?>


<a href="revisionHistory.php?articleId=<?php echo $row["id"]; ?>">

    Revisions

</a>


<a href="articleAnalytics.php?articleId=<?php echo $row["id"]; ?>">

    Analytics

</a>


<?php

if(
    $row["status"] == "published"
){

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

</tbody>

</table>


<script>

function searchArticle(){

    let keyword = document.getElementById(
        "searchBox"
    ).value;


    let xhr = new XMLHttpRequest();


    xhr.open(

        "GET",

        "../../../ajax/searchArticles.php?keyword="
        + keyword,

        true

    );


    xhr.onload = function(){

        document.getElementById(
            "articleTable"
        ).innerHTML = this.responseText;

    };


    xhr.send();

}

</script>

</body>

</html>