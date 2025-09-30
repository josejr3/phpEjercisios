<?php
require 'conexion.php';
session_start();
$_SESSION['error']="";
$user=isset($_POST['user']);
$pasword=isset($_POST['pasword']);
$pasword2=isset($_POST['pasword2']);
$hash=password_hash($pasword,PASSWORD_DEFAULT);
$email=isset($_POST['email']);

if (!empty($pasword)) {
    if ($pasword === $pasword2 ) {
        print_r($_SESSION['user']." ".$_SESSION['pasword']);
        $smt =$conn->prepare("INSERT INTO usuarios (username,pasword,email) values(:username,:pasword,:email)");
        $smt->bindParam('username',$user);
        $smt->bindParam('pasword',$hash);
        $smt->bindParam('email',$email);
        $smt->execute();
    }else{
        $_SESSION['error']="Las contraseñas son diferentes";
        //header('Location: index.php');
    }
}



