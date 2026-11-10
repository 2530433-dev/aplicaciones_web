//La agenda alamcena contactos completos y evita correos duplicados
let contactos = JSON.parse(localStorage.getItem('agendaContactos')) || [];
let formulario = document.querySelector('#formulario');
function guardar(){
    //Persiste la coleccion completa de contactos en el local storage
    localStorage.setItem('agendaContactos', JSON.stringify(contactos));
}
function pintar(){
    //Filtra por la busqueda y reconstruye los resultados visibles
    let consulta = document.querySelector('#buscar').value.toLowerCase();
    let lista = document.querySelector('#lista');
    lista.replaceChildren();
    contactos.filter((contacto) =>
        JSON.stringify(contacto).toLowerCase().includes(consulta),
    ).forEach((contacto, indice) => {
        let elemento = document.createElement('article');
        elemento.className = 'contacto';
        elemento.innerHTML = `<span><b></b><small></small><span><button>Eliminar</button>`;
        elemento.querySelector('b').textContent = 
            `${contacto.nombre} . ${contacto.categoria}`;
        elemento.querySelector('small').textContent =
            `${contacto.telefono} . ${contacto.correo}`;
        elemento.querySelector('button').addEventListener('click', () =>{
            contactos.splice(indice, 1);
            guardar();
            pintar();
        });
        lista.appendChild(elemento);
    });
}
formulario.addEventListener('submit', (event) => {
    //Agrega un contacto solamente si el correo no exite
    event.preventDefault();
    let contacto = Object.fromEntries(new FormData(formulario));
    if(contactos.some(item => item.correo === contacto.correo)) return;
    contactos.push(contacto);
    guardar();
    formulario.reset();
    pintar();
});
document.querySelector("#buscar").addEventListener("input", pintar);
pintar();