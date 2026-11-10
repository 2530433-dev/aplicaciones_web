<?php
    $calificacion = $_POST['calificacion'];
    $pago = $_POST['pago'];
    $beca = 0;

    if ($calificacion >= 95) {
        $beca = 1;
    } else if($calificacion >= 90) {
        $beca = 0.5;
    } else if($calificacion >= 85) {
        $beca = 0.25;
    } 

    $pagoFinal = $pago - ($pago * $beca);

    if ($calificacion >= 95) {
        $beca = 100;
    } else if($calificacion >= 90) {
        $beca = 50;
    } else if($calificacion >= 85) {
        $beca = 25;
    } 


    echo '<div class="resultado"> Beca = %'.$beca.'<br>'. 'Pago final = $'.$pagoFinal.'</div>';
?>