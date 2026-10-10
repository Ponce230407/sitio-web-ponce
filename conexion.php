<?php
// Render usa DB_HOST / DB_USER / DB_PASSWORD / DB_NAME
// Si no existen, usa valores locales para pruebas.
$host = getenv('DB_HOST') ?: getenv('MYSQLHOST') ?: 'localhost';
$user = getenv('DB_USER') ?: getenv('MYSQLUSER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: getenv('MYSQLPASSWORD') ?: '';
$dbname = getenv('DB_NAME') ?: getenv('MYSQLDATABASE') ?: 'sistema';
$port = getenv('DB_PORT') ?: getenv('MYSQLPORT') ?: '3306';

$conexion = new mysqli($host, $user, $password, $dbname, $port);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
