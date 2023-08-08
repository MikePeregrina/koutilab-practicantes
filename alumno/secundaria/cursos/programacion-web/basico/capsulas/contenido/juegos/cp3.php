<?php 
session_start();
$id_user = $_SESSION['id_alumno_secundaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_secundaria'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_secundaria'];
$permiso = "capsulapago3";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_secundaria c INNER JOIN detalle_capsulas_pago_secundaria d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 1;");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../../../../basico/capsulas/contenido/alertas/paquete_premium3.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../../../../../../img/lgk.png" />
    <link rel="stylesheet" href="../../css/css-juegos/box.css" />
    <script src="script.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body onload="alert1()">
    <div class="titulo-gen">
		<h2 class="titulo"><b>BOX MODEL</b></h2>
	</div>

	<div class="timer">
		<b>Tiempo: <br>
			<p id="tiempo" style="margin: 0 0 0 0;"></p>
		</b>
	</div>

    <div class="contenido">
        <a href="../../../../../../rutas/ruta-pw-b.php"><button style="float: left; position: absolute; margin: 10px 0 0 10px;" class="btn-b" id="btn-cerrar-modalV">
			<i class="fas fa-reply"></i></button>
		</a>

		<!-- Titulo secundario -->
		<h4 class="titulo"><b>Desliza las tarjetas usando el ratón para desplazarlas y colocarlas en el orden correcto</b></h4>
        
        <div class="game">
            <div class="respuestas">
                <div class="imagenes">
                    <div class="caja-img">
                        <img src="../../img/img-juegos/border.png" alt="" draggable="true" ondragstart="drag(event)" id="border" class="imagen1">
                    </div>
                    <div class="caja-img">
                        <img src="../../img/img-juegos/top.png" alt="" draggable="true" ondragstart="drag(event)" id="top" class="imagen1">
                    </div>
                    <div class="caja-img">
                        <img src="../../img/img-juegos/bottom.png" alt="" draggable="true" ondragstart="drag(event)" id="bottom" class="imagen1">
                    </div>
                    <div class="caja-img">
                        <img src="../../img/img-juegos/right.png" alt="" draggable="true" ondragstart="drag(event)" id="right" class="imagen1">
                    </div>
                    <div class="caja-img">
                        <img src="../../img/img-juegos/content.png" alt="" draggable="true" ondragstart="drag(event)" id="content" class="imagen1">
                    </div>
                    <div class="caja-img">
                        <img src="../../img/img-juegos/padding.png" alt="" draggable="true" ondragstart="drag(event)" id="padding" class="imagen1">
                    </div>
                    <div class="caja-img">
                        <img src="../../img/img-juegos/left.png" alt="" draggable="true" ondragstart="drag(event)" id="left" class="imagen1">
                    </div>
                    <div class="caja-img">
                        <img src="../../img/img-juegos/margin.png" alt="" draggable="true" ondragstart="drag(event)" id="margin" class="imagen1">
                    </div>
                </div>
            </div>
            <div class="cuadro-juego">
                <!-- Content -->
                <div class="box1" ondrop="drop(event)" id="0" ondragover="allowDrop(event)"></div>
                
                <!-- Padding -->
                <div class="box2" ondrop="drop(event)" id="1" ondragover="allowDrop(event)"></div>
                
                <!-- Border -->
                <div class="box3" ondrop="drop(event)" id="2" ondragover="allowDrop(event)"></div>                    
                
                <!-- Margin -->
                <div class="box4" ondrop="drop(event)" id="3" ondragover="allowDrop(event)"></div>
                
                <!-- Top -->
                <div class="box5" ondrop="drop(event)" id="4" ondragover="allowDrop(event)"></div>
                
                <!-- Bottom -->
                <div class="box6" ondrop="drop(event)" id="5" ondragover="allowDrop(event)"></div>
                
                <!-- Left -->
                <div class="box7" ondrop="drop(event)" id="6" ondragover="allowDrop(event)"></div>
                
                <!-- Right -->
                <div class="box8" ondrop="drop(event)" id="7" ondragover="allowDrop(event)"></div>
                
                <div class="cuadro"></div>
            </div>
        </div>
        <div class="btn-v">
            <button class="verificar" onclick="verificar()">Comprobar respuestas</button>
            <button class="recargar" id="recarga" onclick="recargar()">Volver a intentar</button>
        </div>
        
    </div>
         <!-- CAMBIOS -->
	<footer class="footerimga">
		<div class="imagen-footer">
			<img src="../../img/img-juegos/benvenida.png" alt="No-image">
		</div>
	</footer>
<!-- fIN CAMBIOS -->
</body>
<script>
    function alert1() {
        Swal.fire({
            title: '¡Hola!',
            text: 'Koubot quiere repasar lo aprendido sobre Box Model, ¿Podrías ayudarlo a saber cual es el nombre de cada capa del Box Model?',
            imageUrl: "../../img/img-juegos/mascota-1.png",
            imageHeight: 320,
            confirmButtonText: '¡Vamos!',
            confirmButtonColor: '#85c42c',
        }).then((result) => {
            if (result.isConfirmed) {
                iniciarTiempo();
            }
        });
    }
</script>
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
            Swal.fire({
                title: 'Oops...',
                text: '¡Se acabó el tiempo!',
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
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
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


</script>
<script>
    //Funcion para validar las respuestas, primero si nungun campo esta vacio y luego si son las correctas
    function verificar() {
        if (arreglo[0] != "" && arreglo[1] != "" && arreglo[2] != "" && arreglo[3] != "" && arreglo[4] != "" && arreglo[5] != "" && arreglo[6] != "" && arreglo[7]) {
            if (arreglo[0] == "border" && arreglo[1] == "top" && arreglo[2] == "bottom" && arreglo[3] == "right" && arreglo[4] == "content" && arreglo[5] == "padding" && arreglo[6] == "left" && arreglo[7] == "margin") {
                xmlhttp.onreadystatechange = function() {
                    Swal.fire({
                        title: '¡Bien hecho!',
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
                            window.location.href = '../../../../../../rutas/ruta-pw-b.php';
                        }
                    });
                    correcto.play(); //agregando sonido al juego completado
                }
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


    //Funcion para recargar pagina
    let recargar = document.getElementById('recarga');
    recargar.addEventListener('click', _ => {
        location.reload();
    })
</script>

</html>