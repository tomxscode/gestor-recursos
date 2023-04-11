<?php
include('conexion.php');
//require('verificar_sesion.php');
require('verificar_admin.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar funcionario</title>
    <?php require "head.php"; ?>
</head>

<body>
    <?php require "header.php"; ?>
    <div class="container pt-2">
        <?php
        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $run = $_POST['run'];
            $rol = $_POST['area'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $password = password_hash($run, PASSWORD_DEFAULT);
            if ($rol == "administrativo") {
                $sql = "
                START TRANSACTION;
                INSERT INTO users (username, email, password, role) VALUES ('$run', '$email', '$password', 'admin');
                SET @user_id = LAST_INSERT_ID();
                INSERT INTO funcionarios (rut, nombre, apellido, area, telefono, usuario_id) VALUES ('$run', '$nombre', '$apellido', '$rol', '$telefono', @user_id);
                COMMIT;
            ";
            } else if ($rol == "inspectores") {
                $sql = "
                START TRANSACTION;
                INSERT INTO users (username, email, password, role) VALUES ('$run', '$email', '$password', 'encargado');
                SET @user_id = LAST_INSERT_ID();
                INSERT INTO funcionarios (rut, nombre, apellido, area, telefono, usuario_id) VALUES ('$run', '$nombre', '$apellido', '$rol', '$telefono', @user_id);
                COMMIT;
                ";
            } else if ($rol == "profesores") {
                $sql = "
                START TRANSACTION;
                INSERT INTO users (username, email, password, role) VALUES ('$run', '$email', '$password', 'profesor');
                SET @user_id = LAST_INSERT_ID();
                INSERT INTO funcionarios (rut, nombre, apellido, area, telefono, usuario_id) VALUES ('$run', '$nombre', '$apellido', '$rol', '$telefono', @user_id);
                COMMIT;
                ";
            }  else {
                $sql = "
                START TRANSACTION;
                INSERT INTO users (username, email, password, role) VALUES ('$run', '$email', '$password', 'usuario');
                SET @user_id = LAST_INSERT_ID();
                INSERT INTO funcionarios (rut, nombre, apellido, area, telefono, usuario_id) VALUES ('$run', '$nombre', '$apellido', '$rol', '$telefono', @user_id);
                COMMIT;
            ";
            }
            
            // consulta
            if ($con->multi_query($sql) === TRUE) {
                echo "
                        <div class='alert alert-success' role='alert'>
                            El funcionario fue registrado con éxito. <br>
                            Sus datos de acceso son: <br>
                            Usuario: " . $run . " <br>
                            Contraseña: " . $run . "
                        </div>
                    ";
            } else {
                echo "
                    <div class='alert alert-danger' role='alert'>
                        No se pudo registrar al funcionario, si cree que es un error contactese con su administrador
                    </div>
                  ";
            }
            $con->close();
        }
        ?>
        <div class="row">
            <h1>Registrar un nuevo funcionario</h1>
            <p>Todos los datos solicitados son obligatorios</p>
            <form action="agregar_funcionario.php" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apellido">Apellido:</label>
                            <input type="text" name="apellido" id="apellido" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="run">RUN:</label>
                    <input type="text" name="run" id="run" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="area">Rol:</label>
                    <select class="custom-select" id="area" name="area">
                        <option value="profesores">Profesor</option>
                        <option value="auxiliares">Auxiliar</option>
                        <option value="administrativo">Administrativo</option>
                        <option value="inspectores">Inspector</option>
                        <option value="asistentes">Asistente educativo</option>
                        <option value="apoyos">Apoyo (psicologo, trabajador social, etc)</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="tel" name="telefono" id="telefono" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="Crear" class="form-control btn-success">
                </div>
            </form>
        </div>
    </div>
</body>

</html>