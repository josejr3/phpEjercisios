<?php
require 'detalles_juego_logic.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalles de <?php echo $juego['titulo']; ?></title>
    <link rel="stylesheet" type="text/css" href="../styles/styles.css">
</head>

<body class="dashboard-body">

    <header class="dashboard-header">
        <div class="header-content">
            <h1>Detalles del Juego</h1>
            <nav>
                <a href="../dashboard.php" class="btn-header">Volver al Dashboard</a>
            </nav>
        </div>
    </header>

    <main class="details-container">
        <div class="details-card">
            <div class="details-image">
                <?php
                $caratula = !empty($juego['caratula_imagen']) ? '../' . $juego['caratula_imagen'] : '../uploads/default-cover.png';
                ?>
                <img src="<?php echo $caratula; ?>" alt="Carátula de <?php echo $juego['titulo']; ?>">
            </div>
            <div class="details-info">
                <h2><?php echo $juego['titulo']; ?></h2>

                <div class="info-item">
                    <strong>Año de lanzamiento:</strong>
                    <span><?php echo $juego['anio_lanzamiento']; ?></span>
                </div>

                <div class="info-item">
                    <strong>Plataforma:</strong>
                    <span><?php echo str_replace('_', ' ', $juego['nombre_plataforma']); ?></span>
                </div>

                <?php if (!empty($juego['descripcion'])): ?>
                    <div class="info-item">
                        <strong>Descripción:</strong>
                        <p><?php echo nl2br($juego['descripcion']); ?></p>
                    </div>
                <?php endif; ?>

                <?php if (!empty($juego['url_juego'])): ?>
                    <div class="info-item">
                        <strong>Más información:</strong>
                        <a href="<?php echo $juego['url_juego']; ?>" target="_blank">Visitar sitio web</a>
                    </div>
                <?php endif; ?>
                <p>Vistas: <?php echo($juego['vistas']+1); ?></p>

                <div class="details-actions">
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $juego['id_usuario_creador']): ?>

                        <form action="editar_juego_logic.php" method="post" style="display: inline;">
                            <input type="hidden" name="id_juego" value="<?php echo $id_juego; ?>">
                            <button type="submit" class="btn-edit">Editar</button>
                        </form>

                        <form action="eliminar_juego_logic.php" method="post" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este juego?');">
                            <input type="hidden" name="id_juego" value="<?php echo $id_juego; ?>">
                            <button type="submit" class="btn-delete">Eliminar</button>
                        </form>
                        

                    <?php endif; ?>

                    <div class="votos-container">
                            <button type="button" class="btn-voto" id="like" onclick="votar('like')">like</button>
                            <button type="button" class="btn-voto" id="dislike"  onclick="votar('dislike')">dislike</button>
                            <p id="botos"></p>
                    </div>

                </div>
            </div>
        </div>
    </main>

</body>
<script>
  function votar(str) {
 if (str == "like") {
    console.log(<?php echo($id_juego) ?>);
        document.getElementById("like").classList.add('activo');
        document.getElementById("dislike").classList.remove('activo');
    } else {
        document.getElementById("dislike").classList.add('activo');
        document.getElementById("like").classList.remove('activo');
    }
   let xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {

        if (this.readyState == 4) {   
            documet.getElementById("botos").innerHTML = this.responseText;;     
            console.log("Status de la petición: " + this.status);
            console.log("Respuesta del servidor: " + this.responseText); 
        }
  
  }

   xmlhttp.open("GET", "votar.php?voto=" + str+"&id_juego="+<?php echo($id_juego) ?>, true);
   
   xmlhttp.send();
}


</script>

</html>