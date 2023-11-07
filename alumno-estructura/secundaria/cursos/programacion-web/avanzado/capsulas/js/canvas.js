
const ALTURA_CANVAS = 165,
ANCHURA_CANVAS = 330;

// Obtener el elemento del DOM
const canvas = document.querySelector("#canvas");
canvas.width = ANCHURA_CANVAS;
canvas.height = ALTURA_CANVAS;

// Del canvas, obtener el contexto para poder dibujar
const contexto = canvas.getContext("2d");
// Comenzar
contexto.beginPath();
// Grosor de línea
contexto.lineWidth = 3;
// Color de línea 
contexto.strokeStyle = "blue";
// Comenzamos en 0, 0
contexto.moveTo(0, 20);
// Hacemos una línea hasta 48, 48
contexto.lineTo(430, 175);
contexto.stroke(); // "Guardar" cambios


// Otra línea
contexto.beginPath();
contexto.strokeStyle = "red";
contexto.moveTo(100, 0);
contexto.lineTo(52, 48);
contexto.stroke();


// Otra línea
contexto.beginPath();
contexto.strokeStyle = "yellow";
contexto.moveTo(0, 100);
contexto.lineTo(48, 52);
contexto.stroke();


// Otra línea
contexto.beginPath();
contexto.strokeStyle = "green";
contexto.moveTo(100, 100);
contexto.lineTo(52, 52);
contexto.stroke();