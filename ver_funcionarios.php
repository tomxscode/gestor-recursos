<?php
// Incluir archivo de conexión a la base de datos
require_once 'conexion.php';
require_once('verificar_admin.php');

// si filtro
if (isset($_POST['funcionarios_str'])) {
    $areastr = $_POST['funcionarios_str'];
    if ($areastr == 0) { 
        //$query2 = "SELECT * FROM articulos";
        $query2 = "SELECT f.*, u.email AS email FROM funcionarios f  JOIN users u ON f.usuario_id = u.id";
     } else {
        //$query2 = "SELECT * FROM articulos WHERE categoria_id = $categoria";
        $query2 = "SELECT f.*, u.email AS email FROM funcionarios f  JOIN users u ON f.usuario_id = u.id WHERE area = '$areastr'";
     }
} else if (!isset($_POST['funcionarios_str']) || $_POST['funcionarios_str'] == 0) {
    //$query2 = "SELECT * FROM articulos";
    $query2 = "SELECT f.*, u.email AS email FROM funcionarios f  JOIN users u ON f.usuario_id = u.id";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver funcionarios</title>
    <?php require "head.php"; ?>
</head>

<body>
    <?php require "header.php"; ?>
    <div class="container pt-2">
        <div class="row">
            <div class="row">
                <div class="col-md-6">
                    <h1>Funcionarios</h1>

                </div>
                <div class="col-md-6">
                    <form action="ver_funcionarios.php" method="post" name="filtrar">
                        <div class="input-group">
                            <select class="custom-select" id="funcionarios_str" name="funcionarios_str"
                                aria-label="Example select with button addon">
                                <option value='0'>Ninguno</option>"
                                <option value='profesores'>Profesores</option>"
                                <option value='administrativo'>Administrativos</option>"
                                <option value='inspectores'>Inspectores</option>"
                                <option value='asistentes'>Asistentes de aula</option>"
                                <option value='auxiliares'>Auxiliares</option>"
                                <option value='apoyos'>Apoyos</option>"

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
                echo "<thead class='thead-info'>
                        <tr>
                            <th>ID</th>
                            <th>RUN</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>";
                echo "<tbody>";
                while ($fila = mysqli_fetch_assoc($resultado2)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id'] . "</td>";
                    echo "<td>" . $fila['rut'] . "</td>";
                    echo "<td>" . $fila['nombre'] . "</td>";
                    echo "<td>" . $fila['apellido'] . "</td>";
                    // nombre a la categoría
                    echo "<td>" . $fila['email'] . "</td>";
                    echo "<td>" . $fila['telefono'] . "</td>";
                    echo "<td>" . $fila['area'] . "</td>";
                    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'encargado') {
                        echo "<td><a class='btn btn-danger' href='eliminar_funcionario.php?id=" . $fila['id'] . "' onclick='return confirm(\"¿Está seguro de que desea eliminar este funcionario?\")'>Eliminar</a></td>";
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