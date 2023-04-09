<?php
include('conexion.php');
require('verificar_sesion.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear articulo</title>
    <?php require "head.php"; ?>
</head>

<body>
    <?php require "header.php"; ?>
    <div class="container pt-2">
        <?php
        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $categoria_id = $_POST['categoria_id'];
            $existencias = $_POST['existencias'];
            $sql = "INSERT INTO articulos (nombre, categoria_id, descripcion, cantidad) VALUES ('$nombre', $categoria_id, '$descripcion', $existencias)";
            if (mysqli_query($con, $sql)) {
                echo "
                <div class='alert alert-success' role='alert'>
                    El artículo se creó exitosamente
                </div>
              ";
            } else {
                echo "
                <div class='alert alert-danger' role='alert'>
                    El artículo no se pudo crear, comuniquese con su administrador
                </div>
              ";
            }
            mysqli_close($con);
        }
        ?>
        <div class="row">
            <?php
            $sql = "SELECT COUNT(*) as total FROM categorias";
            $resultado = mysqli_query($con, $sql);
            $fila = mysqli_fetch_assoc($resultado);
            if ($fila['total'] > 0) {
            ?>
            <h1>Crear nuevo artículo</h1>
            <p>Ingrese los datos requeridos para crear un nuevo artículo</p>
            <form action="crear_articulo.php" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre del artículo:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nombre">Descripción del artículo</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nombre">Existencias</label>
                    <input type="number" min="1" value="1" name="existencias" id="existencias" class="form-control"
                        required>
                </div>
                <div class="form-group">
                    <label for="categoria_id">Categoría</label>
                    <select multiple class="form-control" id="categoria_id" name="categoria_id">
                        <?php
                        $sql = "SELECT * FROM categorias";
                        $resultado = mysqli_query($con, $sql);
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='" . $fila['id'] . "'>". $fila['nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" value="Crear" class="form-control btn-success">
                </div>
            </form>
            <?php } else { ?>
                <div class='alert alert-danger' role='alert'>
                    No existen categorías, por lo que no se pueden crear artículos. <br> Si crees que es un error, comunicate con el administrador
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>