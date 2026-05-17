<?php include "../controller/registerController.php"; ?>

<h2>Register</h2>

<?php if($message != ""){ ?>
    <p><?= $message; ?></p>
<?php } ?>

<form method="POST">

    <input type="text" name="name" placeholder="Name"><br><br>

    <input type="text" name="username" placeholder="Username"><br><br>

    <input type="email" name="email" placeholder="Email"><br><br>

    <input type="password" name="password" placeholder="Password"><br><br>

    <button type="submit">Register</button>

</form>