<?php
require 'conexion.php';
session_start();
if (!empty($_POST)) {
    $errores = array();

    $_SESSION['email']=$_POST['email'];
    $_SESSION['password']=$_POST['password'];

    if ( !filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL) && !empty($_SESSION['email'])) 
        $errores['errorEmail'] = "El email no es válido  </br>";

    if ( empty($_SESSION['password']) ) 
        $errores['errorPassword'] = "La contraseña no puede estar vacía</br>";

    if ( empty($_SESSION['email']) ) 
        $errores['errorEmail'] = "El email no puede estar vacío  </br>";

    if (count($errores)===0) {
        $smt =$conn->prepare("SELECT id_usuario, username, password_hash FROM usuarios WHERE email=:email");
        $smt->bindParam('email',$_SESSION['email']);
        try {
            $smt->execute();
            $userData=$smt->fetch(PDO::FETCH_ASSOC);
            if ($userData && password_verify($_SESSION['password'], $userData['password_hash'])) {
                $_SESSION['logged'] = true;
                header("location: dashboard.php");
            } else {
                $errores['errorEmail'] = "Email o contraseña incorrectos</br>";
            }
        } catch ( PDOException $e) {

            if ($e->getCode()==23000) $errores['errorEmail'] = "El email no esta registrado</br>";        
        }
          
    }
    if(count($errores)>0){ 
        $_SESSION['erroresLoging']=$errores;
        header('Location: ../index.php'); 
    }
   
}
