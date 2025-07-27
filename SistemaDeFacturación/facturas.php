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
    <title>Nueva Factura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function calcularTotal() {
            const cantidades = document.querySelectorAll('.cantidad');
            const precios = document.querySelectorAll('.precio');
            let total = 0;

            for (let i = 0; i < cantidades.length; i++) {
                const subtotal = cantidades[i].value * precios[i].value;
                document.getElementById('subtotal'+i).innerText = subtotal.toFixed(2);
                total += subtotal;
            }
            document.getElementById('total').innerText = total.toFixed(2);
        }
    </script>
</head>
<body>
<div class="container mt-5">
    <h3>Nueva Factura</h3>
    <form action="guardar_factura.php" method="POST">
        <div class="mb-3">
            <input type="text" name="cliente" class="form-control" placeholder="Nombre del Cliente" required>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Artículo</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i=0; $i<3; $i++): ?>
                <tr>
                    <td><input name="articulo[]" class="form-control" required></td>
                    <td><input name="cantidad[]" class="form-control cantidad" type="number" value="1" min="1" onchange="calcularTotal()" required></td>
                    <td><input name="precio[]" class="form-control precio" type="number" value="0" min="0" onchange="calcularTotal()" required></td>
                    <td>$<span id="subtotal<?= $i ?>">0.00</span></td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <h5>Total: $<span id="total">0.00</span></h5>
        <button class="btn btn-primary mt-3">Guardar Factura</button>
    </form>
</div>
</body>
</html>
