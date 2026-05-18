<?php

session_start();

if(!isset($_SESSION["userId"])){

    header(
        "Location:../views/author/authorLogin.php"
    );

    exit();

}

?>