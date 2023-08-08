<?php
session_start();
$id_user = $_SESSION['id_alumno_secundaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_secundaria'])) {
	header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_secundaria'];
$permiso = "capsula3";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_secundaria c INNER JOIN detalle_capsulas_secundaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 11");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
	header("Location: ../../../../intermedio/capsulas/acciones/capsulas.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 4;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_secundaria WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 11");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_secundaria WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 11");
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
<html>

<head>
	<title>KOUTILAB</title>
	<link rel="shortcut icon" href="img/lgk.png">
	<link rel="stylesheet" type="text/css" href="../../css/css-juegos/memorama.css"> <!--Linkeo de la hoja de estilos-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
	<!-- CAMBIOS -->
	<!-- Timer -->
	<div class="timer" id="timer">
		<b>Tiempo: <br>
			<p id="tiempo" style="margin: 0 0 0 0;"></p>
		</b>
	</div>

	<!-- Titulo general -->
	<div class="titulo-gen">
		<h2 class="titulo"><b>MENU DE SELECCION DE PERSONAJE</b></h2>
	</div>

	<section>

		<div class="cont-st">
			<a href="#" onclick="history.back();"><button style="float: left; position: relative; margin: 10px 0 0 10px;" class="btn-b">
					<i class="fas fa-reply"></i></button>
			</a>

			<h6 class="titulo"><b>Encuentra todos los pares de tarjetas para poder ganar el juego</b></h6>
		</div>
		<!-- Boton de iniciar juego, al iniciar, desaparece -->
		<div class="nuevo-juego" id="generar" onclick="generarTablero()">
			Iniciar juego
		</div>

		<!-- Generador del tablero -->
		<div id="tablero"></div>

	</section>

	<!-- CAMBIOS -->
	<footer class="footerimga">
		<div class="imagen-footer">
			<img src="../../img/img-juegos/benvenida.png" alt="No-image">
		</div>
	</footer>
	<!-- fIN CAMBIOS -->

	<script>
		let cantidadTarjetas = 24;
		let iconos = []
		let selecciones = []


		//Iconos pertenecientes a las tarjetas

		function cargarIconos() {
			iconos = [
				'<i class="fa-solid fa-person"></i>',
				'<i class="fa-solid fa-person-rifle"></i>',
				'<i class="fa-solid fa-gamepad"></i>',
				'<i class="fa-brands fa-unity"></i>',
				'<i><img src="../../img/OIP.jpg"  width= "50px"></i>',
				'<i><img src="../../img/OIP (1).jpg" width= "50px"></i>',
				'<i><img src="../../img/images.jpg" width= "50px"></i>',
				'<i><img src="../../img/descarga (1).jpg" width= "50px"></i>',
				'<i><img src="../../img/OIP (2).jpg" width= "50px"></i>',
				'<i><img src="../../img/OIP (3).jpg" width= "50px"></i>',
				'<i><img src="../../img/descarga (2).jpg" width= "50px"></i>',
				'<i><img src="../../img/OIP (4).jpg" width= "50px"></i>'
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
					trasera1.style.background = "rgba(149, 255, 0, 0.45)" /*Se cambia el color de la tarjeta cuando es el par en color verde*/
					trasera2.style.background = "rgba(149, 255, 0, 0.45)" /*Se cambia el color de la tarjeta cuando es el par en color verde*/
				}
				if (verificar()) {
					var xmlhttp = new XMLHttpRequest();
					var param = "score=" + 10 + "&validar=" + 'correcto' + "&permiso=" + 4 + "&id_curso=" + 11; //cancatenation
					xmlhttp.open("POST", "../../acciones/insertar_pd4.php", true);
					xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xmlhttp.send(param);
					Swal.fire({
						title: '¡Bien hecho!',
						text: '¡Puntuación guardada con éxito!',
						imageUrl: "../../img/img-juegos/Thumbs-Up.gif",
						imageHeight: 300,
						backdrop: `
									rgba(0,143,255,0.6)
									url("../../img/img-juegos/fondo.gif")
									`,
						confirmButtonColor: '#a14cd9',
						confirmButtonText: 'Aceptar',
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href = '../../../../../../rutas/ruta-vj-i.php';
						}
					});
					Correcto.play(); //agregando sonido al juego completado
				}
			}, 1000);
		}
		//Verificar si ambas son iguales
		function verificar() {
			for (let i = 0; i < cantidadTarjetas; i++) {
				let trasera = document.getElementById("trasera" + i);
				if (trasera.style.background != "rgba(149, 255, 0, 0.45)") {
					return false;
				}
			}
			return true;
		}
	</script>

	<script>
		var Correcto = document.createElement("audio");
		Correcto.src = ".../../sonidos/correcto.mp3";
		var Incorrecto = document.createElement("audio");
		Incorrecto.src = "../../sonidos/incorrecto.mp3";

		var segundos = 240;
		let puntos = 0;

		//Funcion que inicia el tiempo y verifica si acabo para dar anuncio de que perdió el jugador

		//Agregando animacion a el timer

		function iniciarTiempo() {
			document.getElementById('tiempo').innerHTML = segundos + "<br>segundos";
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
				var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 4 + "&id_curso=" + 11; //cancatenation
				xmlhttp.open("POST", "../../acciones/insertar_pd4.php", true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send(param);
				Swal.fire({
					title: 'Oops...',
					text: '¡Verifica tu respuesta!',
					imageUrl: "../../img/img-juegos/loop.gif",
					imageHeight: 300,
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.reload();
					}
				});
				Incorrecto.play(); //agregando sonido al juego no completado
			} else {
				segundos--;
				setTimeout("iniciarTiempo()", 1000);
			}
		}
	</script>
	</script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>