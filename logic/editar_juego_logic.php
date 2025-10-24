<?php
session_start();
require 'conexion.php';
require 'funciones.php'; 

if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    header("location: ../index.php");
    exit();
}

if (isset($_POST['id_juego']) && is_numeric($_POST['id_juego'])) {
    $id_juego = $_POST['id_juego'];

    $juego_a_editar = obtenerDetallesJuego($id_juego, $_SESSION['user_id'],$conn);

    if ($juego_a_editar) {
        
        $_SESSION['form_data'] = [
            'id_juego'        => $id_juego,
            'titulo'          => $juego_a_editar['titulo'],
            'descripcion'     => $juego_a_editar['descripcion'],
            'anio'            => $juego_a_editar['anio_lanzamiento'],
            'url'             => $juego_a_editar['url_juego'],
            'plataforma'      => $juego_a_editar['nombre_plataforma'],
            'caratula_imagen' => $juego_a_editar['caratula_imagen'] 
        ];
        $_SESSION['form_mode'] = 'edit';
              
        header("Location: ../form/juegos_form.php");
        exit();
    }
}
header("Location: ../dashboard.php");
exit();