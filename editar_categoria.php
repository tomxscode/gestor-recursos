<?php
// Incluir archivo de conexión a la base de datos
require_once 'conexion.php';
require_once('verificar_sesion.php');
// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];

    // Preparar consulta SQL
    $sql = "UPDATE categorias SET nombre = ? WHERE id = ?";

    // Preparar la sentencia
    $stmt = $con->prepare($sql);

    // Asignar parámetros
    $stmt->bind_param('si', $nombre, $id);

    // Ejecutar consulta y verificar resultado
    if ($stmt->execute()) {
        // Redirigir a la lista de categorías
        header('Location: listar_categorias.php');
        exit;
    } else {
        // Mostrar mensaje de error
        echo 'Error al actualizar la categoría: ' . $stmt->error;
    }
} else {
    // Verificar si se envió el ID de la categoría
    if (isset($_GET['id'])) {
        // Obtener el ID de la categoría
        $id = $_GET['id'];

        // Preparar consulta SQL
        $sql = "SELECT * FROM categorias WHERE id = ?";

        // Preparar la sentencia
        $stmt = $con->prepare($sql);

        // Asignar parámetros
        $stmt->bind_param('i', $id);

        // Ejecutar consulta y obtener resultado
        $stmt->execute();
        $resultado = $stmt->get_result();

        // Verificar si se encontró la categoría
        if ($resultado->num_rows === 1) {
            // Obtener los datos de la categoría
            $categoria = $resultado->fetch_assoc();
        } else {
            // Redirigir a la lista de categorías
            header('Location: listar_categorias.php');
            exit;
        }
    } else {
        // Redirigir a la lista de categorías
        header('Location: listar_categorias.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar categoría</title>
</head>
<body>
    <h1>Editar categoría</h1>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $categoria['id']; ?>">

        <label>
            Nombre:
            <input type="text" name="nombre" value="<?php echo $categoria['nombre']; ?>">
        </label>

        <button type="submit">Guardar cambios</button>
    </form>
</body>
</html>