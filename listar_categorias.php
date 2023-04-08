<?php
// Incluir archivo de conexión a la base de datos
require_once 'conexion.php';
require_once('verificar_sesion.php');

// Preparar la consulta SQL para obtener todas las categorías
$query = "SELECT * FROM categorias";

// Ejecutar la consulta SQL y guardar resultados en una variable
$resultado = mysqli_query($con, $query);

// Verificar si se encontraron categorías
if(mysqli_num_rows($resultado) > 0){
    // Si hay categorías, mostrar tabla con listado de categorías
    echo "<table>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>";

    while($fila = mysqli_fetch_assoc($resultado)){
        echo "<tr>";
        echo "<td>" . $fila['id'] . "</td>";
        echo "<td>" . $fila['nombre'] . "</td>";
        echo "<td><a href='editar_categoria.php?id=" . $fila['id'] . "'>Editar</a> | <a href='eliminar_categoria.php?id=" . $fila['id'] . "' onclick='return confirm(\"¿Está seguro de que desea eliminar la categoría?\")'>Eliminar</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    // Si no hay categorías, mostrar mensaje indicando que no se encontraron resultados
    echo "No se encontraron categorías.";
}

// Cerrar conexión a la base de datos
mysqli_close($con);
?>
