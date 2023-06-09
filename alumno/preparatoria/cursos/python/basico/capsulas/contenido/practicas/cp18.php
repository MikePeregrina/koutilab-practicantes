<?php
session_start();
$id_user = $_SESSION['id_alumno_preparatoria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_preparatoria'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_preparatoria'];
$permiso = "capsula3";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_preparatoria c INNER JOIN detalle_capsulas_preparatoria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 4");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: ../../../../basico/capsulas/acciones/capsulas.php");
}
//Verificar si ya se tiene permiso y no dar puntos de más
//Verificar si permiso_intento es correcto
$permiso_intento = 28;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_preparatoria WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 4");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_preparatoria WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 4");
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
            <div class="new-g" style="text-align: center;">Cápsula práctica 18</div><br>
            <div class="board">
                <table width="100%">
                    <thead>
                        <tr>
                            <td>Instrucciones</td>
                            <td>Imagen Muestra</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="nombre">
                                <p> Utiliza un bucle "while" para imprimir los números del 1 al 5.
                                </p>
                            </td>
                            <td class="ne">
                                <img src="../../img/code18.png" ">
                                </img>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="">
                <h3>EDITOR DE CÓDIGO</h3>
                <!--
                <textarea onkeyup=" actualizar()" class="cd" id="cd" placeholder="Escribe el código aquí"></textarea>
                                <iframe class="editor" id="editor" srcdoc=" "></iframe> -->
                                <button type="button" class="btn-grd" onclick="copyToClipBoard()" style="width: 5%; padding: 5px; margin: -30px 60px -20px 1050px; scale: 80%;"><i class="fas fa-paste fa-2x"></i></button>

                                <div class="editor-container">
                                    <div class="cd" id="editor"></div>
                                </div>
            </div>
            <a style="text-decoration: none;"><button onclick="miFunc()" type="submit" class="btn-grd" id="update" style="width: 20%; margin-top:1%;">Evaluar</button></a>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.5.3/ace.js"></script>
    <script src="../../js/codePy.js"></script>
    <script src="../../js/fund.js"></script>
    <script>
        //se esta llamando los sonidos de la carpeta "sonidos"
        var Correcto = document.createElement("audio");
        Correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
        var Incorrecto = document.createElement("audio");
        Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

        function miFunc() {

            let ta = document.getElementById('editor').innerText
            // evaluacion del string
            let esCorrecto = ta == '1\n2\n3\n4\n5\ndef es_par(numero):\n    if numero % 2 == 0:\n        return True\n    else:\n        return False';

            if (!esCorrecto) {
                //se llama a "sonido" y reproducimos el sonido de que esta incorrecto
                Incorrecto.play();

                Swal.fire({
                    title: 'Oops...',
                    text: '¡Verifica tu respuesta!',
                    imageUrl: "../../../../../../img/signo.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../../acciones/insertar_pd4.php?validar=' + 'incorrecto' + '&permiso=' + 4 + '&id_curso=' + 4 + '&practico=' + 10;
                    }
                });
            } else {
                //se llama a "sonido" y reproducimos el sonido de que esta correcto
                Correcto.play();

                //UNA SERIE DE CONDICIONALES ANIDADAS LAS CUALES VALIDAN NUESTROS 4 POSIBLES RESULTADOS Y MANDA LA ALERTA CORRESPONDIENTE
                if (puntos == 0) {
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
                            window.location.href = '../../acciones/insertar_pd4.php?validar=' + 'correcto' + '&permiso=' + 4 + '&id_curso=' + 4 + '&practico=' + 10;
                        }
                    });
                } else if (puntos == 6) {
                    Swal.fire({
                        title: '¡Bien hecho! ' + 'Obtuviste ' + puntos + ' puntos prácticos',
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
                            window.location.href = '../../acciones/insertar_pd4.php?validar=' + 'correcto' + '&permiso=' + 4 + '&id_curso=' + 4 + '&practico=' + 10;
                        }
                    });
                } else if (puntos == 8) {
                    Swal.fire({
                        title: '¡Bien hecho! ' + 'Obtuviste ' + puntos + ' puntos prácticos',
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
                            window.location.href = '../../acciones/insertar_pd4.php?validar=' + 'correcto' + '&permiso=' + 4 + '&id_curso=' + 4 + '&practico=' + 10;
                        }
                    });
                } else if (puntos == 10) {
                    Swal.fire({
                        title: '¡Excelente sigue asi! ' + 'Obtuviste ' + puntos + ' puntos prácticos',
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
                            window.location.href = '../../acciones/insertar_pd4.php?validar=' + 'correcto' + '&permiso=' + 4 + '&id_curso=' + 4 + '&practico=' + 10;
                        }
                    });
                }
            }
        }
    </script>

    <script>
        function copyToClipBoard() {
            // Crea un input para poder copiar el texto dentro       
            let copyText = document.getElementById('editor').innerText
            const textArea = document.createElement('textarea');
            textArea.textContent = copyText;
            document.body.append(textArea);
            textArea.select();
            document.execCommand("copy");
            // Delete created Element       
            textArea.remove()
        }
    </script>
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
</body>