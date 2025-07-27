<?php
$dbFile = __DIR__ . "/database/la_rubia_db.sqlite";

if (file_exists($dbFile)) {
    echo "✅ Base de datos ya existe. Puedes comenzar a usar el sistema.";
    exit;
}

try {
    $conn = new PDO("sqlite:" . $dbFile);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear tabla de usuarios
    $conn->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL
        );
    ");

    // Crear usuario por defecto
    $hashedPassword = password_hash("tareafacil25", PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:u, :p)");
    $stmt->execute([':u' => 'demo', ':p' => $hashedPassword]);

    // Crear tabla de clientes
    $conn->exec("
        CREATE TABLE IF NOT EXISTS clients (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT,
            phone TEXT
        );
    ");

    // Crear tabla de productos
    $conn->exec("
        CREATE TABLE IF NOT EXISTS products (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            description TEXT,
            price REAL NOT NULL
        );
    ");

    // Crear tabla de facturas
    $conn->exec("
        CREATE TABLE IF NOT EXISTS invoices (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            client_id INTEGER,
            date TEXT NOT NULL,
            total REAL NOT NULL,
            FOREIGN KEY(client_id) REFERENCES clients(id)
        );
    ");

    // Crear tabla de detalles de factura
    $conn->exec("
        CREATE TABLE IF NOT EXISTS invoice_details (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            invoice_id INTEGER,
            product_id INTEGER,
            quantity INTEGER NOT NULL,
            price REAL NOT NULL,
            FOREIGN KEY(invoice_id) REFERENCES invoices(id),
            FOREIGN KEY(product_id) REFERENCES products(id)
        );
    ");

    echo "✅ Base de datos y tablas creadas exitosamente.<br>";
    echo "🔐 Usuario por defecto: <b>demo</b><br>";
    echo "🔑 Contraseña: <b>tareafacil25</b>";
} catch (PDOException $e) {
    die("Error al crear la base de datos: " . $e->getMessage());
}
?>
