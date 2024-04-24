<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Bienvenido a SMR2 Somorrostro</title>
</head>
<body>
    <h2 class="nombre-inicio">Bienvenido/a <?php session_start(); echo $_SESSION['name']; ?></h2>
    <ul class="lista-inicio">
        <li><a href="crear.php">Crear cuenta</a></li>
        <li><a href="eliminar.php">Eliminar cuenta</a></li>
        <li><a href="gestion_dispositivos.php">Gestionar dispositivos</a></li>
        <li><a href="lista.php">Lista de usuarios</a></li>
        <li><a href="crearhost.php">Crear equipo</a></li>
        <li><a href="./index.php">Cerrar sesión</a></li>
    </ul>
    <!-- <h3 class="rol-inicio">Tu rol es profesor</h3> -->

</body>
</html>

<?php 
    if ($_SESSION["status"] == 0 ) {
        header('Location: iniciobase.php');
        
    }
?>