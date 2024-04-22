<?php
$servername = "127.0.0.1";
$port = "3305";
$username = "root";
$password = "";
$dbname = "smr2";

$conn = new mysqli($servername . ':' . $port, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["activar"])) {
    $usernameGetted = $_POST["usernameGetted"];

    $sql = "UPDATE alumnos SET rango = 1 WHERE username = '$usernameGetted'";
    $conn->query($sql);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["desactivar"])) {
    $usernameGetted = $_POST["usernameGetted"];

    $sql = "UPDATE alumnos SET rango = 0 WHERE username = '$usernameGetted'";
    $conn->query($sql);
}

$sql = "SELECT numclase, nombre, rango, apellido, username FROM alumnos";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Agentes - Policía</title>
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
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
        <h2>Lista de usuarios</h2>

        <table>
            <tr>
                <th>Número de clase</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Rango</th>
                <th>Convertir en profe</th>
                <th>Convertir en alumno</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["numclase"]; ?></td>
                    <td><?php echo $row["nombre"]; ?></td>
                    <td><?php echo $row["apellido"]; ?></td>
                    <td><?php if ($row["rango"] == 1) {
                        echo "Profesor";
                    } else {
                        echo "Alumno";
                    }?></td>                    
                    <td>
                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                            <input type="hidden" name="usernameGetted" value="<?php echo $row["username"]; ?>">
                            <button class="button-3" type="submit" name="activar">Convertir</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                            <input type="hidden" name="usernameGetted" value="<?php echo $row["username"]; ?>">
                            <button class="button-3" type="submit" name="desactivar">Convertir</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <button class="button-3" onclick="window.location.href='index.php'">Volver a la pagina inicial</button>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
