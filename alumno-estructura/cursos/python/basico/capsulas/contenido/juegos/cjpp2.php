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

    <link rel="stylesheet" href="../../css/css-juegos/arrastrar-y-soltar.css">

    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../../img/img-juegos/lgk.png">

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
        <h1><b>PALABRAS RESERVADAS</b></h1>
    </div>

    <section>
        <div class="cont-st">
            <a href="../../../../../../rutas/ruta-py-b-<?php echo $rol;?>.php">
                <button class="btn-b">
                    <i class="fas fa-reply"></i>
                </button>
            </a>
            <h4 class="titulo"><b>Arrastra el fragmento de código a tipo que le pertenece</b></h4>
        </div>
        <!-- Parte que modifique Final -->
        <div class="caja">
            <div class="caja-img">
                <img src="../../img/img-juegos/altura.png" alt="" draggable="true" ondragstart="drag(event)" id="1" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img-juegos/apellido.png" alt="" draggable="true" ondragstart="drag(event)" id="1" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img-juegos/false.png" alt="" draggable="true" ondragstart="drag(event)" id="2" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img-juegos/color.png" alt="" draggable="true" ondragstart="drag(event)" id="1" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img-juegos/for.png" alt="" draggable="true" ondragstart="drag(event)" id="2" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img-juegos/nombre.png" alt="" draggable="true" ondragstart="drag(event)" id="1" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img-juegos/if.png" alt="" draggable="true" ondragstart="drag(event)" id="2" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img-juegos/peso.png" alt="" draggable="true" ondragstart="drag(event)" id="1" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img-juegos/true.png" alt="" draggable="true" ondragstart="drag(event)" id="1" class="imagen1">
            </div>
            <div class="caja-img">
                <img src="../../img/img-juegos/while.png" alt="" draggable="true" ondragstart="drag(event)" id="1" class="imagen1">
            </div>
        </div>

        <div class="caja">
            <!-- Etiquetas HTML -->
            <div class="htt1" ondrop="drop(event)" id="0" ondragover="allowDrop(event)">
                <div class="html-b-t">VARIABLES</div>
            </div>

            <div class="htt6" ondrop="drop(event)" id="5" ondragover="allowDrop(event)">
                <div class="html-b-t">PALABARAS RESERVADAS</div>
            </div>

            <div class="htt2" ondrop="drop(event)" id="1" ondragover="allowDrop(event)">
                <div class="html-b-t">VARIABLES</div>
            </div>

            <div class="htt7" ondrop="drop(event)" id="6" ondragover="allowDrop(event)">
                <div class="html-b-t">PALABRAS RESERVADAS</div>
            </div>

            <div class="htt3" ondrop="drop(event)" id="2" ondragover="allowDrop(event)">
                <div class="html-b-t">VARIABLES</div>
            </div>

            <div class="htt8" ondrop="drop(event)" id="7" ondragover="allowDrop(event)">
                <div class="html-b-t">PALABRAS RESERVADAS</div>
            </div>

            <div class="htt4" ondrop="drop(event)" id="3" ondragover="allowDrop(event)">
                <div class="html-b-t">VARIABLES</div>
            </div>

            <div class="htt9" ondrop="drop(event)" id="8" ondragover="allowDrop(event)">
                <div class="html-b-t">PALBARAS RESERVADAS</div>
            </div>

            <div class="htt5" ondrop="drop(event)" id="4" ondragover="allowDrop(event)">
                <div class="html-b-t">VARIABLES</div>
            </div>
            <!---->
            <div class="htt10" ondrop="drop(event)" id="9" ondragover="allowDrop(event)">
                <div class="html-b-t">PALABRAS RESERVADAS</div>
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
            <img src="../../img/img-juegos/benvenida.png" alt="No-image">
        </div>
    </footer>
    <!-- Parte que modifique Final -->
    <script>
        var segundos = 240;
        let puntos = 0;

        //se esta llamando los sonidos de la carpeta "sonidos"
        var Correcto = document.createElement("audio");
        Correcto.src = "../../../../../../../acciones/sonidos/correcto.mp3";
        var Incorrecto = document.createElement("audio");
        Incorrecto.src = "../../../../../../../acciones/sonidos/incorrecto.mp3";

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
                Incorrecto.play(); //Agregando sonido al juego no completado
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
                if (arreglo[0] == "1" && arreglo[1] == "2" && arreglo[2] == "1" && arreglo[3] == "2" && arreglo[4] == "1" && arreglo[5] == "2" && arreglo[6] == "1" && arreglo[7] == "2" && arreglo[8] == "1" && arreglo[9] == "2") {
                    // var puntos = <//?php echo $puntosGanados; ?>

                    Swal.fire({
                        title: '¡Bien hecho! ',
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
                            <a href="../../../../../../rutas/ruta-py-b-<?php echo $rol;?>.php">
                        }
                    });
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
                    Correcto.play(); //Agregando sonido al juego completado
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