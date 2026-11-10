<?php
    session_start();
    $titulo = "Sistema de registro de alumnos";
    include "includes/header.php";

    if (!isset($_SESSION["alumnos"])) {
        $_SESSION["alumnos"] = [];
    }

    //Limpia unicamente la variable de sesion utilizada
    if (isset($_POST["reiniciar"])) {
        unset($_SESSION["alumnos"]);
        $_SESSION["alumnos"] = [];
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_POST["reiniciar"])) {
        $nombre = trim($_POST["nombre"] ?? "");
        $matricula = trim($_POST["matricula"] ?? "");
        $edad = (int)($_POST["edad"] ?? 0);
        $promedio = (float)($_POST["promedio"] ?? 0);

        if ($nombre !== "" && $matricula !== ""){
            $_SESSION["alumnos"][] = [
                "nombre" => $nombre,
                "matricula" => $matricula,
                "edad" => $edad,
                "promedio" => $promedio,
                "clasificacion" => $edad > 49 ? "Tercera edad" : ($edad >= 18 ? "Mayor de edad" : "Menor de edad"),
                "estatus" => $promedio >= 70 ? "Aprobado" : "No aprobado"
            ];
        }

    }   
?>

<form method="post">
    <label >Nombre:</label>
    <input type="text" name="nombre" required>
    <label >Matricula:</label>
    <input type="text" name="matricula"required>
    <label>Edad:</label>
    <input type="number" name="edad" min="1" required>
    <label>Promedio:</label>
    <input type="number" name="promedio" min="0" max="100" step="0.01" required>
    <button type="submit">Registrar alumno</button>
    <button type="reset">Limpiar</button>
</form>

<?php if($_SESSION["alumnos"]): ?>
    <table>
        <tr><th>Nombre</th><th>Matricula</th><th>Edad</th><th>Promedio</th><th>Clasificación</th><th>Estatus</th></tr>
        <?php foreach ($_SESSION["alumnos"] as $alumno): ?>
            <tr>
                <td><?= htmlspecialchars($alumno["nombre"]) ?></td>
                <td><?= htmlspecialchars($alumno["matricula"]) ?></td>
                <td><?= ($alumno["edad"]) ?></td>
                <td><?= ($alumno["clasificacion"]) ?></td>
                <td><?= number_format($alumno["promedio"], 2) ?></td>
                <td><?= ($alumno["estatus"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>



<?php
    include "includes/footer.php";
?>