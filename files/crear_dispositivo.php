<?php
require_once('./classes.php');
$BDClass = new BaseDedatos;
$conn = new mysqli($BDClass->servername. ':' . $BDClass->port, $BDClass->db_username, $BDClass->db_password, $BDClass->dbname);;
$modalMessage = "El registro no se puede editar, solo eliminar, ten cuidado.";

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Datos recibidos del formulario embedido abajo --> Ususario, Contraseña, Nombre Completo y Rango añadidos como: username, password, name, rank.
    $nombre_dispositivo = $_POST["nombre"];
    $ip = $_POST["IP"];
    $file_name = $_POST["file_name"] . ".sh";

    $sql = "INSERT IGNORE INTO devices (display_name, ip, file_name) VALUES ('$nombre_dispositivo', '$ip', '$file_name')";

    if ($conn->query($sql) === TRUE) {
        $modalMessage = "Datos insertados <br> El script a usar es: <strong>" . $file_name;
    } else {
        $modalMessage = "Error al insertar datos: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>

<!-- HTML PART -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de dispositivos</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Registro de dispositivos</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="numclase">Nombre a mostrar:</label>
            <input type="text" name="nombre" required>
            
            <label for="username">Nombre del script a ejecutar:</label>
            <input type="text" name="file_name" required>

            <label for="password">IP de la maquina final:</label>
            <input type="text" name="IP" required>

            <input type="submit" value="Registrar dispositivo nuevo">
        </form>
        <button class="button-3" onclick="window.location.href='index.php'">Volver a la pagina inicial</button>
    </div>
      <!-- Modal y overlay -->
      <div id="modal" class="modal">
        <p id="modal-message"><?php echo $modalMessage; ?></p>
        <button class="button-3" onclick="closeModal()">Cerrar</button>
    </div>
    <div id="overlay" class="overlay"></div>
    <script src="../js/script.js"></script>
</body>
</html>

