<?php
// Incluir archivo de conexión a la base de datos
require_once 'conexion.php';
require_once('verificar_admin.php');
// Verificar si se ha enviado el ID de la categoría a eliminar
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $idUser = 0;
    $query = "SELECT usuario_id FROM funcionarios WHERE id = $id";
    $_result = mysqli_query($con, $query);
    if ($_result) {
        $fila = mysqli_fetch_assoc($_result);
        $idUser = $fila['usuario_id'];
    } else {
        exit;
    }

    // Preparar la consulta SQL para eliminar la categoría
    $query = "DELETE FROM funcionarios WHERE id = $id";

    // Ejecutar la consulta SQL
    if(mysqli_query($con, $query)){
        echo "Exito";
    } else {
        // Si hubo un error en la eliminación, mostrar mensaje de error
        echo "Error al eliminar el funcionario: " . mysqli_error($conexion);
    }

    $query = "DELETE FROM users WHERE id = $idUser";
    if(mysqli_query($con, $query)){
        echo "Exito";
    } else {
        // Si hubo un error en la eliminación, mostrar mensaje de error
        echo "Error al eliminar el funcionario: " . mysqli_error($conexion);
    }
    header('Location: ver_funcionarios.php');
    exit;
} else {
    // Si no se ha enviado el ID de la categoría a eliminar, redireccionar al listado de categorías
    header('Location: ver_funcionarios.php');
    exit;
}
?>
