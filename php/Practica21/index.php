<?php 
    $titulo = "Calificaciones por unidad";
    include "includes/header.php";
    
    //Se elije el archivo donde se guardan las respuetas
    $archivo = __DIR__ . "/data/unidades.json";
    //se llaman las respuestas que esten guardadas en los archivos json
    $registros = json_decode(file_get_contents($archivo), true) ? : [];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //se extraen los valores del formulario
        $nombre = $_POST["nombre"];
        $matricula = $_POST["matricula"];
        $u1 = $_POST["u1"];
        $u2 = $_POST["u2"];
        $u3 = $_POST["u3"];

        if ($u1 < 70) {
            $u1 = 60;
        }
        if ($u2 < 70) {
            $u2 = 60;
        }
        if ($u3 < 70) {
            $u3 = 60;
        }

        if ($u1 === 60 || $u2 === 60 || $u3 === 60) {
            $promedio = 60;
        } else {
            $promedio = ($u1 + $u2 + $u3) / 3;
        }

        if ($nombre != ""){

            $registros[] = [
                "nombre" => $nombre,
                "matricula" => $matricula,
                "u1" => $u1,
                "u2" => $u2,
                "u3" => $u3,
                "promedio" => $promedio,
            ];
            file_put_contents($archivo, json_encode($registros, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }

    
?>







<form method="post">

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="matricula">Matricula:</label>
    <input type="text" id="matricula" name="matricula" required>

    <label for="u1">Unidad 1:</label>
    <input type="number" id="u1" name="u1" step="0.01" min="0" required>

    <label for="u2">Unidad 2:</label>
    <input type="number" id="u2" name="u2" step="0.01" min="0" required>

    <label for="u3">Unidad 3:</label>
    <input type="number" id="u3" name="u3" step="0.01" min="0" required>

    <button type="submit">Guardar</button>

</form>



<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Matricula</th>
            <th>Unidad 1</th>
            <th>Unidad 2</th>
            <th>Unidad 3</th>
            <th>Promedio</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($registros as $fila): ?>
            <tr>
                <td><?= htmlspecialchars($fila['nombre'] ?? '') ?></td>
                <td><?= htmlspecialchars($fila['matricula'] ?? '') ?></td>
                <td><?= number_format((float) ($fila['u1'] ?? 0), 2) ?></td>
                <td><?= number_format((float) ($fila['u2'] ?? 0), 2) ?></td>
                <td><?= number_format((float) ($fila['u3'] ?? 0), 2) ?></td>
                <td><?= number_format((float) ($fila['promedio'] ?? 0), 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '/includes/footer.php'; ?>