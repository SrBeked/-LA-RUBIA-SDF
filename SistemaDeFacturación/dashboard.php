<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - La Rubia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">La Rubia</a>
    <div class="d-flex">
      <span class="navbar-text text-white me-3">
        Usuario: <?= htmlspecialchars($_SESSION["user"]) ?>
      </span>
      <a href="logout.php" class="btn btn-outline-light">Cerrar sesión</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h1 class="mb-4">Bienvenido al Sistema de Facturación</h1>
    <p class="lead">Selecciona una opción para comenzar:</p>

    <div class="row g-4">
        <div class="col-md-4">
            <a href="nueva_factura.php" class="btn btn-primary w-100">Registrar Factura</a>
        </div>
        <div class="col-md-4">
            <a href="facturas.php" class="btn btn-secondary w-100">Ver Facturas</a>
        </div>
        <div class="col-md-4">
            <a href="registrar_cliente.php" class="btn btn-success w-100">Registrar Cliente</a>
        </div>
        <div class="col-md-4">
            <a href="clientes.php" class="btn btn-outline-success w-100">Ver Clientes</a>
        </div>
        <div class="col-md-4">
            <a href="registrar_producto.php" class="btn btn-warning w-100">Registrar Producto</a>
        </div>
        <div class="col-md-4">
            <a href="productos.php" class="btn btn-outline-warning w-100">Ver Productos</a>
        </div>
    </div>
</div>
</body>
</html>
