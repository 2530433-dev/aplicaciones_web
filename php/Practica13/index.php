<?php
    $titulo = "Beca basada en calificacion";
    include "includes/header.php";
?>

<form method="post">
    <label >Ingrese la calificacion del alumno:</label>
    <input type="number" name="calificacion" min="0" required>
    <label >Ingrese el monto de la colegiatura:</label>
    <input type="number" name="pago" min="0" step="0.01" required>
    <button type="submit">Calcular</button>
</form>

<?php if ($_POST) {
    include "procesar.php";
}
?>

<?php
    include "includes/footer.php";
?>