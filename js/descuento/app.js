const subtotal = 1500;
let descuento;
if(subtotal < 1000){
    descuento = 0;
} else {
    descuento = subtotal * 0.1;
}
let total = subtotal - descuento;
console.log("El monto total es: ", total)