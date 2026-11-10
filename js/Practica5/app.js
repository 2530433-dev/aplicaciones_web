//Cada tarjeta conoce su titulo y la columna en que se encuentra 
let tarjetas = JSON.parse(localStorage.getItem("tableroKanban")) || [];

function guardar(){
    //Guarda las tres columnas y las distribuye para conservar su columna
    localStorage.setItem("tableroKanban", JSON.stringify(tarjetas));
}

function pintar() {
    //Limpia las tres columnas
    ["pendiente", "proceso", "terminado"].forEach((estado) =>
        document.querySelector(`#${estado}`).replaceChildren(),
    );

    tarjetas.forEach((tarjeta, indice) =>{
        let contenedor = document.querySelector(`#${tarjeta.estado}`);

        let elemento = document.createElement("article");
        elemento.className = "tarjeta";

        elemento.innerHTML = 
            "<span></span><br><button>Retroceder</button><button>Avanzar</button><button>Editar</button><button>Eliminar</button>";

        elemento.querySelector("span").textContent = tarjeta.titulo;

        elemento.querySelectorAll("button")[0].addEventListener("click", () => {
            //Retrocede a la columna anterior
            let estados = ["pendiente", "proceso", "terminado"];

            tarjeta.estado =
                estados[Math.max(estados.indexOf(tarjeta.estado) - 1, 0)];

            guardar();
            pintar();
        });

        elemento.querySelectorAll("button")[1].addEventListener("click", () => {
            //Avanza a la siguiente columna
            let estados = ["pendiente", "proceso", "terminado"];

            tarjeta.estado =
                estados[Math.min(estados.indexOf(tarjeta.estado) + 1, 2)];

            guardar();
            pintar();
        });

        elemento.querySelectorAll("button")[2].addEventListener("click", () => {
            //Edita el titulo de la tarjeta
            let nuevoTitulo = prompt("Escribe el nuevo titulo:", tarjeta.titulo);

            if (nuevoTitulo !== null && nuevoTitulo.trim() !== "") {
                tarjeta.titulo = nuevoTitulo.trim();
                guardar();
                pintar();
            }
        });

        elemento.querySelectorAll("button")[3].addEventListener("click", () => {
            //Elimina la tarjeta del tablero
            tarjetas.splice(indice, 1);

            guardar();
            pintar();
        });

        contenedor.append(elemento);
    });
}

document.querySelector("#formulario").addEventListener("submit", (evento) => {
    //Crea una tarjeta en la columna correspondiente
    evento.preventDefault();

    tarjetas.push({ ...Object.fromEntries(new FormData(evento.target)) });

    guardar();
    evento.target.reset();
    pintar();
});

pintar();