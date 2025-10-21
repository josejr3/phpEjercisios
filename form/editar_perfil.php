<?php
  require '../logic/editar_perfil_logic.php';
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>perfil</title>
     <link rel="stylesheet" type="text/css" href="../styles/styles.css">
</head>
<body>

<body class="form-page-body">
    
    <form action="../logic/register_logic.php" method="post" enctype="multipart/form-data" class="form">
        <h2>Editar datos</h2>       
        <div class="formDiv">
            <label for="user">Nombre de usuario: </label>
             <p class="error"><?php echo $errores['errorUser'] ?? '&nbsp;'; ?></p>              
            <input type="text" name="user" id="user" 
                value="<?php echo isset($_SESSION['user']) && !isset($errores['errorUser']) ? $_SESSION['user'] : ''; ?>"/>
        </div>
            <?php 
                    $src="../uploads/usuario.jpg";
                    if ($imagen_perfil!=null) {           
                        $src=$imagen_perfil;
                    }
                 ?>   
             <img id="perfil_dashboar" src="../<?php echo($src) ?>" alt="usuario"></img>
        
        <div class="formDiv">
          <label for="imagen_perfil" style="font-weight: normal;">Imagen (opcional):</label>
          <input type="file" name="imagen_perfil" id="imagen_perfil" accept="image/*">
        </div>
 
        <div class="formDiv">
            <button type="submit" value="Registrarse" name="enviar">Editar</button>
        </div>
      <?php
        if (isset($_SESSION['errores'])) {
         $_SESSION['errores']=null;
        }
      ?>
        
    </form>
    
</body>
    
</body>
</html>