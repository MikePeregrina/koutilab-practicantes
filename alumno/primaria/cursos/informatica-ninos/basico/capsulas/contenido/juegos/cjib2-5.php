<?php
session_start();
$id_user = $_SESSION['id_alumno_primaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_primaria'])) {
  header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_primaria'];
$permiso = "capsula41";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 19");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
  header("Location: ../../../../basico/capsulas/acciones/capsulas.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 42;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_primaria WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 19");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_primaria WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 19");
$resultadoIntentos = mysqli_fetch_assoc($consultaIntentos);
if (isset($resultadoIntentos['intentos'])) {
  $totalIntentos = $resultadoIntentos['intentos'];
  if ($totalIntentos == 2 && $result_sql_permisos == 0) {
    $puntosGanados = 8;
  } else if ($totalIntentos == 3 && $result_sql_permisos == 0) {
    $puntosGanados = 6;
  } else if ($totalIntentos > 3 && $result_sql_permisos == 0) {
    $puntosGanados = 0;
  } else {
    $puntosGanados = 0;
  }
} else {
  $puntosGanados = 10;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../css/css-juegos/adivinanza.css" /><!--Linkeo de la hoja de estilos-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>KOUTILAB</title>
</head>

<body onload="iniciarTiempo()">
  <!-- CAMBIOS -->
  <!-- Timer -->
  <div class="timer" id="timer">
    <b>Tiempo: <br>
      <p id="tiempo" style="margin: 0 0 0 0;"></p>
    </b>
  </div>

  <!-- Titulo general -->
  <div class="titulo-gen">
    <h2 class="titulo"><b>ANDORID</b></h2>
  </div>


  <!-- Contenedor principal -->
  <div class="contenido">

    <!-- Tenoch Moises -->
    <section>
      <div class="cont-st">
        <a href="../../../../../../rutas/ruta-in-b.php">
          <button class="btn-b">
            <i class="fas fa-reply"></i>
          </button>
        </a>
        <h4 class="titulo"><b>Adivina las frases o palabras antes de que se termine el tiempo</b></h4>
      </div>

      <div class="main-ctn">
        <div class="contador" id="contador"></div><!--Marcador de adivinanzas-->
        <div class="crossword" id="crossword"></div><!--generado de cuadritos por cada adivinanza-->
        <div class="hint" id="hint"></div><!--Pista a proprcionar-->
        <div class="result" id="resultado"></div><!--Resultados al finalizar-->
      </div>
      <button class="verificar" onclick="comprobarRespuesta()">Comprobar
        Respuesta</button><!--btn comprobar respuesta-->
    </section>

    <!-- CAMBIOS -->
    <footer class="footerimga">
      <div class="imagen-footer">
        <img src="../../img/img_juegos/benvenida.png" alt="No-image">
      </div>
    </footer>
    <!-- fIN CAMBIOS -->
    <!--<script src="../../js/adivinanza.js"></script>Linkeo de la hoja del js-->
    <script>
      //arreglo que almacena las pistas y respuestas de la adivinanza
      //arreglo que almacena las pistas y respuestas de la adivinanza
      const adivinanzas = [{
          pregunta: "Es un sistema operativo móvil desarrollado por Google y diseñado principalmente para dispositivos móviles.",
          respuesta: "Android",
          respondida: false
        },
        {
          pregunta: "En que mes fue lanzado Android.",
          respuesta: "Septiembre",
          respondida: false
        },
        {
          pregunta: "Es el tipo de dispositivo que ocupan Android.",
          respuesta: "Movil",
          respondida: false
        },
        {
          pregunta: "Esto significa que el código fuente del sistema operativo está disponible públicamente y se puede modificar y distribuir de forma gratuita.",
          respuesta: "Abierto",
          respondida: false
        },
        {
          pregunta: " Es el nombre que Android ofrece a un sistema que te informa sobre mensajes.",
          respuesta: "Notificacion",
          respondida: false
        }
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
          var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 42 + "&id_curso=" + 19 + "&redireccion=" + '../contenido/juegos/cjib2-5.php)'; //cancatenation
          xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
          xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xmlhttp.send(param);
          Swal.fire({
            title: "Oops...Inténtalo nuevamente, te has quedado sin tiempo",
            text: "",
            imageUrl: "../../img/img_juegos/loop.gif",
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
          var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 42 + "&id_curso=" + 19 + "&redireccion=" + '../contenido/juegos/cjib2-5.php)'; //cancatenation
          xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
          xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xmlhttp.send(param);
          // Si el puntaje es menor o igual a 2, mostramos una alerta para repetir el juego
          Swal.fire({
            title: "¡Ups! Inténtalo nuevamente, necesitas más aciertos.",
            text: "",
            imageUrl: "../../img/img_juegos/loop.gif",
            imageHeight: 350,
            backdrop: `
        rgba(0,143,255,0.6)
        url("../../img/img_juegos/fondo.gif")`,
            confirmButtonColor: "#a14cd9",
            confirmButtonText: "Reintentar",
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.reload();
            }
          });
        } else if (puntaje >= 3) {
          // Si el puntaje es mayor a 3, mostramos la alerta de felicitaciones y finalizamos el juego.
          alertExcelent();
        }
      }

      //Alerta muestra de que el juego fue completado
      function alertExcelent() {
        var puntos = <?php echo $puntosGanados; ?>

        var xmlhttp = new XMLHttpRequest();
        var param = "score=" + 10 + "&validar=" + 'correcto' + "&permiso=" + 42 + "&id_curso=" + 19 + "&redireccion=" + '../contenido/juegos/cjib2-5.php)'; //cancatenation
        xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(param);
        Swal.fire({
          title: "¡Felicidades!",
          text: '¡Puntuación guardada con éxito! Obtienes ' + puntos + ' puntos de logros',
          imageUrl: "../../img/img_juegos/Thumbs-Up.gif",
          imageHeight: 350,
          backdrop: `
      rgba(0,143,255,0.6)
      url("../../img/img_juegos/fondo.gif")`,
          confirmButtonColor: "#a14cd9",
          confirmButtonText: "¡Genial!",
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = "../../../../../../rutas/ruta-in-b.php";;
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
        });
      }

      document.addEventListener('keydown', reemplazarLetra);
      mostrarPreguntaAleatoria();
      document.getElementById('contador').textContent = `${puntaje} / ${adivinanzas.length}`;
    </script>
</body>

</html>