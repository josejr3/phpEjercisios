<?php

$servername = "localhost";

try {
  $conn = new PDO("mysql:host=$servername;dbname=biblioteca_de_juegos", 'root', '');
  
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}