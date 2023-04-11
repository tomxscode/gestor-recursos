<?php
// Incluir archivo de conexión a la base de datos
require_once 'conexion.php';
require_once('verificar_sesion.php');

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi cuenta</title>
  <?php require "head.php"; ?>
</head>

<body>
  <?php require "header.php"; ?>
  <div class="container pt-2">
    <div class="row">
      <h1>Administración de cuentas</h1>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <h3>Mi información</h3>
          <form>
            <?php
            $userid = $_SESSION['user_id'];
            //$query2 = "SELECT a.*, c.nombre AS nombre_categoria FROM articulos a JOIN categorias c ON a.categoria_id = c.id";
            
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
              <input type="hidden" name="userid" value="<?php echo $userid; ?>">
              <label for="nombre">Nombre:</label>
              <input type="text" class="form-control" disabled
                value="<?php echo $fila['nombre'] . " " . $fila['apellido']; ?>">
            </div>
            <div class="form-group">
              <label for="telefono">Teléfono:</label>
              <input type="tel" class="form-control" disabled value="<?php echo $fila['telefono']; ?>">
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" disabled value="<?php echo $fila['func_email']; ?>">
            </div>
            <div class="form-group">
              <label for="email">Rol:</label>
              <input type="email" class="form-control" disabled value="<?php echo $fila['area']; ?>">
            </div>
            <div class="form-group">
              <button type="submit" class="form-control btn btn-info">Editar información</button>
            </div>
          </form>
          <!-- formulario de cambio de contraseña  -->
          <form method="post" action="cambiar_password.php">
            <div class="form-group">
              <input type="hidden" name="userid" value="<?php echo $userid; ?>">
              <button type="submit" class="form-control btn btn-warning">Modificar contraseña</button>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <h3>Mis asignaciones</h3>
        </div>
      </div>
    </div>
  </div>
</body>

</html>