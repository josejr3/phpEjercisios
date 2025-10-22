<?php
session_start();
$color='<p style="';
$errores="";
$numeroCaracteres="la contraseña deve tener mas de 8 caratres </p>";
$letrasMayuscula=" una letra mayuscula </p>";
$letrasMinuscula=" una minuscula </p>";
$numero=" un numero";
$rojo='color:red">';
$berde='color:green">';
$texto=$_REQUEST["texto"] ?? "";


if($texto!=""){
    if(strlen($texto)<8){
        $errores.=$color.$rojo.$numeroCaracteres;   
    }else{
          $errores.=$color.$berde.$numeroCaracteres; 
    }
    if(preg_match("/[A-Z]/",$texto)===0){  
        $errores.=$color.$rojo.$letrasMayuscula;
    }else{
        $errores.=$color.$berde.$letrasMayuscula;     
    }
     if(preg_match("/[a-z]/",$texto)===0){  
        $errores.=$color.$rojo.$letrasMinuscula;
    }else{
        $errores.=$color.$berde.$letrasMinuscula;     
    }
    if(preg_match("/[0-9]/",$texto)===0){  
        $errores.=$color.$rojo.$numero;
    }else{
        $errores.=$color.$berde.$numero;     
    }
    echo($errores);
}
