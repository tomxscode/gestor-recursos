<?php
session_start(); // Iniciamos sesión

require_once 'conexion.php'; // Conexión a la base de datos

// Verificamos si el usuario ya inició sesión
if (isset($_SESSION['user_id'])) {
  header('Location: index.php'); // Redireccionamos al inicio
  exit();
}

$error = ''; // Variable para almacenar el mensaje de error

// Verificamos si se envió el formulario
if (isset($_POST['submit'])) {
  // Obtenemos el usuario y la contraseña ingresados
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Consulta para verificar si el usuario existe en la base de datos
  $query = "SELECT id, username, password, role FROM users WHERE username = '$username' LIMIT 1";
  $result = mysqli_query($con, $query);

  if ($result && mysqli_num_rows($result) > 0) { // Verificamos si se encontró el usuario
    $user = mysqli_fetch_assoc($result);

    // Verificamos si la contraseña es correcta
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id']; // Almacenamos el id del usuario en la sesión
      $_SESSION['user_role'] = $user['role']; // Almacenamos el rol del usuario en la sesión

      // Redireccionamos al inicio dependiendo del rol del usuario
      if ($user['role'] == 'admin') {
        header('Location: admin/index.php');
      } elseif ($user['role'] == 'encargado') {
        header('Location: encargado/index.php');
      } else {
        header('Location: index.php');
      }
      exit();
    }
  }

  $error = 'Usuario o contraseña incorrectos.'; // Mensaje de error
}

// Mostramos el formulario de login
?>

<!DOCTYPE html>
<html>

<head>
  <title>Inicio de sesión</title>
  <?php require("head.php") ?>
</head>

<body>
  <div class="container">
    <div class="row p-3" style="height: 100vh;">
      <div class="col-md-8 mx-auto align-middle">
        <h1>Inicio de sesión</h1>
        <p>Para poder acceder al sitio necesitas credenciales de acceso</p>
        <?php if ($error): ?>
          <p>
          <div class="alert alert-danger" role="alert">
            ¡Sucedió un error!: <br>
            <?php echo $error; ?>
            <br>
            Si crees que es un error comunicalo con tu administrador.
          </div>
          </p>
        <?php endif; ?>
        <form method="POST">
          <div class="form-group">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" class="form-control">
          </div>
          <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" name="submit" value="Iniciar sesión" class="form-control btn btn-primary">
            <small>¿No tienes creedenciales de acceso?, solicitalas con tu administrador</small>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>