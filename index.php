<?php  
    require 'register.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>

<body>
    
    <form action="register.php" method="post" class="form">
        <div class="formDiv">
            <label for="user">Nombre de usuario: </label>
            <input type="text" name="user" id="user" />
        </div>
   
        <div class="formDiv">
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" />
        </div>
        <div class="formDiv">
            <label for="pasword">Contraseña: </label>
            <input type="text" name="pasword" id="pasword" />
        </div>
        <div class="formDiv">
            <label for="pasword2">Confirmar contraseña: </label>
            <input type="text" name="pasword2" id="pasword2" />
        </div>
        <div class="formDiv">
            <input type="submit" value="Registrarse" name="enviar"/>
        </div>
         <?php
          if(isset($_SESSION['error'])){
            echo "<p style='color:red'>".$_SESSION['error']."</p>";
            $_SESSION['error']=null;
          }
        ?>
        
    </form>

</body>

</html>