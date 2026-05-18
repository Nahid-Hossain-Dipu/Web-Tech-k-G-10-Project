<?php

include "../../middleware/authorOnly.php";

include "../../../config/database.php";
include "../../models/articleModel.php";

$articleId = $_GET["articleId"];

$article = new ArticleModel($conn);

$result = $article->getCommentsByArticle(
    $articleId
);

?>

<!DOCTYPE html>

<html>

<head>

    <title>Comments</title>

    <style>
        table {

            width: 100%;
            border-collapse: collapse;

        }

        th,
        td {

            border: 1px solid black;
            padding: 10px;

        }

        textarea {

            width: 100%;
            height: 60px;

        }

        button {

            padding: 10px;

        }
    </style>

</head>

<body>

    <h1>

        Comments

    </h1>

    <a href="articleList.php">

    <button>

        Back To Article List

    </button>

    </a> <br><br>

    <table>

        <tr>

            <th>ID</th>

            <th>Comment</th>

            <th>Reply</th>

            <th>Action</th>

        </tr>

        <tbody id="commentTable">

            <?php

            while ($row = $result->fetch_assoc()) {

            ?>

                <tr id="row<?php echo $row["id"]; ?>">

                    <td>

                        <?php echo $row["id"]; ?>

                    </td>

                    <td>

                        <?php echo $row["content"]; ?>

                    </td>

                    <td>

                        <div>

                            <?php echo $row["reply"] ?? "-"; ?>

                        </div>

                        <br>

                        <textarea
                            id="reply<?php echo $row["id"]; ?>"></textarea>

                    </td>

                    <td>

                        <button

                            onclick="replyComment(
<?php echo $row['id']; ?>
)">

                            Reply

                        </button>


                        <button

                            onclick="deleteComment(
<?php echo $row['id']; ?>
)">

                            Delete

                        </button>

                    </td>

                </tr>

            <?php

            }

            ?>

        </tbody>

    </table>


    <script>
        function replyComment(commentId) {

            let reply = document.getElementById(
                "reply" + commentId
            ).value;


            let xhr = new XMLHttpRequest();

            xhr.open(
                "POST",
                "../../../ajax/commentAjax.php",
                true
            );

            xhr.setRequestHeader(
                "Content-type",
                "application/x-www-form-urlencoded"
            );

            xhr.onload = function() {

                location.reload();

            };

            xhr.send(

                "action=reply" +
                "&commentId=" +
                commentId +
                "&reply=" +
                encodeURIComponent(reply)

            );

        }


        function deleteComment(commentId) {

            let xhr = new XMLHttpRequest();

            xhr.open(
                "POST",
                "../../../ajax/commentAjax.php",
                true
            );

            xhr.setRequestHeader(
                "Content-type",
                "application/x-www-form-urlencoded"
            );

            xhr.onload = function() {

                document.getElementById(
                    "row" + commentId
                ).remove();

            };

            xhr.send(

                "action=delete" +
                "&commentId=" +
                commentId

            );

        }
    </script>

</body>

</html>