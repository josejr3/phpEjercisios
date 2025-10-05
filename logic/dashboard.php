<?php 
    session_start();
    if (!isset($_SESSION['logged'])==true) {
        header("location: ../index.php");
    }else{
        echo("Bienvenido ".$_SESSION["user"]);
    }
    
?>