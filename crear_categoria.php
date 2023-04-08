<?php
    include('conexion.php');
    require_once('verificar_sesion.php');
    if(isset($_POST['nombre'])){
        $nombre = $_POST['nombre'];
        $sql = "INSERT INTO categorias (nombre) VALUES ('$nombre')";
        if(mysqli_query($con, $sql)){
            echo "Categoría creada exitosamente";
        } else{
            echo "Error al crear la categoría: " . mysqli_error($con);
        }
        mysqli_close($con);
    }
?>

<h1>Crear nueva categoría</h1>
<form action="crear_categoria.php" method="post">
    <label for="nombre">Nombre de la categoría:</label>
    <input type="text" name="nombre" id="nombre" required>
    <br><br>
    <input type="submit" value="Crear">
</form>