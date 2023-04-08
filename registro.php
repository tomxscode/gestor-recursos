<?php
// Conexión a la base de datos
include("conexion.php");

// Procesar el formulario de registro de usuarios
if(isset($_POST['register'])) {
  // Obtener los datos del formulario
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role = $_POST['role'];

  // Insertar los datos del usuario en la base de datos
  $sql = "INSERT INTO users (username, email, password, role)
          VALUES ('$username', '$email', '$password', '$role')";

  if ($con->query($sql) === TRUE) {
    echo "El usuario ha sido registrado exitosamente";
  } else {
    echo "Error al registrar el usuario: " . $conn->error;
  }
}

// Cerrar la conexión a la base de datos
$con->close();
?>

<!-- Formulario de registro de usuarios -->
<form method="post" action="registro.php">
  <label>Nombre de usuario:</label>
  <input type="text" name="username" required>

  <label>Email:</label>
  <input type="email" name="email" required>

  <label>Contraseña:</label>
  <input type="password" name="password" required>

  <label>Rol:</label>
  <select name="role">
    <option value="usuario">Usuario</option>
    <option value="admin">Administrador</option>
    <option value="encargado">Encargado</option>
  </select>

  <button type="submit" name="register">Registrar</button>
</form>