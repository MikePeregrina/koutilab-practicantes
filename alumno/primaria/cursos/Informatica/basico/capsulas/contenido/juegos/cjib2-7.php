<!DOCTYPE html>
<html>

<head>
	<title>KOUTILAB</title>
	<link rel="shortcut icon" href="../../img/img_juegos/lgk.png">

	<link rel="stylesheet" type="text/css" href="../../css/css-juegos/sopa-letras.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/wordfind.js"></script>
	<script type="text/javascript" src="../../js/wordfindgame1.js"></script>
	<script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body onload="iniciarTiempo();">
	<!-- Titulo general -->
	<div class="titulo-gen">
		<h2 class="titulo"><b>IOS</b></h2>
	</div>


	<div class="timer" id="timer">
		<b style="margin-top: 10px;">Tiempo: <br>
			<p id="tiempo"></p>
		</b>
	</div>

	<div class="contenido">

		<a href="#"><button style="float: left; position: relative; margin: 10px 0 0 10px;" class="btn-b">
			<i class="fas fa-reply"></i></button>
		</a>

		<!-- Titulo secundario -->
		<h4 class="titulo"><b>Busca las palabras ocultas dentro de la sopa de letras</b></h4>
		<br>

		<!-- Sección donde se agregan las palabras a buscar dentro de la sopa de letras -->
		<div class="words">
			<h6><b>Palabras a buscar:</b></h6>
			<div id='Palabras' style="font-size: 120%;"></div>
		</div>

		<div class="linea"></div>

		<!-- Sección donde se agrega la sopa de letras -->
		<div class="soup">
			<div id='juego' style="margin: 0 0 0 40px;"></div>
		</div>

	</div>

    <script>

        //ambos
        //funciona para mostrar el resultado al presionar el boton "comprobar respuestas"
        function marcador() {
            if (mostrar_pantalla_juego_términado) {
                swal.fire({
                    title: "Juego finalizado",
                    text:
                        "Puntuación: " + preguntas_correctas + "/" + "5",//preguntas_hechas
                    icon: "success",
                    confirmButtonText: '¡Genial!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        alertExcelent();
                    }
                });
            }
        }
        //funciona para mostrar el resultado al agotarse el tiempo
        function marcadorTiempoAgotado() {
            if (mostrar_pantalla_juego_términado) {
                swal.fire({
                    title: "Juego finalizado",
                    text:
                        "Puntuación: " + preguntas_correctas + "/" + "5",//preguntas_hechas
                    icon: "success",
                    confirmButtonText: '¡Genial!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        tiempoAgotado();
                    }
                });
            }
        }

        //sirve para mostrar cuando el tiempo se ha acabado al final del juego y recarga la pagina
        function tiempoAgotado() {
            Swal.fire({
                title: 'Mala Suerte',
                text: '¡Mejora tu Tiempo!',
                imageUrl: "../../../capsulas/img/img_juegos/Thumbs-Up copy.gif",
                imageHeight: 350,
                backdrop: `
						rgba(0,143,255,0.6)
						url("../../../capsulas/img/img_juegos/fondo.gif")`,
                confirmButtonColor: '#a14cd9',
                confirmButtonText: '¡Genial!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        }
        //ambos


        //Contador de tiempo en segundos, si se acaba el tiempo sale alerta
        var segundos = 240;

		let puntos = 0;

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
                    div.style.cssText = "animation-name: animation2; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
                }
            if (segundos == 0) {
                Swal.fire({
                    title: 'Oops...',
                    text: '¡El tiempo se acabo!',
                    imageUrl: "../../../capsulas/img/img_juegos/loop.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        marcadorTiempoAgotado();
                        // window.location.reload();
                    }
                });
            } else {
                segundos--;
                setTimeout("iniciarTiempo()", 1000);
            }
        }

        //Alerta muestra de que el juego fue completado
        function alertExcelent() {
            Swal.fire({
                title: 'Excelente',
                text: '¡Buen trabajo!',
                imageUrl: "../../../capsulas/img/img_juegos/Thumbs-Up.gif",
                imageHeight: 350,
                backdrop: `
						rgba(0,143,255,0.6)
						url("../../../capsulas/img/img_juegos/fondo.gif")`,
                confirmButtonColor: '#a14cd9',
                confirmButtonText: '¡Genial!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        }
    </script>


</body>

</html>