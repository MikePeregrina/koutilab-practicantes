//Apartado de canvas para trazar lineas

//variables para la medida del canvas
const ALTURA_CANVAS = 290,
    ANCHURA_CANVAS = 535;

// Obtener el elemento del DOM
const canvas = document.querySelector("#canvas");
canvas.width = ANCHURA_CANVAS;
canvas.height = ALTURA_CANVAS;

// Del canvas, obtener el contexto para poder dibujar
const contexto = canvas.getContext("2d");




// Apartado para seleccinador para relacionar columas
const palabras = document.querySelectorAll('.word-box');

//variables a utilizar y contadores
let palabraseleccionada = null;
let respuestasCorrectas = 0;
let respuestasIncorrectas = 0;

// Agregar eventos de clic a las palabras
palabras.forEach(word => {
    word.addEventListener('click', selectWord);
});

// Función para seleccionar una palabra
function selectWord() {
    if (palabraseleccionada) {
        // Si ya hay una palabra seleccionada, la deseleccionamos
        palabraseleccionada.classList.remove('seleccionado');
    }
    palabraseleccionada = this;
    if (
        palabraseleccionada.id !== 'interactividad' &&
        palabraseleccionada.id !== 'private' &&
        palabraseleccionada.id !== 'Public' &&
        palabraseleccionada.id !== 'Elemento' &&
        palabraseleccionada.id !== 'EventSystem'
    ) {
        palabraseleccionada.classList.add('seleccionado');
    } else {
        palabraseleccionada = null;
    }
}

// Función para verificar la respuesta
function checkAnswer(respuesta) {
    const idPalabraSeleccionada = palabraseleccionada.id;
    const estadopalabra = document.getElementById(respuesta);

    //validamos que ya haya seleccionado una palabra
    if (palabraseleccionada) {
        //aqui para cada relacion la validamos en caso de ser correcta se trazara la linea
        if (respuesta === 'estilos' && idPalabraSeleccionada === 'css') {
            palabraseleccionada.classList.add('correcto');
            // Comenzar
            contexto.beginPath();
            // Grosor de línea
            contexto.lineWidth = 3;
            // Color de línea 
            contexto.strokeStyle = "#84c42c";
            // Comenzamos en 0, 0
            contexto.moveTo(0, 30);
            // Hacemos una línea hasta 48, 48
            contexto.lineTo(560, 210);
            contexto.stroke(); // "Guardar" cambios
            //sumamos al contador
            respuestasCorrectas++;
        } else if (respuesta === 'estructura' && idPalabraSeleccionada === 'html') {
            palabraseleccionada.classList.add('correcto');
            contexto.beginPath();
            contexto.lineWidth = 3;
            contexto.strokeStyle = "#84c42c";
            contexto.moveTo(0, 145);
            contexto.lineTo(560, 145);
            contexto.stroke();
            respuestasCorrectas++;
        }
        else if (
            respuesta === 'interactividad' && idPalabraSeleccionada === 'javascript'
        ) {
            palabraseleccionada.classList.add('correcto');
            contexto.beginPath();
            contexto.lineWidth = 3;
            contexto.strokeStyle = "#84c42c";
            contexto.moveTo(0, 205);
            contexto.lineTo(560, 20);
            contexto.stroke();
            respuestasCorrectas++;
        } else if (
            respuesta === 'funcionalidad' && idPalabraSeleccionada === 'php'
        ) {
            palabraseleccionada.classList.add('correcto');
            contexto.beginPath();
            contexto.lineWidth = 3;
            contexto.strokeStyle = "#84c42c";
            contexto.moveTo(0, 260);
            contexto.lineTo(560, 75);
            contexto.stroke();
            respuestasCorrectas++;


        } else if (
            respuesta === 'administrar' && idPalabraSeleccionada === 'sql'
        ) {
            palabraseleccionada.classList.add('correcto');
            contexto.beginPath();
            contexto.lineWidth = 3;
            contexto.strokeStyle = "#84c42c";
            contexto.moveTo(0, 95);
            contexto.lineTo(560, 270);
            contexto.stroke();
            respuestasCorrectas++;
        } else {
            palabraseleccionada.classList.add('incorrecto');
            respuestasIncorrectas++;
        }

        //una vez seleccionada la desabilitamos
        palabraseleccionada.classList.remove('seleccionado');
        palabraseleccionada.classList.add('deshabilitado');
        palabraseleccionada.removeEventListener('click', selectWord);
        //limpiamos la palabra seleccionada
        palabraseleccionada = null;
        estadopalabra.classList.add('deshabilitado');
        estadopalabra.removeEventListener('click', selectWord);
    }
}




// Agregar evento de clic al botón de comprobar respuestas
const botonComprobar = document.querySelector('.verificar');
botonComprobar.addEventListener('click', mostrarResultados);

// Función para mostrar los resultados
function mostrarResultados() {
    let todasSeleccionadas = true;

    // Verificar si todas las opciones han sido seleccionadas
    palabras.forEach(word => { //se recorre cada opción utilizando el método forEach en la lista palabras
        if (!word.classList.contains('deshabilitado')) { // verifica si no tiene la clase deshabilitado
            todasSeleccionadas = false;
        }
    });
    //validamos que ya se hizo intento de resolver todo el juego
    if (todasSeleccionadas) {
        if (respuestasCorrectas < 3) {
            Swal.fire({
                //estrucutra de la alerta
                title: '!Puedes seguir mejorado!',
                html: `Respuestas correctas: ${respuestasCorrectas}<br>Respuestas incorrectas: ${respuestasIncorrectas}`,
                imageUrl: '../../img/img-juegos/loop.gif',
                imageHeight: 350,
                backdrop: `
                    rgba(0,143,255,0.6)
                    url("../../img/img-juegos/fondo.gif")`,
                confirmButtonColor: '#a14cd9',
                confirmButtonText: '¡Genial!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        } else {
            //llamamos a la alerta
            Swal.fire({
                //estrucutra de la alerta
                title: 'Resultados',
                html: `Respuestas correctas: ${respuestasCorrectas}<br>Respuestas incorrectas: ${respuestasIncorrectas}`,
                imageUrl: '../../img/img-juegos/Thumbs-Up.gif',
                imageHeight: 350,
                backdrop: `
                    rgba(0,143,255,0.6)
                    url("../../img/img-juegos/fondo.gif")`,
                confirmButtonColor: '#a14cd9',
                confirmButtonText: '¡Genial!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        }
    }
    //en caso de que no se hayan seleccionado todas mandamos alerta para notificar que se debe intentar relacionar todas las columnas
    else {
        Swal.fire({
            title: 'Oops...',
            text: 'Debes seleccionar todas las opciones antes de comprobar las respuestas.',
            imageUrl: 'img/loop.gif',
            imageHeight: 350,
            backdrop: `
                rgba(0,143,255,0.6)
                url("img/fondo.gif")`,
            confirmButtonColor: '#a14cd9',
            confirmButtonText: '¡Genial!',
        });
    }
}


