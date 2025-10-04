<?php
session_start();
if (!isset($_SESSION['logged']) === true) {
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Juego</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <form action="juegos_process.php" method="post" enctype="multipart/form-data" class="form">
        <h2>Agregar juego</h2>

        <div class="formDiv">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo">
        </div>

        <div class="formDiv">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="3"></textarea>
        </div>

        <div class="formDiv">
            <label for="anio">Año:</label>
            <select name="anio" id="anio">
                <?php
                $currentYear = date('Y');
                for ($y = $currentYear; $y >= 1950; $y--) {
                    echo "<option value=\"$y\">$y</option>";
                }
                ?>
            </select>
        </div>
        <div class="formDiv">
            <label for="plataforma">Plataforma:</label>
            <select name="plataforma" id="plataforma">
                <option value="">Selecciona una plataforma</option>
                <option value="PC">PC</option>
                <option value="Xbox">Xbox</option>
                <option value="Nintendo">Nintendo</option>
                <option value="PlayStation">PlayStation</option>
            </select>
        </div>

        <div class="formDiv">
            <label for="caratula">Carátula:</label>
            <input type="file" name="caratula" id="caratula" accept="image/*">
        </div>

        <div class="formDiv">
            <label for="url">URL:</label>
            <input type="url" name="url" id="url" placeholder="https://...">
        </div>

        <button type="submit" name="guardar">Guardar juego</button>





    </form>