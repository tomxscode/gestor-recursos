<?php
include('conexion.php');
//require('verificar_sesion.php');
require('verificar_admin.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear categoría</title>
    <?php require "head.php"; ?>
</head>

<body>
    <?php require "header.php"; ?>
    <div class="container pt-2">
        <?php
        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $sql = "INSERT INTO categorias (nombre, descripcion) VALUES ('$nombre', '$descripcion')";
            if (mysqli_query($con, $sql)) {
                echo "
                <div class='alert alert-success' role='alert'>
                    La categoría se creó satisfactoriamente
                </div>
              ";
            } else {
                echo "
                <div class='alert alert-danger' role='alert'>
                    La categoría no se pudo crear, comuniquese con su administrador
                </div>
              ";
            }
            mysqli_close($con);
        }
        ?>
        <div class="row">
            <h1>Crear nueva categoría</h1>
            <p>Ingrese los datos requeridos para crear la categoría</p>
            <form action="crear_categoria.php" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre de la categoría:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nombre">Descripción de la categoría:</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Crear" class="form-control btn-success">
                </div>
            </form>
        </div>
    </div>
</body>

</html>