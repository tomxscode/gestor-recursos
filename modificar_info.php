<?php
// Incluir archivo de conexión a la base de datos
require_once 'conexion.php';
require_once('verificar_sesion.php');
$userid = $_SESSION['user_id'];

if (isset($_POST['telefono'])) {
  $_tel = $_POST['telefono'];
  $_mail = $_POST['email'];
  $_sql = "UPDATE funcionarios SET telefono = '$_tel' WHERE usuario_id = $userid";
  if (mysqli_query($con, $_sql)) {
    $_sql = "UPDATE users SET email = '$_mail' WHERE id = $userid";
    if (mysqli_query($con, $_sql)) {
      header('Location micuenta.php');
    } else { echo "Error al cambiar la tabla users"; }
  } else { echo "Error al cambiar la tabla funcionarios"; }
  header('Location: micuenta.php');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi cuenta - Edición</title>
  <?php require "head.php"; ?>
</head>

<body>
  <?php require "header.php"; ?>
  <div class="container pt-2">
    <div class="row">
      <h1>Administración de cuentas</h1>
      <hr>
      <div class="row">
        <h3>Editar información</h3>
        <form method="post" action="modificar_info.php">
          <?php        
          $sql = "
            SELECT f.*, u.email AS func_email FROM funcionarios f JOIN users u ON f.usuario_id = $userid WHERE usuario_id = $userid;
            ";
          if (mysqli_query($con, $sql)) {
            $fila = mysqli_fetch_assoc(mysqli_query($con, $sql));
          } else {
            echo "Sucedió un error al conectar a la base de datos";
          }
          ?>
          <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" disabled
              value="<?php echo $fila['nombre']?>">
          </div>
          <div class="form-group">
            <label for="nombre">Apellido:</label>
            <input type="text" class="form-control" disabled
              value="<?php echo $fila['apellido']?>">
          </div>
          <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="tel" class="form-control" name="telefono" value="<?php echo $fila['telefono']; ?>">
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="<?php echo $fila['func_email']; ?>">
          </div>
          <div class="form-group">
            <label for="email">Rol:</label>
            <input type="email" class="form-control" disabled value="<?php echo $fila['area']; ?>">
          </div>
          <div class="form-group">
            <button type="submit" class="form-control btn btn-info">Editar información</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>