<!DOCTYPE html>

<html>

<head>

<title>

Editor Login

</title>

<link
rel="stylesheet"
href="../../../public/assets/css/login.css">

</head>

<body>

<h2>

Editor Login

</h2>

<form
method="POST"
action="../../controllers/AuthController.php"
>

<table>

<tr>

<td>Email :</td>

<td>

<input
type="email"
name="email"

value="<?php echo $_COOKIE["userEmail"] ?? ""; ?>"

required
>

</td>

</tr>


<tr>

<td>Password :</td>

<td>

<input
type="password"
name="password"
required
>

</td>

</tr>


<tr>

<td></td>

<td>

<input
type="submit"
value="Login"
>

</td>

</tr>

<tr>

<td></td>

<td>

<input
type="checkbox"
name="remember">

Remember Me

</td>

</tr>

</table>

</form>

</body>

</html>