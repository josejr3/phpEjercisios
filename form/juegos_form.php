<?php
session_start();
$modo_edicion = (isset($_SESSION['form_mode']) && $_SESSION['form_mode'] === 'edit');

if ($modo_edicion) {
    $titulo_pagina = "Editar Juego";
    $texto_boton = "Actualizar Juego";
    $action_url = '../logic/actualizar_juego_logic.php';
} else {
    $titulo_pagina = "Agregar Juego";
    $texto_boton = "Guardar Juego";
    $action_url = '../logic/juegos_logic.php';
}

$datos = $_SESSION['form_data'] ?? [];
$errores = $_SESSION['form_errors'] ?? [];

unset($_SESSION['form_mode']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($titulo_pagina); ?></title>
    <link rel="stylesheet" type="text/css" href="../styles/styles.css">
</head>
<body class="form-page-body">

    <form action="<?php echo $action_url; ?>" method="post" enctype="multipart/form-data" class="form">
        
        <h2><?php echo htmlspecialchars($titulo_pagina); ?></h2>

        <?php if ($modo_edicion && !empty($datos['id_juego'])): ?>
            <input type="hidden" name="id_juego" value="<?php echo htmlspecialchars($datos['id_juego']); ?>">
        <?php endif; ?>

        <div class="formDiv">
            <label for="titulo">Título:</label>
            <p class="error"><?php echo $errores['titulo'] ?? ''; ?></p>
            <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($datos['titulo'] ?? ''); ?>">
        </div>

        <div class="formDiv">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="4"><?php echo htmlspecialchars($datos['descripcion'] ?? ''); ?></textarea>
        </div>

        <div class="formDiv">
            <label for="anio">Año:</label>
            <select name="anio" id="anio">
                <?php
                $currentYear = date('Y');
                $selectedYear = $datos['anio'] ?? $currentYear;
                for ($y = $currentYear; $y >= 1950; $y--) {
                    $selected = ($y == $selectedYear) ? 'selected' : '';
                    echo "<option value=\"$y\" $selected>$y</option>";
                }
                ?>
            </select>
        </div>

        <div class="formDiv">
            <label for="plataforma">Plataforma:</label>
            <p class="error"><?php echo $errores['plataforma'] ?? ''; ?></p>
            <select name="plataforma" id="plataforma">
                <option value="">Selecciona una plataforma</option>
                <?php 
                $plataformas = ["PC", "Xbox", "Nintendo", "PlayStation"];
                foreach ($plataformas as $p) {
                    $selected = (isset($datos['plataforma']) && $datos['plataforma'] == $p) ? 'selected' : '';
                    echo "<option value=\"$p\" $selected>$p</option>";
                }
                ?>
            </select>
        </div>

        <div class="formDiv">
            <label for="caratula">Carátula:</label>
            
            <?php if ($modo_edicion && !empty($datos['caratula_imagen'])): ?>
                <div style="margin-bottom: 10px;">
                    <p style="margin: 0 0 5px 0; font-size: 0.9em;">Imagen actual:</p>
                    <img src="../<?php echo htmlspecialchars($datos['caratula_imagen']); ?>" alt="Carátula actual" style="width: 100px; border-radius: 6px;">
                    <input type="hidden" name="caratula_actual" value="<?php echo htmlspecialchars($datos['caratula_imagen']); ?>">
                </div>
                <label for="caratula" style="font-weight: normal;">Cambiar carátula (opcional):</label>
            <?php endif; ?>

            <p class="error"><?php echo $errores['caratula'] ?? ''; ?></p>
            <input type="file" name="caratula" id="caratula" accept="image/*">
        </div>

        <div class="formDiv">
            <label for="url">URL:</label>
            <p class="error"><?php echo $errores['url'] ?? ''; ?></p>
            <input type="text" name="url" id="url" placeholder="https://..." value="<?php echo htmlspecialchars($datos['url'] ?? ''); ?>">
        </div>

        <button type="submit" name="guardar"><?php echo htmlspecialchars($texto_boton); ?></button>

        <?php
        if (isset($_SESSION['form_errors'])) {
            $_SESSION['form_errors'] = null;
        }
        if (isset($_SESSION['form_data'])) {
            $_SESSION['form_data'] = null;
        }
        ?>
    </form>
</body>
</html>