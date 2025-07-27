<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - La Rubia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-box {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            background-color: white;
            transition: 0.3s;
        }
        .dashboard-box:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .nav-link {
            color: white;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="#">La Rubia</a>
    <div>
        <span class="text-white me-3">Usuario: <?= htmlspecialchars($_SESSION['usuario']) ?></span>
        <a href="logout.php" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="mb-4">Bienvenido al Sistema de Facturación</h2>
    <p>Aquí podrás gestionar tus facturas, clientes y productos.</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <a href="factura.php" class="text-decoration-none text-dark">
                <div class="dashboard-box">
                    <h4>🧾 Crear Factura</h4>
                    <p>Registra una nueva venta</p>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="ver_facturas.php" class="text-decoration-none text-dark">
                <div class="dashboard-box">
                    <h4>📑 Ver Facturas</h4>
                    <p>Consulta el historial</p>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="#" class="text-decoration-none text-dark">
                <div class="dashboard-box">
                    <h4>👤 Clientes</h4>
                    <p>(Proximamente)</p>
                </div>
            </a>
        </div>
    </div>
</div>
</body>
</html>
