<?php 
    $titulo = "Gastos por categoria";
    include "includes/header.php";
    
    //Se elije el archivo donde se guardan las respuetas
    $archivo = __DIR__ . "/data/calificaciones.json";
    //se llaman las respuestas que esten guardadas en los archivos json
    $alumnos = json_decode(file_get_contents($archivo), true) ? : [];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //se extraen los valores del formulario
        $nombre = $_POST["nombre"];
        $cal1 = $_POST["cal1"];
        $cal2 = $_POST["cal2"];
        $cal3 = $_POST["cal3"];
        $promedio = ($cal1 + $cal2 + $cal3) / 3;

        if ($nombre != ""){

            $alumnos[] = [
                "nombre" => $nombre,
                "cal1" => $cal1,
                "cal2" => $cal2,
                "cal3" => $cal3,
                "promedio" => $promedio,
                "estatus" => $promedio >= 70 ? "Aprobado" : "Reprobado"
            ];
            file_put_contents($archivo, json_encode($alumnos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }

    $promedioGrupo = 0;
    $aprobados = 0;

    if ($alumnos){
        foreach ($alumnos as $alumno) {
            $promedioGrupo += $alumno["promedio"];
            if ($alumno["estatus"] === "Aprobado") {
                $aprobados++;
            }
        }
        $promedioGrupo /= count($alumnos);
    }
?>
<form method="post">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>
    <label>Calificaion 1</label>
    <input type="number" name="cal1" min="0" required>
    <label>Calificaion 2</label>
    <input type="number" name="cal2" min="0" required>
    <label>Calificaion 3</label>
    <input type="number" name="cal3" min="0" required>
    <button type="submit">Guardar</button>
</form>
<table>
    <tr><th>Alumno</th><th>C1</th><th>C2</th><th>C3</th><th>Promedio</th><th>Estatus</th></tr>
    <?php foreach ($alumnos as $alumno): ?>
        <tr>
            <td><?= htmlspecialchars($alumno["nombre"]) ?></td>
            <td><?= $alumno["cal1"] ?></td>
            <td><?= $alumno["cal2"] ?></td>
            <td><?= $alumno["cal3"] ?></td>
            <td><?= number_format($alumno["promedio"], 2) ?></td>
            <td><?= $alumno["estatus"] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<div>
    <p>Promedio del grupo: <?= number_format($promedioGrupo, 2) ?></p>
    <p>Alumnos aprobados: <?= $aprobados ?></p>
</div>

<?php include "includes/footer.php"; ?>