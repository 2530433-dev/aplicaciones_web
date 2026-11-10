<!-- Declaracion de variables ei insersion de codigo e html-->



<?php
    //Declaracion de variables
    $nombre = "Gael";
    $precio = 250;
    $descuento = .10;
    $total = $precio * (1 - $descuento);
    //trabajaremos con un array para imprimir diferentes valores con descuento

    $tabla =[];
    for ($i=1; $i <= 10; $i++) { 
        //llenado del array
        $tabla[]= "5 x $i = " . (5 * $i);
        
    }
?>

<!-- Trabajaremos con el php en el html-->
 <html>
    <h1>Hola <?= ($nombre) ?></h1>
    <p> Total: <?=number_format($total, 2) ?> </p>

    <!-- Se imprime a traves de un ciclo losvalores de la tabla de multiplicar-->
    <ul>
        <?php foreach ($tabla as $linea): ?>
            <li><?= $linea ?></li>
        <?php endforeach; ?>
    </ul>
 </html>