<?php
$user = "root";
$psw = ""; 
$dbname = "mantenimiento_edificio";
$host = "localhost";

try {
    // Conexión a la base de datos 
    $dsn = "mysql:host=$host;dbname=$dbname";
    $conexion = new PDO($dsn, $user, $psw);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO solicitudes (nombre, email, telefono) VALUES (:nombre, :email, :telefono)";
    $stmt = $conexion->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);

    // Ejecutar la consulta
    $stmt->execute();

    // Redireccionar de vuelta a la página principal o a una página de confirmación
    header("Location: index.html");
    exit(); // Asegúrate de terminar el script después de la redirección
} catch (PDOException $e) {
    echo "Error al enviar la solicitud: " . $e->getMessage();
}
?>
