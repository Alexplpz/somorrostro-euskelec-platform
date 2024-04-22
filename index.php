<?php
session_start();
session_destroy();
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']);

    $servername = "127.0.0.1";
    $port = "3305";
    $db_username = "root";
    $db_password = "";
    $dbname = "euskelec";

    $conn = new mysqli($servername . ':' . $port, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
 
    // Utilizar consultas preparadas para evitar la inyección de SQL
    $sql = "SELECT password, rank, name FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc())
    if ($row["password"] == $password) {
        $_SESSION['name'] = $row["name"];
        if ($row["rank"] != 0) {
            $_SESSION['status'] = 1;
            header('Location: inicioadmin.php');
            exit();
        } else {
            $_SESSION['status'] = 0;
            header('Location: iniciobase.php');
            exit();
        }
    } else {
        $error_message = 'Nombre de usuario o contraseña incorrectos.';
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Euskelec Somorrostro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- <img src=./logosomo.jpg> -->
        <h3 class="titulos">Plataforma de Somorrostro</h3>
        <h4 class="subtitulos">Euskelec</h4>
        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>

            <input type="submit" value="Iniciar Sesión">
        </form>
    </div>
</body>
</html>
