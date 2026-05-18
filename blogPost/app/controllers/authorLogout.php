<?php

session_start();

$_SESSION = [];

session_destroy();

header(
    "Location:../views/author/authorLogin.php"
);

exit();

?>