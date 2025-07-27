<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

require_once "includes/db.php";

$cliente = $_POST['cliente'];
$articulos = $_POST['articulo'];
$cantidades = $_POST['cantidad'];
$precios = $_POST['precio'];

$total = 0;
foreach ($cantidades as $i => $cant) {
    $total += $cant * $precios[$i];
}

try {
    $conn->beginTransaction();

    $stmt = $conn->prepare("INSERT INTO facturas (cliente, total) VALUES (:cliente, :total)");
    $stmt->execute([':cliente' => $cliente, ':total' => $total]);

    $factura_id = $conn->lastInsertId();

    $detalleStmt = $conn->prepare("INSERT INTO factura_detalles (factura_id, articulo, cantidad, precio, subtotal)
        VALUES (:factura_id, :articulo, :cantidad, :precio, :subtotal)");

    foreach ($articulos as $i => $art) {
        $cant = $cantidades[$i];
        $precio = $precios[$i];
        $subtotal = $cant * $precio;

        $detalleStmt->execute([
            ':factura_id' => $factura_id,
            ':articulo' => $art,
            ':cantidad' => $cant,
            ':precio' => $precio,
            ':subtotal' => $subtotal
        ]);
    }

    $conn->commit();
    header("Location: ver_facturas.php");
} catch (PDOException $e) {
    $conn->rollBack();
    die("Error al guardar la factura: " . $e->getMessage());
}
?>
