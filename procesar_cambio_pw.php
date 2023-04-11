<?php
require "conexion.php";
require "verificar_sesion.php";

if (!isset($_POST['actual'])) {
  echo "Error";
  header('Location: cambiar_password.php?estado=1');
  exit;
}

$userid = $_SESSION['user_id'];
$pwActual = $_POST['actual'];
$nueva_1 = $_POST['nueva_1'];
$nueva_2 = $_POST['nueva_2'];

// obtener contraseña actual

$_sql = "SELECT password FROM users WHERE id = $userid";
if (mysqli_query($con, $_sql)) {
  $fila = mysqli_fetch_assoc(mysqli_query($con, $_sql));
  if (password_verify($pwActual, $fila['password'])) { // si es la contraseña retorna 1
    if ($nueva_1 == $nueva_2) {
      $pwNueva = password_hash($nueva_1, PASSWORD_DEFAULT);
      $_sql = "UPDATE users SET password = '$pwNueva' WHERE id = $userid";
      if (mysqli_query($con, $_sql)) {
        header('Location: cambiar_password.php?estado=0');
      } else {
        header('Location: cambiar_password.php?estado=3');
      }
    } else { header('Location: cambiar_password.php?estado=1'); }
  } else { header('Location: cambiar_password.php?estado=2'); }
} else { "error en consulta sql"; }

//password_verify($password, $row["password"])

//editar_articulo.php?id=x
?>