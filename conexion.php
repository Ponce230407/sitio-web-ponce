<?php
// Si está en Railway/Render leerá estas, si no, usará localhost para tus pruebas locales
$host = getenv('MYSQLHOST') ?: 'localhost';
$user = getenv('MYSQLUSER') ?: 'root';
$password = getenv('MYSQLPASSWORD') ?: '';
$dbname = getenv('MYSQLDATABASE') ?: 'sistema';
$port = getenv('MYSQLPORT') ?: '3306';

$conexion = new mysqli($host, $user, $password, $dbname, $port);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>