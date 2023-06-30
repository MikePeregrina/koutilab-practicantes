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
	<!-- Titulo general -->
	<div class="titulo-gen">
		<h3 class="titulo"><b>PRESENTACIONES ELECTRÓNICAS</b></h3>
	</div>


	<div class="timer" id="timer">
		<b>Tiempo: <br>
			<p id="tiempo"></p>
		</b>
	</div>

	<div class="contenido">

		<a href="#">
			<button class="btn-b">
				<i class="fas fa-reply"></i>
			</button>
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
			<div id='juego'></div>
		</div>

	</div>

	<script>
		// Se pueden agregar las palabras que quieran, pero agregar al menos una palabra de 10 letras
		// para mantener proporcion
		var words = ['POWERPOINT', 'PRESENTAR', 'TRANSPARENTE', 'PIZARRA', 'VERSATIL', 'DISEÑO', 'AUDIENCIA', 'PRUEBA'];
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
		var segundos = 240;

		let puntos = 0;

		function iniciarTiempo() {
			document.getElementById('tiempo').innerHTML = segundos + " segundos";
			if (segundos <= 60) {
				var div = document.getElementById("timer");
				div.style.cssText = "animation-name: animation1; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
			}
			if (segundos <= 30) {
				var div = document.getElementById("timer");
				div.style.cssText = "animation-name: animation2; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
			}
			if (segundos == 0) {
				Swal.fire({
					title: 'Oops...',
					text: '¡Verifica tu respuesta!',
					imageUrl: "img/loop.gif",
					imageHeight: 350,
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = '#';
					}
				});
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