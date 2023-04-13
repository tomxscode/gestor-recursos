<?php

require_once "./clases/Articulo.php";
require_once "../database/conexion.php";

$articulo = new Articulo($conn);
$datos = $articulo->obtenerArticulos();
echo json_encode($datos);

?>