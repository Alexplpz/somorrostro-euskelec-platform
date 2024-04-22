<?php
$servername = "127.0.0.1";
$port = "3305";
$username = "root";
$password = "";
$dbname = "euskelec";
$modalMessage = "Ten cuidado con el registro, no se puede rehacer";
$conn = new mysqli($servername . ':' . $port, $username, $password, $dbname);

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
    <link rel="stylesheet" type="text/css" href="style.css">
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
    <script src="script.js"></script>
</body>
</html>

