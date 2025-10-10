<?php
$errores=["la contraseña deve tener mas de 8 caratres","una letra mayuscula","una letra minuscula","un signo de puntuación"];
$colores=["red","red","red","red"];
$p=$_REQUEST["q"];
if($p!=""){
    if(strlen($q)>8){
        array_push($colores,"gren");     
    }
}