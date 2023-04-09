<?php
// Incluir archivo de conexión a la base de datos
require_once 'conexion.php';
require_once('verificar_sesion.php');
// Verificar si se ha enviado el ID de la categoría a eliminar
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $estado = $_GET['estado'];

    // Preparar la consulta SQL para eliminar la categoría
    $query = "SELECT entregado FROM prestamos WHERE id = $id";
    if ($estado == 0) {
        $query = "UPDATE prestamos SET entregado = 1 WHERE id = $id";
    } else {
        $query = "UPDATE prestamos SET entregado = 0 WHERE id = $id";
    }
    // Ejecutar la consulta SQL
    if(mysqli_query($con, $query)){
        // Si la eliminación fue exitosa, redireccionar al listado de categorías
        header('Location: ver_prestamos.php');
        exit;
    } else {
        // Si hubo un error en la eliminación, mostrar mensaje de error
        echo "Error al cambiar el estado: " . mysqli_error($conexion);
    }
} else {
    // Si no se ha enviado el ID de la categoría a eliminar, redireccionar al listado de categorías
    header('Location: ver_prestamos.php');
    exit;
}
?>
