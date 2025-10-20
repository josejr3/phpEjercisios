<?php
    require 'logic/dashboard_logic.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard de Videojuegos</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css" />
</head>

<body class="dashboard-body">

    <header class="dashboard-header">
        
        <div class="header-content">
            <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION["user"]); ?></h1>
            <nav>
                <a href="form/juegos_form.php" class="btn-header">Añadir Juego</a>
                <a href="logout.php" class="btn-header">Cerrar Sesión</a>
                <a href="editar_perfil.php" class="btn-header">Editar Perfil</a>
                <?php 
                    $src="uploads/usuario.jpg";
                    if ($imagen_perfil!=null) {           
                        $src=$imagen_perfil;
                    }
                  

                 ?>
                 
                <img id="perfil_dashboar" src="<?php echo($src) ?>" alt="usuario"></img>
              
               
                
            </nav>
        </div>
    </header>

    <main class="games-container">
        <div class="games-grid">

            <?php foreach ($juegos as $juego): ?>
                <a href="logic/detalles_juego.php?id=<?php echo $juego['id_juego']; ?>" class="game-card">
                    <div class="game-image-container">
                        <?php

                        $caratula = !empty($juego['caratula_imagen']) ? $juego['caratula_imagen'] : 'uploads/default-cover.png';
                        ?>
                        <img src="<?php echo htmlspecialchars($caratula); ?>" alt="Carátula de <?php echo htmlspecialchars($juego['titulo']); ?>">
                    </div>
                    <div class="game-info">
                        <h3><?php echo htmlspecialchars($juego['titulo']); ?></h3>
                        <p><?php echo htmlspecialchars($juego['anio_lanzamiento']); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>

            <?php if (empty($juegos)): ?>
                <p class="no-games">Aún no has añadido ningún juego a tu colección. ¡Anímate a añadir el primero!</p>
            <?php endif; ?>

        </div>
    </main>

</body>

</html>