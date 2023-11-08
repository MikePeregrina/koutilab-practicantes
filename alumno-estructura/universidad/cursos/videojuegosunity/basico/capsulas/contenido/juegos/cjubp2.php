<?php
session_start();
$id_user = $_SESSION['id_alumno_universidad'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_universidad'])) {
	header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_universidad'];
$permiso = "capsulapago2";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_universidad c INNER JOIN detalle_capsulas_pago_universidad d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 10;");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
	header("Location: ../../../../basico/capsulas/contenido/alertas/paquete_premium2.php");
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>KOUTILAB</title>
	<link rel="shortcut icon" href="img/lgk.png">

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
	<!-- CAMBIOS -->
	<!-- Timer -->
	<div class="timer" id="timer">
		<b>Tiempo: <br>
			<p id="tiempo" style="margin: 0 0 0 0;"></p>
		</b>
	</div>

	<!-- Titulo general -->
	<div class="titulo-gen">
		<h2 class="titulo"><b> INTERFACE Y VENTANAS </b></h2>
	</div>

	<section>

		<div class="cont-st">
			<a href="#" onclick="history.back();" s>
				<button class="btn-b">
					<i class="fas fa-reply"></i>
				</button>
			</a>
			<h6 class="titulo"><b>Busca las palabras ocultas dentro de la sopa de letras</b></h6>
		</div>
		<!--FIN  CAMBIOS -->

		<!--CONTENEDOR DEL JUEGO-->
		<div class="mjuego">
			<!-- Sección donde se agregan las palabras a buscar dentro de la sopa de letras -->
			<div class="words">
				<div class="title-h6">
					<h4><b>Palabras a buscar:</b></h4>
				</div>
				<div id='Palabras'></div>
			</div>

			<!-- Sección donde se agrega la sopa de letras -->
			<div class="soup">
				<div id='juego' style="margin: 0 0 0 40px;"></div>
			</div>
		</div>

	</section>
	<!-- CAMBIOS -->
	<footer class="footerimga">
		<div class="imagen-footer">
			<img src="../../img/img-juegos/benvenida.png" alt="No-image">
		</div>
	</footer>
	<!-- fIN CAMBIOS -->
	<script>
		// Se pueden agregar las palabras que quieran, pero agregar al menos una palabra de 10 letras
		// para mantener proporcion
		var words = ['INTERFAZ', 'VENTANAS', 'HERRAMIENTAS', 'VISTA', '3D', 'PROYECTO', 'PROPIEDADES', '2D'];
		var gamePuzzle = wordfindgame.create(words, '#juego', '#Palabras');

		var puzzle = wordfind.newPuzzle(words, {
			height: 18,
			width: 18,
			fillBlanks: false
		});
		wordfind.print(puzzle);

		$('#solve').click(function() {
			wordfindgame.solve(gamePuzzle, words);
		});
	</script>
	<script>
		//se esta llamando los sonidos de la carpeta "sonidos"
		var Correcto = document.createElement("audio");
		Correcto.src = "../../acciones/sonidos/correcto.mp3";
		var Incorrecto = document.createElement("audio");
		Incorrecto.src = "../../acciones/sonidos/incorrecto.mp3";

		var segundos = 240;
		var count = 1000;
		let puntos = 0;

		function iniciarTiempo() {
			document.getElementById("tiempo").innerHTML =
				segundos + " segundos";
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
				var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 12 + "&id_curso=" + 10; //cancatenation
				xmlhttp.open("POST", "../../acciones/insertar_pd12.php", true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send(param);
				Swal.fire({
					title: "Oops...",
					text: "Se acabó el tiempo",
					imageUrl: "../../img/img-juegos/loop.gif",
					imageHeight: 350,
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.reload();
					}
				});
				Incorrecto.play(); //Agregando sonido al juego no completado
				loseText.setText("Juego terminado");
				player.setTint(0xff0000);
				player.anims.play("turn");
				gameoverSound();
				gameOver = true;
			} else {
				segundos--;
				setTimeout("iniciarTiempo()", count);
			}
		}
	</script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>