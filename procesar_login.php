<?php
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $stmt = $con->prepare("SELECT * FROM usuarios WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row["password"])) {
      session_start();
      $_SESSION["usuario_id"] = $row["id"];
      $_SESSION["usuario_rol"] = $row["rol"];
      header("location: crear_categoria.php");
    } else {
      echo "Contraseña incorrecta.";
    }
  } else {
    echo "Email no registrado.";
  }
}
?>
