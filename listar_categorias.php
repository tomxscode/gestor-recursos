<?php
// Incluir archivo de conexión a la base de datos
require_once 'conexion.php';
require_once('verificar_sesion.php');

// Preparar la consulta SQL para obtener todas las categorías
$query = "SELECT * FROM categorias";

// Ejecutar la consulta SQL y guardar resultados en una variable
$resultado = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar categoría</title>
    <?php require "head.php"; ?>
</head>

<body>
    <?php require "header.php"; ?>
    <div class="container pt-2">
        <div class="row">
            <h1>Registros:</h1>
            <?php
            // Verificar si se encontraron categorías
            if (mysqli_num_rows($resultado) > 0) {
                // Si hay categorías, mostrar tabla con listado de categorías
                echo "<div class='table-responsive'>";
                echo "<table class='table'>";
                echo "<thead class='thead-info'><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Acciones</th></tr></thead>";
                echo "<tbody>";
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id'] . "</td>";
                    echo "<td>" . $fila['nombre'] . "</td>";
                    echo "<td>" . $fila['descripcion'] . "</td>";
                    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                        echo "<td><a class='btn btn-warning' href='editar_categoria.php?id=" . $fila['id'] . "'>Editar</a> <a class='btn btn-danger' href='eliminar_categoria.php?id=" . $fila['id'] . "' onclick='return confirm(\"¿Está seguro de que desea eliminar la categoría?\")'>Eliminar</a></td>";
                    } else { echo "<td>n/a</td>"; }
                    echo "</tr>";
                }
                echo "</tbody>";

                echo "</table>";
                echo "</div>";
            } else {
                // Si no hay categorías, mostrar mensaje indicando que no se encontraron resultados
                echo "
                <div class='alert alert-danger' role='alert'>
                    No se han encontrado categorías. <br> Si cree que es un error, comuniquese con el administrador
                </div>
              ";
            }

            // Cerrar conexión a la base de datos
            mysqli_close($con);
            ?>
        </div>
    </div>
</body>

</html>