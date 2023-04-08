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
  <title>Login</title>
</head>
<body>
  <h1>Login</h1>
  <?php if ($error): ?>
    <p><?php echo $error; ?></p>
  <?php endif; ?>
  <form method="POST">
    <div>
      <label for="username">Usuario:</label>
      <input type="text" id="username" name="username">
    </div>
    <div>
      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password">
    </div>
    <div>
      <input type="submit" name="submit" value="Iniciar sesión">
    </div>
  </form>
</body>
</html>