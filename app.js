// Arreglo de prácticas del proyecto
const practicas = [
    // Prácticas JavaScript
    { num: 3, tipo: 'js', ruta: 'js/Practica3/index.html' },
    { num: 4, tipo: 'js', ruta: 'js/Practica4/index.html' },
    { num: 5, tipo: 'js', ruta: 'js/Practica5/index.html' },
    { num: 6, tipo: 'js', ruta: 'js/Practica6/index.html' },
    { num: 7, tipo: 'js', ruta: 'js/Practica7/index.html' },
    { num: 8, tipo: 'js', ruta: 'js/Practica8/index.html' },
    { num: 9, tipo: 'js', ruta: 'js/Practica9/index.html' },
    { num: 10, tipo: 'js', ruta: 'js/Practica10/index.html' },
    
    // Prácticas PHP
    { num: 12, tipo: 'php', ruta: 'php/Practica12/index.php' },
    { num: 13, tipo: 'php', ruta: 'php/Practica13/index.php' },
    { num: 14, tipo: 'php', ruta: 'php/Practica14/index.php' },
    { num: 15, tipo: 'php', ruta: 'php/Practica15/index.php' },
    { num: 16, tipo: 'php', ruta: 'php/Practica16/index.php' },
    { num: 17, tipo: 'php', ruta: 'php/Practica17/index.php' }
];

document.addEventListener('DOMContentLoaded', () => {
    const gridJs = document.getElementById('grid-js');
    const gridPhp = document.getElementById('grid-php');

    practicas.forEach(p => {
        const isJs = p.tipo === 'js';
        const cardHTML = `
            <a href="${p.ruta}" class="card">
                <div class="card-header">
                    <span class="card-title">Práctica ${p.num}</span>
                </div>
            </a>
        `;

        if (isJs) {
            gridJs.innerHTML += cardHTML;
        } else {
            gridPhp.innerHTML += cardHTML;
        }
    });
});