<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud Confirmada</title>
    <link rel="stylesheet" href="style .css">
</head>

<body>
    <header>
        <div class="container">
            <h1>Solicitud de Mantenimiento</h1>
        </div>
    </header>

    <main>
        <div class="container">
            <h2>Solicitud Confirmada</h2>
            <?php
            // Recuperar los parámetros GET
            $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
            $email = isset($_GET['email']) ? $_GET['email'] : '';

            echo "<p>Problemas reportados por: $nombre ($email)</p>";

            // Configuración de conexión a la base de datos con PDO
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mantenimiento_edificio";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Consulta SQL para obtener las solicitudes del usuario
                $sql = "SELECT nombre, email, telefono, mensaje, fecha FROM solicitudes WHERE nombre = :nombre AND email = :email";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    // Mostrar las solicitudes en forma de tabla
                    echo "<table>";
                    echo "<tr><th>Nombre</th><th>Email</th><th>Teléfono</th><th>Mensaje</th><th>Fecha</th></tr>";
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["telefono"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["fecha"]) . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No se encontraron solicitudes registradas para este usuario.</p>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            // Cerrar conexión
            $conn = null;
            ?>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Solicitud de Mantenimiento. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>
