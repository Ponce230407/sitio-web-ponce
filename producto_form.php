<?php
require __DIR__ . '/conexion.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: null;

if ($id) {
    $stmt = $conexion->prepare('SELECT * FROM productos WHERE id_producto = :id');
    $stmt->execute(['id' => $id]);
    $producto = $stmt->fetch();
} else {
    $producto = null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim((string)($_POST['nombre'] ?? ''));
    $descripcion = trim((string)($_POST['descripcion'] ?? ''));
    $precio = isset($_POST['precio']) ? (float) $_POST['precio'] : 0;
    $stock = isset($_POST['stock']) ? (int) $_POST['stock'] : 0;

    if ($id) {
        $stmt = $conexion->prepare('UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, stock = :stock WHERE id_producto = :id');
        $stmt->execute([
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'stock' => $stock,
            'id' => $id,
        ]);
    } else {
        $stmt = $conexion->prepare('INSERT INTO productos (nombre, descripcion, precio, stock, activo) VALUES (:nombre, :descripcion, :precio, :stock, TRUE)');
        $stmt->execute([
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'stock' => $stock,
        ]);
    }

    header('Location: productos.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $producto ? 'Editar' : 'Nuevo' ?> Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <?php include 'menu.php'; ?>
    <div class="container col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4><?= $producto ? 'Editar' : 'Nuevo' ?> Producto</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($producto['nombre'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control"><?= htmlspecialchars($producto['descripcion'] ?? '') ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Precio ($)</label>
                            <input type="number" step="0.01" name="precio" class="form-control" value="<?= htmlspecialchars((string)($producto['precio'] ?? '')) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" name="stock" class="form-control" value="<?= htmlspecialchars((string)($producto['stock'] ?? '')) ?>" required>
                        </div>
                    </div>
                    <a href="productos.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
