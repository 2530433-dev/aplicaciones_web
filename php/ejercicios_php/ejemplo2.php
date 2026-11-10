<?php

    //Ejercicio donde se calcule edad de una persona a partir de su anio de nacimiento asi mismo se controlan,valida y imprimen los valores de diversas variables

    declare(strict_types=1);

    //Funcion que convierte caracteres especiales para mostrar los datos como texto en html
    function h(mixed $value): string {

    //escapap caracteres para mostrar contenido de forma segura
        return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
    //inicializa una coleccion de de identificacion de indices numericos
    $perfil = ['nombre' => "Gael Alonso", "anio_nacimiento" => 2007, "correo" => 'galonso@upv.edu.mx', "telefono" => 8342703668, 'publico' => false];

    //tratamiento de los datos  y transformacion de las entradas usando diferentes filtros en php
    $correoValido = filter_var($perfil['correo'], FILTER_VALIDATE_EMAIL) !== false;
    $edadAprox = (int) date('Y') - $perfil['anio_nacimiento'];
    $telefono = $perfil['telefono'] ? $perfil['telefono'] : 'Reservado';
    $output = sprintf("Nombre %s\nEdad aproximada %d\nCorreo %s\nTelefono %s", $perfil['nombre'], $edadAprox, $correoValido ? "Si" : "No", $telefono);
?>

<html>
    <head>
        <title>Ejercicio de variables</title>
        <!-- Poner estilos a la salida del output desde PHP-->
         <style>
            body{
                max-width: 840px;
                margin: 40px;
                font: 16/1.55 system-ui;
                padding: 0 20px;
                color: #1c2b38;
            }
            table{
                border-collapse: collapse;
                width: 100%;
            }
            td, th{
                border: 1px solid #cad5de;
                padding: 8px;
            }
            pre{
                white-space: pre-wrap;
                background: #f4f6f8;
                padding: 16px;
            }
         </style>
    </head>
    <body>
        <h1>Ficha de perfiles con valiaciones</h1>
        <pre><?=  h($output) ?></pre>
    </body>
</html>