<?php
session_start();
$id_user = $_SESSION['id_alumno_secundaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_secundaria'])) {
	header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_secundaria'];
$permiso = "capsula3";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_secundaria c INNER JOIN detalle_capsulas_secundaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 1");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
	header("Location: ../../../../basico/capsulas/acciones/capsulas.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 4;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_secundaria WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 1");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_secundaria WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 1");
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
	<link rel="shortcut icon" href="../../img/img_juegos/lgk.png">

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
		<h2 class="titulo"><b>¿QUÉ NIVEL DE API MÍNIMO DEBERÍAS USAR?</b></h2>
	</div>

	<section>

		<div class="cont-st">
			<a href="#" onclick="history.back();">
				<button class="btn-b">
					<i class="fas fa-reply"></i>
				</button>
			</a>
			<button class="btn-b" id="pause" >
			   <i class="fas fa-pause"></i>
			</button>
			<button class="btn-b" id="play" >
			   <i class="fas fa-play"></i>
			</button>
			<h6 class="titulo" style="margin-left: auto;"><b>Encuentra todos los pares de tarjetas para poder ganar el juego</b></h6>
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
				'<i class="fas fa-mobile-alt"></i>',
				'<i class="far fa-images"></i>',
				'<i class="fas fa-video"></i>',
				'<i class="fas fa-keyboard"></i>',
				'<i class="fab fa-apple"></i>',
				'<i class="fas fa-rocket"></i>',
				'<i class="fab fa-app-store-ios"></i>',
				'<i class="fab fa-android"></i>',
				'<i class="fas fa-heart"></i>',
				'<i class="fas fa-globe"></i>',
				'<i class="fas fa-code"></i>',
				'<i class="far fa-file-code"></i>'
			]
		}

		//Generador de tablero, inicia el tiempo, carga los iconos y quita el boton de iniciar
		function generarTablero() {
			reproducirSonido()
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
				var click = new Audio('../../../../../../../../acciones/sonidos/click.mp3');
				click.play();
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
					var incorrecto = new Audio('../../../../../../../../acciones/sonidos/no.mp3');
				    incorrecto.play();
				} else {
					var correcto = new Audio('../../../../../../../../acciones/sonidos/si.mp3');
					correcto.play();
					trasera1.style.background = "rgba(149, 255, 0, 0.45)" /*Se cambia el color de la tarjeta cuando es el par en color verde*/
					trasera2.style.background = "rgba(149, 255, 0, 0.45)" /*Se cambia el color de la tarjeta cuando es el par en color verde*/
				}
				if (verificar()) {
					var puntos = <?php echo $puntosGanados; ?>

					var xmlhttp = new XMLHttpRequest();
					var param = "score=" + 10 + "&validar=" + 'correcto' + "&permiso=" + 4 + "&id_curso=" + 1 + "&redireccion=" + '../contenido/juegos/cjhtml1.php'; //cancatenation
					xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
					xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xmlhttp.send(param);
					Swal.fire({
						title: '¡Bien hecho!',
						text: '¡Puntuación guardada con éxito! Obtienes ' + puntos + ' puntos de logros',
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
							window.location.href = '../../../../../../rutas/ruta-pw-b.php';
						}
					});
					alerta1.play(); //agregando sonido al juego completado
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
		var segundos = 240; //240
		let puntos = 0;

		//Funcion que agrega el sonido al juego
		var alerta1 = document.createElement("audio");
		alerta1.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
		var alerta2 = document.createElement("audio");
		alerta2.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

		//Funcion que inicia el tiempo y verifica si acabo para dar anuncio de que perdió el jugador
		function iniciarTiempo() {
			document.getElementById("tiempo").innerHTML =
				segundos + " segundos";
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
			//document.getElementById('tiempo').innerHTML = segundos + " segundos";
			if (segundos == 0) {
				var xmlhttp = new XMLHttpRequest();
				var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 4 + "&id_curso=" + 1 + "&redireccion=" + '../contenido/juegos/cjhtml1.php'; //cancatenation
				xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
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
				alerta2.play(); //agregando sonido al juego no completado
			} else {
				segundos--;
				setTimeout("iniciarTiempo()", 1000);
			}
		}
	</script>

<script>
		function reproducirSonido() {
			var sonido = new Audio('../../../../../../../../acciones/sonidos/f1.mp3'); // Reemplaza 'ruta_del_sonido.mp3' con la URL de tu archivo de sonido
			sonido.loop = true; // Establece la propiedad loop en true para repetir el sonido
			sonido.play(); // Reproduce el sonido
			
			pause.addEventListener('click', ()=>{
				sonido.pause();
			});
			play.addEventListener('click', ()=>{
				reproducirSonido();
			});
			
		}

		// Llama a la función cuando la página se carga completamente
		window.addEventListener('load', reproducirSonido);
</script>

	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>