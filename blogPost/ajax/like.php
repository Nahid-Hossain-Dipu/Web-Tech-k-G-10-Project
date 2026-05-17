 <?php

session_start();

include "../config/database.php";

header('Content-Type: application/json');


// CHECK LOGIN

if(!isset($_SESSION['user_id'])){
    
    echo json_encode([
        "likes" => 0
    ]);

    exit();
}


$user_id = $_SESSION['user_id'];

$article_id = $_POST['article_id'];


// CHECK EXISTING LIKE

$check_sql = "
SELECT * FROM likes
WHERE article_id=? AND user_id=?
";

$check_stmt = mysqli_prepare($conn, $check_sql);

mysqli_stmt_bind_param(
    $check_stmt,
    "ii",
    $article_id,
    $user_id
);

mysqli_stmt_execute($check_stmt);

$check_result = mysqli_stmt_get_result($check_stmt);


// IF ALREADY LIKED → REMOVE LIKE

if(mysqli_num_rows($check_result) > 0){

    $delete_sql = "
    DELETE FROM likes
    WHERE article_id=? AND user_id=?
    ";

    $delete_stmt = mysqli_prepare($conn, $delete_sql);

    mysqli_stmt_bind_param(
        $delete_stmt,
        "ii",
        $article_id,
        $user_id
    );

    mysqli_stmt_execute($delete_stmt);

}else{

    // INSERT LIKE

    $insert_sql = "
    INSERT INTO likes(article_id, user_id)
    VALUES(?,?)
    ";

    $insert_stmt = mysqli_prepare($conn, $insert_sql);

    mysqli_stmt_bind_param(
        $insert_stmt,
        "ii",
        $article_id,
        $user_id
    );

    mysqli_stmt_execute($insert_stmt);
}


// COUNT TOTAL LIKES

$count_sql = "
SELECT COUNT(*) AS total
FROM likes
WHERE article_id=?
";

$count_stmt = mysqli_prepare($conn, $count_sql);

mysqli_stmt_bind_param(
    $count_stmt,
    "i",
    $article_id
);

mysqli_stmt_execute($count_stmt);

$count_result = mysqli_stmt_get_result($count_stmt);

$count = mysqli_fetch_assoc($count_result);


// RETURN JSON RESPONSE

echo json_encode([
    "likes" => $count['total']
]);

?>