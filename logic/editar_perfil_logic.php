<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    header("location: ../dashboard.php"); 
    exit();
}

try {
    $sql_imagen = "SELECT imagen_perfil FROM usuarios WHERE id_usuario=:id";  
    $stmt_imagen = $conn->prepare($sql_imagen);
    $stmt_imagen -> bindParam(':id',$_SESSION['user_id']);
    $stmt_imagen -> execute();
    $imagen_perfil = $stmt_imagen->fetch(PDO::FETCH_ASSOC);  
    $imagen_perfil=$imagen_perfil['imagen_perfil']; 
} catch (PDOException $e) {
    die("Error al consultar la la iamgen del usuario: " . $e->getMessage());
}

if (!empty($_POST)) {
    $erroresDeeditarperfil = array();

    //$_SESSION['userPerfil']=$_POST['user'];
    //$_SESSION['passwordPerfil']=$_POST['password'];
    //$_SESSION['password2Perfil']=$_POST['password2'];

    if ( empty($_SESSION['user']) ) 
        $erroresDeeditarperfil['errorUser'] = "El nombre de usuario no puede estar vacío  </br>";

    if (isset($_FILES['imagen_perfil']) && $_FILES['imagen_perfil']['error'] === UPLOAD_ERR_OK) {

        $archivo = $_FILES['imagen_perfil'];
        $extension_archivo = pathinfo($archivo['name'], PATHINFO_EXTENSION);
        $nombre_archivo = 'imagen_perfil_' . uniqid() . '.' . $extension_archivo;

        move_uploaded_file($archivo['tmp_name'], '../uploads/' . $nombre_archivo);
        $imagen_perfil = 'uploads/' . $nombre_archivo;
    }else{
        $imagen_perfil=null;
    }
     if (count($erroresDeeditarperfil)===0) {
        try {
            $stmt=$conn ->prepare("UPDATE usuarios SET username=:nuevoNombre, imagen_perfil=:imagen WHERE id_usuario=:userid");
            $stmt ->bindParam(":nuevoNombre", $_POST['user']);
            $stmt ->bindParam(":imagen",$imagen_perfil);
            $stmt ->bindParam(":userid",$_SESSION['user_id']);
            $stmt -> execute();
            header("location:../dashboard.php");
        } catch (PDOException $e) {
           echo($e->getMessage());
        }     
     }

     
}

