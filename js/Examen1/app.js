const formulario = document.querySelector("#formulario");
const resultado = document.querySelector("#resultado");

formulario.addEventListener("submit", function(event) {
    event.preventDefault();

    // Obtener valores de texto
    const nombre = document.querySelector("#nombre").value.trim();
    const correo = document.querySelector("#correo").value.trim();
    const telefono = document.querySelector("#telefono").value.trim();

    // Obtener la opción seleccionada de cada grupo
    const cursoSeleccionado = document.querySelector('input[name="curso"]:checked');
    const modalidadSeleccionada = document.querySelector('input[name="modalidad"]:checked');
    const credencialSeleccionada = document.querySelector('input[name="credencial"]:checked');

    if (!cursoSeleccionado || !modalidadSeleccionada || !credencialSeleccionada) {
        alert("Por favor seleccione todas las opciones del formulario.");
        return;
    }

    // Precio según el curso seleccionado
    const precioCurso = Number(cursoSeleccionado.value);

    // Aplicar descuento por credencial (10%)
    let descuento = 0;
    if (credencialSeleccionada.value === "si") {
        descuento = precioCurso * 0.10;
    }

    // Aplicar recargo por modalidad presencial
    let recargo = 0;
    if (modalidadSeleccionada.value === "presencial") {
        recargo = 300;
    }

    // Cuota fija de inscripción
    const cuota = 200;

    // Cálculo total
    const total = precioCurso - descuento + recargo + cuota;

    // Renderizar resultados en pantalla
    resultado.innerHTML = `
        <p><strong>Comprobante de Inscripción</strong></p>
        <p><strong>Nombre:</strong> ${nombre}</p>
        <p><strong>Correo:</strong> ${correo}</p>
        <p><strong>Teléfono:</strong> ${telefono}</p>
        <hr>
        <p><strong>Precio del curso:</strong> $${precioCurso.toFixed(2)} MXN</p>
        <p><strong>Descuento (Credencial):</strong> -$${descuento.toFixed(2)} MXN</p>
        <p><strong>Recargo (Modalidad):</strong> +$${recargo.toFixed(2)} MXN</p>
        <p><strong>Cuota fija:</strong> +$${cuota.toFixed(2)} MXN</p>
        <h3>Total a pagar: $${total.toFixed(2)} MXN</h3>
    `;
});