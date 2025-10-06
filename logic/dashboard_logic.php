<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    header("location: index.php"); 
    exit();
}

$juegos = [];
try {
    $sql = "SELECT id_juego, titulo, anio_lanzamiento, caratula_imagen FROM juegos ORDER BY fecha_subida DESC";
    $stmt = $conn->query($sql);
    $juegos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error al consultar la tabla de juegos: " . $e->getMessage());
}
