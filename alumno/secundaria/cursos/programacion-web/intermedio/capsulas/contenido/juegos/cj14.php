<?php
session_start();
$id_user = $_SESSION['id_alumno_secundaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_secundaria'])) {
	header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_secundaria'];
$permiso = "capsula37";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_secundaria c INNER JOIN detalle_capsulas_secundaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 2");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
	header("Location: ../../../../intermedio/capsulas/acciones/capsulas.php");
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>KOUTILAB</title>
	<link rel="shortcut icon" href="../../../../../../img/lgk.png">
	<link rel="stylesheet" type="text/css" href="../../css/css-juegos/sopa-letras.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/wordfind.js"></script>
	<script type="text/javascript" src="../../js/wordfindgame4.js"></script>
	<script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body onload="iniciarTiempo();">
	<!-- Titulo general -->
	<div class="titulo-gen">
		<h2 class="titulo" style="margin-left: 475px;"><b>SOPA DE LETRAS</b></h2>
	</div>

	<div class="timer">
		<b style="margin-top: 10px;">Tiempo: <br>
			<p id="tiempo"></p>
		</b>
	</div>

	<div class="contenido">
		<a href="#" onclick="history.back(); return false;"><button style="float: left; position: relative" class="btn-b" id="btn-cerrar-modalV">
				<i class="fas fa-reply"></i></button></a>
		<!-- Titulo secundario -->
		<h5 class="titulo"><b>Busca las palabras ocultas dentro de la sopa de letras</b></h5>
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

			<!-- Boton para resolver la sopa de letras, mantener comentado -->
			<!-- <button id='solve'>Resolver el juego</button> -->
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

				var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 38 + "&id_curso=" + 2; //cancatenation
				Swal.fire({
					title: 'Oops...',
					text: '¡Verifica tu respuesta!',
					imageUrl: "../../../../../../img/signo.gif",
					imageHeight: 350,
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = 'cj14.php';
					}
				});
				xmlhttp.open("POST", "../../acciones/insertar_pd38.php", true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send(param);
			} else {
				segundos--;
				setTimeout("iniciarTiempo()", 1000);
			}
		}
	</script>

	<script>
		// Se pueden agregar las palabras que quieran, pero agregar al menos una palabra de 10 letras
		// para mantener proporcion
		var words = ['CONTENEDOR', 'FILAS', 'COLUMNAS', 'REJILLA', 'LISTA', 'DISPLAY', 'GRID', 'LAYOUT'];
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
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>