<?php
session_start();

if(isset($_SESSION['user_id']) && $_SESSION['user_role'] != 'admin' || !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    // todo: poner un enlace a una pagina de error
    exit();
}
?>