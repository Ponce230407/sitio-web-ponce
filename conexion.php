<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$user = "root";
$pass = "";
$db   = "sistema"; // Apunta a la nueva base de datos "sistema"

// 1. Conectar a MySQL
$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_error) {
    die("Error de conexión local: " . $conexion->connect_error);
}

// Configurar juego de caracteres a utf8mb4
$conexion->set_charset("utf8mb4");

// NOTA: No dejamos ninguna salida 'echo' para evitar interferir con la carga HTML o JSON de otras páginas.
?>