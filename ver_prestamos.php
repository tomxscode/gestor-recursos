<?php
// Incluir archivo de conexión a la base de datos
require_once 'conexion.php';
require_once('verificar_sesion.php');

// si filtro
if (isset($_POST['estado'])) {
    $estado = $_POST['estado'];
    $query2 = "SELECT prestamos.id, articulos.nombre AS nombre_articulo, prestamos.fecha_prestamo, prestamos.fecha_devolucion, prestamos.estudiante, prestamos.entregado FROM prestamos JOIN articulos ON prestamos.articulo_id = articulos.id WHERE entregado = $estado";
} else {
    $query2 = "SELECT prestamos.id, articulos.nombre AS nombre_articulo, prestamos.fecha_prestamo, prestamos.fecha_devolucion, prestamos.estudiante, prestamos.entregado FROM prestamos JOIN articulos ON prestamos.articulo_id = articulos.id";
}

if (isset($_GET['expirados'])) {
    $expiradosEstado = $_GET['expirados'];
    if ($expiradosEstado == 1) {
        $query2 = "SELECT prestamos.id, articulos.nombre AS nombre_articulo, prestamos.fecha_prestamo, prestamos.fecha_devolucion, prestamos.estudiante, prestamos.entregado FROM prestamos JOIN articulos ON prestamos.articulo_id = articulos.id WHERE prestamos.fecha_devolucion < CURDATE() AND prestamos.entregado = 0";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver artículos</title>
    <?php require "head.php"; ?>
</head>

<body>
    <?php require "header.php"; ?>
    <div class="container pt-2">
        <div class="row">
            <div class="row">
                <?php
                if (isset($_GET['expirados'])) {
                    $expiradosEstado = $_GET['expirados'];
                    if ($expiradosEstado == 1) {
                        echo "
                                <div class='alert alert-warning' role='alert'>
                                Se están mostrado todos los préstamos expirados, si no quieres verlos más haz <a href='ver_prestamos.php'>click aqui</a>
                                </div>";
                    }
                }
                ?>
                <div class="col-md-6">
                    <h1>Prestamos</h1>
                </div>
                <div class="col-md-6">
                    <form action="ver_prestamos.php" method="post" name="filtrar">
                        <div class="input-group">
                            <select class="custom-select" id="estado" name="estado"
                                aria-label="Example select with button addon">
                                <option value='0'>No entregados</option>";
                                <option value='1'>Entregados</option>";

                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-info" type="submit">Filtrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            // Preparar la consulta SQL para obtener todas las categorías
            // Ejecutar la consulta SQL y guardar resultados en una variable
            $resultado2 = mysqli_query($con, $query2);
            // Verificar si se encontraron categorías
            if (mysqli_num_rows($resultado2) > 0) {
                // Si hay categorías, mostrar tabla con listado de categorías
                echo "<div class='table-responsive'>";
                echo "<table class='table'>";
                echo "<thead class='thead-info'><tr><th>ID</th><th>Nombre</th><th>Alumno</th><th>Fecha prestamo</th><th>Fecha devolución</th><th>Estado</th><th>Acciones</th></tr></thead>";
                echo "<tbody>";
                while ($fila = mysqli_fetch_assoc($resultado2)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id'] . "</td>";
                    echo "<td>" . $fila['nombre_articulo'] . "</td>";
                    echo "<td>" . $fila['estudiante'] . "</td>";
                    echo "<td>" . $fila['fecha_prestamo'] . "</td>";
                    echo "<td>" . $fila['fecha_devolucion'] . "</td>";
                    if ($fila['entregado'] == 0) {
                        echo "<td>No entregado</td>";
                    } else {
                        echo "<td>Entregado</td>";
                    }

                    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'encargado') {
                        echo "<td><a class='btn btn-info' href='cambiar_estado.php?id=" . $fila['id'] . "&estado=" . $fila['entregado'] . "' onclick='return confirm(\"¿Está seguro de cambiar el estado?\")'>Cambiar estado</a></td>";
                    } else {
                        echo "<td>n/a</td>";
                    }
                    echo "</tr>";
                }
                echo "</tbody>";

                echo "</table>";
                echo "</div>";
            } else {
                // Si no hay categorías, mostrar mensaje indicando que no se encontraron resultados
                echo "
                <div class='alert alert-danger' role='alert'>
                    No se han encontrado préstamos con los filtros establecidos.
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