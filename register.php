<?php
require 'conexion.php';
session_start();
$_SESSION['error']="";
$_SESSION['user']=$_POST['user']??'';
$_SESSION['pasword']=$_POST['pasword']??'';
$_SESSION['pasword2']=$_POST['pasword2']??'';
$_SESSION['email']=$_POST['email']??'';
$hash=password_hash($_SESSION['pasword'],PASSWORD_BCRYPT);
//comprobaciones
$_SESSION['error'] .= empty($_SESSION['pasword'])? "La contraseña es obligatoria" : '';
$_SESSION['error'] .= empty($_SESSION['pasword2'])? "La confirmación de contraseña es obligatoria" : '';
$_SESSION['error'] .= empty($_SESSION['email'])? "El email es obligatorio" : '';
$_SESSION['error'] .= empty($_SESSION['user'])? "El nombre de usuario es obligatorio" : '';
$_SESSION['error'] .= $_SESSION['pasword']!=$_SESSION['pasword2']?"Las contraseñas no coinciden":'';
if ($_SESSION['error']==="") {
        $smt =$conn->prepare("INSERT INTO usuarios (username,pasword,email) values(:username,:pasword,:email)");
        $smt->bindParam('username',$_SESSION['user']);
        $smt->bindParam('pasword',$hash);
        $smt->bindParam('email',$_SESSION['email']);
        $smt->execute();

    }else{
     
    }
   




