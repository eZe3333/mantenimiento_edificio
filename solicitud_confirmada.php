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
            <?php
            // Configuración de conexión a la base de datos con PDO
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mantenimiento_edificio";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Consulta SQL para obtener todas las solicitudes ordenadas por fecha
                $sql = "SELECT nombre, email, telefono, mensaje, piso, fecha FROM solicitudes ORDER BY fecha DESC";
                $stmt = $conn->query($sql);

                if ($stmt->rowCount() > 0) {
                    // Mostrar las solicitudes en forma de tabla
                    echo "<h3>Todas las Solicitudes Registradas:</h3>";
                    echo "<table>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Nombre</th>";
                    echo "<th>Email</th>";
                    echo "<th>Teléfono</th>";
                    echo "<th>Mensaje</th>";
                    echo "<th>Número de Departamento</th>";
                    echo "<th>Fecha</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["telefono"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["mensaje"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["piso"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["fecha"]) . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo '<a href="index.html" class="btn">Volver a Enviar Solicitud</a>';
                } else {
                    echo "<p>No hay solicitudes registradas.</p>";
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
