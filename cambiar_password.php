<?php
// Incluir archivo de conexión a la base de datos
require_once 'conexion.php';
require_once('verificar_sesion.php');

if (!isset($_POST['userid'])) {
  $userid = $_SESSION['user_id'];
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cambio de contraseña</title>
  <?php require "head.php"; ?>
</head>

<body>
  <?php require "header.php"; ?>
  <div class="container pt-2">
    <div class="row">
      <h1>Cambio de contraseña</h1>
      <hr>
      <div class="row">
        <?php
        if (isset($_GET['estado'])) {
          $estado = $_GET['estado'];
          if ($estado == 1) {
            echo "
                  <div class='alert alert-warning' role='alert'>
                    Hubo un error en el cambio de contraseña, las contraseñas ingresadas no coinciden
                  </div>";
          } elseif ($estado == 2) {
            echo "
                  <div class='alert alert-warning' role='alert'>
                    Hubo un error en el cambio de contraseña, la contraseña actual no es la ingresada
                  </div>";
          } else {
            echo "
                  <div class='alert alert-success' role='alert'>
                    La contraseña fue cambiada con éxito
                  </div>";
          }
        }
        ?>
        <form action="procesar_cambio_pw.php" method="post">
          <div class="form-group">
            <label for="actual">Ingrese su contraseña actual:</label>
            <input type="password" name="actual" id="actual" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="nueva_1">Ingrese su nueva contraseña:</label>
            <input type="password" name="nueva_1" id="nueva_1" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="nueva_2">Confirme su nueva contraseña:</label>
            <input type="password" name="nueva_2" id="nueva_2" class="form-control">
          </div>
          <div class="form-group">
            <button type="submit" class="form-control btn btn-info">Cambiar contraseña</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>