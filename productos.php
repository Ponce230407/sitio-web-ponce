<?php
require __DIR__ . '/conexion.php';

$sql = 'SELECT * FROM productos WHERE activo = TRUE ORDER BY id_producto DESC';
$stmt = $conexion->query($sql);
$productos = $stmt ? $stmt->fetchAll() : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <?php include 'menu.php'; ?>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Catálogo de Productos</h2>
            <a href="producto_form.php" class="btn btn-success">+ Nuevo Producto</a>
        </div>

        <table class="table table-striped table-hover shadow-sm bg-white rounded">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($productos)): ?>
                    <?php foreach ($productos as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars((string) $row['id_producto']) ?></td>
                        <td><?= htmlspecialchars((string) $row['nombre']) ?></td>
                        <td><?= htmlspecialchars((string) $row['descripcion']) ?></td>
                        <td>$<?= number_format((float) $row['precio'], 2) ?></td>
                        <td><?= htmlspecialchars((string) $row['stock']) ?></td>
                        <td>
                            <a href="producto_form.php?id=<?= (int) $row['id_producto'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="producto_eliminar.php?id=<?= (int) $row['id_producto'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar producto?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center text-muted">No hay productos disponibles</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="index.html" class="btn btn-secondary mt-3">Volver al Inicio</a>
    </div>
</body>
</html>
