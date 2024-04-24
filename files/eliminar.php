<?php
require_once('./classes.php');
$BDClass = new BaseDedatos;
$conn = new mysqli($BDClass->servername. ':' . $BDClass->port, $BDClass->db_username, $BDClass->db_password, $BDClass->dbname);;
$modalMessage = "Inserta el numero de placa del policia que quieras dar de baja";

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["user"];

    $sql = "DELETE FROM alumnos WHERE username='$user'";

    if ($conn->query($sql) === TRUE) {
        $modalMessage = "Usuario borrado correctamente";
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
    <title>Borrar Alumno</title>
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
        <h2>Borrar Alumno</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="placa">Usuario del alumno a borrar</label>
            <input type="text" name="user" required>

            <input type="submit" value="Borrar Alumno">
            
        </form>
        <button class="button-3" onclick="window.location.href='index.php'">Volver a la pagina inicial</button>
    </div>

    <div id="modal" class="modal">
        <p id="modal-message"><?php echo $modalMessage; ?></p>
        <button class="button-3" onclick="closeModal()">Cerrar</button>
    </div>
    <div id="overlay" class="overlay"></div>

    <script src="../js/script.js"></script></body>
</html>
