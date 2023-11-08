<?php
session_start();
$id_user = $_SESSION['id_alumno_preparatoria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_preparatoria'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_preparatoria'];
$permiso = "capsula43";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_preparatoria c INNER JOIN detalle_capsulas_preparatoria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 8");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: ../../../../basico/capsulas/acciones/capsulas.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 44;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_preparatoria WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 8");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_preparatoria WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 8");
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
    <div class="timer" id="timer">
        <b>Tiempo: <br>
            <p id="tiempo" style="margin: 0 0 0 0;"></p>
        </b>
    </div>

    <!-- Titulo general -->
    <div class="titulo-gen">
        <h2 class="titulo"><b>RELACIONA LAS COLUMNAS</b></h2>
    </div>

    <section>

        <div class="cont-st">
            <a href="#">
                <button class="btn-b">
                    <i class="fas fa-reply"></i>
                </button>
            </a>
            <h5 class="titulo"><b>Selecciona una palabra de lado izquierdo y relacionala con una del lado derecho</b></h5>
        </div>
        <!-- contenido del juego -->
        <div class="container-all">
            <!-- Columna de lado izquierdo -->
            <div class="left-column">
                <!-- opciones estas son las principales -->
                <div class="word-box" id="css">Imágenes</div>
                <div class="word-box" id="sql">Tablas</div>
                <div class="word-box" id="html">Gráficos</div>
                <div class="word-box" id="javascript">Formas</div>
                <div class="word-box" id="php">Cuadros de texto</div>
            </div>
            <!-- Mapeo donde se trazan las lineas -->
            <canvas id="canvas"> </canvas>

            <!-- columna de lado derecho -->
            <div class="right-column">
                <!-- Respuestas -->
                <div class="word-box" id="interactividad" onclick="checkAnswer('interactividad')"><i class="fas fa-circle fa-lg"></i></div>
                <div class="word-box" id="funcionalidad" onclick="checkAnswer('funcionalidad')"><i class="fas fa-text-height fa-lg"></i></div>
                <div class="word-box" id="estructura" onclick="checkAnswer('estructura')"><i class="fas fa-chart-line fa-lg"></i></div>
                <div class="word-box" id="estilos" onclick="checkAnswer('estilos')"><i class="fas fa-image fa-lg"></i></div>
                <div class="word-box" id="administrar" onclick="checkAnswer('administrar')"><i class="fas fa-table fa-lg"></i></div>
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
        //Funcion que agrega el sonido al juego
        var correcto = document.createElement("audio");
        correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
        var incorrecto = document.createElement("audio");
        incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

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
                    contexto.moveTo(0, 20);
                    // Hacemos una línea hasta 48, 48
                    contexto.lineTo(560, 220);
                    contexto.stroke(); // "Guardar" cambios
                    //sumamos al contador
                    respuestasCorrectas++;
                } else if (respuesta === 'estructura' && idPalabraSeleccionada === 'html') {
                    palabraseleccionada.classList.add('correcto');
                    contexto.beginPath();
                    contexto.lineWidth = 3;
                    contexto.strokeStyle = "#84c42c";
                    contexto.moveTo(0, 145);
                    contexto.lineTo(560, 150);
                    contexto.stroke();
                    respuestasCorrectas++;
                } else if (
                    respuesta === 'interactividad' && idPalabraSeleccionada === 'javascript'
                ) {
                    palabraseleccionada.classList.add('correcto');
                    contexto.beginPath();
                    contexto.lineWidth = 3;
                    contexto.strokeStyle = "#84c42c";
                    contexto.moveTo(0, 210);
                    contexto.lineTo(560, 15);
                    contexto.stroke();
                    respuestasCorrectas++;
                } else if (
                    respuesta === 'funcionalidad' && idPalabraSeleccionada === 'php'
                ) {
                    palabraseleccionada.classList.add('correcto');
                    contexto.beginPath();
                    contexto.lineWidth = 3;
                    contexto.strokeStyle = "#84c42c";
                    contexto.moveTo(0, 270);
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
                    contexto.moveTo(0, 85);
                    contexto.lineTo(560, 280);
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
                            window.location.href = "../../../../../../rutas/ruta-in-i.php";
                        }
                    });

                }
                correcto.play(); //agregando sonido al juego completado
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
        var segundos = 240;

        let puntos = 0;

        function iniciarTiempo() {
            document.getElementById('tiempo').innerHTML = segundos + " segundos";
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
                incorrecto.play(); //agregando sonido al juego no completado
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