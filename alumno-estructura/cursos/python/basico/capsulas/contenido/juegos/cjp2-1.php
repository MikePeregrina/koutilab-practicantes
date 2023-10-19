<?php
session_start();
$id_user = $_SESSION['id_alumno'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno'];
$permiso = "capsula26";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 4");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: ../../../../basico/capsulas/acciones/capsulas.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 27;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_$rol WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 4");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_$rol WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 4");
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
    <!-- Timer -->
    <div class="timer" id="timer">
        <b>Tiempo: <br>
            <p id="tiempo" style="margin: 0 0 0 0;"></p>
        </b>
    </div>

    <!-- Titulo general del juego -->
    <div class="titulo-gen">
        <h2 class="titulo"><b>OPERADORES LÓGICOS</b></h2>
    </div>

    <!-- Contenedor principal -->
    <section>

        <div class="cont-st">
            <a href="#">
                <button class="btn-b">
                    <i class="fas fa-reply"></i>
                </button>
            </a>
            <h5 class="titulo"><b>Selecciona una palabra de lado izquierdo y relacionala con una del lado derecho</b></h5>
        </div>
        <br>
        <!-- contenido del juego -->
        <div class="container-all">
            <!-- Columna de lado izquierdo -->
            <div class="left-column">
                <!-- opciones estas son las principales -->
                <!-- opciones estas son las principales -->
                <div class="word-box" id="css">INT</div>
                <div class="word-box" id="sql">TUPLE</div>
                <div class="word-box" id="html">STR</div>
                <div class="word-box" id="javascript">BOOL</div>
                <div class="word-box" id="php">LIST</div>
            </div>
            <!-- Mapeo donde se trazan las lineas -->
            <canvas id="canvas"> </canvas>

            <!-- columna de lado derecho -->
            <div class="right-column">
                <!-- Respuestas -->

                <div class="word-box" id="interactividad" onclick="checkAnswer('interactividad')">Verdad o falso</div>
                <div class="word-box" id="funcionalidad" onclick="checkAnswer('funcionalidad')">Secuencia</div>
                <div class="word-box" id="estructura" onclick="checkAnswer('estructura')">Texto</div>
                <div class="word-box" id="estilos" onclick="checkAnswer('estilos')">Numérico</div>
                <div class="word-box" id="administrar" onclick="checkAnswer('administrar')">Multiples datos</div>
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
    <script src="../../js/seleccionador-2.js"></script>
    <script>
        //Contador de tiempo en segundos, si se acaba el tiempo sale alerta
        var segundos = 240;
        var puntos = <?php echo $puntosGanados; ?>

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
                var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 27 + "&id_curso=" + 4 + "&redireccion=" + '../contenido/juegos/cjp2-1.php'; //cancatenation
                xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
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