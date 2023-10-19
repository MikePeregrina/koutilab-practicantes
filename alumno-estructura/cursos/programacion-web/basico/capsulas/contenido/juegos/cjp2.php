<?php
session_start();
$id_user = $_SESSION['id_alumno'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno'];
$permiso = "capsulapago2";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 1;");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../../../../basico/capsulas/contenido/alertas/paquete_premium2.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../../css/css-juegos/drag-drop.css"> <!---linkeo de la hoja de estilos-->
    <title>KOUTILAB</title><!--titulo del proyecto-->
    <link rel="shortcut icon" href="../../../../../../img/lgk.png" />
</head>

<body onload="iniciarTiempo();">
    <!-- Alerta -->
    <div id="mensaje"></div>
    <div class="timer" id="timer">
        <b>Tiempo: <br>
            <p id="tiempo" style="margin: 0;"></p>
        </b>
    </div>
    <!-- Titulo general -->
    <div class="titulo-gen">
        <h2 class="titulo"><b>MENÚ</b></h2> <!--Titulo del juego-->
    </div>
    <!-- Contenido donde se encuentran las imagenes y los espacios donde van a ir -->
    <section>
        <div class="cont-st">
            <a href="../../../../../../rutas/ruta-pw-b.php">
                <button class="btn-b">
                    <i class="fas fa-reply"></i>
                </button>
            </a>
            <h4 class="titulo"><b>Arrastra el fragmento de código a tipo que le pertenece</b></h4>
        </div>
        <!-- Parte que modifique Final -->

        <!-- Area donde se encuentran las imagenes inicialmente -->
        <div class="caja">
            <div class="caja-img">
                <img src="../../img/img-juegos/menu-horizontal1.png" alt="" draggable="true" ondragstart="drag(event)" id="horizontal" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img-juegos/menu-horizontal2.png" alt="" draggable="true" ondragstart="drag(event)" id="horizontal" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img-juegos/menu-vertical1.png" alt="" draggable="true" ondragstart="drag(event)" id="vertical" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img-juegos/menu-horizontal3.png" alt="" draggable="true" ondragstart="drag(event)" id="horizontal" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img-juegos/menu-vertical2.png" alt="" draggable="true" ondragstart="drag(event)" id="vertical" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img-juegos/menu-horizontal4.png" alt="" draggable="true" ondragstart="drag(event)" id="horizontal" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img-juegos/menu-vertical3.png" alt="" draggable="true" ondragstart="drag(event)" id="vertical" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img-juegos/menu-horizontal5.png" alt="" draggable="true" ondragstart="drag(event)" id="horizontal" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img-juegos/menu-vertical4.png" alt="" draggable="true" ondragstart="drag(event)" id="vertical" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img-juegos/menu-vertical5.png" alt="" draggable="true" ondragstart="drag(event)" id="vertical" class="imagen1">
            </div>
        </div>

        <!-- Caja donde se encuentran los espacios para colocar las imagenes de HTML -->
        <div class="caja">
            <!-- Etiquetas HTML -->
            <div class="htt1" ondrop="drop(event)" id="0" ondragover="allowDrop(event)">
                <div class="html-b-t">Menú Horizontal</div>
            </div>
            <div class="htt2" ondrop="drop(event)" id="1" ondragover="allowDrop(event)">
                <div class="html-b-t">Menú Horizontal</div>
            </div>
            <div class="htt3" ondrop="drop(event)" id="2" ondragover="allowDrop(event)">
                <div class="html-b-t">Menú Horizontal</div>
            </div>
            <div class="htt4" ondrop="drop(event)" id="3" ondragover="allowDrop(event)">
                <div class="html-b-t">Menú Horizontal</div>
            </div>
            <div class="htt5" ondrop="drop(event)" id="4" ondragover="allowDrop(event)">
                <div class="html-b-t">Menú Horizontal</div>
            </div>
            <!---->
            <div class="htt6" ondrop="drop(event)" id="5" ondragover="allowDrop(event)">
                <div class="html-b-t">Menú Vertical</div>
            </div>
            <div class="htt7" ondrop="drop(event)" id="6" ondragover="allowDrop(event)">
                <div class="html-b-t">Menú Vertical</div>
            </div>
            <div class="htt8" ondrop="drop(event)" id="7" ondragover="allowDrop(event)">
                <div class="html-b-t">Menú Vertical</div>
            </div>
            <div class="htt9" ondrop="drop(event)" id="8" ondragover="allowDrop(event)">
                <div class="html-b-t">Menú Vertical</div>
            </div>
            <div class="htt10" ondrop="drop(event)" id="9" ondragover="allowDrop(event)">
                <div class="html-b-t">Menú Vertical</div>
            </div>

        </div>

        <!-- Caja donde se encuentran los espacios para colocar las imagenes de CSS -->
        <!--<div class="caja-css" style="font-size: 65%;">-->
        <!-- Etiquetas CSS -->
        <!-- Contenedores CSS -->
        <!--</div>-->

        <div class="btn-v">
            <button class="verificar" onclick="verificar()">Comprobar respuestas</button>
            <button class="recargar" id="recarga" onclick="recargar()">Volver a intentar</button>
        </div>
    </section>

    <footer class="footerimga">
        <div class="imagen-footer">
            <img src="../../img/img-juegos/benvenida.png" alt="No-image">
        </div>
    </footer>
    <script>
        var segundos = 240;
        let puntos = 0;

        //Funcion que agrega el sonido al juego
        var correcto = document.createElement("audio");
        correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
        var incorrecto = document.createElement("audio");
        incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

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
                Swal.fire({
                    title: 'Oops...',
                    text: '¡Verifica tu respuesta!',
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
    </script>

    <script>
        //Funcionamiento

        //Arreglo donde se declara el total de imagenes que se van a ocupar
        let arreglo = ["", "", "", "", "", "", "", "", "", ""];

        //Funcion para mantener alojada una imagen en un espacio vacio
        function allowDrop(ev) {
            ev.preventDefault();
        }

        //Funcion para poder arrastrar las imagenes y tomar el valor que tiene en id
        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        //Funcion para la transferencia del id al campo vacio solo si esta vacio
        function drop(ev) {
            if (arreglo[parseInt(ev.target.id)] == "") {
                var data = ev.dataTransfer.getData("text");
                arreglo[parseInt(ev.target.id)] = data;
                ev.target.appendChild(document.getElementById(data));
            }
        }

        //Funcion para validar las respuestas, primero si nungun campo esta vacio y luego si son las correctas
        function verificar() {
            if (arreglo[0] != "" && arreglo[1] != "" && arreglo[2] != "" && arreglo[3] != "" && arreglo[4] != "" && arreglo[5] != "" && arreglo[6] != "" && arreglo[7] != "" && arreglo[8] != "" && arreglo[9] != "") {
                if (arreglo[0] == "horizontal" && arreglo[1] == "horizontal" && arreglo[2] == "vertical" && arreglo[3] == "horizontal" && arreglo[4] == "vertical" && arreglo[5] == "horizontal" && arreglo[6] == "vertical" && arreglo[7] == "horizontal" && arreglo[8] == "vertical" && arreglo[9] == "vertical") {
                    Swal.fire({
                        title: '¡Bien hecho! ' + 'Obtuviste ' + puntos + ' trofeos',
                        text: '¡Puntuación guardada con éxito!',
                        imageUrl: "../../img/img-juegos/Thumbs-Up.gif",
                        imageHeight: 350,
                        backdrop: `
                        rgba(0,143,255,0.6)
                        url("../../img/img-juegos/fondo.gif")
                        `,
                        confirmButtonColor: '#a14cd9',
                        confirmButtonText: 'Aceptar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'acciones/insertar_ep1.php?id_capsula=' + 2 + '&id_curso=' + 1 + '&estrellas=' + 15;
                        }
                    });
                    correcto.play(); //agregando sonido al juego completado
                } else {
                    Swal.fire({
                        title: 'Oops...',
                        text: '¡Verifica tu respuesta!',
                        imageUrl: "../../img/img-juegos/loop.gif",
                        imageHeight: 350,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
            }
        }
    </script>
    <script>
        //Funcion para recargar pagina
        let recargar = document.getElementById('recarga');
        recargar.addEventListener('click', _ => {
            location.reload();
        })
    </script>
</body>

</html>