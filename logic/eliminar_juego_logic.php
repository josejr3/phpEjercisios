<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    header("location: ../index.php");
    exit();
}

if (isset($_POST['id_juego']) ) {
    
    $id_juego_a_eliminar = $_POST['id_juego'];
    try {        
            $sql_delete = "DELETE FROM juegos WHERE id_juego = :id_juego";
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bindParam(':id_juego', $id_juego_a_eliminar, PDO::PARAM_INT);
            $stmt_delete->execute();
            header("Location: ../dashboard.php?status=deleted");
            exit();

    } catch (PDOException $e) {
        header("Location: ../dashboard.php");
        exit();
    }
}


header("Location: ../dashboard.php");
exit();