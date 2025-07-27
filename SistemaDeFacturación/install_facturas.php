<?php
require_once "includes/db.php";

$conn->exec("
CREATE TABLE IF NOT EXISTS facturas (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    cliente TEXT NOT NULL,
    total REAL NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS factura_detalles (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    factura_id INTEGER,
    articulo TEXT,
    cantidad INTEGER,
    precio REAL,
    subtotal REAL,
    FOREIGN KEY (factura_id) REFERENCES facturas(id)
);
");

echo "Tablas creadas correctamente.";
?>
