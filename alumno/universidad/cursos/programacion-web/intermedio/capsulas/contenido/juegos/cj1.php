<!-- Este juego debe insertar el permiso 4 -->
<?php
session_start();
$id_user = $_SESSION['id_alumno_universidad'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_universidad'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_universidad'];
$permiso = "capsula3";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_universidad c INNER JOIN detalle_capsulas_universidad d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 2");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: ../../../../intermedio/capsulas/acciones/capsulas.php");
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
    <link rel="stylesheet" href="../../css/css-juegos/drag-drop.css">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../../../../../../img/lgk.png">
</head>

<body onload="iniciarTiempo();">
    <!-- Titulo general -->
    <div class="titulo-gen">
        <h2 class="titulo" style="margin-left: 465px;"><b>ARRASTRAR Y SOLTAR</b></h2>
    </div>

    <div class="timer">
        <b style="margin-top: 10px;">Tiempo: <br>
            <p id="tiempo"></p>
        </b>
    </div>

    <!-- Alerta -->
    <div id="mensaje"></div>

    <!-- Contenido donde se encuentran las imagenes y los espacios donde van a ir -->
    <div class="contenido">

        <a href="#" onclick="history.back(); return false;"><button style="float: left; position: relative" class="btn-b" id="btn-cerrar-modalV">
                <i class="fas fa-reply"></i></button>
        </a>

        <div class="div-vertical"></div>

        <div class="div-horizontal"></div>

        <!-- Titulo secundario -->
        <h4 class="titulo"><b>Arrastra el fragmento de código a tipo que le pertenece</b></h4>
        <br>

        <!-- Area donde se encuentran las imagenes inicialmente -->
        <div class="imagenes">
            <div class="caja-img">
                <img src="../../img/img_juegos/img/especial1.png" alt="" draggable="true" ondragstart="drag(event)" id="html" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img_juegos/img/especial2.png" alt="" draggable="true" ondragstart="drag(event)" id="html" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img_juegos/img/acentuado1.png" alt="" draggable="true" ondragstart="drag(event)" id="css" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img_juegos/img/especial3.png" alt="" draggable="true" ondragstart="drag(event)" id="html" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img_juegos/img/acentuado2.png" alt="" draggable="true" ondragstart="drag(event)" id="css" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img_juegos/img/especial4.png" alt="" draggable="true" ondragstart="drag(event)" id="html" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img_juegos/img/acentuado3.png" alt="" draggable="true" ondragstart="drag(event)" id="css" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img_juegos/img/especial5.png" alt="" draggable="true" ondragstart="drag(event)" id="html" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img_juegos/img/acentuado4.png" alt="" draggable="true" ondragstart="drag(event)" id="css" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img_juegos/img/acentuado5.png" alt="" draggable="true" ondragstart="drag(event)" id="css" class="imagen1">
            </div>
        </div>

        <!-- Caja donde se encuentran los espacios para colocar las imagenes de HTML -->
        <div class="caja-html">
            <!-- Etiquetas HTML -->
            <div class="ht1">
                <div class="html-b-t">ESPECIALES</div>
            </div>
            <div class="ht2">
                <div class="html-b-t">ESPECIALES</div>
            </div>
            <div class="ht3">
                <div class="html-b-t">ESPECIALES</div>
            </div>
            <div class="ht4">
                <div class="html-b-t">ESPECIALES</div>
            </div>
            <div class="ht5">
                <div class="html-b-t">ESPECIALES</div>
            </div>

            <!-- Contenedores HTML -->
            <div class="caja-contenedor">
                <div class="box" ondrop="drop(event)" id="0" ondragover="allowDrop(event)"></div>
            </div>
            <div class="caja-contenedor">
                <div class="box" ondrop="drop(event)" id="1" ondragover="allowDrop(event)"></div>
            </div>
            <div class="caja-contenedor">
                <div class="box" ondrop="drop(event)" id="2" ondragover="allowDrop(event)"></div>
            </div>
            <div class="caja-contenedor">
                <div class="box" ondrop="drop(event)" id="3" ondragover="allowDrop(event)"></div>
            </div>
            <div class="caja-contenedor">
                <div class="box" ondrop="drop(event)" id="4" ondragover="allowDrop(event)"></div>
            </div>
        </div>



        <!-- Caja donde se encuentran los espacios para colocar las imagenes de CSS -->
        <div class="caja-css">
            <!-- Etiquetas CSS -->
            <div class="ht1">
                <div class="html-b-t">ACENTUADO</div>
            </div>
            <div class="ht2">
                <div class="html-b-t">ACENTUADO</div>
            </div>
            <div class="ht3">
                <div class="html-b-t">ACENTUADO</div>
            </div>
            <div class="ht4">
                <div class="html-b-t">ACENTUADO</div>
            </div>
            <div class="ht5">
                <div class="html-b-t">ACENTUADO</div>
            </div>

            <!-- Contenedores CSS -->
            <div class="caja-contenedor">
                <div class="box" ondrop="drop(event)" id="5" ondragover="allowDrop(event)"></div>
            </div>
            <div class="caja-contenedor">
                <div class="box" ondrop="drop(event)" id="6" ondragover="allowDrop(event)"></div>
            </div>
            <div class="caja-contenedor">
                <div class="box" ondrop="drop(event)" id="7" ondragover="allowDrop(event)"></div>
            </div>
            <div class="caja-contenedor">
                <div class="box" ondrop="drop(event)" id="8" ondragover="allowDrop(event)"></div>
            </div>
            <div class="caja-contenedor">
                <div class="box" ondrop="drop(event)" id="9" ondragover="allowDrop(event)"></div>
            </div>
        </div>
        <div class="btn-v">
            <button class="verificar" onclick="verificar()">Comprobar respuestas</button>
            <button class="recargar" id="recarga" onclick="recargar()">Volver a intentar</button>
        </div>
    </div>

    <script>
        //se esta llamando los sonidos de la carpeta "sonidos"
        var Correcto = document.createElement("audio");
        Correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
        var Incorrecto = document.createElement("audio");
        Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

        var segundos = 180;

        let puntos = 0;

        function iniciarTiempo() {
            document.getElementById('tiempo').innerHTML = segundos + " segundos";
            if (segundos == 0) {
                //se llama a "sonido" y reproducimos el sonido de que esta incorrecto
                Incorrecto.play();

                var xmlhttp = new XMLHttpRequest();

                var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 4 + "&id_curso=" + 2; //cancatenation
                Swal.fire({
                    title: 'Oops...',
                    text: '¡Verifica tu respuesta!',
                    imageUrl: "../../../../../../img/signo.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'cj1.php';
                    }
                });
                xmlhttp.open("POST", "../../acciones/insertar_pd4.php", true);
                xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlhttp.send(param);
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
                if (arreglo[0] == "html" && arreglo[1] == "html" && arreglo[2] == "html" && arreglo[3] == "html" && arreglo[4] == "html" && arreglo[5] == "css" && arreglo[6] == "css" && arreglo[7] == "css" && arreglo[8] == "css" && arreglo[9] == "css") {
                    var xmlhttp = new XMLHttpRequest();

                    var param = "score=" + 10 + "&validar=" + 'correcto' + "&permiso=" + 4 + "&id_curso=" + 2; //cancatenation

                    xmlhttp.onreadystatechange = function() {
                        //se llama a "sonido" y reproducimos el sonido de que esta correcto
                        Correcto.play();

                        Swal.fire({
                            title: '¡Bien hecho!',
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
                                window.location.href = '../../../../../../rutas/ruta-pw-i.php';
                            }
                        });
                    }
                    xmlhttp.open("POST", "../../acciones/insertar_pd4.php", true);
                    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xmlhttp.send(param);
                } else {
                    //se llama a "sonido" y reproducimos el sonido de que esta incorrecto
                    Incorrecto.play();

                    var xmlhttp = new XMLHttpRequest();

                    var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 4 + "&id_curso=" + 2; //cancatenation
                    Swal.fire({
                        title: 'Oops...',
                        text: '¡Verifica tu respuesta!',
                        imageUrl: "../../../../../../img/signo.gif",
                        imageHeight: 350,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../../../../../../rutas/ruta-pw-i.php';
                        }
                    });
                    xmlhttp.open("POST", "../../acciones/insertar_pd4.php", true);
                    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xmlhttp.send(param);
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