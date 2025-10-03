<?php

$servername = "localhost";
//$username = $_SESSION['user'];
//$password =$_SESSION['pasword'];


try {
  $conn = new PDO("mysql:host=$servername;dbname=prueba", 'root', '');
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if (isset($_SESSION['user'])) {
     header("location: dashboard.php");
  }
 
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}