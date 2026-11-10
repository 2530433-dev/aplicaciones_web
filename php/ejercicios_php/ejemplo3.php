<?php
declare(strict_types=1);
/*
Calculadora basica con operaciones suma, resta, division, multipicacion y  procentaje
*/

//funcion que convierte caracteres especiales para mostrar datos como texto en html
function h(mixed $value): string {
    //escapap caracteres para mostrar contenido de forma segura
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

//Tratamiento de operaciones matematicas
$historial =[];
function operar(float $a, float $b, string $op): float {
    return match($op){
        '+' => $a + $b,
        '-' => $a - $b,
        '*' => $a * $b,
        '/' => $b !== 0.0 ? throw new InvalidArgumentException('No dividir entre 0') : $a / $b,
        '%' => $a * $b / 100,
        default => throw new InvalidArgumentException('Operacion desconocida'),
    };
    //Identificar las operaciones con valores estabecidos
    $operaciones = [[100,16, '%'], [7,3, '*'], [8, 0, '/']]; 

    //Recorrido de los elementos del array
    foreach($operaciones as [$a, $b, $op]){
        try{
            $resultado = operar($a, $b, $op);
        }catch(Throwable $e){
            $historial[] = "Error: ".$e->getMessage();

        }
    }
}
$output = implode("\n", $historial);


?>