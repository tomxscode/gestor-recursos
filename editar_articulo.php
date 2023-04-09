<?php
// Incluir archivo de conexión a la base de datos
require_once 'conexion.php';
require_once('verificar_sesion.php');
// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $categoria_id = $_POST['categoria_id'];
    $cantidad = $_POST['cantidad'];

    // Preparar consulta SQL
    $sql = "UPDATE articulos SET nombre = ?, descripcion = ?, categoria_id = ?, cantidad = ? WHERE id = ?";

    // Preparar la sentencia
    $stmt = $con->prepare($sql);

    // Asignar parámetros
    $stmt->bind_param('ssiii', $nombre, $descripcion, $categoria_id, $cantidad, $id);

    // Ejecutar consulta y verificar resultado
    if ($stmt->execute()) {
        // Redirigir a la lista de categorías
        header('Location: ver_articulos.php');
        exit;
    } else {
        // Mostrar mensaje de error
        echo 'Error al actualizar el artículo: ' . $stmt->error;
    }
} else {
    // Verificar si se envió el ID de la categoría
    if (isset($_GET['id'])) {
        // Obtener el ID de la categoría
        $id = $_GET['id'];

        // Preparar consulta SQL
        $sql = "SELECT * FROM articulos WHERE id = ?";

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
            $articulo = $resultado->fetch_assoc();
        } else {
            // Redirigir a la lista de categorías
            header('Location: ver_articulos.php');
            exit;
        }
    } else {
        // Redirigir a la lista de categorías
        header('Location: ver_articulos.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar categoria</title>
    <?php require "head.php"; ?>
</head>

<body>
    <?php require "header.php"; ?>
    <div class="container pt-2">
        <div class="row">
            <h1>Editar artículo</h1>
            <form method="POST">
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $articulo['id']; ?>">
                    <label>
                        Nombre:
                    </label>
                    <input type="text" name="nombre" class="form-control" value="<?php echo $articulo['nombre']; ?>">
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $articulo['id']; ?>">
                    <label>
                        Descripción:
                    </label>
                    <input type="text" name="descripcion" class="form-control"
                        value="<?php echo $articulo['descripcion']; ?>">
                </div>
                <div class="form-group">
                    <label for="categoria_id">Categoría</label>
                    <br>
                    <small>Puedes cambiar la categoría, pulsa en el nombre de esta</small>

                    <select class="form-control" id="categoria_id" name="categoria_id">
                        <?php
                        $sql = "SELECT * FROM categorias";
                        $resultado = mysqli_query($con, $sql);
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            if ($fila['id'] == $articulo['id']) {
                                echo "<option value='" . $fila['id'] . "' selected>" . $fila['nombre'] . "</option>";
                            } else {
                                echo "<option value='" . $fila['id'] . "'>" . $fila['nombre'] . "</option>";
                            }

                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>
                        Cantidad:
                    </label>
                    <input type="number" name="cantidad" value="<?php echo $articulo['cantidad']; ?>"
                        class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class='form-control btn btn-info'>Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>