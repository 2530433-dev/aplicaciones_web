<?php 
    $titulo = "Encuesta con resultados";
    include "includes/header.php";
    
    //Se elije el archivo donde se guardan las respuetas
    $archivo = __DIR__ . "/data/encuesta.json";
    $nombresArchivo = __DIR__ . "/data/nombres.json";
    //se llaman las respuestas que esten guardadas en los archivos json
    $respuestas = json_decode(file_get_contents($archivo), true) ? : [];
    $nombres = json_decode(file_get_contents($nombresArchivo), true) ? : [];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //se extraen los valores del formulario
        $respuesta = $_POST["respuesta"] ?? "";
        $nombre = $_POST["nombre"] ?? "";

        if (in_array($respuesta, ["Exelente", "Bueno", "Regular", "Malo"], true)) {
            $respuestas[] = $respuesta;
            $nombres[] = $nombre;
            file_put_contents($archivo, json_encode($respuestas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            file_put_contents($nombresArchivo, json_encode($nombres, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }

    $conteos = array_count_values($respuestas);
    $total = count($respuestas);
?>
<form method="post">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>
    <label>Matricula:</label>
    <input type="text" name="matricula" required>
    <label>Grupo:</label>
    <input type="text" name="grupo" required>
    <label>Como calificas el curso?</label>
    <select name="respuesta">
        <option disabled selected>Selecciona una opcion</option>
        <option>Exelente</option>
        <option>Bueno</option>
        <option>Regular</option>
        <option>Malo</option>
    </select>
    <button type="submit">Guardar respuesta</button>
</form>
<table>
    <tr><th>Opcion</th><th>Respuestas</th><th>Porcentaje</th></tr>
    <?php foreach (["Exelente", "Bueno", "Regular", "Malo"] as $opcion): ?>
        <?php $cantidad = $conteos[$opcion] ?? 0; ?>
        <tr>
            <td><?= $opcion ?></td>
            <td><?= $cantidad ?></td>
            <td><?= $total > 0 ? number_format(($cantidad / $total) * 100, 1) : "0" ?>%</td>
        </tr>
    <?php endforeach; ?>
</table>
<table>
    <tr><th>Nombre</th><th>Calificacion</th></tr>
    <?php foreach ($nombres as $i => $nombre): ?>
        <tr>
            <td><?= $nombre ?></td>
            <td><?= $respuestas[$i] ?? "" ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include "includes/footer.php"; ?>