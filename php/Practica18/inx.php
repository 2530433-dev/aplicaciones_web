<?php 
    $titulo = "Gastos por categoria";
    include "includes/header.php";
    
    //Se elije el archivo donde se guardan las respuetas
    $archivo = __DIR__ . "/data/gastos.json";
    //se llaman las respuestas que esten guardadas en los archivos json
    $respuestas = json_decode(file_get_contents($archivo), true) ? : [];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //se extraen los valores del formulario
        $respuesta = $_POST["categoria"] ?? "";

        if (in_array($respuesta, ["Hogar", "Personal", "Extra", "Inversion"], true)) {
            $respuestas[] = $respuesta;
            file_put_contents($archivo, json_encode($respuestas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }

    $conteos = array_count_values($respuestas);
    $total = count($respuestas);
?>
<form method="post">
    <label>Gasto:</label>
    <input type="number" name="gasto" required>
    <label>Categoria</label>
    <select name="categoria">
        <option disabled selected>Selecciona una opcion</option>
        <option>Hogar</option>
        <option>Personales</option>
        <option>Extra</option>
        <option>Inversion</option>
    </select>
    <button type="submit">Guardar</button>
</form>
<table>
    <tr><th>Categoria</th><th>Gasto</th><th>Porcentaje</th></tr>
    <?php foreach (["Hogar", "Personal", "Extra", "Inversion"] as $opcion): ?>
        <?php $cantidad = $conteos[$opcion] ?? 0; ?>
        <tr>
            <td><?= $opcion ?></td>
            <td><?= $cantidad ?></td>
            <td><?= $total > 0 ? number_format(($cantidad / $total) * 100, 1) : "0" ?>%</td>
        </tr>
    <?php endforeach; ?>
    <td>Total</td>
    <td></td>
</table>

<?php include "includes/footer.php"; ?>