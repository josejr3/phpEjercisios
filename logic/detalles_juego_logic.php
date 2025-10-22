<?php
session_start();
require 'conexion.php';
require 'funciones.php'; 

if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    header("location: ../index.php");
    exit();
}
$id_juego = $_GET['id'];

$juego = obtenerDetallesJuego($id_juego, $conn);

if (!$juego) {
    header("location: ../dashboard.php");
    echo($juego);
    exit();
}

try {
    $smt = $conn ->prepare("UPDATE juegos SET vistas= vistas+1 WHERE id_juego=:id");
    $smt ->bindParam("id",$_GET['id']);
    $smt -> execute();
} catch (PDOException $e) {
    echo($e->getMessage());
}

