const nombre = document.querySelector("#nombre");
const tema = document.querySelector("#tema");
const tamano = document.querySelector("#tamano");
const mensaje = document.querySelector("#mensaje");

const btnGuardar = document.querySelector("#btnGuardar");
const btnEliminar = document.querySelector("#btnEliminar");

function aplicarPreferencias(preferencias) {
    document.body.style.backgroundColor =
        preferencias.tema === "oscuro" ? "#222" : "#fff";

    document.body.style.color =
        preferencias.tema === "oscuro" ? "#fff" : "#000";

    if (preferencias.tamano === "pequeno") {
        document.body.style.fontSize = "14px";
    } else if (preferencias.tamano === "mediano") {
        document.body.style.fontSize = "18px";
    } else {
        document.body.style.fontSize = "24px";
    }
}

function guardarPreferencias(e) {
    e.preventDefault(); // Evita que la página se recargue al enviar el formulario

    const preferencias = {
        nombre: nombre.value.trim(),
        tema: tema.value,
        tamano: tamano.value
    };

    localStorage.setItem(
        "preferenciasUsuario",
        JSON.stringify(preferencias)
    );

    aplicarPreferencias(preferencias);
    mensaje.textContent = "Preferencias guardadas correctamente.";
}

function cargarPreferencias() {
    const guardado = localStorage.getItem("preferenciasUsuario");

    if (!guardado) {
        return;
    }

    const preferencias = JSON.parse(guardado);

    nombre.value = preferencias.nombre || "";
    tema.value = preferencias.tema || "claro";
    tamano.value = preferencias.tamano || "mediano";

    aplicarPreferencias(preferencias);

    if (preferencias.nombre) {
        mensaje.textContent = `Bienvenido, ${preferencias.nombre}`;
    }
}

function eliminarPreferencias() {
    localStorage.removeItem("preferenciasUsuario");

    nombre.value = "";
    tema.value = "claro";
    tamano.value = "mediano";

    aplicarPreferencias({
        tema: "claro",
        tamano: "mediano"
    });

    mensaje.textContent = "Preferencias eliminadas.";
}

btnGuardar.addEventListener("click", guardarPreferencias);
btnEliminar.addEventListener("click", eliminarPreferencias);

cargarPreferencias();