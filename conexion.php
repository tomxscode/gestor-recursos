<?php
//Conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "escuela_";

$con = mysqli_connect($host, $user, $password, $database);

//Verificar conexión
if (!$con) {
  die("Error al conectar: " . mysqli_connect_error());
}
?>
