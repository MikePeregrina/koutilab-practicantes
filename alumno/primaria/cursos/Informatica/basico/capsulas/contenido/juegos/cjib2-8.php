<?php
session_start();
$id_user = $_SESSION['id_alumno_primaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_primaria'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_primaria'];
$permiso = "capsula49";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 7");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: ../../../../basico/capsulas/acciones/capsulas.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 50;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_primaria WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 7");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_primaria WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 7");
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
    <link rel="stylesheet" href="../../css/css-juegos/cjib2-7.1.css">
    <link rel="stylesheet" href="../../css/css-juegos/cjib2-7.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="../../img/img_juegos/lgk.png">
    <title>KOUTILAB</title>
</head>

<body onload="iniciarTiempo(), iniciar() ">
    <!-- Titulo general del juego -->
    <div class="titulo-gen">
        <h2 class="titulo"><b>WINDOWS</b></h2>
    </div>

    <!-- Timer -->
    <div class="timer" id="timer">
        <b>Tiempo: <br>
            <p id="tiempo" style="margin: 0 0 0 0;"></p>
        </b>
    </div>


    <!-- Contenedor principal -->
    <div class="contenido">

        <!-- Boton para regresar -->
        <a href="../../../../../../rutas/ruta-in-b.php"><button style="float: left; position: absolute; margin: 10px 0 0 10px;" class="btn-b" id="btn-cerrar-modalV">
                <i class="fas fa-reply"></i></button>
        </a>

        <!-- Titulo secundario -->
        <h4 class="titulo"><b>El juego consiste en responder correctamente una serie de preguntas pierde si se acaba el
                tiempo o responde mal</b></h4>
        <br>


        <!-- Tenoch Moises -->
        <!--contenedor principal-->
        <div class="contenedor">
            <!--para mostrar la puntuacion-->
            <div class="puntaje" id="puntaje"></div>
            <!--es el encabezado donde se muestra la categoria, numero, pregunta e imagen-->
            <div class="encabezado">
                <!--es opcional la parte de mostrar categoria y esta implementado para funcionar sin ella tambien-->
                <div class="categoria" id="categoria"></div>
                <!--No se muestra en la pantalla pero permite que se generen las preguntas "NO MOVER" -->
                <div class="numero" id="numero"></div>
                <!--es donde se muestra la pregunta-->
                <h3><b>
                        <div class="pregunta" id="pregunta">
                        </div>
                    </b></h3>
                <!--muestra una imagen ilustrativa para dar pista de la respuesta pero igual es implementado para  funcionar sin la imagen-->
                <img src="#" class="imagen" id="imagen">
            </div>
            <!--Funcionan con un "onclick" y solo tiene una respuesta correcta-->

            <div class="btn" id="btn1" onclick="oprimir_btn(0)"></div>
            <div class="btn" id="btn2" onclick="oprimir_btn(1)"></div>
            <div class="btn" id="btn3" onclick="oprimir_btn(2)"></div>
            <div class="btn" id="btn4" onclick="oprimir_btn(3)"></div>
            <!--script donde se le da funcionalidad al juego-->
            <script src="../../js/cjib2-7.js"></script>

        </div>
        <!-- boton de verificar respuestas-->
        <!-- NOTA: SE MANDO A LLAMAR LA FUNCION "marcador()" DONDE SE LLEVA LA PUNTUACION
            EN ESA FUNCION SE MANDA A LLAMAR LA FUNCION ORIGINAL "alertExcelent()" -->
        <!-- <button class="verificar" onclick="marcador()  ">Finalizar</button> -->
    </div>
    <!-- Tenoch Moises -->

    <script>
        //ambos
        //funciona para mostrar el resultado al presionar el boton "comprobar respuestas"
        function marcador() {
            if (mostrar_pantalla_juego_términado) {
                swal.fire({
                    title: "Juego finalizado",
                    text: "Puntuación: " + preguntas_correctas + "/" + "5", //preguntas_hechas
                    icon: "success",
                    confirmButtonText: '¡Genial!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        alertExcelent();
                    }
                });
            }
        }
        //funciona para mostrar el resultado al agotarse el tiempo
        function marcadorTiempoAgotado() {
            if (mostrar_pantalla_juego_términado) {
                swal.fire({
                    title: "Juego finalizado",
                    text: "Puntuación: " + preguntas_correctas + "/" + "5", //preguntas_hechas
                    icon: "success",
                    confirmButtonText: '¡Genial!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        tiempoAgotado();
                    }
                });
            }
        }

        //sirve para mostrar cuando el tiempo se ha acabado al final del juego y recarga la pagina
        function tiempoAgotado() {
            var xmlhttp = new XMLHttpRequest();
            var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 50 + "&id_curso=" + 7; //cancatenation
            xmlhttp.open("POST", "../../acciones/insertar_pd50.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send(param);
            Swal.fire({
                title: 'Mala Suerte',
                text: '¡Mejora tu Tiempo!',
                imageUrl: "../../img/img_juegos/Thumbs-Up.gif",
                imageHeight: 350,
                backdrop: `
						rgba(0,143,255,0.6)
						url("../../img/img_juegos/fondo.gif")`,
                confirmButtonColor: '#a14cd9',
                confirmButtonText: '¡Genial!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        }
        //ambos


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
                    text: '¡El tiempo se acabo!',
                    imageUrl: "../../../capsulas/img/img_juegos/loop.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        marcadorTiempoAgotado();
                        // window.location.reload();
                    }
                });
                incorrecto.play();
            } else {
                segundos--;
                setTimeout("iniciarTiempo()", 1000);
            }
        }

        //Alerta muestra de que el juego fue completado
        function alertExcelent() {
            var xmlhttp = new XMLHttpRequest();
            var param = "score=" + 10 + "&validar=" + 'correcto' + "&permiso=" + 50 + "&id_curso=" + 7; //cancatenation
            xmlhttp.open("POST", "../../acciones/insertar_pd50.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send(param);
            Swal.fire({
                title: 'Excelente',
                text: '¡Buen trabajo!',
                imageUrl: "../../../capsulas/img/img_juegos/Thumbs-Up.gif",
                imageHeight: 350,
                backdrop: `
						rgba(0,143,255,0.6)
						url("../../../capsulas/img/img_juegos/fondo.gif")`,
                confirmButtonColor: '#a14cd9',
                confirmButtonText: '¡Genial!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../../../../../../rutas/ruta-in-b.php';
                }
            });
            correcto.play();
        }
    </script>


</body>

</html>