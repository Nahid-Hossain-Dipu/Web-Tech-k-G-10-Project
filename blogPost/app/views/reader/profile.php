<?php
session_start();
include "config/database.php";

$user_id = $_SESSION['user_id'];

// UPDATE PROFILE

if(isset($_POST['updateProfile'])){

    $name = trim($_POST['name']);
    $bio = trim($_POST['bio']);

    // IMAGE UPLOAD

    $image_name = $_FILES['profile_picture']['name'];
    if($image_name != ""){
        $tmp_name = $_FILES['profile_picture']['tmp_name'];
        $target = "uploads/" . $image_name;
        move_uploaded_file($tmp_name, $target);

        $sql = "
        UPDATE users
        SET name=?, bio=?, profile_picture=?
        WHERE id=?
        ";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "sssi",
            $name,
            $bio,
            $image_name,
            $user_id
        );

    }else{

        $sql = "
        UPDATE users
        SET name=?, bio=?
        WHERE id=?
        ";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "ssi",
            $name,
            $bio,
            $user_id
        );
    }

    mysqli_stmt_execute($stmt);

    $_SESSION['name'] = $name;
}



// UPDATE PASSWORD

if(isset($_POST['changePassword'])){

    $new_password = $_POST['new_password'];

    $sql_password = "
    UPDATE users
    SET password=?
    WHERE id=?
    ";

    $stmt_password = mysqli_prepare($conn, $sql_password);

    mysqli_stmt_bind_param(
        $stmt_password,
        "si",
        $new_password,
        $user_id
    );

    mysqli_stmt_execute($stmt_password);
}



// GET USER DATA

$sql_user = "SELECT * FROM users WHERE id=?";

$stmt_user = mysqli_prepare($conn, $sql_user);

mysqli_stmt_bind_param($stmt_user, "i", $user_id);

mysqli_stmt_execute($stmt_user);

$result_user = mysqli_stmt_get_result($stmt_user);

$user = mysqli_fetch_assoc($result_user);



// READING STATISTICS

// TOTAL COMMENTS

$sql_comments = "
SELECT COUNT(*) AS total_comments
FROM comments
WHERE user_id=?
";

$stmt_comments = mysqli_prepare($conn, $sql_comments);

mysqli_stmt_bind_param($stmt_comments, "i", $user_id);

mysqli_stmt_execute($stmt_comments);

$result_comments = mysqli_stmt_get_result($stmt_comments);

$comments_data = mysqli_fetch_assoc($result_comments);


// TOTAL LIKES

$sql_likes = "
SELECT COUNT(*) AS total_likes
FROM likes
WHERE user_id=?
";

$stmt_likes = mysqli_prepare($conn, $sql_likes);

mysqli_stmt_bind_param($stmt_likes, "i", $user_id);

mysqli_stmt_execute($stmt_likes);

$result_likes = mysqli_stmt_get_result($stmt_likes);

$likes_data = mysqli_fetch_assoc($result_likes);


// TOTAL BOOKMARKS

$sql_bookmarks = "
SELECT COUNT(*) AS total_bookmarks
FROM bookmarks
WHERE user_id=?
";

$stmt_bookmarks = mysqli_prepare($conn, $sql_bookmarks);

mysqli_stmt_bind_param($stmt_bookmarks, "i", $user_id);

mysqli_stmt_execute($stmt_bookmarks);

$result_bookmarks = mysqli_stmt_get_result($stmt_bookmarks);

$bookmarks_data = mysqli_fetch_assoc($result_bookmarks);

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="profile-container">
<h2>My Profile</h2>

<a href="index.php">Back</a>

<hr>


<!-- PROFILE PICTURE -->
<?php if(isset($user['profile_picture']) && $user['profile_picture'] != ""){ ?>

<img
class="profile-image"
src="uploads/<?php echo $user['profile_picture']; ?>">

<?php } ?>
<!-- PROFILE FORM -->

<form method="POST" enctype="multipart/form-data">

    <p>Name</p>

    <input
    type="text"
    name="name"
    value="<?php echo $user['name']; ?>">

    <br><br>

    <p>Bio</p>

    <textarea name="bio" rows="5" cols="40"><?php echo $user['bio']; ?></textarea>

    <br><br>

    <p>Profile Picture</p>

    <input type="file" name="profile_picture">

    <br><br>

    <button type="submit" name="updateProfile">

        Update Profile

    </button>

</form>

<hr>


<!-- PASSWORD -->

<h3>Change Password</h3>

<form method="POST">
    <input type="password" name="new_password" placeholder="New Password"><br><br>
    <button type="submit" name="changePassword">Change Password</button>
</form>

<hr>


<!-- STATISTICS -->

<h3>Reading Statistics</h3>
<p>Comments Posted:<?php echo $comments_data['total_comments']; ?></p>
<p>Likes Given:<?php echo $likes_data['total_likes']; ?></p>
<p>Saved Articles:<?php echo $bookmarks_data['total_bookmarks']; ?></p>
</div>
</body>
</html>