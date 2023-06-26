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
    <link rel="shortcut icon" href="../../img/img-juegos/lgk.png">
</head>

<body onload="iniciarTiempo()">
    <!-- Titulo general del juego -->
    <div class="titulo-gen">
        <h1 class="titulo"><b>RELACIONA LAS COLUMNAS</b></h1>
    </div>

    <!-- Timer -->
    <div class="timer" id="timer">
        <b>Tiempo: <br>
            <p id="tiempo"></p>
        </b>
    </div>

    <!-- Contenedor principal -->
    <div class="contenido">
        <!-- Boton para regresar -->
        <a href="#">
            <button class="btn-b">
                <i class="fas fa-reply"></i>
            </button>
        </a>

        <!-- Titulo secundario -->
        <h4 class="titulo"><b>Selecciona una palabra de lado izquierdo con un clic y relacionala con una del lado
                derecho con otro clic</b></h4>

        <br>
        <!-- contenido del juego -->
        <div class="container-all">
            <!-- Columna de lado izquierdo -->
            <div class="left-column">
                <!-- opciones estas son las principales -->
                <div class="word-box" id="css">Pasa de una diapositiva a otra</div>
                <div class="word-box" id="sql">Agrega un efecto a un elemento</div>
                <div class="word-box" id="html">Es donde ponemos todos los elementos</div>
                <div class="word-box" id="javascript">Conjunto de diapositivas</div>
                <div class="word-box" id="php">Programa que trabajamos</div>
            </div>
            <!-- Mapeo donde se trazan las lineas -->
            <canvas id="canvas"> </canvas>

            <!-- columna de lado derecho -->
            <div class="right-column">
                <!-- Respuestas -->
                <div class="word-box" id="interactividad" onclick="checkAnswer('interactividad')">Presentación</div>
                <div class="word-box" id="funcionalidad" onclick="checkAnswer('funcionalidad')">PowerPoint</div>
                <div class="word-box" id="estructura" onclick="checkAnswer('estructura')">Diapositiva</div>
                <div class="word-box" id="estilos" onclick="checkAnswer('estilos')">Transición</div>
                <div class="word-box" id="administrar" onclick="checkAnswer('administrar')">Animación</div>
            </div>
        </div>

        <!-- boton de verificar respuestas -->
        <button class="verificar">Comprobar respuestas</button>
    </div>

    <!-- Linkeamos un documento donde tenemos todo lo relacionado a la relacion de columnas -->
    <script>
        //Apartado de canvas para trazar lineas

        //variables para la medida del canvas
        const ALTURA_CANVAS = 360,
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
                palabraseleccionada.id !== 'funcionalidad' &&
                palabraseleccionada.id !== 'estructura' &&
                palabraseleccionada.id !== 'estilos' &&
                palabraseleccionada.id !== 'administrar'
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
                    contexto.moveTo(25, 20);
                    // Hacemos una línea hasta 48, 48
                    contexto.lineTo(508, 290);
                    contexto.stroke(); // "Guardar" cambios
                    //sumamos al contador
                    respuestasCorrectas++;
                } else if (respuesta === 'estructura' && idPalabraSeleccionada === 'html') {
                    palabraseleccionada.classList.add('correcto');
                    contexto.beginPath();
                    contexto.lineWidth = 3;
                    contexto.strokeStyle = "#84c42c";
                    contexto.moveTo(25, 200);
                    contexto.lineTo(508, 220);
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
                    contexto.moveTo(25, 280);
                    contexto.lineTo(508, 100);
                    contexto.stroke();
                    respuestasCorrectas++;
                } else if (
                    respuesta === 'funcionalidad' && idPalabraSeleccionada === 'php'
                ) {
                    palabraseleccionada.classList.add('correcto');
                    contexto.beginPath();
                    contexto.lineWidth = 3;
                    contexto.strokeStyle = "#84c42c";
                    contexto.moveTo(25, 360);
                    contexto.lineTo(508, 150);
                    contexto.stroke();
                    respuestasCorrectas++;


                } else if (
                    respuesta === 'administrar' && idPalabraSeleccionada === 'sql'
                ) {
                    palabraseleccionada.classList.add('correcto');
                    contexto.beginPath();
                    contexto.lineWidth = 3;
                    contexto.strokeStyle = "#84c42c";
                    contexto.moveTo(25, 100);
                    contexto.lineTo(508, 350);
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

        //Se esta llamando los sonidos de la carpeta "sonidos"
        var correcto = document.createElement("audio");
		correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
	    var incorrecto = document.createElement("audio");
		incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";


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
                    correcto.play(); //agregando sonido al juego completado
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
        var segundos = 120
        ;
        let puntos = 0;

        function iniciarTiempo() {
            document.getElementById('tiempo').innerHTML = segundos + " segundos";
            if (segundos <= 60) {
                var div = document.getElementById("timer");
                div.style.cssText = "animation-name: animation1; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
            }
            if (segundos <= 30) {
                var div = document.getElementById("timer");
                div.style.cssText = "animation-name: animation2; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
            }
            if (segundos == 0) {
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
                incorrecto.play(); //agregando sonido al juego completado
            } else {
                segundos--;
                setTimeout("iniciarTiempo()", 1000);
            }
        }

        // //Alerta muestra de que el juego fue completado
        // function alertExcelent() {
        //     Swal.fire({
        //         title: 'Excelente',
        //         text: '¡Buen trabajo!',
        //         imageUrl: "img/Thumbs-Up.gif",
        //         imageHeight: 350,
        //         backdrop: `
		// 				rgba(0,143,255,0.6)
		// 				url("img/fondo.gif")`,
        //         confirmButtonColor: '#a14cd9',
        //         confirmButtonText: '¡Genial!',
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             window.location.reload();
        //         }
        //     });

        // }


    </script>
</body>

</html>