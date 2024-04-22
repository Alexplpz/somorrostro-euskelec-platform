<?php
$servername = "127.0.0.1";
$port = "3305";
$username = "root";
$password = "";
$dbname = "euskelec";

$modalMessage = "Inserta la IP del dispositivo que quieras dar de baja";
$conn = new mysqli($servername . ':' . $port, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ip = $_POST["ip"];

    $sql = "DELETE FROM devices WHERE IP='$ip'";

    if ($conn->query($sql) === TRUE) {
        $modalMessage = "Dipositivo borrado correctamente";
    } else {
        $modalMessage = "Error al borrar usuario: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar dispositivo</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilos específicos para borrar.php */
        form {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Borrar dispositivo</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="placa">IP del dispositivo a borrar</label>
            <input type="text" name="ip" required>

            <input type="submit" value="Borrar dipositivo">
            
        </form>
        <button class="button-3" onclick="window.location.href='iniciobase.php'">Volver a la pagina inicial</button>
    </div>

    <div id="modal" class="modal">
        <p id="modal-message"><?php echo $modalMessage; ?></p>
        <button class="button-3" onclick="closeModal()">Cerrar</button>
    </div>
    <div id="overlay" class="overlay"></div>

    <script src="script.js"></script>
</body>
</html>
