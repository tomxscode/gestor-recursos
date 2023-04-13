<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "escuela_";

// Creamos la conexión
$conn = new mysqli($servername, $username, $password, $dbname); 

// comprobamos si se ejecutó correctamente
if ($conn->connect_error) {
  die("Conexión fallida, error: " . $conn->connect_error);
}
?>