<?php
require_once('./classes.php');
$BDClass = new BaseDedatos;
$conn = new mysqli($BDClass->servername. ':' . $BDClass->port, $BDClass->db_username, $BDClass->db_password, $BDClass->dbname);;

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}




$sql = "SELECT identifier, ip, file_name, display_name FROM devices";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["encender"])) {
    $ipGetted = $_POST["ipGetted"];
    shell_exec("start; echo " . $ipGetted);

}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ejecutar"])) {
    $fileGetted = $_POST["fileGetted"];
    shell_exec("start; echo " .  $fileGetted);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de dispositivos</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #374f6b;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 0px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #374f6b;
            color: white;
        }

        button{
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lista de dispositivos</h2>

        <table>
            <tr>
                <th>Nombre</th>
                <th>IP</th>
                <th>Archivo asignado</th>
                <th>Encender maquina</th>
                <th>Ejecutar script</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["display_name"]; ?></td>
                    <td><?php echo $row["ip"]; ?></td>
                    <td><?php echo $row["file_name"]; ?></td>                  
                    <td>
                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                            <input type="hidden" name="ipGetted" value="<?php echo $row["ip"]; ?>">
                            <button class="button-3" type="submit" name="encender">Encender</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                            <input type="hidden" name="fileGetted" value="<?php echo $row["file_name"]; ?>">
                            <button class="button-3" type="submit" name="ejecutar">Ejecutar</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <button class="button-3" onclick="window.location.href='iniciobase.php'">Volver a la pagina inicial</button>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
