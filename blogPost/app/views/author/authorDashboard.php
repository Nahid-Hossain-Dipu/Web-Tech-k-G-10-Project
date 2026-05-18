    <?php
    include "../../middleware/authorOnly.php";

    include "../../../config/database.php";

    include "../../models/articleModel.php";

    include "../../models/authorUserModel.php";


    $authorId = $_SESSION["userId"];


    /* User Profile */

    $user =
    new AuthorUserModel($conn);

    $userResult =
    $user->getUser(
        $authorId
    );

    $userRow =
    $userResult->fetch_assoc();


    $social =
    json_decode(

    $userRow["social_links"],
    true

    );



    /* Article Status */

    $sql = "SELECT

    title,
    status

    FROM articles

    WHERE author_id=?";


    $stmt =
    $conn->prepare($sql);


    $stmt->bind_param(

        "i",

        $authorId

    );


    $stmt->execute();


    $result =
    $stmt->get_result();

    ?>

    <!DOCTYPE html>

    <html>

    <head>

    <title>

    Author Dashboard

    </title>

    <style>

    body{

    font-family:Arial;
    margin:40px;

    }

    img{

    width:150px;
    height:150px;
    object-fit:cover;
    border-radius:50%;

    }

    .profileCard{

    border:1px solid black;
    padding:20px;
    margin-bottom:30px;

    }

    table{

    width:100%;
    border-collapse:collapse;

    }

    th,
    td{

    border:1px solid black;
    padding:10px;

    }

    button{

    padding:10px 20px;
    margin-right:10px;
    margin-top:15px;
    cursor:pointer;

    }

    </style>

    </head>

    <body>

    <h1>

    Author Dashboard

    </h1>



    <div class="profileCard">

<?php

if(!empty($userRow["profile_pic"])){

?>

<img
src="/project/blogPost/<?php echo $userRow["profile_pic"]; ?>"
alt="Profile Image"
>

<br><br>

<?php

}

?>


    <h2>

    <?php

    echo $userRow["name"];

    ?>

    </h2>


    <p>

    <b>Bio:</b>

    <?php

    echo $userRow["bio"] ?? "-";

    ?>

    </p>


    <p>

    <b>Twitter:</b>

    <?php

    echo $social["twitter"] ?? "-";

    ?>

    </p>


    <p>

    <b>LinkedIn:</b>

    <?php

    echo $social["linkedin"] ?? "-";

    ?>

    </p>


    <p>

    <b>GitHub:</b>

    <?php

    echo $social["github"] ?? "-";

    ?>

    </p>


    <a href="authorProfile.php">

    Edit Profile

    </a>


    <br><br>


    <a href="createArticle.php">

    <button>

    Create Article

    </button>

    </a>


    <a href="articleList.php">

    <button>

    My Articles

    </button>

    </a>


    <a href="../../controllers/authorLogout.php">

    <button>

    Logout

    </button>

    </a>
    </div>



    <h2>

    Article Submission Status

    </h2>


    <table>

    <tr>

    <th>

    Article

    </th>

    <th>

    Submission Status

    </th>

    </tr>


    <?php

    while(

    $row =
    $result->fetch_assoc()

    ){

    ?>

    <tr>

    <td>

    <?php echo $row["title"]; ?>

    </td>

    <td>

    <?php echo $row["status"]; ?>

    </td>

    </tr>

    <?php } ?>

    </table>

    </body>

    </html>