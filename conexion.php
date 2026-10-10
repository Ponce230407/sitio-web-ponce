<?php
// Render usa DB_HOST / DB_USER / DB_PASSWORD / DB_NAME / DB_PORT
// Si no existen, usa valores locales para pruebas.
$host = getenv('DB_HOST') ?: 'localhost';
$port = getenv('DB_PORT') ?: '3306';
$dbname = getenv('DB_NAME') ?: 'sitio_web';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';
$charset = 'utf8mb4';

$dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset={$charset}";

try {
    $conexion = new PDO($dsn, $user, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $conexion->exec("
        CREATE TABLE IF NOT EXISTS productos (
            id_producto INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(255) NOT NULL,
            descripcion TEXT,
            precio DECIMAL(10,2) NOT NULL,
            stock INT NOT NULL,
            activo BOOLEAN NOT NULL DEFAULT TRUE
        )
    ");

    $conexion->exec("
        CREATE TABLE IF NOT EXISTS respuestas_encuesta (
            id_respuesta INT AUTO_INCREMENT PRIMARY KEY,
            nombre_completo VARCHAR(150) NOT NULL,
            p1_profesores VARCHAR(100) NOT NULL,
            p2_alumnos VARCHAR(100) NOT NULL,
            p3_instalaciones VARCHAR(100) NOT NULL,
            p4_examenes VARCHAR(100) NOT NULL,
            p5_comida VARCHAR(100) NOT NULL,
            fecha_respuesta TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        )
    ");
} catch (PDOException $e) {
    die("No se pudo conectar a MySQL: " . $e->getMessage());
}
?>
