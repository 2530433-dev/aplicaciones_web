<?php
    $titulo = "Cotizador de productos";
    include 'includes/header.php';
    include "data/productos.php";

    $resultado = null;
    $error = "";
    $productoSeleccionado = $_POST['producto'] ?? "";
    $cantidad = max(1, (int)($_POST['cantidad'] ?? 1));


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($productos) || !array_key_exists($productoSeleccionado, $productos)) {
            $error = "Selecciona un producto valido";
        } else {
            //Calcular las cantidades por el precio y los descuentos respectivos
            $precio = $productos[$productoSeleccionado]['precio'];
            $subtotal = $precio * $cantidad;

            //Aplicar descuento si la venta supera los 20000 pesos
            if ($subtotal >= 20000) {
                $descuento = $subtotal * 0.1;
            } else {
                $descuento = 0;
            }

            //Calculamos cifras totales con o sin descuento y agregamos el IVA
            $subtotalConDescuento = $subtotal - $descuento;
            $iva = $subtotalConDescuento * 0.16;
            $total = $subtotalConDescuento + $iva;

            //Preparamos el array de los resultados paraposteriorme te imprimirlo en HTML
            $resultado = [
                "producto" => $productoSeleccionado,
                "precio" => $precio,
                "cantidad" => $cantidad,
                "subtotal" => $subtotal,
                "descuento" => $descuento,
                'iva' => $iva,
                'total' => $total
            ];
        }
    }
?>

<form method="post">
    <label for="producto">Producto:</label>
    <select name="producto" id="producto" required>
        <option value="" disabled <?= $productoSeleccionado === "" ? "selected" : ""; ?>>Selecciona un producto</option>
        <!-- integrar los productos desde un array en php -->
        <?php foreach ($productos as $nombre => $precio): ?>
            <option 
                value="<?= htmlspecialchars($nombre) ?>"
                <?= $productoSeleccionado === $nombre ? "selected" : "" ?>
            >
                <?= htmlspecialchars($nombre) ?> - $<?= number_format($precio, 2) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label for="cantidad">Cantidad:</label>
    <input type="number" name="cantidad" id="cantidad" value="<?= $cantidad ?>" min="1" required>
    <button type="submit">Cotizar</button>
</form>

<?php if ($error !== ""): ?>

<div class="resultado">
    <?= htmlspecialchars($error) ?>
</div>

<?php endif; ?>

<?php if ($resultado): ?>
    <div class="resultado">
        <p>Producto: <?= htmlspecialchars($resultado["producto"]) ?></p>
        <p>Precio: $<?= number_format($resultado["precio"], 2) ?></p>
        <p>Cantidad: <?= $resultado["cantidad"] ?></p>
        <p>Subtotal: $<?= number_format($resultado["subtotal"], 2) ?></p>
        <p>Descuento: $<?= number_format($resultado["descuento"], 2) ?></p>
        <p>IVA: $<?= number_format($resultado["iva"], 2) ?></p>
        <p>Total: $<?= number_format($resultado["total"], 2) ?></p>
    </div>
<?php endif; ?>

<?php 
    include "includes/footer.php"
?>