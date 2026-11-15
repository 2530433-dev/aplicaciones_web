<?php
$titulo = "Alumnos CRUD";
$archivo = __DIR__ . "/data/registros.json";
include __DIR__ . "/includes/funciones.php";

//cargamos los registros existentes desde el JSON

$registros = leerJson($archivo);
$mensaje = "";

//SI EXISTE los registros sin id se les asigna uno para que
//Editar y eliminar funcionen de manera estable
// y haya filtros

$actualizado = false;
foreach ($registros as &$registro) {
    if (empty($registro["id"])) {
        $registro["id"] = uniqid("alu_", true);
        $actualizado = true;
    }
}
unset($registro);
if ($actualizado) {
    guardarJson($archivo, $registros);
}

//eliminar registros por su ID
if (isset($_GET['eliminar'])) {
    $idEliminar = limpiar($_GET['eliminar']);

    $registros = array_values(array_filter( //sirve para filtrar el array que vamos a eliminar
        $registros,
        function ($fila) use ($idEliminar) {
            return ($fila['id'] ?? '') !== $idEliminar;
        }
    ));

    guardarJson($archivo, $registros);
    header('Location: index.php?mensaje=eliminado');
    exit;
}





//Leer para edicion de reigstros que se van a editar
$registroEditar = null;
if (isset($_GET['editar'])) {
    $idEditar = limpiar($_GET['editar']);

    foreach ($registros as $fila) {
        if (($fila['id'] ?? '') === $idEditar) {
            $registroEditar = $fila;
            break;
        }
    }
}


//crear / actualizar el registro 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = limpiar($_POST['accion'] ?? 'crear');
    $id = limpiar($_POST['id'] ?? '');
    $nombre = limpiar($_POST['nombre'] ?? '');
    $categoria = limpiar($_POST['categoria'] ?? '');
    $valor = (float) ($_POST['valor'] ?? 0);

    if ($nombre !== '' && $categoria !== '' && $valor >= 0) {
        if ($accion === 'actualizar' && $id !== '') {
            // UPDATE: buscamos el id y reemplazamos sus valores.
            foreach ($registros as &$fila) {
                if (($fila['id'] ?? '') === $id) {
                    $fila['nombre'] = $nombre;
                    $fila['categoria'] = $categoria;
                    $fila['valor'] = $valor;
                    $fila['actualizado'] = date('Y-m-d H:i:s');
                    break;
                }
            }
            unset($fila);

            guardarJson($archivo, $registros);
            header('Location: index.php?mensaje=actualizado');
            exit;
        }

        // CREATE: agregamos un registro nuevo con id único.
        $registros[] = [
            'id' => uniqid('alu_', true),
            'nombre' => $nombre,
            'categoria' => $categoria,
            'valor' => $valor,
            'fecha' => date('Y-m-d H:i:s')
        ];
        guardarJson($archivo, $registros);
        header('Location: index.php?mensaje=guardado');
        exit;
    }
    $mensaje = 'Completa correctamente todos los campos.';
}


//Mensajes de confirmación
if (isset($_GET['mensaje'])) {
    $mensajes = [
        'guardado' => 'Alumno guardado correctamente.',
        'actualizado' => 'Alumno actualizado correctamente.',
        'eliminado' => 'Alumno eliminado correctamente.'
    ];

    $claveMensaje = limpiar($_GET['mensaje']);
    $mensaje = $mensajes[$claveMensaje] ?? '';
}
// Filtro por categoría
$filtro = limpiar($_GET['categoria'] ?? '');
$visibles = $registros;

if ($filtro !== '') {
    $visibles = array_values(array_filter(
        $registros,
        function ($fila) use ($filtro) {
            return strcasecmp($fila['categoria'] ?? '', $filtro) === 0;
        }
    ));
}

//Resumen de las capturas

$total = array_reduce(
    $registros,
    function ($acum, $fila) {
        return $acum + (float) ($fila['valor'] ?? 0);
    },
    0
);

include __DIR__ . '/includes/header.php';
?>

<p>
    Ejercicio CRUD completo: crear, listar, editar y eliminar alumnos
    con persistencia en JSON.
</p>

<?php if ($mensaje): ?>
    <div class="alert">
        <?= htmlspecialchars($mensaje) ?>
    </div>
<?php endif; ?>

<h2>
    <?= $registroEditar ? 'Editar alumno' : 'Registrar alumno' ?>
</h2>

<form method="post">
    <input type="hidden" name="accion" value="<?= $registroEditar ? 'actualizar' : 'crear' ?>">

    <input type="hidden" name="id" value="<?= htmlspecialchars($registroEditar['id'] ?? '') ?>">

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($registroEditar['nombre'] ?? '') ?>"
        required>

    <label for="categoria">Categoría</label>
    <input type="text" id="categoria" name="categoria"
        value="<?= htmlspecialchars($registroEditar['categoria'] ?? '') ?>" required>

    <label for="valor">Valor</label>
    <input type="number" id="valor" name="valor" step="0.01" min="0"
        value="<?= htmlspecialchars((string) ($registroEditar['valor'] ?? '')) ?>" required>

    <div class="actions">
        <button type="submit">
            <?= $registroEditar ? 'Actualizar alumno' : 'Guardar alumno' ?>
        </button>

        <?php if ($registroEditar): ?>
            <a class="button secondary" href="index.php">
                Cancelar edición
            </a>
        <?php endif; ?>
    </div>
</form>

<h2>Buscar / filtrar</h2>

<form method="get">
    <label for="filtro">Filtrar por categoría</label>
    <input type="text" id="filtro" name="categoria" value="<?= htmlspecialchars($filtro) ?>">

    <div class="actions">
        <button type="submit">Filtrar</button>
        <a class="button secondary" href="index.php">Limpiar filtro</a>
    </div>
</form>

<p>
    <strong>Total acumulado:</strong>
    <?= number_format($total, 2) ?>
</p>

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Valor</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($visibles as $fila): ?>
            <tr>
                <td><?= htmlspecialchars($fila['nombre'] ?? '') ?></td>
                <td><?= htmlspecialchars($fila['categoria'] ?? '') ?></td>
                <td><?= number_format((float) ($fila['valor'] ?? 0), 2) ?></td>
                <td>
                    <div class="actions">
                        <a class="button edit" href="?editar=<?= urlencode($fila['id'] ?? '') ?>">
                            Editar
                        </a>

                        <a class="button danger" href="?eliminar=<?= urlencode($fila['id'] ?? '') ?>"
                            onclick="return confirm('¿Seguro que deseas eliminar este alumno?')">
                            Eliminar
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '/includes/footer.php'; ?>