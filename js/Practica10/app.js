const $form = vista_nuevaAct.querySelector("#formularioEncuesta");
    const $lblNombre = vista_nuevaAct.querySelector("#mostrarNombre");
    const $lblGrupo = vista_nuevaAct.querySelector("#mostrarGrupo");
    const $lblTema = vista_nuevaAct.querySelector("#mostrarTema");
    const $lblCalificacion = vista_nuevaAct.querySelector("#mostrarCalificacion");
    const $lblComentarios = vista_nuevaAct.querySelector("#mostrarComentarios");

    // Estado local y lectura de LocalStorage
    let registroEncuesta = {};
    try {
        const datosAlmacenados = localStorage.getItem('encuestaGuardada');
        if (datosAlmacenados) {
            registroEncuesta = JSON.parse(datosAlmacenados);
        }
    } catch (e) {
        registroEncuesta = {};
    }

    // Persistencia en LocalStorage
    const guardarEnStorage = () => {
        localStorage.setItem('encuestaGuardada', JSON.stringify(registroEncuesta));
    };

    // Renderizado en pantalla
    const actualizarVista = () => {
        if (registroEncuesta.nombre) {
            $lblNombre.textContent = `Nombre: ${registroEncuesta.nombre}`;
            $lblGrupo.textContent = `Grupo: ${registroEncuesta.grupo}`;
            $lblTema.textContent = `Tema favorito: ${registroEncuesta.tema}`;
            $lblCalificacion.textContent = `Calificación: ${registroEncuesta.calificacion}`;
            $lblComentarios.textContent = `Comentarios: ${registroEncuesta.comentarios}`;
        }
    };

    // Evento de envío del formulario
    $form.addEventListener("submit", (e) => {
        e.preventDefault();

        const valNombre = $form.querySelector("#nombre").value.trim();
        const valGrupo = $form.querySelector("#grupo").value.trim();
        const valTema = $form.querySelector("#tema").value;
        const opcionCalificacion = $form.querySelector('input[name="calificacion"]:checked');
        const valComentarios = $form.querySelector("#comentarios").value.trim();

        registroEncuesta = {
            nombre: valNombre,
            grupo: valGrupo,
            tema: valTema,
            calificacion: opcionCalificacion ? opcionCalificacion.value : '',
            comentarios: valComentarios
        };

        guardarEnStorage();
        actualizarVista();
    });