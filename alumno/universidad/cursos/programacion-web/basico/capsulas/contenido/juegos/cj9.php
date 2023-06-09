<?php
session_start();
$id_user = $_SESSION['id_alumno_universidad'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_universidad'])) {
	header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_universidad'];
$permiso = "capsulapago1";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_universidad c INNER JOIN detalle_capsulas_pago_universidad d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 1;");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
	header("Location: ../../../../basico/capsulas/contenido/pasarela/capsula1html.php");
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>KOUTILAB</title>
	<link rel="shortcut icon" href="../../../../../../img/lgk.png">

	<link rel="stylesheet" type="text/css" href="../../css/css-juegos/memorama.css">
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

<body>

	<!-- Titulo general -->
	<div class="titulo-gen">
		<h2 class="titulo" style="margin-left: 490px;"><b>MEMORAMA</b></h2>
	</div>

	<!-- Tiempo -->
	<div class="timer">
		<b style="margin-top: 10px;">Tiempo: <br>
			<p id="tiempo"></p>
		</b>
	</div>

	<div class="contenido">

		<a href="#" onclick="history.back(); return false;"><button style="float: left; position: relative; margin: 10px 0 0 10px;" class="btn-b" id="btn-cerrar-modalV">
				<i class="fas fa-reply"></i></button>
		</a>

		<!-- Titulo secundario -->
		<h5 class="titulo"><b>Encuentra todos los pares de tarjetas para poder ganar el juego</b></h5>
		<br>

		<!-- Boton de iniciar juego, al iniciar, desaparece -->
		<div class="nuevo-juego" id="generar" onclick="generarTablero()">
			Iniciar juego
		</div>

		<!-- Generador del tablero -->
		<div id="tablero"></div>

	</div>

	<script>
		//se esta llamando los sonidos de la carpeta "sonidos"
		var Correcto = document.createElement("audio");
		Correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
		var Incorrecto = document.createElement("audio");
		Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

		let cantidadTarjetas = 24;
		let iconos = []
		let selecciones = []

		//Iconos pertenecientes a las tarjetas
		function cargarIconos() {
			iconos = [
				'<i class="fas fa-stopwatch"></i>',
				'<i class="fas fa-hourglass-half"></i>',
				'<i class="fas fa-file-video"></i>',
				'<i class="fas fa-keyboard"></i>',
				'<i class="fab fa-html5"></i>',
				'<i class="fab fa-css3-alt"></i>',
				'<i class="fas fa-folder"></i>',
				'<i class="fas fa-terminal"></i>',
				'<i class="far fa-file-pdf"></i>',
				'<i class="fas fa-link"></i>',
				'<i class="fas fa-code"></i>',
				'<i class="far fa-file-code"></i>'
			]
		}

		//Generador de tablero, inicia el tiempo, carga los iconos y quita el boton de iniciar
		function generarTablero() {
			iniciarTiempo()
			cargarIconos()
			$('#generar').remove();
			let len = iconos.length
			selecciones = []
			let tablero = document.getElementById("tablero")
			let tarjetas = []

			for (let i = 0; i < cantidadTarjetas; i++) {
				tarjetas.push(`
                <div class="area-tarjeta" onclick="seleccionarTarjeta(${i})">
                    <div class="tarjeta" id="tarjeta${i}">
                        <div class="cara trasera" id="trasera${i}">
                            ${iconos[0]}
                        </div>
                        <div class="cara superior">
                            <i class="far fa-question-circle"></i>
                        </div>
                    </div>
                </div>        
                `)
				if (i % 2 == 1) {
					iconos.splice(0, 1)
				}
			}
			tarjetas.sort(() => Math.random() - 0.5)
			tablero.innerHTML = tarjetas.join(" ")
		}

		//Selecionador de tarjetas
		function seleccionarTarjeta(i) {
			let tarjeta = document.getElementById("tarjeta" + i)
			if (tarjeta.style.transform != "rotateY(180deg)") {
				tarjeta.style.transform = "rotateY(180deg)"
				selecciones.push(i)
			}
			if (selecciones.length == 2) {
				deseleccionar(selecciones)
				selecciones = []
			}
		}

		//Quitar seleccion y verificar que la tarjeta sea identica a su par
		function deseleccionar(selecciones) {
			setTimeout(() => {
				let trasera1 = document.getElementById("trasera" + selecciones[0])
				let trasera2 = document.getElementById("trasera" + selecciones[1])
				if (trasera1.innerHTML != trasera2.innerHTML) {
					let tarjeta1 = document.getElementById("tarjeta" + selecciones[0])
					let tarjeta2 = document.getElementById("tarjeta" + selecciones[1])
					tarjeta1.style.transform = "rotateY(0deg)"
					tarjeta2.style.transform = "rotateY(0deg)"
				} else {
					trasera1.style.background = "rgba(61, 172, 244, 0.5)"
					trasera2.style.background = "rgba(61, 172, 244, 0.5)"
				}
				if (verificar()) {
					var xmlhttp = new XMLHttpRequest();

					var param = "score=" + 10 + "&validar=" + 'correcto' + "&permiso=" + 3 + "&id_curso=" + 1; //cancatenation
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
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
									window.location.href = '../../../../../../rutas/ruta-pw-b.php';
								}
							});
						}
					}
					xmlhttp.open("POST", "../../acciones/insertar_cp3.php", true);
					xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xmlhttp.send(param);
				}
			}, 1000);
		}

		//Verificar si ambas son iguales
		function verificar() {
			for (let i = 0; i < cantidadTarjetas; i++) {
				let trasera = document.getElementById("trasera" + i);
				if (trasera.style.background != "rgba(61, 172, 244, 0.5)") {
					return false;
				}
			}
			return true;
		}
	</script>

	<script>
		var segundos = 240;
		let puntos = 0;

		//Funcion que inicia el tiempo y verifica si acabo para dar anuncio de que perdió el jugador
		function iniciarTiempo() {
			document.getElementById('tiempo').innerHTML = segundos + " segundos";
			if (segundos == 0) {
				//se llama a "sonido" y reproducimos el sonido de que esta incorrecto
				Incorrecto.play();

				var xmlhttp = new XMLHttpRequest();

				var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 3 + "&id_curso=" + 1; //cancatenation
				Swal.fire({
					title: 'Oops...',
					text: '¡Verifica tu respuesta!',
					imageUrl: "../../../../../../img/signo.gif",
					imageHeight: 350,
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = 'cj9.php';
					}
				});
				xmlhttp.open("POST", "../../acciones/insertar_cp3.php", true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send(param);
			} else {
				segundos--;
				setTimeout("iniciarTiempo()", 1000);
			}
		}
	</script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>