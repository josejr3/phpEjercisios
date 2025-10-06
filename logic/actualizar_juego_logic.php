<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    header("location: ../index.php");
    exit();
}

if (isset($_POST['guardar']) ) {

    $id_juego_a_actualizar = $_POST['id_juego'];
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $anio = $_POST['anio'];
    $plataforma_nombre = $_POST['plataforma'];
    $url = trim($_POST['url']);

    $errores = [];

    if (empty($titulo)) {
        $errores['titulo'] = "El título no puede estar vacío.";
    }
    if (empty($plataforma_nombre)) {
        $errores['plataforma'] = "Debes seleccionar una plataforma.";
    }
}

if (empty($errores)) {
    
    $ruta_caratula_db = $_POST['caratula_actual'] ?? null; 


    if (isset($_FILES['caratula']) && $_FILES['caratula']['error'] === UPLOAD_ERR_OK) {
        
        if (!empty($ruta_caratula_db) && file_exists('../' . $ruta_caratula_db)) {
            unlink('../' . $ruta_caratula_db);
        }

        $archivo = $_FILES['caratula'];
        $extension_archivo = pathinfo($archivo['name'], PATHINFO_EXTENSION);
        $nombre_archivo = 'caratula_' . uniqid() . '.' . $extension_archivo;
        $ruta_caratula_db = 'uploads/' . $nombre_archivo; 
       
    }

    if (empty($errores)) { 
 
        try {

            $conn->beginTransaction();

            $sql_update_juego = "UPDATE juegos SET titulo = :titulo, descripcion = :descripcion, anio_lanzamiento = :anio, url_juego = :url, caratula_imagen = :caratula WHERE id_juego = :id_juego";
            $stmt_update = $conn->prepare($sql_update_juego);
            $stmt_update->bindParam(':titulo', $titulo);
            $stmt_update->bindParam(':descripcion', $descripcion);
            $stmt_update->bindParam(':anio', $anio);
            $stmt_update->bindParam(':url', $url);
            $stmt_update->bindParam(':caratula', $ruta_caratula_db);
            $stmt_update->bindParam(':id_juego', $id_juego_a_actualizar);
            $stmt_update->execute();

            $sql_plataforma = "SELECT id_plataforma FROM plataformas WHERE nombre_plataforma = :nombre";
            $stmt_plataforma = $conn->prepare($sql_plataforma);
            $stmt_plataforma->bindParam(':nombre', $plataforma_nombre);
            $stmt_plataforma->execute();
            $plataforma_resultado = $stmt_plataforma->fetch(PDO::FETCH_ASSOC);
            
            if($plataforma_resultado) {
                $id_plataforma = $plataforma_resultado['id_plataforma'];
                $sql_update_relacion = "UPDATE juegos_plataformas SET id_plataforma = :id_plataforma WHERE id_juego = :id_juego";
                $stmt_update_rel = $conn->prepare($sql_update_relacion);
                $stmt_update_rel->bindParam(':id_plataforma', $id_plataforma);
                $stmt_update_rel->bindParam(':id_juego', $id_juego_a_actualizar);
                $stmt_update_rel->execute();
            }

            $conn->commit();
            header("Location: ../dashboard.php");
            exit();

        } catch (Exception $e) {
            $conn->rollBack();
            $_SESSION['form_errors'] = ['db_error' => 'Error al actualizar el juego: ' . $e->getMessage()];
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