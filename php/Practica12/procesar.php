<?php
    $horas = $_POST['horas'];
    $pago = $_POST['pago'];
    $salario = $horas * $pago;

    /* calcular depues de 40 horas, se pague por hora extra 25% de cada una  y si supera los $500.00 que mande un mensaje indicando que ha
    alcanado el tope maximo de horas
    */

    $pagExtra = $pago * 1.25;
    $salarioExtra = 0;

    if ($horas > 40) {
        $mensaje = "Trabajo horas extras";
        $salarioExtra = ($horas - 40) * $pagExtra;

    } else {
        $mensaje = "Trabajo horario normal";
    }

    $salario += $salarioExtra;
    if ($salario > 500) {
        $mensaje = "<br>Ha alcanzado el tope maximo de horas";
    }

    echo '<div class="resultado"> Salario $'.$salario.'<br>'.$mensaje.'</div>';
?>