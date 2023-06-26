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
    <link rel="shortcut icon" href="../../img/img_juegos/lgk.png">
</head>

<body onload="iniciarTiempo();">
    <!-- Titulo general -->
    <div class="titulo-gen">
        <h2 class="titulo"><b>DISPOSITIVOS DE ALMACENAMIENTO</b></h2> <!--Titulo del juego-->
    </div>

    <!-- Alerta -->
    <div id="mensaje"></div>
    <div class="timer" id="timer">
        <b>Tiempo: <br>
            <p id="tiempo" style="margin: 0;"></p>
        </b>
    </div>

    <!-- Contenido donde se encuentran las imagenes y los espacios donde van a ir -->
    <div class="contenido">
        <a href="#">
            <button class="btn-b" style="float: left; position: relative; margin: 10px 0 0 10px;" >
                <i class="fas fa-reply"></i>
            </button>
        </a>
        <div class="div-vertical"></div>

        <div class="div-horizontal"></div>

        <!-- Descripcion del juego -->
        <div class="cont-st">
            <h4 class="titulo"><b>Arrastra el fragmento de código a tipo que le pertenece</b></h4>
            <br>
        </div>

        <!-- Area donde se encuentran las imagenes inicialmente -->
        <div class="imagenes">
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
        <div class="caja-html" style="font-size: 65%;">
            <!-- Etiquetas HTML -->
            <div class="ht1">
                <div class="html-b-t">ALMACENAN</div>
            </div>
            <div class="ht2">
                <div class="html-b-t">ALMACENAN</div>
            </div>
            <div class="ht3">
                <div class="html-b-t">ALMACENAN</div>
            </div>
            <div class="ht4">
                <div class="html-b-t">ALMACENAN</div>
            </div>
            <div class="ht5">
                <div class="html-b-t">ALMACENAN</div>
            </div>
            <!---->
            <div class="ht6">
                <div class="html-b-t">NO ALMACENAN</div>
            </div>
            <div class="ht7">
                <div class="html-b-t">NO ALMACENAN</div>
            </div>
            <div class="ht8">
                <div class="html-b-t">NO ALMACENAN</div>
            </div>
            <div class="ht9">
                <div class="html-b-t">NO ALMACENAN</div>
            </div>
            <div class="ht10">
                <div class="html-b-t">NO ALMACENAN</div>
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

        <!-- Caja donde se encuentran los espacios para colocar las imagenes de CSS -->
        <!--<div class="caja-css" style="font-size: 65%;">-->
            <!-- Etiquetas CSS -->
            <!-- Contenedores CSS -->
        <!--</div>-->

        <div class="btn-v">
            <button class="verificar" onclick="verificar()">Comprobar respuestas</button>
            <button class="recargar" id="recarga" onclick="recargar()">Volver a intentar</button>
        </div>
    </div>

    <script>
        //Se esta llamando los sonidos de la carpeta "sonidos"
        var correcto = document.createElement("audio");
		correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
	    var incorrecto = document.createElement("audio");
		incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

         var segundos = 240;

let puntos = 0;

function iniciarTiempo() {
    document.getElementById('tiempo').innerHTML = segundos + " segundos";
        //declarando condiciones que permiten cambiar el color de fondo del timer/
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
    div.style.cssText = "animation-name: animation2; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
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
                window.location.href = 'cj3.php';
            }
        });
        incorrecto.play(); //agregando sonido del juego no completado
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
                if (arreglo[0] == "1" && arreglo[1] == "2" && arreglo[2] == "1" && arreglo[3] == "2" && arreglo[4] == "1" && arreglo[5] == "2" && arreglo[6] == "1" && arreglo[7] == "2" && arreglo[8] == "1" && arreglo[9] == "2") {
                        Swal.fire({
                            title: '¡Bien hecho! ' + 'Obtuviste ' + puntos + ' trofeos',
                            text: '¡Puntuación guardada con éxito!',
                            imageUrl: "../../img/img_juegos/Thumbs-Up.gif",
                            imageHeight: 350,
                            backdrop: `
                        rgba(0,143,255,0.6)
                        url("../../img/img_juegos/fondo.gif)
                        `,
                            confirmButtonColor: '#a14cd9',
                            confirmButtonText: 'Aceptar',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '../../../../../../rutas/ruta-pw-b.php';
                            }
                        });
                        correcto.play(); //agregando sonido del juego completado
                } else {
                    Swal.fire({
                        title: 'Oops...',
                        text: '¡Verifica tu respuesta!',
                        imageUrl: "../../../../../../img/signo.gif",
                        imageHeight: 350,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../../../../../../rutas/ruta-pw-b.php';
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