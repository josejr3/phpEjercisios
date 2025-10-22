<?php
session_start();
require 'conexion.php';
require 'funciones.php';

$id_juego = $_POST['id_juego'] ?? "";;
$id_usuario = $_SESSION['user_id'] ?? "";;
$voto = $_POST['voto'] ?? "";;

if (!(empty($id_usuario) || empty($id_juego)|| empty($voto))) {
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
    
    echo "$nueva_puntuacion,$voto";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
}



