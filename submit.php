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
    $mensaje = $_POST['mensaje'];
    $piso = $_POST['piso']; // Nuevo campo agregado

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO solicitudes (nombre, email, telefono, mensaje, piso) VALUES (:nombre, :email, :telefono, :mensaje, :piso)";
    $stmt = $conexion->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
    $stmt->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
    $stmt->bindParam(':piso', $piso, PDO::PARAM_STR);

    // Ejecutar la consulta
    $stmt->execute();

    // Redireccionar a la página de confirmación con parámetros GET
    header("Location: solicitud_confirmada.php?nombre=" . urlencode($nombre) . "&email=" . urlencode($email));
    exit();
} catch (PDOException $e) {
    echo "Error al enviar la solicitud: " . $e->getMessage();
}
?>
