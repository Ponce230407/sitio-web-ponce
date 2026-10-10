<?php
require __DIR__ . '/conexion.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: null;

if ($id) {
    $stmt = $conexion->prepare('UPDATE productos SET activo = FALSE WHERE id_producto = :id');
    $stmt->execute(['id' => $id]);
}

header('Location: productos.php');
exit();
?>
