<?php
session_start();
$id_user = $_SESSION['id_alumno_secundaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_secundaria'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_secundaria'];
$permiso = "capsulapago4";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_secundaria c INNER JOIN detalle_capsulas_pago_secundaria d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 11;");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../../../../intermedio/capsulas/contenido/alertas/paquete_premium4.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/css-juegos/columnas.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="img/lgk.png">
</head>

<body onload="iniciarTiempo()">
    <!-- Timer -->
    <div class="timer" id="timer">
        <b>Tiempo: <br>
            <p id="tiempo" style="margin: 0 0 0 0;"></p>
        </b>
    </div>

    <!-- Titulo general del juego -->
    <div class="titulo-gen">
        <h2 class="titulo"><b>CICLO DE DÍA Y NOCHE</b></h2>
    </div>

    <!-- Contenedor principal -->
    <section>

        <div class="cont-st">
            <a href="#" onclick="history.back();">
                <button class="btn-b">
                    <i class="fas fa-reply"></i>
                </button>
            </a>
            <h5 class="titulo"><b>Selecciona una palabra de lado izquierdo y relacionala con una del lado derecho</b>
            </h5>
        </div>
        <br>
        <!-- contenido del juego -->
        <div class="container-all">
            <!-- Columna de lado izquierdo -->
            <div class="left-column">
                <!-- opciones estas son las principales -->
                <!-- opciones estas son las principales -->
                <div class="word-box" id="realismo">REALISMO</div>
                <div class="word-box" id="rotacion">ROTACIÓN GRADUAL</div>
                <div class="word-box" id="importa">IMPORTA</div>
                <div class="word-box" id="script">SCRIPT</div>
                <div class="word-box" id="curva">CURVA DE ANIMACIÓN</div>
            </div>
            <!-- Mapeo donde se trazan las lineas -->
            <canvas id="canvas"> </canvas>

            <!-- columna de lado derecho -->
            <div class="right-column">
                <!-- Respuestas -->

                <div class="word-box" id="dia" onclick="checkAnswer('dia')">DayNightController</div>
                <div class="word-box" id="intensity" onclick="checkAnswer('intensity')">intensityCurve</div>
                <div class="word-box" id="elementos" onclick="checkAnswer('elementos')">Elementos visuales</div>
                <div class="word-box" id="dinamismo" onclick="checkAnswer('dinamismo')">Admósfera</div>
                <div class="word-box" id="intensidad" onclick="checkAnswer('intensidad')">Intensidad de luz</div>
            </div>
        </div>

        <!-- boton de verificar respuestas -->
        <button class="verificar">Comprobar respuestas</button>
    </section>

    <!-- CAMBIOS -->
    <footer class="footerimga">
        <div class="imagen-footer">
            <img src="../../img/img-juegos/benvenida.png" alt="No-image">
        </div>
    </footer>
    <!-- fIN CAMBIOS -->
    <!-- Linkeamos un documento donde tenemos todo lo relacionado a la relacion de columnas -->
    <script>
        //Apartado de canvas para trazar lineas

        //variables para la medida del canvas
        const ALTURA_CANVAS = 290,
            ANCHURA_CANVAS = 535;

        //se esta llamando los sonidos de la carpeta "sonidos"
        var Correcto = document.createElement("audio");
        Correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
        var Incorrecto = document.createElement("audio");
        Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

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
                palabraseleccionada.id !== 'dia' &&
                palabraseleccionada.id !== 'intensity' &&
                palabraseleccionada.id !== 'elementos' &&
                palabraseleccionada.id !== 'dinamismo' &&
                palabraseleccionada.id !== 'intensidad'
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
                if (respuesta === 'dinamismo' && idPalabraSeleccionada === 'realismo') {
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
                } else if (respuesta === 'elementos' && idPalabraSeleccionada === 'importa') {
                    palabraseleccionada.classList.add('correcto');
                    contexto.beginPath();
                    contexto.lineWidth = 3;
                    contexto.strokeStyle = "#84c42c";
                    contexto.moveTo(0, 145);
                    contexto.lineTo(560, 145);
                    contexto.stroke();
                    respuestasCorrectas++;
                } else if (
                    respuesta === 'dia' && idPalabraSeleccionada === 'script'
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
                    respuesta === 'intensity' && idPalabraSeleccionada === 'curva'
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
                    respuesta === 'intensidad' && idPalabraSeleccionada === 'rotacion'
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
                            window.location.href = "../../../../../../rutas/ruta-vj-i.php";
                        }
                    });
                    Correcto.play(); //Agregando sonido al juego completado
                }
            }
            //en caso de que no se hayan seleccionado todas mandamos alerta para notificar que se debe intentar relacionar todas las columnas
            else {
                Swal.fire({
                    title: 'Oops...',
                    text: 'Debes seleccionar todas las opciones antes de comprobar las respuestas.',
                    imageUrl: '../../img/img-juegos/loop.gif',
                    imageHeight: 350,
                    backdrop: `
                rgba(0,143,255,0.6)
                url("../../img/img-juegos/fondo.gif")`,
                    confirmButtonColor: '#a14cd9',
                    confirmButtonText: '¡Genial!',
                });
            }
        }
    </script>
    <script>
        //Contador de tiempo en segundos, si se acaba el tiempo sale alerta
        var segundos = 120;
        let puntos = 0;

        //se esta llamando los sonidos de la carpeta "sonidos"
        var Correcto = document.createElement("audio");
        Correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
        var Incorrecto = document.createElement("audio");
        Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

        function iniciarTiempo() {
            document.getElementById('tiempo').innerHTML = segundos + " segundos";
            /*declarando condiciones que permiten cambiar el color de fondo del timer*/
            if (segundos <= 60) {
                var div = document.getElementById("timer");
                div.style.cssText = "animation-name: animation1; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
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
                var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 26 + "&id_curso=" + 4; //cancatenation
                xmlhttp.open("POST", "../../acciones/insertar_pd26.php", true);
                xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlhttp.send(param);
                Swal.fire({
                    title: 'Oops...',
                    text: '¡Tiempo Agotado! Vuelve a intentarlo',
                    imageUrl: "../../img/img-juegos/loop.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
                Incorrecto.play(); //agregando sonido al juego no completado
            } else {
                segundos--;
                setTimeout("iniciarTiempo()", 1000);
            }
        }
    </script>
</body>

</html>