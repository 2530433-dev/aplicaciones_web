const formulario = document.querySelector("#calificaciones");
const resultado = document.querySelector("#resultados");

formulario.addEventListener("submit", function(event){
    event.preventDefault();

    const nombre = document.querySelector("#nombre").value;
    const calif1 = Number(
        document.querySelector("#calif1").value
    );
    const calif2 = Number(
        document.querySelector("#calif2").value
    );
    const calif3 = Number(
        document.querySelector("#calif3").value
    );

    let promedio = (calif1 + calif2 + calif3) / 3;
    let status;

    if(promedio < 70){
        status = "Reprobado";
    } else {
        status = "Aprobado";
    }

    resultado.style.whiteSpace = "pre-line";

    resultado.textContent = `
        Nombre = ${nombre}
        Calificacion 1 : ${calif1}
        Calificacion 2 : ${calif2}
        Calificacion 3 : ${calif3}
        Promedio: ${promedio}
        Estatus del alumno : ${status}
    `;
});