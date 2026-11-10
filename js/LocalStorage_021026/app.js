// Cada nota es un objeto con titulo, contenido y fecha en milisegundos
// Se recupera el arreglo al cargar el script o se comienza con una lista vacia
let notas = [];

try {
    let datosGuardados = localStorage.getItem("notasRapidas");

    if (datosGuardados) {
        notas = JSON.parse(datosGuardados);
    }

} catch (error) {
    console.log("Los datos guardados estaban dañados.");
    localStorage.removeItem("notasRapidas");
    notas = [];
}

// Referencias al formulario y al listado de notas
let contenedor = document.querySelector("#notas");
let formulario = document.querySelector("#formulario");
let campoTitulo = formulario.elements.titulo;
let campoContenido = formulario.elements.contenido;
let botonGuardar = document.querySelector("#guardarNota");
let botonCancelar = document.querySelector("#cancelarEdicion");
let estado = document.querySelector("#estado");

// Mantiene la referencia a la nota activa en edicion
let notaEdicion = null;

function guardar() {
    // Convierte el arreglo completo a JSON y lo guarda
    localStorage.setItem("notasRapidas", JSON.stringify(notas));
}

function pintar() {
    // Vacia la vista
    contenedor.replaceChildren();

    // Ordena las notas de la mas reciente a la mas antigua
    [...notas]
        .sort((a, b) => b.fecha - a.fecha)
        .forEach(nota => {

            let tarjeta = document.createElement("article");
            let titulo = document.createElement("h2");
            let contenido = document.createElement("p");
            let fecha = document.createElement("small");
            let editar = document.createElement("button");
            let borrar = document.createElement("button");

            tarjeta.className = "nota";

            titulo.textContent = nota.titulo;
            contenido.textContent = nota.contenido;

            // Convierte la fecha numerica en una fecha legible
            fecha.textContent = new Date(nota.fecha).toLocaleString("es-MX");

            editar.type = "button";
            editar.className = "editar";
            editar.textContent = "Editar";

            editar.addEventListener("click", () => {

                notaEdicion = nota;

                campoTitulo.value = nota.titulo;
                campoContenido.value = nota.contenido;

                botonGuardar.textContent = "Guardar cambios";
                botonCancelar.hidden = false;

                campoTitulo.focus();
            });

            borrar.type = "button";
            borrar.textContent = "Eliminar";

            borrar.addEventListener("click", () => {

                notas.splice(notas.indexOf(nota), 1);

                if (notaEdicion === nota) {
                    cancelarEdicion();
                }

                guardar();
                pintar();
            });

            tarjeta.append(
                titulo,
                contenido,
                fecha,
                editar,
                borrar
            );

            contenedor.append(tarjeta);
        });
}

function cancelarEdicion() {

    notaEdicion = null;

    formulario.reset();

    botonGuardar.textContent = "Guardar nota";
    botonCancelar.hidden = true;
}

formulario.addEventListener("submit", (event) => {

    event.preventDefault();

    // Se obtienen los valores escritos
    let titulo = campoTitulo.value.trim();
    let contenido = campoContenido.value.trim();

    // Se rechazan los valores vacios
    if (!titulo || !contenido) {
        return;
    }

    if (notaEdicion) {

        // Actualiza la nota existente
        notaEdicion.titulo = titulo;
        notaEdicion.contenido = contenido;
        notaEdicion.fecha = Date.now();

        cancelarEdicion();

        estado.textContent = "Nota actualizada";

    } else {

        // Agrega una nota nueva
        notas.push({
            titulo: titulo,
            contenido: contenido,
            fecha: Date.now()
        });

        formulario.reset();

        estado.textContent = "Nota guardada";
    }

    guardar();
    pintar();
});

botonCancelar.addEventListener("click", cancelarEdicion);

pintar();
