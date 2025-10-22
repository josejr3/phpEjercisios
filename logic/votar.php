<?php
session_start();
require 'conexion.php';
require 'funciones.php';

$id_juego = $_REQUEST['id_juego'] ?? "";;
$id_usuario = $_SESSION['user_id'] ?? "";;
$voto = $_REQUEST['voto'] ?? "";;

if (!(empty($id_usuario) || empty($id_juego)|| empty($voto))) {
  if($voto==="like"||$voto==="dislike"){
  try {
    $sql = "INSERT INTO votos_juegos (id_usuario, id_juego, voto)
            VALUES (:id_usuario, :id_juego, :voto)
            ON DUPLICATE KEY UPDATE voto = :voto";
            
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->bindParam(':id_juego', $id_juego );
    $stmt->bindParam(':voto', $voto);
    $stmt->execute();
    $nueva_puntuacion = obtenerPuntuacionJuego($id_juego,$conn);
    
    echo ($nueva_puntuacion);

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
}else{
  echo("error en el voto");
  die();
}
}else{
  die("Error: idjuego: ".$id_juego."idusuario: "." voto: ".$voto);
}



