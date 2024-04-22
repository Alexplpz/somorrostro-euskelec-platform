<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Bienvenido a SMR2 Somorrostro</title>
</head>
<body>
    <h2 class="nombre-inicio">¿Que quieres hacer con los dispositivos?</h2>
    <ul class="lista-inicio">
        <li><a href="crear_dispositivo.php">Crear dispositivo nuevo</a></li>
        <li><a href="eliminar_dispositivo.php">Eliminar un dispositivo</a></li>
        <li><a href="lista_dispositivo.php">Encender o ejecutar dispositivos</a></li>
        <li><a href="./iniciobase.php">Volver al inicio</a></li>
        <li><a href="./index.php">Cerrar sesión</a></li>
    </ul>
    <!-- <h3 class="rol-inicio">Tu rol es profesor</h3> -->

</body>
</html>

<?php 
    session_start();
    if ($_SESSION["status"] == 0 ) {
        header('Location: iniciobase.php');
        
    }
?>