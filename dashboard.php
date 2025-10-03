<?php 
    if (!isset($_SESSION)) {
        header("locate: index.php");
    }
    echo("Vienvenido "+$_SESSION["user"]);
?>