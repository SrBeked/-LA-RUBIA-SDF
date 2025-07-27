<?php
$databasePath = __DIR__ . '/../database/la_rubia_db.sqlite';

try {
    $conn = new PDO("sqlite:$databasePath");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}
?>
