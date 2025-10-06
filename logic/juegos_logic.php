<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    header("location: ../index.php");
    exit();
}


if (isset($_POST['guardar'])) {

    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $anio = $_POST['anio'];
    $plataforma_nombre = $_POST['plataforma'];
    $url = trim($_POST['url']);
    $id_usuario = $_SESSION['user_id'];

    $errores = [];

    if (empty($titulo)) {
        $errores['titulo'] = "El título no puede estar vacío.";
    }
    if (empty($plataforma_nombre)) {
        $errores['plataforma'] = "Debes seleccionar una plataforma.";
    }
    if (!empty($url) && !filter_var($url, FILTER_VALIDATE_URL)) {
        $errores['url'] = "La URL no es válida.";
    }

    $ruta_caratula_db = null;


    if (isset($_FILES['caratula']) && $_FILES['caratula']['error'] === UPLOAD_ERR_OK) {

        $archivo = $_FILES['caratula'];
        $extension_archivo = pathinfo($archivo['name'], PATHINFO_EXTENSION);
        $nombre_archivo = 'caratula_' . uniqid() . '.' . $extension_archivo;

        move_uploaded_file($archivo['tmp_name'], '../uploads/' . $nombre_archivo);

        $ruta_caratula_db = 'uploads/' . $nombre_archivo;
    }

    if (empty($errores)) {
        try {
            $conn->beginTransaction();

            $sql_juego = "INSERT INTO juegos (titulo, descripcion, anio_lanzamiento, caratula_imagen, url_juego, id_usuario_creador) 
                          VALUES (:titulo, :descripcion, :anio, :caratula, :url, :id_usuario)";

            $stmt_juego = $conn->prepare($sql_juego);
            $stmt_juego->bindParam(':titulo', $titulo);
            $stmt_juego->bindParam(':descripcion', $descripcion);
            $stmt_juego->bindParam(':anio', $anio);
            $stmt_juego->bindParam(':caratula', $ruta_caratula_db);
            $stmt_juego->bindParam(':url', $url);
            $stmt_juego->bindParam(':id_usuario', $id_usuario);
            $stmt_juego->execute();

            $id_juego_nuevo = $conn->lastInsertId();
            $sql_plataforma = "SELECT id_plataforma FROM plataformas WHERE nombre_plataforma = :nombre";
            $stmt_plataforma = $conn->prepare($sql_plataforma);
            $stmt_plataforma->bindParam(':nombre', $plataforma_nombre);
            $stmt_plataforma->execute();
            $plataforma_resultado = $stmt_plataforma->fetch(PDO::FETCH_ASSOC);

            $id_plataforma = $plataforma_resultado['id_plataforma'];
            $sql_relacion = "INSERT INTO juegos_plataformas (id_juego, id_plataforma) VALUES (:id_juego, :id_plataforma)";
            $stmt_relacion = $conn->prepare($sql_relacion);
            $stmt_relacion->bindParam(':id_juego', $id_juego_nuevo);
            $stmt_relacion->bindParam(':id_plataforma', $id_plataforma);
            $stmt_relacion->execute();


            $conn->commit();
            header("Location: ../dashboard.php");
            exit();
        } catch (Exception $e) {
            $conn->rollBack();
            $_SESSION['form_errors'] = ['db_error' => 'Error al guardar el juego: ' . $e->getMessage()];
            header("Location: ../form/juegos_form.php");
            exit();
        }
    } else {
        $_SESSION['form_errors'] = $errores;
        $_SESSION['form_data'] = $_POST;
        header("Location: ../form/juegos_form.php");
        exit();
    }
}
