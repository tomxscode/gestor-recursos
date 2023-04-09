<?php
// Incluir archivo de conexión a la base de datos
require_once 'conexion.php';
require_once('verificar_sesion.php');

// si filtro
if (isset($_POST['categoria_id'])) {
    $categoria = $_POST['categoria_id'];
    if ($categoria == 0) { 
        //$query2 = "SELECT * FROM articulos";
        $query2 = "SELECT a.*, c.nombre AS nombre_categoria FROM articulos a JOIN categorias c ON a.categoria_id = c.id";
     } else {
        //$query2 = "SELECT * FROM articulos WHERE categoria_id = $categoria";
        $query2 = "SELECT a.*, c.nombre AS nombre_categoria FROM articulos a JOIN categorias c ON a.categoria_id = c.id WHERE categoria_id = $categoria";
     }
} else if (!isset($_POST['categoria_id']) || $_POST['categoria_id'] == 0) {
    //$query2 = "SELECT * FROM articulos";
    $query2 = "SELECT a.*, c.nombre AS nombre_categoria FROM articulos a JOIN categorias c ON a.categoria_id = c.id";
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
                <div class="col-md-6">
                    <h1>Artículos</h1>

                </div>
                <div class="col-md-6">
                    <form action="ver_articulos.php" method="post" name="filtrar">
                        <div class="input-group">
                            <select class="custom-select" id="categoria_id" name="categoria_id"
                                aria-label="Example select with button addon">
                                <?php
                                $sql = "SELECT * FROM categorias";
                                $resultado = mysqli_query($con, $sql);
                                echo "<option value='0'>Ninguno</option>";
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    echo "<option value='" . $fila['id'] . "'>" . $fila['nombre'] . "</option>";
                                }
                                ?>
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
                echo "<thead class='thead-info'><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Categoría</th><th>Cantidad</th><th>Acciones</th></tr></thead>";
                echo "<tbody>";
                while ($fila = mysqli_fetch_assoc($resultado2)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id'] . "</td>";
                    echo "<td>" . $fila['nombre'] . "</td>";
                    echo "<td>" . $fila['descripcion'] . "</td>";
                    // nombre a la categoría
                    echo "<td>" . $fila['nombre_categoria'] . "</td>";
                    echo "<td>" . $fila['cantidad'] . "</td>";
                    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'encargado') {
                        echo "<td><a class='btn btn-warning' href='editar_articulo.php?id=" . $fila['id'] . "'>Editar</a> <a class='btn btn-danger' href='eliminar_articulo.php?id=" . $fila['id'] . "' onclick='return confirm(\"¿Está seguro de que desea eliminar el artículo?\")'>Eliminar</a> <a class='btn btn-info' href='prestar_articulo.php?id=" . $fila['id'] . "' onclick='return confirm(\"¿Está seguro que desea prestar este artículo?\")'>Prestar</a></td>";
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