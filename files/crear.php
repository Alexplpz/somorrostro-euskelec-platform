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
    $nombre = $_POST["nombre"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $rank = $_POST["rank"];

    $sql = "INSERT IGNORE INTO users (name, username, password, rank) VALUES ('$nombre', '$username', '$password', '$rank')";

    if ($conn->query($sql) === TRUE) {
        $modalMessage = "Datos insertados correctamente";
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
    <title>Registro de usuarios</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Registro de usuarios</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="numclase">Nombre completo:</label>
            <input type="text" name="nombre" required>
            
            <label for="username">Usuario:</label>
            <input type="text" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="text" name="password" required>

            <label for="quantity">Rango (Entre 0 y 2):</label>
            <input type="number" id="quantity" name="rank" min="0" max="2">

            <input type="submit" value="Registrar usuario nuevo">
        </form>
        <button class="button-3" onclick="window.location.href='index.php'">Volver a la pagina inicial</button>
    </div>
      <!-- Modal y overlay -->
      <div id="modal" class="modal">
        <p id="modal-message"><?php echo $modalMessage; ?></p>
        <button class="button-3" onclick="closeModal()">Cerrar</button>
    </div>
    <div id="overlay" class="overlay"></div>
    <script src="../js/script.js"></script></body>
</html>

