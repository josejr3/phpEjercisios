<?php
require 'conexion.php';
session_start();
if (!empty($_POST)) {
    $errores = array();

    $_SESSION['user']=$_POST['user'];
    $_SESSION['password']=$_POST['password'];
    $_SESSION['password2']=$_POST['password2'];
    $_SESSION['email']=$_POST['email'];

    if ( strlen($_SESSION['password']) < 8)
         $errores['errorPassword'] = "La contraseña debe tener al menos 8 caracteres  </br>";

    if ( empty($_SESSION['password']) ) 
        $errores['errorPassword'] = "La contraseña no puede estar vacía</br>";

    if ( empty($_SESSION['password2']) ) 
        $errores['errorPassword2'] = "La confirmación de contraseña no puede estar vacía </br>";

    if ( empty($_SESSION['email']) ) 
        $errores['errorEmail'] = "El email no puede estar vacío  </br>";

    if ( empty($_SESSION['user']) ) 
        $errores['errorUser'] = "El nombre de usuario no puede estar vacío  </br>";

    if ( $_SESSION['password'] != $_SESSION['password2']) 
        $errores['errorPassword'] = "Las contraseñas no coinciden  </br>";

    if ( !filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL)) 
        $errores['errorEmail'] = "El email no es válido  </br>";

    if (isset($_FILES['imagen_perfil']) && $_FILES['imagen_perfil']['error'] === UPLOAD_ERR_OK) {

        $archivo = $_FILES['imagen_perfil'];
        $extension_archivo = pathinfo($archivo['name'], PATHINFO_EXTENSION);
        $nombre_archivo = 'imagen_perfil_' . uniqid() . '.' . $extension_archivo;

        move_uploaded_file($archivo['tmp_name'], '../uploads/' . $nombre_archivo);

        $ruta_caratula_db = 'uploads/' . $nombre_archivo;
    }

    if (count($errores)===0) {
        $hash=password_hash($_SESSION['password'],PASSWORD_BCRYPT);
        $smt =$conn->prepare("INSERT INTO usuarios (username,password_hash,email,imagen_perfil) values(:username,:password_hash,:email,:imagen_perfil)");
        $smt->bindParam('username',$_SESSION['user']);
        $smt->bindParam('imagen_perfil',$ruta_caratula_db);
        $smt->bindParam('password_hash',$hash);
        $smt->bindParam('email',$_SESSION['email']);
        try {
            $smt->execute();
        } catch ( PDOException $e) {
                      
            if ($e->getCode()==23000) {
                $errores['errorEmail'] = "El email ya esta registrado</br>";
            
            }else{
                echo $e->getMessage();
            }
            
        }
          
    }
    if(count($errores)>0){ 
        $_SESSION['errores']=$errores;
        header('Location: ../form/register_form.php'); 
    }else{
        $_SESSION['logged'] = true;

       header("location: ../index.php");
    }
   
}







