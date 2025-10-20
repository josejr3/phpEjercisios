<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    header("location: index.php"); 
    exit();
}

$juegos = [];

$mostraMisJuegos=$_GET["mostraMisJuegos"] ?? null;

if($mostraMisJuegos){
     $sql = "SELECT id_juego, titulo, anio_lanzamiento, caratula_imagen FROM juegos WHERE id_usuario_creador = :id";
     $stmt = $conn->prepare($sql);
     $stmt ->bindParam(':id',$_SESSION['user_id']);
     $stmt ->execute();

}else{
     $sql = "SELECT id_juego, titulo, anio_lanzamiento, caratula_imagen FROM juegos";
     $stmt = $conn->query($sql);
     $stmt ->execute();
}

try {
    

    $juegos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
} catch (PDOException $e) {
    die("Error al consultar la tabla de juegos: " . $e->getMessage());
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


