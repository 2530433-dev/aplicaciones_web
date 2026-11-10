<?php 
    if (!isset($titulo)) {
        $titulo = "Ejercicio ed cuenta de resultados";
    }
?>
<html>
    <head>
        <title><?= htmlspecialchars($titulo) ?></title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="container">
            <h1><?= htmlspecialchars($titulo) ?></h1>