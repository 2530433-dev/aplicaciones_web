<?php 
    if (!isset($titulo)) {
        $titulo = "Gastos por categoria";
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