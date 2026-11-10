let formulario = document.querySelector("#formulario");
let clave = "borradorRegistro";
let estado = document.querySelector("#estado");
function guardar(){
    //Guarda los valores del formulario en Local Storage
    localStorage.setItem(
        clave,
        JSON.stringify(Object.fromEntries(new FormData(formulario)))
    );
    estado.textContent = "Registro guardado";
}
function cargar(){
    let datos = JSON.parse(localStorage.getItem(clave) || "{}");
    Object.entries(datos).forEach(([campo, valor]) => {
        if(formulario.elements[campo]) formulario.elements[campo].value = valor;
    });

}
formulario.addEventListener("submit", (evento)=>{
    evento.preventDefault();
    if(!formulario.checkValidity()){
        formulario.repprtValidity();
        return;
    }
    guardar();
    estado.textContent = "Registro confirmado";
});
document.querySelector("#borrar").addEventListener("click", ()=>{
    localStorage.removeItem(clave);
    formulario.reset();
    estado.textContent = "Registro borado"
});
cargar();