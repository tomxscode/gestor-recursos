<?php

require_once "../database/conexion.php";
require_once "./clases/Articulo.php";

$articulo = new Articulo($conn);

$articulos = $articulo->buscarArticuloPorNombre(($_POST['nombre']));
header('Content-Type: applications/json');
echo json_encode($articulos);

?>