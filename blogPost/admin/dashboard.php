<?php

session_start();

include("../config/db.php");

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");

}

$totalUsers = $conn->query(

"SELECT COUNT(*) as total FROM users"

);

$userData = $totalUsers->fetch_assoc();

?>

<!DOCTYPE html>

<html>

<head>

<title>Dashboard</title>

</head>

<body>

<h1>Admin Dashboard</h1>

<h2>Total Users</h2>

<p>

<?php echo $userData['total']; ?>

</p>

</body>

</html>