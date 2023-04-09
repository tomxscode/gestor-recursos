<?php
// Incluir archivo de conexión a la base de datos
require_once 'conexion.php';
require_once('verificar_sesion.php');

// si filtro
if (isset($_GET['id'])) {
    $articulo_id = $_GET['id'];
    $sql = "SELECT * FROM articulos WHERE id = $articulo_id";
    $resultado = mysqli_query($con, $sql);
    $articulo = mysqli_fetch_assoc($resultado);
} else {
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Préstamo de artículos</title>
    <?php require "head.php"; ?>
</head>

<body>
    <?php require "header.php"; ?>
    <div class="container pt-2">
        <div class="row">
            <?php
            if ($articulo['cantidad'] > 0) {
            ?>
                <h1>Préstamo de artículos</h1>
                <form action="procesar_prestamo.php" method="post">
                    <div class="form-group">
                        <label for="nombre_articulo">Nombre del artículo:</label>
                        <input type="text" class="form-control" disabled
                        value='<?php echo $articulo['nombre']; ?>''>
                    </div>
                    <div class="form-group">
                        <label for="fecha_devolucion">Fecha de devolución:</label>
                        <input type="date" name="fecha_devolucion" id="fecha_devolucion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="estudiante">Estudiante:</label>
                        <small>Ingrese el rut del alumno sin puntos y sin guión</small>
                        <input type="text" class="form-control" name="estudiante" required>
                        <input type="hidden" name="articulo_id" value="<?php echo $articulo_id; ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary">Prestar</button>
                    </div>
                </form>
            <?php
            } else { // cierre del if anterior
            ?>
            <h1>No hay suficientes unidades para prestar</h1>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>