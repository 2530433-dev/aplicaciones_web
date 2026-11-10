const formulario = document.querySelector("#formulario");
const cheque = document.querySelector("#cheque");

formulario.addEventListener("submit", function (event) {
    event.preventDefault();

    const nombre = document.querySelector("#nombre").value;
    const anterior = Number(
        document.querySelector("#anterior").value
);
    const actual = Number(
        document.querySelector("#actual").value
    );

    if (actual < anterior) {
        alert("La lectura actual no puede ser menor que la anterior");
        return;
    }

    const consumo = actual - anterior;

    const pago1 = Math.min(consumo, 100);

    const pago2 = Math.min(Math.max(consumo - 100, 0), 150);

    const pago3 = Math.max(consumo - 250, 0);

    const costo1 = pago1 * 1.20;
    const costo2 = pago2 * 1.50;
    const costo3 = pago3 * 1.80;

    const total = costo1 + costo2 + costo3;

    cheque.style.whiteSpace = "pre-line";
    cheque.textContent = `
        Cliente: ${nombre}
        Consumo total: ${consumo} kWh
        Hasta 100 kWh: ${costo1}
        De 101 a 250 kWh: ${costo2}
        Mas de 250 kWh: ${costo3}
        Total a pagar: $${total}
    `;
});