<?php
    session_start();
    $titulo = "Captura de calificaciones";
    include "includes/header.php";

    if (!isset($_SESSION["calificaciones"])) {
        $_SESSION["calificaciones"] = [];
    }

    $mensaje = "";

    //Limpia los registros
    if (isset($_POST["reset"])) {
        $_SESSION["calificaciones"] = [];
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_POST["reset"])) {
        $nombre = trim($_POST["nombre"] ?? "");
        $matricula = trim($_POST["matricula"] ?? "");
        $calificacion = (float)($_POST["calificacion"] ?? 0);

        if ($nombre !== "" && $matricula !== "") {
            $estatus = ($calificacion >= 7) ? "Aprobado" : "Reprobado";

            $existe = false;

            //recorre el arreglo buscando si ya existe un alumno con la misma matricula para actualizarlo
            foreach ($_SESSION["calificaciones"] as $indice => $alumno) {
                if ($alumno["matricula"] === $matricula) {

                    $_SESSION["calificaciones"][$indice]["calificacion"] = $calificacion;
                    $_SESSION["calificaciones"][$indice]["estatus"] = $estatus;

                    $existe = true;
                    $mensaje = "El alumno ya existente, calificacion actualizada";
                    break;
                }
            }

            if (!$existe) {
                $_SESSION["calificaciones"][] = [
                    "nombre" => $nombre,
                    "matricula" => $matricula,
                    "calificacion" => $calificacion,
                    "estatus" => $estatus
                ];
                $mensaje = "Alumno registrado correctamente.";
            }
        }

    }   
?>
<div class="container">

    <form method="post" >
        <label >Nombre:</label>
        <input type="text" name="nombre" required>
        <label >Matricula:</label>
        <input type="text" name="matricula"required>
        <label>Calificacion:</label>
        <input type="number" name="calificacion" min="0" max="10" step="0.01" required>
        <div class="actions">
            <button type="submit" class="primary">Registrar Alumno</button>
            <button type="submit" name="reset" value="1" class="danger" formnovalidate>Borrar registros</button>
        </div>
    </form>
</div>

<?php if($_SESSION["calificaciones"]): ?>

    <h2><?= $mensaje ?></h2>
    <div class="table-wrap">

        <table>
            <tr><th>Nombre</th><th>Matricula</th><th>Calificacion</th><th>Estatus</th></tr>
            <?php foreach ($_SESSION["calificaciones"] as $registros): ?>
            <tr>
                <td><?= htmlspecialchars($registros["nombre"]) ?></td>
                <td><?= htmlspecialchars($registros["matricula"]) ?></td>
                <td><?= number_format($registros["calificacion"], 2) ?></td>
                <td><?= ($registros["estatus"]) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>



<?php
    include "includes/footer.php";
?>