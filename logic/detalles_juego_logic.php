<?php
session_start();
require 'conexion.php';
require 'funciones.php'; 

if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    header("location: ../index.php");
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("location: ../dashboard.php");
    exit();
}
$id_juego = $_GET['id'];

$juego = obtenerDetallesJuego($id_juego, $conn);

if (!$juego) {
    header("location: ../dashboard.php?error=notfound");
    exit();
}

