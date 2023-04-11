<?php
// Incluir archivo de conexión a la base de datos
require_once 'conexion.php';
require_once('verificar_sesion.php');

// prestamos expirados, contarlos
//SELECT COUNT(*) AS cantidad FROM prestamos WHERE fecha_devolucion < DATE_ADD(CURDATE(), INTERVAL 1 DAY)
$_sqlPrestamosExp = "SELECT COUNT(*) as cantidad FROM prestamos WHERE fecha_devolucion < DATE_ADD(CURDATE(), INTERVAL 1 DAY) AND entregado = 0";
$_resultPrestamosExp = mysqli_query($con, $_sqlPrestamosExp);
if ($_resultPrestamosExp) {
    $fila = mysqli_fetch_assoc($_resultPrestamosExp);
    $cantidad_vencidos = $fila['cantidad'];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor escolar</title>
    <?php require "head.php"; ?>
</head>

<body>
    <?php require "header.php"; ?>
    <div class="container pt-2">
        <div class="row">
            <h1>Gestor escolar</h1>
            <div class="row mt-2">
                <div class="col-md-6">
                    <h5>Prestamos expirados <span class="badge badge-secondary">
                        <?php echo $cantidad_vencidos; ?>
                    </span></h5>
                    <form action="ver_prestamos.php" method="get">
                        <input type="hidden" name="expirados" value="1">
                        <button class="btn btn-warning">Ver expirados</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>