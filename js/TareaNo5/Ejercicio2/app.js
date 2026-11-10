const formulario = document.querySelector("#compra");
const total = document.querySelector("#total");

formulario.addEventListener("submit", function(event){
    event.preventDefault();

    const nombre = document.querySelector("#nombre").value;
    const monto = Number(
        document.querySelector("#monto").value
    );

    let descuento = 0;

    if(monto >= 2000){
        descuento = monto * 0.15;
    } else if (monto >= 1000){
        descuento = monto * 0.1;
    }

    let final = monto - descuento;

    total.style.whiteSpace = "pre-line";

    total.textContent = `
        Nombre del cliente: ${nombre}
        Subtotal: ${monto}
        Descuento: ${descuento}
        Total: ${final}
    `;
});