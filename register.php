<?php
require 'conexion.php';
session_start();
if (!empty($_POST)) {
    $errores = array();
 
    $_SESSION['user']=$_POST['user'];
    $_SESSION['pasword']=$_POST['pasword'];
    $_SESSION['pasword2']=$_POST['pasword2'];
    $_SESSION['email']=$_POST['email'];
    $hash=password_hash($_SESSION['pasword'],PASSWORD_BCRYPT);
    $_SESSION['error']=null;
    if ( empty($_SESSION['pasword']) )array_push($errores, $valor)
    $errores = empty($_SESSION['pasword'])? "La contraseña es obligatoria  </br>"                   :'';
    $errorPasword2 = empty($_SESSION['pasword2'])? "La confirmación de contraseña es obligatoria  </br>" :'';
    $errorEmail = empty($_SESSION['email'])? "El email es obligatorio  </br>"                               :'';
    
    $errorUser= empty($_SESSION['user'])? "El nombre de usuario es obligatorio  </br>"                      :'';
    $errorPasword=$_SESSION['pasword']!=$_SESSION['pasword2']?"Las contraseñas no coinciden </br>"  :'';
    if ($_SESSION['error']==="") {
        $smt =$conn->prepare("INSERT INTO usuarios (username,pasword,email) values(:username,:pasword,:email)");
        $smt->bindParam('username',$_SESSION['user']);
        $smt->bindParam('pasword',$hash);
        $smt->bindParam('email',$_SESSION['email']);
        try {
            $smt->execute();
        } catch ( PDOException $e) {
            if ($e->getCode()==23000){
                $_SESSION['error']="El email ya esta registrado</br>";
            }
        }
        
       
    }
    if(isset($_SESSION['error']) && $_SESSION['error'] != ''){
        header('Location: index.php');
    }
   
}







