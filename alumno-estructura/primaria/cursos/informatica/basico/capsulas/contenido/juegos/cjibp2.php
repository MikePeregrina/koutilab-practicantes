<?php
session_start();
$id_user = $_SESSION['id_alumno_primaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_primaria'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_primaria'];
$permiso = "capsulapago2";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_primaria c INNER JOIN detalle_capsulas_pago_primaria d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 7");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../../../../basico/capsulas/contenido/alertas/paquete_premium2.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="../../css/css-juegos/arratrar-y-soltar.css">

    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="img/lgk.png">

</head>
<!-- Parte que modifique Inicio -->

<body onload="iniciarTiempo();">
    <div id="mensaje"></div>
    <div class="timer" id="timer">
        <b>Tiempo: <br>
            <p id="tiempo" style="margin: 0;"></p>
        </b>
    </div>

    <div class="titulo-gen">
        <h1><b>DISPOSITIVOS DE ALMACENAMIENTO</b></h1>
    </div>
    <section>
        <div class="cont-st">
            <a href="../../../../../../rutas/ruta-in-b.php">
                <button class="btn-b" style="float: left; position: relative; margin: 10px 0 0 10px;">
                    <i class="fas fa-reply"></i>
                </button>
            </a>
            <h4 class="titulo"><b>Arrastra el fragmento de código a tipo que le pertenece</b></h4>
        </div>
        <!-- Parte que modifique Final -->
        <div class="caja">
            <div class="caja-img">
                <img src="../../img/img/dispositivo1.jpg" alt="" draggable="true" ondragstart="drag(event)" id="1" class="imagen1">
            </div>
            <!--1 almacena 2 no almacena-->
            <div class="caja-img">
                <img src="../../img/img/dispositivo2.jpg" alt="" draggable="true" ondragstart="drag(event)" id="1" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img/dispositivo6.jpg" alt="" draggable="true" ondragstart="drag(event)" id="2" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img/dispositivo3.jpg" alt="" draggable="true" ondragstart="drag(event)" id="1" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img/dispositivo7.jpg" alt="" draggable="true" ondragstart="drag(event)" id="2" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img/dispositivo4.jpg" alt="" draggable="true" ondragstart="drag(event)" id="1" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img/dispositivo8.jpg" alt="" draggable="true" ondragstart="drag(event)" id="2" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img/dispositivo5.jpg" alt="" draggable="true" ondragstart="drag(event)" id="1" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img/dispositivo9.jpg" alt="" draggable="true" ondragstart="drag(event)" id="2" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img/dispositivo10.jpg" alt="" draggable="true" ondragstart="drag(event)" id="2" class="imagen1">
            </div>
        </div>

        <!-- Caja donde se encuentran los espacios para colocar las imagenes de HTML -->
        <div class="caja">
            <!-- Etiquetas HTML -->
            <div class="htt1" ondrop="drop(event)" id="0" ondragover="allowDrop(event)">
                <div class="html-b-t">ALMACENA</div>
            </div>

            <div class="htt6" ondrop="drop(event)" id="5" ondragover="allowDrop(event)">
                <div class="html-b-t">NO ALMACENA</div>
            </div>

            <div class="htt2" ondrop="drop(event)" id="1" ondragover="allowDrop(event)">
                <div class="html-b-t">ALMACENA</div>
            </div>

            <div class="htt7" ondrop="drop(event)" id="6" ondragover="allowDrop(event)">
                <div class="html-b-t">NO ALMACENA</div>
            </div>

            <div class="htt3" ondrop="drop(event)" id="2" ondragover="allowDrop(event)">
                <div class="html-b-t">ALMACENA</div>
            </div>

            <div class="htt8" ondrop="drop(event)" id="7" ondragover="allowDrop(event)">
                <div class="html-b-t">NO ALMACENA</div>
            </div>

            <div class="htt4" ondrop="drop(event)" id="3" ondragover="allowDrop(event)">
                <div class="html-b-t">ALMACENA</div>
            </div>

            <div class="htt9" ondrop="drop(event)" id="8" ondragover="allowDrop(event)">
                <div class="html-b-t">NO ALMACENA</div>
            </div>

            <div class="htt5" ondrop="drop(event)" id="4" ondragover="allowDrop(event)">
                <div class="html-b-t">ALMACENA</div>
            </div>
            <!---->
            <div class="htt10" ondrop="drop(event)" id="9" ondragover="allowDrop(event)">
                <div class="html-b-t">NO ALMACENA</div>
            </div>

        </div>



        <!-- Parte que modifique Inicio -->
        <div class="btn-v">
            <button class="verificar" onclick="verificar()">Comprobar respuestas</button>
            <button class="recargar" id="recarga" onclick="recargar()">Volver a intentar</button>

        </div>
    </section>

    <footer class="footerimga">
        <div class="imagen-footer">
            <img src="../../img/img_juegos/benvenida.png" alt="No-image">
        </div>
    </footer>
    <!-- Parte que modifique Final -->
    <script>
        var correcto = document.createElement("audio");
        correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
        var incorrecto = document.createElement("audio");
        incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";
        var segundos = 5;

        let puntos = <?php echo $puntosGanados ?>;

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
                var xmlhttp = new XMLHttpRequest();

                var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 10 + "&id_curso=" + 1; //cancatenation
                Swal.fire({
                    title: 'Oops...',
                    text: '¡Verifica tu respuesta!',
                    imageUrl: "../../../../../../img/signo.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
                incorrecto.play();
                xmlhttp.open("POST", "../../acciones/insertar_pd10.php", true);
                xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlhttp.send(param);
            } else {
                segundos--;
                setTimeout("iniciarTiempo()", 1000);
            }
        }
    </script>

    <script>
        //CAMBIO DE JS
        //Funcionamiento

        //Arreglo donde se declara el total de imagenes que se van a ocupar
        let arreglo = ["", "", "", "", "", "", "", "", "", ""];

        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            if (arreglo[parseInt(ev.target.id)] == "") {
                var data = ev.dataTransfer.getData("text");
                arreglo[parseInt(ev.target.id)] = data;
                ev.target.appendChild(document.getElementById(data));

                // Ocultar las letras
                var letras = ev.target.getElementsByClassName("html-b-t");
                for (var i = 0; i < letras.length; i++) {
                    letras[i].style.display = "none";
                }
            }
        }


        //Funcion para validar las respuestas, primero si nungun campo esta vacio y luego si son las correctas
        function verificar() {
            if (arreglo[0] != "" && arreglo[1] != "" && arreglo[2] != "" && arreglo[3] != "" && arreglo[4] != "" && arreglo[5] != "" && arreglo[6] != "" && arreglo[7] != "" && arreglo[8] != "" && arreglo[9] != "") {
                if (arreglo[0] == "1" && arreglo[1] == "1" && arreglo[2] == "1" && arreglo[3] == "1" && arreglo[4] == "1" && arreglo[5] == "2" && arreglo[6] == "2" && arreglo[7] == "2" && arreglo[8] == "2" && arreglo[9] == "2") {
                    Swal.fire({
                        title: '¡Bien hecho! ' + 'Obtuviste ' + puntos + ' trofeos',
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
                            window.location.href = '../../../../../../rutas/ruta-in-b.php';
                        }
                    });
                    correcto.play();
                } else {
                    Swal.fire({
                        title: 'Oops...',
                        text: '¡Verifica tu respuesta!',
                        imageUrl: "../../../../../../img/signo.gif",
                        imageHeight: 350,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../../../../../../rutas/ruta-in-b.php';
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