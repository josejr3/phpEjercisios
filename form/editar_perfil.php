<?php
  session_start();
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
    
    <form action="../logic/editar_perfil_logic.php" method="post" enctype="multipart/form-data" class="form">
        <h2>Editar datos</h2>       
        <div class="formDiv">
            <label for="user">Nombre de usuario: </label>
             <p class="error"><?php echo $errores['errorUserPerfil'] ?? '&nbsp;'; ?></p>              
            <input type="text" name="user" id="userPerfil" 
                value="<?php echo isset($_SESSION['userPerfil']) && !isset($errores['errorUserPerfil']) ? $_SESSION['userPerfil'] : ''; ?>"/>
        </div>
            <?php 
                    $src="uploads/usuario.jpg";
                    if(isset($imagen_perfil)){
                      if ($imagen_perfil!=null) {           
                          $src=$imagen_perfil;
                      }
                  }
                 ?>   
             <img id="perfil_dashboar" src="../<?php echo($src) ?>" alt="usuario"></img>
        
        <div class="formDiv">
          <label for="imagen_perfil" style="font-weight: normal;">Imagen (opcional):</label>
          <input type="file" name="imagen_perfil" id="imagen_perfil" accept="image/*">
        </div>
 
        <div class="formDiv">
            <button type="submit" value="Registrarse" name="enviar">Enviar</button>
        </div>
      <?php
        if (isset($_SESSION['erroresDeeditarperfil'])) {
         $_SESSION['erroresDeeditarperfil']=null;
        }
      ?>
        
    </form>
    
</body>
    
</body>
</html>