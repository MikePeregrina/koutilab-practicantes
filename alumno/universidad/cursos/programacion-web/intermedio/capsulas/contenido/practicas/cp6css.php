<?php
session_start();
$id_user = $_SESSION['id_alumno_universidad'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_universidad'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_universidad'];
$permiso = "capsulapago4";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_universidad c INNER JOIN detalle_capsulas_pago_universidad d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 2;");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../../../../intermedio/capsulas/contenido/alertas/paquete_premium4.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
//Verificar si permiso_intento es correcto
$permiso_intento = 28;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_universidad WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 2");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

// //Contar total de intentos
// $consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_universidad WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 2");
// $resultadoIntentos = mysqli_fetch_assoc($consultaIntentos);
// if (isset($resultadoIntentos['intentos'])) {
//     $totalIntentos = $resultadoIntentos['intentos'];
//     if ($totalIntentos == 2 && $result_sql_permisos == 0) {
//         $puntosGanados = 8;
//     } else if ($totalIntentos == 3 && $result_sql_permisos == 0) {
//         $puntosGanados = 6;
//     } else if ($totalIntentos > 3 && $result_sql_permisos == 0) {
//         $puntosGanados = 0;
//     } else {
//         $puntosGanados = 0;
//     }
// } else {
//     $puntosGanados = 10;
// }

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../../../../../../img/lgk.png">
    <link rel="stylesheet" href="../../css/capsula-practica.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="body">
        <div class="container">
            <a href="#" onclick="history.back(); return false;"><button style="float: left;" class="btn-b" id="btn-cerrar-modalV"><i class="fas fa-reply"></i></button></a>
            <a href="../../../../../../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct6css.php"><button style="float: right; width: 100px; height: 40px;" class="btn-b"><b>Volver a teoría</b></button></a>
            <div class="new-g" style="text-align: center;">Cápsula práctica 6 CSS</div><br>
            <div class="board">
                <table width="100%">
                    <thead>
                        <tr>
                            <td>Instrucciones</td>
                            <td>Ejemplo del resultado</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="nombre">
                                <p> En un documento html crea 6 div 3n el cual les establezcan
                                    u orden o bien puedes alterar cada una de sus posiciones y
                                    a uno de los div dale un flexx-grow, flex ,flex-shrink, flex-basis.
                                    Como se muestra a continuación:
                                    <br><br>
                                </p>
                            </td>
                            <td class="ne">
                                <img src="../../../../../../img/practica6cssI.png" style="height: 90px; width: 600px;">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="editor-container">
                <h3 style="margin-bottom: 20px;">EDITOR DE CÓDIGO</h3>
                <!--
                <textarea onkeyup="actualizar()" class="cd" id="cd" placeholder="Escribe el código aquí"></textarea>
                <iframe class="editor" id="editor" srcdoc=" "></iframe> -->
                <!-- <button type="button" class="btn-grd" onclick="copyToClipBoard()" style="width: 5%; padding: 5px; margin: -30px 60px -20px 1050px; scale: 80%;"><i class="fas fa-paste fa-2x"></i></button> -->

                <div class="editor1">
                    <div class="titulo-edit1">
                        <h6>HTML</h6>
                    </div>
                    <div class="titulo-edit2">
                        <h6>CSS</h6>
                    </div>
                    <div class="titulo-edit3">
                        <h6>JAVASCRIPT</h6>
                    </div>
                    <div class="titulo-edit4">
                        <h6>SALIDA</h6>
                    </div>
                    <textarea onkeyup="actualizar()" id="html-code" class="cd" placeholder="Escribe el código HTML aquí"></textarea>
                    <textarea onkeyup="actualizar()" id="css-code" class="cd1" placeholder="Escribe el código CSS aquí"></textarea>
                    <textarea onkeyup="actualizar()" id="js-code" class="cd2" placeholder="Escribe el código JavaScript aquí"></textarea> <br>
                    <iframe id="output" class="editor" style="margin-top: 20px;"></iframe>
                </div>

            </div>
            <a style="text-decoration: none;"><button onclick="miFunc()" type="submit" class="btn-grd" id="update" disabled>Evaluar</button></a>
        </div>
    </div>
    <script src="../../js/editor.js"></script>
    <script type="text/javascript">
        function run() {
            let htmlCode = document.querySelector(".editor1 #html-code").value;
            let cssCode = "<style>" + document.querySelector(".editor1 #css-code").value + "</style>";
            let jsCode = document.querySelector(".editor1 #js-code").value;
            let output = document.querySelector(".editor1 #output");

            output.contentDocument.body.innerHTML = htmlCode + cssCode;
            output.contentWindow.eval(jsCode);
        }
        document.querySelector(".editor1 #html-code").addEventListener("keyup", run);
        document.querySelector(".editor1 #css-code").addEventListener("keyup", run);
        document.querySelector(".editor1 #js-code").addEventListener("keyup", run);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.5.3/ace.js"></script>
    <script>
        //se esta llamando los sonidos de la carpeta "sonidos"
        var Correcto = document.createElement("audio");
        Correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
        var Incorrecto = document.createElement("audio");
        Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

        function miFunc() {

            let htmlcode = document.getElementById("html-code").value;
            let csscode = document.getElementById("css-code").value;
            let jscode = document.getElementById("js-code").value;

            var frame = document.getElementById("output").contentWindow.document;
            //Validando etiquetas utilizadas
            let div = frame.querySelectorAll("div").length;
            console.log("div: " + div);
            //Validando aparición de atributos
            let order = contOcurrencias(csscode, 'order');
            console.log("Order: " + order);

            if (csscode.toLowerCase().indexOf('order') !== -1) {
                console.log("Si aparece order en CSS");
            } else {
                console.log("No hay order en CSS");
            }

            if (csscode.toLowerCase().indexOf('flex') !== -1) {
                console.log("Si aparece flex en CSS");
            } else {
                console.log("No hay flex en CSS");
            }

            if (csscode.toLowerCase().indexOf('flex-grow') !== -1) {
                console.log("Si aparece flex-grow en CSS");
            } else {
                console.log("No hay flex-grow en CSS");
            }

            if (csscode.toLowerCase().indexOf('flex-shrink') !== -1) {
                console.log("Si aparece flex-shrink en CSS");
            } else {
                console.log("No hay flex-shrink en CSS");
            }

            if (csscode.toLowerCase().indexOf('flex-basis') !== -1) {
                console.log("Si aparece flex-basis en CSS");
            } else {
                console.log("No hay flex-basis en CSS");
            }

            if (div >= 6 && order == 6 && csscode.toLowerCase().indexOf('flex') !== -1 && csscode.toLowerCase().indexOf('flex-grow') !== -1 && csscode.toLowerCase().indexOf('flex-shrink') !== -1 && csscode.toLowerCase().indexOf('flex-basis') !== -1) {
                //se llama a "sonido" y reproducimos el sonido de que esta correcto
                Correcto.play();

                Swal.fire({
                    title: '¡Excelente sigue asi! ' + 'Obtuviste ' + 10 + ' puntos prácticos',
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
                        window.location.href = '../../acciones/insertar_cp11.php?validar=' + 'correcto' + '&permiso=' + 20 + '&id_curso=' + 2 + '&practico=' + 10;
                    }
                });

            } else {
                //se llama a "sonido" y reproducimos el sonido de que esta correcto
                Incorrecto.play();

                Swal.fire({
                    title: 'Oops...',
                    text: '¡Verifica tu respuesta!',
                    imageUrl: "../../../../../../img/signo.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../../acciones/insertar_cp11.php?validar=' + 'incorrecto' + '&permiso=' + 20 + '&id_curso=' + 2 + '&practico=' + 10;
                    }
                });
            }
        }
    </script>
    <script>
        function copyToClipBoard() {
            var content = document.getElementById('editor');
            content.select();
            document.execCommand('copy');
        }
    </script>
    <script>
        //Función para contar las veces que aparece una cadena dentro de otra
        function contOcurrencias(cadena, subcadena) {
            let apariciones = 0;
            let i = 0;

            while ((i = cadena.indexOf(subcadena, i)) !== -1) {
                apariciones++;

                i += subcadena.length;
            }
            return apariciones;
        }

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
</body>