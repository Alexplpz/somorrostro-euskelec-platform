<?php
$servername = "127.0.0.1";
$port = "3305";
$username = "root";
$password = "";
$dbname = "cbc";

$conn = new mysqli($servername . ':' . $port, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Manejar la acción del botón "Ascender"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["descargar"])) {
    $filename = $_POST["dimeNombre"];
    $file = "./descargas/".$filename;
    
    header('Content-type: application/octet-stream');
    header("Content-Type: ".mime_content_type($file));
    header("Content-Disposition: attachment; filename=".$filename);
    while (ob_get_level()) {
        ob_end_clean();
    }
    readfile($file);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de descargas</title>
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
        <h2>Lista de descargas</h2>

        <table>
            <tr>
                <th>XAMPP</th>
                <th>Wordpress</th>
                <th>Moodle</th>
            </tr>

                <tr>
                    <td>
                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <input type="hidden" name="dimeNombre" value="xampp.rar">
                            <button class="button-3" type="submit" name="descargar">Descargar</button>
                        </form>             
                    </td>
                    <td>
                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <input type="hidden" name="dimeNombre" value="wp.rar">
                            <button class="button-3" type="submit" name="descargar">Descargar</button>
                        </form>             
                    </td>
                    <td>
                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                            <input type="hidden" name="dimeNombre" value="moodle.rar">
                            <button class="button-3" type="submit" name="descargar">Descargar</button>
                        </form>             
                    </td>
                </tr>
        </table>
        <button class="button-3" onclick="window.location.href='inicioalumno.php'">Volver a la pagina inicial</button>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
