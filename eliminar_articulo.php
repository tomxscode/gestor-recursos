<?php
// Incluir archivo de conexión a la base de datos
require_once 'conexion.php';
require_once('verificar_sesion.php');
// Verificar si se ha enviado el ID de la categoría a eliminar
if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Preparar la consulta SQL para eliminar la categoría
    $query = "DELETE FROM articulos WHERE id = $id";

    // Ejecutar la consulta SQL
    if(mysqli_query($con, $query)){
        // Si la eliminación fue exitosa, redireccionar al listado de categorías
        header('Location: ver_articulos.php');
        exit;
    } else {
        // Si hubo un error en la eliminación, mostrar mensaje de error
        echo "Error al eliminar la categoría: " . mysqli_error($conexion);
    }
} else {
    // Si no se ha enviado el ID de la categoría a eliminar, redireccionar al listado de categorías
    header('Location: ver_articulos.php');
    exit;
}
?>
