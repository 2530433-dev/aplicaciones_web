<?php
    $titulo = "Salario con aviso de horas extra";
    include "includes/header.php";
?>

<form method="post">
    <label >Horas trabajadas:</label>
    <input type="number" name="horas" min="0" required>
    <label >Pago por hora:</label>
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