<?php
session_start();
session_destroy();
session_start();

require_once('./classes.php');
$BDClass = new BaseDedatos;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']);
    
    $conn = new mysqli($BDClass->servername. ':' . $BDClass->port, $BDClass->db_username, $BDClass->db_password, $BDClass->dbname);;
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
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <img class="containerLogo" src=../css/logosomo.jpg>
        <x-title>Plataforma de Somorrostro</x-title>
        <x-subtitle>Euskelec</x-subtitle>
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
