<?php

include "../../middleware/authorOnly.php";
include "../../../config/database.php";
include "../../models/articleModel.php";
include "../../models/authorUserModel.php";

$authorId = $_SESSION["userId"];

$user = new AuthorUserModel($conn);
$userResult = $user->getUser($authorId);
$userRow = $userResult->fetch_assoc();

$social = json_decode($userRow["social_links"], true);

$sql = "SELECT title,status
         FROM articles
         WHERE author_id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $authorId);
$stmt->execute();

$result = $stmt->get_result();

?>

<!DOCTYPE html>

<html>

<head>

    <title>Author Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f5f5f5;
        }

        .container {
            width: 90%;
            margin: auto;
        }

        .profileCard {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #ddd;
        }

        #edit {
            color: red;
        }

        h1 {
            margin-bottom: 30px;
        }

        h2 {
            margin-top: 15px;
        }

        p {
            margin: 10px 0;
        }

        a {
            text-decoration: none;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
            margin-top: 15px;
            color: gray;
        }

        button:hover {
            color: black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            padding: 12px;
            border: 1px solid #ddd;
        }

        td {
            padding: 10px;
            border: 1px solid #ddd;
        }
    </style>

</head>

<body>

    <div class="container">

        <h1>Author Dashboard</h1>

        <div class="profileCard">

            <?php if (!empty($userRow["profile_pic"])) { ?>

                <img
                    src="/project/blogPost/<?php echo $userRow["profile_pic"]; ?>"
                    alt="Profile Image">

                <br><br>

            <?php } ?>

            <h2><?php echo $userRow["name"]; ?></h2>

            <p><b>Bio:</b> <?php echo $userRow["bio"] ?? "-"; ?></p>

            <p><b>Twitter:</b> <?php echo $social["twitter"] ?? "-"; ?></p>

            <p><b>LinkedIn:</b> <?php echo $social["linkedin"] ?? "-"; ?></p>

            <p><b>GitHub:</b> <?php echo $social["github"] ?? "-"; ?></p>

            <a id="edit" href="authorProfile.php">

                Edit Profile

            </a>

            <br><br>

            <a href="createArticle.php">
                <button>Create Article</button>
            </a>

            <a href="articleList.php">
                <button>My Articles</button>
            </a>

            <a href="../../controllers/authorLogout.php">
                <button>Logout</button>
            </a>

        </div>

        <h2>Article Submission Status</h2>

        <table>

            <tr>
                <th>Article</th>
                <th>Submission Status</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()) { ?>

                <tr>

                    <td><?php echo $row["title"]; ?></td>

                    <td><?php echo $row["status"]; ?></td>

                </tr>

            <?php } ?>

        </table>

    </div>

</body>

</html>