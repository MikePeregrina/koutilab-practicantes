<?php
session_start();
$id_user = $_SESSION['id_alumno_preparatoria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_preparatoria'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_preparatoria'];
$permiso = "capsula20";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_preparatoria c INNER JOIN detalle_capsulas_preparatoria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 1");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: ../../../../basico/capsulas/acciones/capsulas.php");
}


//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 21;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_preparatoria WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 1");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_preparatoria WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 1");
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
            <a href="../../../../../../cursos/programacion-web/basico/capsulas/contenido/teoricas/ct7html.php"><button style="float: right; width: 100px; height: 40px;" class="btn-b"><b>Volver a teoría</b></button></a>
            <div class="new-g" style="text-align: center;">Cápsula práctica 7 HTML</div><br>
            <div class="board">
                <table width="100%">
                    <thead>
                        <tr>
                            <td>Instrucciones</td>
                            <td>Ejemplo de resultado</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="nombre">
                                <p>Agrega un archivo PDF solo con código HTML.
                                    Utiliza la etiqueta < iframe>. No debe de incluir títulos fuera del PDF.
                                        <br> <br>
                                </p>
                            </td>
                            <td class="ne">
                                <center><img src="../../../../../../img/pdfpractica.png" style=" height:300px; width: 250px;">
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="">
                <h3>EDITOR DE CÓDIGO</h3>
                <textarea onkeyup="actualizar()" class="cd" id="cd" placeholder="Escribe el código aquí"></textarea>
                <iframe class="editor" id="editor" srcdoc=" "></iframe>
            </div>
            <a style="text-decoration: none;"><button onclick="miFunc()" type="submit" class="btn-grd" id="update" style="width: 20%; margin-top:1%;" disabled>Evaluar</button></a>

        </div>
    </div>
    <script>
        //se esta llamando los sonidos de la carpeta "sonidos"
        var Correcto = document.createElement("audio");
        Correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
        var Incorrecto = document.createElement("audio");
        Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

        function miFunc() {
            // checar que haya por lo menos 1 bold, italics y mark
            var puntos = <?php echo $puntosGanados; ?>;
            var frame = document.getElementById("editor").contentWindow.document;
            let iframe = frame.querySelectorAll("iframe").length;

            if (iframe > 0) {

                let frames = frame.querySelectorAll("iframe").length;

                if (frames > 0) {
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
                                window.location.href = '../../acciones/insertar_pd21.php?validar=' + 'correcto' + '&permiso=' + 21 + '&id_curso=' + 1 + '&practico=' + 10;
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
                                window.location.href = '../../acciones/insertar_pd21.php?validar=' + 'correcto' + '&permiso=' + 21 + '&id_curso=' + 1 + '&practico=' + 10;
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
                                window.location.href = '../../acciones/insertar_pd21.php?validar=' + 'correcto' + '&permiso=' + 21 + '&id_curso=' + 1 + '&practico=' + 10;
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
                                window.location.href = '../../acciones/insertar_pd21.php?validar=' + 'correcto' + '&permiso=' + 21 + '&id_curso=' + 1 + '&practico=' + 10;
                            }
                        });
                    }
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
                            window.location.href = '../../acciones/insertar_pd21.php?validar=' + 'incorrecto' + '&permiso=' + 21 + '&id_curso=' + 1 + '&practico=' + 10;

                        }
                    });
                }
            }
        }
    </script>
    <script src="../../js/fund.js"></script>
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