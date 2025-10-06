<?php
    session_start();  
   if (isset($_SESSION['errores'])) {
    $errores=$_SESSION['errores'];
   }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../styles/styles.css">

</head>

<body class="form-page-body">
    
    <form action="../logic/register_logic.php" method="post" class="form">
        <h2>Registro</h2>
        <div class="formDiv">
            <label for="user">Nombre de usuario: </label>
             <p class="error"><?php echo $errores['errorUser'] ?? '&nbsp;'; ?></p>              
            <input type="text" name="user" id="user" 
                value="<?php echo isset($_SESSION['user']) && !isset($errores['errorUser']) ? $_SESSION['user'] : ''; ?>"/>
        </div>
   
        <div class="formDiv">
            <label for="email">Email: </label>
            <p class="error"><?php echo $errores['errorEmail'] ?? '&nbsp;'; ?></p>
            <input type="text" name="email" id="email" 
                value="<?php echo isset($_SESSION['email']) && !isset($errores['errorEmail']) ? $_SESSION['email'] : ''; ?>"/>
        </div>
        <div class="formDiv">
            <label for="password">Contraseña: </label>
               <p class="error"><?php echo $errores['errorPassword'] ?? '&nbsp;'; ?></p>
            <input type="text" name="password" id="password" />
        </div>
        <div class="formDiv">
            <label for="password2">Confirmar contraseña: </label>
                <p class="error"><?php echo $errores['errorPassword2'] ?? '&nbsp;'; ?></p>
            <input type="text" name="password2" id="password2" />
        </div>
        <div class="formDiv">
            <button type="submit" value="Registrarse" name="enviar">Registrarse</button>
        </div>
      <?php
        if (isset($_SESSION['errores'])) {
         $_SESSION['errores']=null;
        }
      ?>
      <div class="form-footer">
        ¿Ya tienes cuenta? <a href="../index.php">Inicia sesión</a>
      </div>
        
    </form>
    
</body>

</html>
