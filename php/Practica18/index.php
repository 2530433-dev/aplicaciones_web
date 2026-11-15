<?php 
    $titulo = "Gastos por categoria";
    include "includes/header.php";
    
    //Se elije el archivo donde se guardan las respuetas
    $archivo = __DIR__ . "/data/gastos.json";
    //se llaman las respuestas que esten guardadas en los archivos json
    $respuestas = json_decode(file_get_contents($archivo), true) ? : [];

    $categorias = ["Hogar", "Personal", "Extra", "Inversion"];
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $categoria = $_POST["categoria"] ?? "";
        $gasto = $_POST["gasto"] ?? "";

        if (
            in_array($categoria, $categorias, true) &&
            is_numeric($gasto) &&
            is_finite((float) $gasto) &&
            (float) $gasto >= 0
        ) {
            $respuestas[] = [
                "categoria" => $categoria,
                "gasto" => (float) $gasto
            ];
            file_put_contents($archivo, json_encode($respuestas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        } else {
            $error = "Ingresa un gasto válido y selecciona una categoría.";
        }
    }

    $gastosPorCategoria = array_fill_keys($categorias, 0);
    $totalGasto = 0;
    foreach ($respuestas as $registro) {
        if (!is_array($registro)) {
            continue;
        }

        $categoria = $registro["categoria"] ?? "";
        $gasto = $registro["gasto"] ?? null;
        if (
            in_array($categoria, $categorias, true) &&
            is_numeric($gasto) &&
            is_finite((float) $gasto) &&
            (float) $gasto >= 0
        ) {
            $gastosPorCategoria[$categoria] += (float) $gasto;
            $totalGasto += (float) $gasto;
        }
    }
?>
<form method="post">
    <?php if ($error !== ""): ?>
        <p><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <label>Gasto:</label>
    <input type="number" name="gasto" min="0" step="0.01" required>
    <label>Categoria</label>
    <select name="categoria">
        <option disabled selected>Selecciona una opcion</option>
        <option>Hogar</option>
        <option>Personal</option>
        <option>Extra</option>
        <option>Inversion</option>
    </select>
    <button type="submit">Guardar</button>
</form>
<table>
    <tr><th>Categoria</th><th>Gasto</th><th>Porcentaje</th></tr>
    <?php foreach ($categorias as $opcion): ?>
        <?php $cantidad = $gastosPorCategoria[$opcion]; ?>
        <tr>
            <td><?= $opcion ?></td>
            <td><?= number_format($cantidad, 2) ?></td>
            <td><?= $totalGasto > 0 ? number_format(($cantidad / $totalGasto) * 100, 1) : "0" ?>%</td>
        </tr>
    <?php endforeach; ?>
    <tfoot>
        <tr>
            <th>Total</th>
            <th><?= number_format($totalGasto, 2) ?></th>
            <th><?= $totalGasto > 0 ? "100" : "0" ?>%</th>
        </tr>
    </tfoot>
</table>

<?php include "includes/footer.php"; ?>