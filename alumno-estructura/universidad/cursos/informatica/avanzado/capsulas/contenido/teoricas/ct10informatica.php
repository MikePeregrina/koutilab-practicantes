<?php
session_start();
$id_user = $_SESSION['id_alumno_universidad'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_universidad'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_universidad'];
$permiso = "capsula22";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_universidad c INNER JOIN detalle_capsulas_universidad d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 9");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: ../../../../avanzado/capsulas/acciones/capsulas.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 23;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_universidad WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 9");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_universidad WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 9");
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
    <link rel="shortcut icon" href="../../../../../../img/lgk.png">
    <link rel="stylesheet" href="../../css/capsula-teoria.css" />
    <link rel="stylesheet" href="../../css/carrusel.css" />
    <link rel="stylesheet" href="./css/laberinto-teoricas.css" /> <!-- Agregar css de laberinto -->
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.2/plyr.css" />
    <script src="https://cdn.plyr.io/3.7.2/plyr.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> <!-- Agregar este -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" /> <!-- Agregar este -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="body">
        <div class="container">
            <a href="#" onclick="history.back(); return false;"><button style="float: left;" class="btn-b" id="btn-cerrar-modalV"><i class="fas fa-reply"></i></button></a>
            <div class="new-g" style="text-align: center;">Cápsula teórica 8 Informatica</div><br>
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
                        <li style="background-image: url('../../img/informatica/1/T8/56.gif'); z-index:0; opacity: 1;"></li>
                        <li style="background-image: url('../../img/informatica/1/T8/57.gif');"></li>
                        <li style="background-image: url('../../img/informatica/1/T8/58.gif');"></li>
                        <li style="background-image: url('../../img/informatica/1/T8/59.gif');"></li>
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
                        <li style="background-image: url('../../img/informatica/1/T8/60.gif');"></li>
                        <li>
                            <div>
                                <form class="forms" id="evaluar" method="POST" enctype="multipart/form-data" action="../../acciones/insertar_teorica.php">
                                    <h2>Para poder avanzar, responde la siguiente pregunta.</h2>
                                    <h1>¿Cuál es una ventaja de descargar plantillas y temas para PowerPoint desde sitios web?</h1>
                                    <div class="container-question">
                                        <input type="checkbox" id="checkbox1" class="check-box" style="scale: 90%;">
                                        <label for="checkbox1">
                                            Mejora el diseño visual de la presentación.
                                        </label>
                                    </div>
                                    <div class="container-question">
                                        <input type="checkbox" id="checkbox2" class="check-box" style="scale: 90%;">
                                        <label for="checkbox2">
                                            Permite insertar enlaces a sitios web relevantes.
                                        </label>
                                    </div>
                                    <div class="container-question">
                                        <input type="checkbox" id="checkbox3" class="check-box" style="scale: 90%;">
                                        <label for="checkbox3">
                                            Permite incorporar contenido de redes sociales.
                                        </label>
                                    </div>
                                    <div class="container-question">
                                        <input type="checkbox" id="checkbox4" class="check-box" style="scale: 90%;">
                                        <label for="checkbox4">
                                            Facilita la colaboración y el intercambio de presentaciones.
                                        </label>
                                        <div class="container-question">
                                            <input type="hidden" name="permiso" value="23">
                                            <input type="hidden" name="teorico" value="10">
                                            <input type="hidden" name="id_curso" value="9">
                                            <input type="hidden" name="validar" id="validar" value="incorrecto">
                                            <input type="hidden" name="redireccion" value="../contenido/teoricas/ct10informatica.php">
                                </form>
                            </div>
                        </li>
                    </ul>
                </section>
        </div>
    </div>
    <footer class="footerimga">
        <div class="imagen-footer">
            <img src="../../img/benvenida.png" alt="No-image">
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
        Correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
        var Incorrecto = document.createElement("audio");
        Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";
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
            if (checkbox2.checked) {
                //UNA SERIE DE CONDICIONALES ANIDADAS LAS CUALES VALIDAN NUESTROS 4 POSIBLES RESULTADOS Y MANDA LA ALERTA CORRESPONDIENTE
                if (puntos == 0) {
                    //se llama a "sonido" y reproducimos el sonido de que esta correcto
                    Correcto.play();
                    //resultado();
                    Swal.fire({
                        title: 'Bien hecho al fin lo lograste. ¡Debes mejorar!',
                        text: '¡Más de 3 intentos, no es posible sumar puntos!',
                        imageUrl: "../../../../../../img/Thumbs-Up.gif",
                        imageHeight: 350,
                        backdrop: `
                    rgba(0,143,255,0.6)
                    url("../../../../../../img/fondo.gif")
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
                        imageUrl: "../../../../../../img/Thumbs-Up.gif",
                        imageHeight: 350,
                        backdrop: `
                    rgba(0,143,255,0.6)
                    url("../../../../../../img/fondo.gif")
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
                        imageUrl: "../../../../../../img/Thumbs-Up.gif",
                        imageHeight: 350,
                        backdrop: `
                    rgba(0,143,255,0.6)
                    url("../../../../../../img/fondo.gif")
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
                        title: '¡Excelente sigue asi! ' + 'Obtuviste ' + puntos + ' puntos teóricos',
                        text: '¡Puntuación guardada con éxito!',
                        imageUrl: "../../../../../../img/Thumbs-Up.gif",
                        imageHeight: 350,
                        backdrop: `
                    rgba(0,143,255,0.6)
                    url("../../../../../../img/fondo.gif")
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

            } else if (checkbox1.checked) {
                //se llama a "sonido" y reproducimos el sonido de que esta incorrecto
                Incorrecto.play();
                Swal.fire({
                    title: 'Oops...',
                    text: '¡Verifica tu respuesta!',
                    imageUrl: "../../../../../../img/signo.gif",
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
                    imageUrl: "../../../../../../img/signo.gif",
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
                    imageUrl: "../../../../../../img/signo.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('evaluar').submit();
                    }
                });
            }
        }
    </script>
    <script src="../../js/validar.js"></script>
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
    <script defer src="../../js/functions.js"></script>
</body>