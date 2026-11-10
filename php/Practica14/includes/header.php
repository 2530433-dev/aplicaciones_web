<?php
    if (!isset($titulo)) {
        $titulo = "Ejercicio de registro de alumnos";
    }
?>


<html>
    <head>
        <title><?=  htmlspecialchars($titulo) ?> ?></title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1><?= htmlspecialchars($titulo) ?></h1>