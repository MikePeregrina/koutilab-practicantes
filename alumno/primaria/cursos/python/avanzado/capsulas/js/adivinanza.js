//arreglo que almacena las pistas y respuestas de la adivinanza
const adivinanzas = [
  { pregunta: "Las funciones en Python son como pequeñas.", respuesta: "Herramientas", respondida: false },
  { pregunta: "Funciona para crear una funcion.", respuesta: "Def", respondida: false },
  { pregunta: "Devuelve el control a la funcion de llamada.", respuesta: "Return", respondida: false },
  { pregunta: "Piensa en una funcion como una.", respuesta: "Caja", respondida: false },
  { pregunta: "Herramientas que pueden hacer cosas específicas.", respuesta: "Funcion", respondida: false }
];

let puntaje = 1; // Iniciamos en la posición 1 del contador
let respuestaActual = ""; //alamacena las respuestas actuales 
let letrasAdivinadas = []; //arreglo que almacena las letras adivinadas
let completado = false; //

//funcion que genera el tablero de las adivinazas
function generarTablero(respuesta) {
  const tablero = document.getElementById('crossword');
  tablero.innerHTML = '';

  for (let i = 0; i < respuesta.length; i++) {
    const celda = document.createElement('div');
    tablero.appendChild(celda);
  }
}
//funcion que muestras las adivinazas aun no completadas
function obtenerPreguntaSinResponder() {
  const preguntasSinResponder = adivinanzas.filter((adivinanza) => !adivinanza.respondida);
  if (preguntasSinResponder.length === 0) return null;
  const indiceAleatorio = Math.floor(Math.random() * preguntasSinResponder.length);
  return preguntasSinResponder[indiceAleatorio];
}
//funcion que muestra las pistas de manera aleatoria
function mostrarPreguntaAleatoria() {
  if (puntaje > adivinanzas.length) {
    mostrarPuntajeFinal();
    return;
  }

  const adivinanzaActual = obtenerPreguntaSinResponder();
  if (!adivinanzaActual) {
    mostrarPuntajeFinal();
    return;
  }

  const pregunta = adivinanzaActual.pregunta;
  respuestaActual = adivinanzaActual.respuesta.toLowerCase();
  adivinanzaActual.respondida = true;
  generarTablero(respuestaActual);
  document.getElementById('hint').textContent = `Pista: ${pregunta}`;
  letrasAdivinadas = Array(respuestaActual.length).fill('');
}

//funcón que valida que las respuestas de las adivinanzas sean correctas
function comprobarRespuesta() {
  const respuestaUsuario = letrasAdivinadas.join('');
  const resultadoElemento = document.getElementById('resultado');

  // Validación del btn comprobar respuestas cuando el usuario no haya respondido alguna adivinanza
  if (respuestaUsuario.trim().length === 0) {
    alertIncomplete(); //se manda a llamar la funcion que genera la alerta 
    return;
  }
//validando las letras ingresadas por el usuario
  if (respuestaUsuario === respuestaActual) {
    puntaje++; 
    alertGood();
  } else {
    alertBad();
    letrasAdivinadas = Array(respuestaActual.length).fill('');
    llenarTableroConRespuesta();
  }

  setTimeout(function() {
    resultadoElemento.textContent = '';
    mostrarPreguntaAleatoria();
    document.getElementById('contador').textContent = `${puntaje} / ${adivinanzas.length}`;
    llenarTableroConRespuesta();
  }, 1500);
}

//función que va llenando los cuadritos de las adivinanzas 
function llenarTableroConRespuesta() {
  const celdasTablero = document.querySelectorAll('.crossword div');

  for (let i = 0; i < celdasTablero.length; i++) {
    celdasTablero[i].textContent = letrasAdivinadas[i] || '';
  }
}
//función que remplaza las letras ingresadas por el usuario en cada campo respectivo
function reemplazarLetra(evento) {
  const teclaPresionada = evento.key.toLowerCase();
  const caracteresPermitidos = /^[a-záéíóúüñ]$/;

  if (teclaPresionada.match(caracteresPermitidos)) {
    const indiceActual = letrasAdivinadas.findIndex(letra => letra === '');
    if (indiceActual !== -1) {
      letrasAdivinadas[indiceActual] = teclaPresionada;
      llenarTableroConRespuesta();
    }
  }
}
//muestra el puntaje obtenido al finalizar el juego
function mostrarPuntajeFinal() {
  const contenedorElemento = document.querySelector('.main-ctn');
  contenedorElemento.innerHTML = `
    <p>Puntuación final: ${puntaje - 1} / ${adivinanzas.length}</p>`;
    verificarPuntaje();
}

//Contador de tiempo en segundos, si se acaba el tiempo sale alerta
var segundos = 120; //120

//se esta llamando los sonidos de la carpeta "sonidos"
var Correcto = document.createElement("audio");
Correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
var Incorrecto = document.createElement("audio");
Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

//funcion que permite definir el tiempo que tiene el jugador
function iniciarTiempo() {
  document.getElementById("tiempo").innerHTML = segundos + " segundos";
  if (segundos <= 60) {
         var div = document.getElementById("timer");
              div.style.cssText = " animation-name: animation1; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
          }
          if (segundos <= 30) {
              var div = document.getElementById("timer");
              div.style.cssText = "animation-name: animation2; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
          }
          if (segundos <= 10) {
              var div = document.getElementById("timer");
              div.style.cssText = "animation-name: animation3; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
          }

  if (segundos == 0) {
    var xmlhttp = new XMLHttpRequest();
    var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 10 + "&id_curso=" + 18 + "&redireccion=" + '../contenido/juegos/cjpi1-3.php)'; //cancatenation
    xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(param);
    Swal.fire({
      title: "Oops...Inténtalo nuevamente, te has quedado sin tiempo",
      text: "",
      imageUrl: "../../img/img-juegos/loop.gif",
      imageHeight: 350,
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.reload();
      }
    });
    Incorrecto.play(); //Agregando sonido al juego no completado
  } else {
    segundos--;
    setTimeout("iniciarTiempo()", 1000);
  }
}

// Nueva función para verificar el puntaje
function verificarPuntaje() {
  if (puntaje - 1 <= 2) {
    var xmlhttp = new XMLHttpRequest();
    var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 10 + "&id_curso=" + 18 + "&redireccion=" + '../contenido/juegos/cjpi1-3.php)'; //cancatenation
    xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(param);
    // Si el puntaje es menor o igual a 2, mostramos una alerta para repetir el juego
    Swal.fire({
      title: "¡Ups! Inténtalo nuevamente, necesitas más aciertos.",
      text: "",
      imageUrl: "../../img/img-juegos/loop.gif",
      imageHeight: 350,
      backdrop: `
        rgba(0,143,255,0.6)
        url("img/fondo.gif")`,
      confirmButtonColor: "#a14cd9",
      confirmButtonText: "Reintentar",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.reload();
      }
    });
  } else if(puntaje >=3){
    // Si el puntaje es mayor a 3, mostramos la alerta de felicitaciones y finalizamos el juego.
    alertExcelent();
  }
}

//Alerta muestra de que el juego fue completado
function alertExcelent() {
  var puntos = <?php echo $puntosGanados; ?>

  var xmlhttp = new XMLHttpRequest();
  var param = "score=" + 10 + "&validar=" + 'correcto' + "&permiso=" + 10 + "&id_curso=" + 18 + "&redireccion=" + '../contenido/juegos/cjpi1-3.php)'; //cancatenation
  xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
  xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlhttp.send(param);
  Swal.fire({
    title: "¡Felicidades!",
    text: "¡Buen trabajo!",
    imageUrl: "../IMG/img-juegos/Thumbs-Up.gif",
    imageHeight: 350,
    backdrop: `
      rgba(0,143,255,0.6)
      url("../IMG/img-juegos/fondo.gif")`,
    confirmButtonColor: "#a14cd9",
    confirmButtonText: "¡Genial!",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.reload()
      ;
    }
  });
  Correcto.play(); //Agregando sonido al juego completado
}

//Alerta, muestra que la respuesta fue incorrecta
function alertBad() {
  Swal.fire({
    position: "center",
    icon: "error",
    title: "Intentalo nuevamente",
    showConfirmButton: false,
    timer: 1800,
  });
}
//Alerta, muestra que la respuesta fue correcta
function alertGood() {
  Swal.fire({
    position: "center",
    icon: "success",
    title: "¡Respuesta Correcta!",
    //background: '#fff url(/img/fondo.gif)',
    showConfirmButton: false,
    timer: 1500,
  });
}
//Alerta muestra que el usuario no ha completado las adivinanzas
function alertIncomplete() {
  Swal.fire({
    position: "center",
    icon: "warning",
    title: "¡Completa las adivinanzas antes de verificar!",
    showConfirmButton: false,
    timer: 1800,
  });}

document.addEventListener('keydown', reemplazarLetra);
mostrarPreguntaAleatoria();
document.getElementById('contador').textContent = `${puntaje} / ${adivinanzas.length}`;