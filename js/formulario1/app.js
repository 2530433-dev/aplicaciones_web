const formulario = document.querySelector("#formularioAlumno");
const resultado = document.querySelector("#resultado");


formulario.addEventListener("submit", function(event){
    //Evitar que el formulario recargue la pagina
    event.preventDefault();

    //Obtener los valores desde el formulario generado en HTML
    const nombre = document.querySelector("#nombre").value;
    const matricula = document.querySelector("#matricula").value;
    const edad = Number(
        document.querySelector("#edad").value
    );
    
    let clasificacionEdad = "";
    //Evaluar edad
    if (edad>49){
        clasificacionEdad = "Es una persona de la tercera edad";
    } else if (edad>17){
        clasificacionEdad = "Es una persona mayor de edad";
    } else{
        clasificacionEdad = "Es una persona menor de edad";
    }

    //mostrar resultados
    resultado.innerHTML = `
        <p>
            <strong>Nombre: </strong>
            ${nombre}
        </p>
        <p>
            <strong>Matricula: </strong>
            ${matricula}
        </p>
        <p>
            <strong>Edad: </strong>
            ${edad}
        </p>
        <p>
            <strong>Calsificacion: </strong>
            ${clasificacionEdad}
        </p>
    `;

}
)
