<?php

include "authMiddleware.php";

if($_SESSION["role"]!="author"){

    die(
        "Access Denied"
    );

}

?>