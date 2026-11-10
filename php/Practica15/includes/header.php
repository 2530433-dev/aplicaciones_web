<?php
    if (!isset($titulo)) {
        $titulo = "Cotizador de productos";
    }
?>


<html>
    <head>
        <title><?=  htmlspecialchars($titulo) ?> ?></title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="container">
            <h1><?= htmlspecialchars($titulo) ?></h1>