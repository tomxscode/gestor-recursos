<?php
require_once 'conexion.php';
require_once('verificar_sesion.php');

$articulo_id = $_POST['articulo_id'];
$fecha_prestamo = date('Y-m-d');
$fecha_devolucion = $_POST['fecha_devolucion'];
$estudiante = $_POST['estudiante'];

$sql = "INSERT INTO prestamos (articulo_id, fecha_prestamo, fecha_devolucion, estudiante, estado) VALUES ($articulo_id, '$fecha_prestamo', '$fecha_devolucion', '$estudiante', 0)";
$resultado = mysqli_query($con, $sql);
if ($resultado) {
    echo "Prestamo exitoso";
    // quitamos 1 de la cantidad
    $_sql = "UPDATE articulos SET cantidad = cantidad-1 WHERE id = $articulo_id";
    $_result = mysqli_query($con, $_sql);
    if ($_result) {
        echo "Se redujo en 1";
    } else {
        echo "Error";
    }
} else {
    echo "Prestamo fallido";
}
?>