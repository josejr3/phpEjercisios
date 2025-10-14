<?php
session_start();
$color='<p style="';
$errores="";
$numeroCaracteres="la contraseña deve tener mas de 8 caratres </p>";
$letras=" una letra mayuscula";
$letras=" una letra ";
$rojo='color:red">';
$berde='color:green">';
$texto=$_REQUEST["texto"] ?? "";




if($texto!=""){
    if(strlen($texto)<8){
        $errores.=$color.$rojo.$numeroCaracteres;   
    }else{
          $errores.=$color.$berde.$numeroCaracteres; 
    }
    echo($errores);
}
