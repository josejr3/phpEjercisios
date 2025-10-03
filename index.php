<?php  
    require 'register.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="style.css" rel="stylesheet" />
</head>

<body>
    
    <form action="register.php" method="post" class="form-example">
        <div class="form-example">
            <label for="user">Nombre de usuario: </label>
            <input type="text" name="user" id="user" />
        </div>
   
        <div class="form-example">
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" />
        </div>
        <div class="form-example">
            <label for="pasword">Contraseña: </label>
            <input type="text" name="pasword" id="pasword" />
        </div>
        <div class="form-example">
            <label for="pasword2">Confirmar contraseña: </label>
            <input type="text" name="pasword2" id="pasword2" />
        </div>
        <div class="form-example">
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