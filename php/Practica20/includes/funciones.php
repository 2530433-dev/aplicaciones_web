<?php
function leerJson(string $archivo):array{
    if(!file_exists($archivo)){
        return [];
    }
    $contenido = file_get_contents($archivo);
    if($contenido === false || trim($contenido) === ''){
        return [];
    }
    $datos =json_decode($contenido, true);
    return is_array($datos) ? $datos : [];
}

function guardarJson( string $archivo , array $datos): void{
    file_put_contents($archivo ,json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}
function limpiar(string $valor):string{
    return trim($valor);
}


?>
