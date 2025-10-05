<?php
    session_start();  
   if (isset($_SESSION['erroresLoging'])) {
    $errores=$_SESSION['erroresLoging'];
   }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css">

</head>

<body>
    
    <form action="loging_logic.php" method="post" class="form">
        <h2>Iniciar sesión</h2>
        <div class="formDiv">
            <label for="email">Email: </label>
            <p class="error"><?php echo $errores['errorEmail'] ?? '&nbsp;'; ?></p>
            <input type="text" name="email" id="email" 
                value="<?php echo isset($_SESSION['email']) && !isset($errores['errorEmail']) ? $_SESSION['email'] : ''; ?>"/>
        </div>
        <div class="formDiv">
            <label for="password">Contraseña: </label>             
            <input type="text" name="password" id="password" />
        </div>       
        <div class="formDiv">
            <button type="submit" value="Login" name="enviar">Iniciar sesión</button>
        </div>
      <?php
        if (isset($_SESSION['erroresLoging'])) {
         $_SESSION['erroresLoging']=null;
        }
      ?>
       <div class="form-footer">
        ¿No tienes cuenta? <a href="register_form.php">Regístrate</a>
    </div>
        
    </form>

</body>

</html>