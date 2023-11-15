<?php
session_start();
$id_user = $_SESSION['id_alumno_preparatoria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_preparatoria'])) {
    header('location: ../../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_preparatoria'];
$permiso = "capsula19";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_preparatoria c INNER JOIN detalle_capsulas_preparatoria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 4");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: ../../../../../basico/capsulas/acciones/capsulas.php");
}
//Verificar si ya se tiene permiso y no dar puntos de más
//Verificar si permiso_intento es correcto
$permiso_intento = 20;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_preparatoria WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND  id_curso = 4");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_preparatoria WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND  id_curso = 4");
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

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../../../../../../../img/lgk.png">
    <link rel="stylesheet" href="../../../css/capsula-teoriaaa.css" />
    <link rel="stylesheet" href="../../../css/carrusel.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.2/plyr.css" />
    <script src="https://cdn.plyr.io/3.7.2/plyr.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- De aqui -->
    <link rel="stylesheet" href="./css/columnas-teoricas.css" /> <!-- Agregar css de columnas -->
    <link rel="stylesheet" href="./css/laberinto-teoricas.css" /> <!-- Agregar css de laberinto -->
    <link rel="stylesheet" href="./css/memorama-teorica.css" /> <!-- Agregar css de memorama -->
    <link rel="stylesheet" href="./css/sopa-teorica.css" /> <!-- Agregar css de sopa -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/wordfind.js"></script>
    <script type="text/javascript" src="js/wordfindgame.js"></script>
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <!-- Hasta aqui -->

</head>

<body>
    <div class="body">
        <div class="container">
            <a href="#" onclick="history.back(); return false;"><button style="float: left;" class="btn-b" id="btn-cerrar-modalV"><i class="fas fa-reply"></i></button></a>
            <div class="new-g" style="text-align: center;">Cápsula teórica 7 Python Básico</div><br>
            <section id="container-slider">
                <section id="container-slider">
                    <a href="javascript: fntExecuteSlide('prev');" class="arrowPrev"><i class="fas fa-chevron-circle-left"></i></a>
                    <a href="javascript: fntExecuteSlide('next');" class="arrowNext"><i class="fas fa-chevron-circle-right"></i></a>
                    <ul class="listslider">
                        <!-- Agregar linea de código <li><a itlist="itList_X" href="#"></a></li> cada que se agrega una imagen más-->
                        <li>
                            <a itlist="itList_1" href="#" class="item-select-slid"></a>
                        </li>
                        <li>
                            <a itlist="itList_2" href="#"></a>
                        </li>
                        <li>
                            <a itlist="itList_3" href="#"></a>
                        </li>
                        <li>
                            <a itlist="itList_4" href="#"></a>
                        </li>
                        <li>
                            <a itlist="itList_5" href="#"></a>
                        </li>
                        <li>
                            <a itlist="itList_6" href="#"></a>
                        </li>
                        <li>
                            <a itlist="itList_7" href="#"></a>
                        </li>
                    </ul>
                    <ul id="slider">
                        <li style="background-image: url('../../../img/P1/T7/54.gif'); z-index:0; opacity: 1;"></li>
                        <li style="background-image: url('../../../img/P1/T7/55.gif');"></li>
                        <li style="background-image: url('../../../img/P1/T7/56.gif');"></li>
                        <li>
                            <!-- Copiar de aqui -->
                            <h4 class="titulo"><b>Usa las flechas para ayudar a Kobot a llegar hasta su cohete espacial</b></h4>
                            <div id="page">

                                <div id="Message-Container">
                                    <div id="message">
                                        <p id="moves"></p>
                                    </div>
                                </div>

                                <br>
                                <div id="menu" style="margin-top: -500px; position: absolute;">
                                    <div class="custom-select">
                                        <select id="diffSelect">
                                            <option value="6">Easy</option>
                                            <option value="15">Medium</option>
                                            <option value="25">Hard</option>
                                            <option value="38">Extreme</option>
                                        </select>
                                    </div>
                                    <input id="startMazeBtn" type="button" onclick="makeMaze()" value="Start" />
                                </div>

                                <div class="maze-contenedor">
                                    <div id="view">
                                        <div id="mazeContainer">
                                            <canvas id="mazeCanvas" class="border" height="1100" width="1100" style="background-color: rgba(61, 171, 244, 0.5)"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <!-- <p id="instructions">Use arrow keys to move the key to the house!</p> -->

                            </div>
                            <!-- Hasta aqui -->
                        </li>
                        <li style="background-image: url('../../../img/P1/T7/57.gif');"></li>
                        <li>
                            <div>
                                <form class="forms" id="evaluar" method="POST" enctype="multipart/form-data" action="../../../acciones/insertar_teorica.php">
                                    <h2>Para poder avanzar, responde la siguiente pregunta.</h2>
                                    <h1>El operador __ devuelve true si los valores no son iguales</h1>
                                    <div class="container-question">
                                        <input type="checkbox" id="checkbox1" class="check-box" style="scale: 90%;">
                                        <label for="checkbox1">!=</label>
                                    </div>
                                    <div class="container-question">
                                        <input type="checkbox" id="checkbox2" class="check-box" style="scale: 90%;">
                                        <label for="checkbox2"> ==</label>
                                    </div>
                                    <div class="container-question">
                                        <input type="checkbox" id="checkbox3" class="check-box" style="scale: 90%;">
                                        <label for="checkbox3">></label>
                                    </div>
                                    <div class="container-question">
                                        <input type="checkbox" id="checkbox4" class="check-box" style="scale: 90%;">
                                        <label for="checkbox4">
                                            <=< /label>
                                    </div>
                                    <input type="hidden" name="permiso" value="20">
                                    <input type="hidden" name="teorico" value="10">
                                    <input type="hidden" name="id_curso" value="4">
                                    <input type="hidden" name="validar" id="validar" value="incorrecto">
                                    <input type="hidden" name="redireccion" value="../contenido/teoricas/P1/ct7python.php">

                                </form>
                            </div>
                        </li>
                    </ul>
                </section>
        </div>
    </div>
    <footer class="footerimga">
        <div class="imagen-footer">
            <img src="../../../img/benvenida.png" alt="No-image">
        </div>
    </footer>
    <script src="js/laberinto.js"></script><!-- Agregar js de columnas -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- Agregar este -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.18/jquery.touchSwipe.min.js"></script> <!-- Agregar este -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script> <!-- Y este -->
    <script>
        window.addEventListener("load", function() {
            var form = document.querySelector("form");
            var fields = form.querySelectorAll("div");
            var randomIndex = Math.floor(Math.random() * fields.length);

            for (var i = 0; i < fields.length; i++) {
                var index = (i + randomIndex) % fields.length;
                form.appendChild(fields[index]);
            }
        });
    </script>
    <script>
        //se esta llamando los sonidos de la carpeta "sonidos"
        var Correcto = document.createElement("audio");
        Correcto.src = "../../../../../../../../../acciones/sonidos/correcto.mp3";
        var Incorrecto = document.createElement("audio");
        Incorrecto.src = "../../../../../../../../../acciones/sonidos/incorrecto.mp3";
        //checar respuesta

        var puntos = <?php echo $puntosGanados; ?>;
        var checkbox1 = document.getElementById('checkbox1');
        var checkbox2 = document.getElementById('checkbox2');
        var checkbox3 = document.getElementById('checkbox3');
        var checkbox4 = document.getElementById('checkbox4');

        checkbox1.addEventListener("change", comprueba, true);
        checkbox2.addEventListener("change", comprueba, true);
        checkbox3.addEventListener("change", comprueba, true);
        checkbox4.addEventListener("change", comprueba, true);

        function comprueba() {
            if (checkbox1.checked) {
                //UNA SERIE DE CONDICIONALES ANIDADAS LAS CUALES VALIDAN NUESTROS 4 POSIBLES RESULTADOS Y MANDA LA ALERTA CORRESPONDIENTE
                if (puntos == 0) {
                    //se llama a "sonido" y reproducimos el sonido de que esta correcto
                    Correcto.play();
                    //resultado();
                    Swal.fire({
                        title: 'Bien hecho al fin lo lograste. ¡Debes mejorar!',
                        text: '¡Más de 3 intentos, no es posible sumar puntos!',
                        imageUrl: "../../../../../../../img/Thumbs-Up.gif",
                        imageHeight: 350,
                        backdrop: `
                    rgba(0,143,255,0.6)
                    url("../../../../../../../img/fondo.gif")
                    `,
                        confirmButtonColor: '#a14cd9',
                        confirmButtonText: 'Aceptar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var inputValidar = document.getElementById("validar");
                            inputValidar.value = "correcto";
                            document.getElementById('evaluar').submit();
                        }
                    });
                } else if (puntos == 6) {
                    //se llama a "sonido" y reproducimos el sonido de que esta correcto
                    Correcto.play();
                    Swal.fire({
                        title: '¡Bien hecho! ' + 'Obtuviste ' + puntos + ' puntos teóricos',
                        text: '¡Puntuación guardada con éxito!',
                        imageUrl: "../../../../../../../img/Thumbs-Up.gif",
                        imageHeight: 350,
                        backdrop: `
                    rgba(0,143,255,0.6)
                    url("../../../../../../../img/fondo.gif")
                    `,
                        confirmButtonColor: '#a14cd9',
                        confirmButtonText: 'Aceptar',
                    }).then((result) => {

                        if (result.isConfirmed) {
                            var inputValidar = document.getElementById("validar");
                            inputValidar.value = "correcto";
                            document.getElementById('evaluar').submit();
                        }
                    });
                } else if (puntos == 8) {
                    //se llama a "sonido" y reproducimos el sonido de que esta correcto
                    Correcto.play();
                    Swal.fire({
                        title: '¡Bien hecho! ' + 'Obtuviste ' + puntos + ' puntos teóricos',
                        text: '¡Puntuación guardada con éxito!',
                        imageUrl: "../../../../../../../img/Thumbs-Up.gif",
                        imageHeight: 350,
                        backdrop: `
                    rgba(0,143,255,0.6)
                    url("../../../../../../../img/fondo.gif")
                    `,
                        confirmButtonColor: '#a14cd9',
                        confirmButtonText: 'Aceptar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var inputValidar = document.getElementById("validar");
                            inputValidar.value = "correcto";
                            document.getElementById('evaluar').submit();
                        }
                    });
                } else if (puntos == 10) {
                    //se llama a "sonido" y reproducimos el sonido de que esta correcto
                    Correcto.play();
                    Swal.fire({
                        title: '¡Excelente sigue así! ' + 'Obtuviste ' + puntos + ' puntos teóricos',
                        text: '¡Puntuación guardada con éxito!',
                        imageUrl: "../../../../../../../img/Thumbs-Up.gif",
                        imageHeight: 350,
                        backdrop: `
                    rgba(0,143,255,0.6)
                    url("../../../../../../../img/fondo.gif")
                    `,
                        confirmButtonColor: '#a14cd9',
                        confirmButtonText: 'Aceptar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var inputValidar = document.getElementById("validar");
                            inputValidar.value = "correcto";
                            document.getElementById('evaluar').submit();
                        }
                    });
                }

            } else if (checkbox2.checked) {
                //se llama a "sonido" y reproducimos el sonido de que esta incorrecto
                Incorrecto.play();
                Swal.fire({
                    title: 'Oops...',
                    text: '¡Verifica tu respuesta!',
                    imageUrl: "../../../../../../../img/signo.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('evaluar').submit();
                    }
                });
            } else if (checkbox3.checked) {
                //se llama a "sonido" y reproducimos el sonido de que esta incorrecto
                Incorrecto.play();
                Swal.fire({
                    title: 'Oops...',
                    text: '¡Verifica tu respuesta!',
                    imageUrl: "../../../../../../../img/signo.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('evaluar').submit();
                    }
                });
            } else if (checkbox4.checked) {
                //se llama a "sonido" y reproducimos el sonido de que esta incorrecto
                Incorrecto.play();
                Swal.fire({
                    title: 'Oops...',
                    text: '¡Verifica tu respuesta!',
                    imageUrl: "../../../../../../../img/signo.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('evaluar').submit();
                    }
                });
            }
        }
    </script>
    <script src="../../../js/validar.js"></script>
    <script>
        function disableIE() {
            if (document.all) {
                return false;
            }
        }

        function disableNS(e) {
            if (document.layers || (document.getElementById && !document.all)) {
                if (e.which == 2 || e.which == 3) {
                    return false;
                }
            }
        }
        if (document.layers) {
            document.captureEvents(Event.MOUSEDOWN);
            document.onmousedown = disableNS;
        } else {
            document.onmouseup = disableNS;
            document.oncontextmenu = disableIE;
        }
        document.oncontextmenu = new Function("return false");
    </script>
    <script>
        onkeydown = e => {
            let tecla = e.which || e.keyCode;

            // Evaluar si se ha presionado la tecla Ctrl:
            if (e.ctrlKey) {
                // Evitar el comportamiento por defecto del nevagador:
                e.preventDefault();
                e.stopPropagation();

                // Mostrar el resultado de la combinación de las teclas:
                if (tecla === 85)
                    console.log("Ha presionado las teclas Ctrl + U");

                if (tecla === 83)
                    console.log("Ha presionado las teclas Ctrl + S");
            }
        }
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script defer src="../../../js/functions.js"></script>
</body>