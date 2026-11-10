<?php
    if (!isset($titulo)) {
        $titulo = "Captura de calificaciones";
    }
?>


<html>
    <head>
        <title><?=  htmlspecialchars($titulo) ?> ?></title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1><?= htmlspecialchars($titulo) ?></h1>