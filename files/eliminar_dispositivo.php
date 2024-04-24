<?php
require_once('./classes.php');
$BDClass = new BaseDedatos;
$conn = new mysqli($BDClass->servername. ':' . $BDClass->port, $BDClass->db_username, $BDClass->db_password, $BDClass->dbname);;
$modalMessage = "El registro no se puede editar, solo eliminar, ten cuidado.";

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
    <link rel="stylesheet" href="../css/style.css">
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

    <script src="../js/script.js"></script></body>
</html>
