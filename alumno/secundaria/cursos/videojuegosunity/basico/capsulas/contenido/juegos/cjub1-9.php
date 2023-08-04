<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="../../css/css-juegos/preg-ag.css" /><!--Linkeo de la hoja de estilos-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<title>KOUTILAB</title>
</head>

<body onload="iniciarTiempo()">
	<!-- CAMBIOS -->
	<!-- Timer -->
	<div class="timer">
		<b>Tiempo: <br>
			<p id="tiempo" style="margin: 0 0 0 0;"></p>
		</b>
	</div>

	<!-- Titulo general -->
	<div class="titulo-gen">
		<h2 class="titulo"><b>CAMARAS</b></h2>
	</div>

	<section>

		<div class="cont-st">
			<a href="#" onclick="history.back();">
				<button class="btn-b">
					<i class="fas fa-reply"></i>
				</button>
			</a>
			<h4 class="titulo"><b>Desliza las tarjetas haciendo click en ellas para desplazarlas y descubrir la imagen
					real</b></h4>
		</div>
		<!--fIN CAMBIOS -->
		<!--Contenedor de las preguntas y respuestas-->
		<div class="main-ctn" id="main-ctn">
			<div class="opt-ctn" id="opt-ctn"></div>
		</div>
		<!-- boton de verificar respuestas - No necesario para la sección-->
		<!--<button class="verificar" onClick="alertExcelent()">Siguiente Sección</button>-->
	</section>

	<!-- CAMBIOS -->
	<footer class="footerimga">
		<div class="imagen-footer">
		<img src="../../img/img-juegos/benvenida.png" alt="No-image">
		</div>
	</footer>
	<!-- fIN CAMBIOS -->
	<script>
		//Arreglo de preguntas
		var preguntas = [
			{
				num: 1,
				pregunta:
					"Las camaras son...",
				opA: "para sacar fotos",
				opB: "son los dispositivos que capturan y muestran el mundo al jugador",
				opC: "para jugar ",
				correcta: "B",
				tiempo: "30",
			},
			{
				num: 2,
				pregunta:
					"Que es una ruta de procesamiento",
				opA: "La ruta de representación utilizada por su proyecto se elige en la configuración del reproductor",
				opB: " dispositivos que capturan y muestran el mundo",
				opC: "Las dos anteriores",
				correcta: "A",
				tiempo: "20",
			},
			{
				num: 3,
				pregunta:
					"Que es una camara",
				opA: "Una escena en Unity se crea mediante el posicionamiento y movimiento de objetos en un espacio tridimensional.",
				opB: "Es una etiqueta",
				opC: "Hojas de Estilo",
				correcta: "A",
				tiempo: "30",
			},
			{
				num: 4,
				pregunta:
					"Que lenguaje de programacion se usa en Unity",
				opA: "Xampp",
				opB: "C Sharp",
				opC: "java",
				correcta: "B",
				tiempo: "30",
			},
			{
				num: 5,
				pregunta:
					"Que funcion tiene el objeto  Main Camara",
				opA: "Mostrar el mundo que rodea al jugador",
				opB: "Mostrar mi equipo",
				opC: "Tener movimientode articulaciones",
				correcta: "A",
				tiempo: "30",
			},

		];

		var puntos = 0; //Leva el conteo de puntos/aciertos
		var seleccion; //Guarda la respuesta elegida
		var contador = 1; //Lleva el conteo de preguntas
		var errores = 0; //Lleva el conteo de errores, si rebasa 2 en una misma pregunta, pierde el juego

		function getRandomInt(max) {
			//para generar números random enteros
			return Math.floor(Math.random() * max);
		}

		var prePas = []; //guarda el index de las preguntas que ya pasaron para no repetir
		var random; //para el index de la pregunta a mostrar

		var resPas = [];  //guarda el index de las respuestas que ya se agregaron para no repetir, orden de las respuestas
		var randomRes; //para el index de la respuesta a mostrar


		function ponerRespuesta() {
			if (randomRes == 0) {
				document.getElementById("opt-ctn").innerHTML +=
					'<button class="btn-opt" value="A" onClick="guardarRespuestaA()" id="optA">' +
					this.preguntas[this.random].opA +
					"</button>";
			} else if (randomRes == 1) {
				document.getElementById("opt-ctn").innerHTML +=
					'<button class="btn-opt" value="B" onClick="guardarRespuestaB()" id="optB">' +
					this.preguntas[this.random].opB +
					"</button>";
			} else if (randomRes == 2) {
				document.getElementById("opt-ctn").innerHTML +=
					'<button class="btn-opt" value="C" onClick="guardarRespuestaC()" id="optC">' +
					this.preguntas[this.random].opC +
					"</button>";
			}
		}

		function ponerPregunta() {
			//Actualiza las preguntas
			document.getElementById("main-ctn").innerHTML =
				'<p id="cont" style="text-align: right; font-weight: bold; font-size: 25px; margin-top: 5px; padding-bottom:0; margin-bottom:0;">' +
				this.contador +
				"/5</p>" +
				'<div class="q-ctn"><div class="title-ctn" id="pregunta-ctn">' +
				"<p>" +
				this.preguntas[this.random].pregunta +
				"</p>" +
				"</div></div>" +
				'<div class="opt-ctn" id="opt-ctn"></div>';

			this.randomRes = getRandomInt(3); //Genera el index de respuesta random para cambiar el orden de las respuestas
			this.resPas.push(randomRes); //agrega el primer index al arreglo
			ponerRespuesta(); //muestra la respuesta

			while (this.resPas.length < 3) { //para desordenar las 2 respuestas restantes
				this.randomRes = getRandomInt(3);
				let found2 = resPas.find((element) => element == this.randomRes);
				while (found2 == this.randomRes) {
					//Si el random corresponde a una respuesta ya mostrada, se genera un nuevo random
					this.randomRes = getRandomInt(3);
					found2 = resPas.find((element) => element == this.randomRes);
				}
				ponerRespuesta();
				this.resPas.push(randomRes); //Se agrega el random al arreglo para evitar repetir la respuesta
			}
			var segundos = (this.segundos = this.preguntas[random].tiempo); //Contador de tiempo en segundos, si se acaba el tiempo sale alerta
		}
		//se esta llamando los sonidos de la carpeta "sonidos"
		var Correcto = document.createElement("audio");
		Correcto.src = "../acciones/sonidos/correcto.mp3";
		var Incorrecto = document.createElement("audio");
		Incorrecto.src = "../acciones/sonidos/incorrecto.mp3";

		let puntos = 0;
		var count = 1000;
		var noRepeat = 0; //necesaria para evitar el cambio de preguntas durante la duración de cada una
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
		//Función para verificar la respuesta correcta
		function evaluarRespuesta() {
			if (this.seleccion == this.preguntas[random].correcta) {
				this.puntos = this.puntos + 1;
				this.contador = this.contador + 1;

				if (this.puntos == 5) {
					//Cuando haya acertado las 10 preguntas
					alertExcelent();
				} else {
					this.random = getRandomInt(5);
					let found = prePas.find((element) => element == this.random);
					while (found == this.random) {
						//Si el random corresponde a una pregunta ya mostrada, se genera un nuevo random
						this.random = getRandomInt(5);
						found = prePas.find((element) => element == this.random);
					}
					this.prePas.push(random); //Se agrega el random al arreglo para evitar repetir la pregunta más adelante
					this.resPas = [];
					ponerPregunta(); //Muestra la pregunta
					this.errores = 0; //Inicializa errores
					this.segundos = this.preguntas[random].tiempo; //fijando nuevo tiempo por pregunta
					console.log("Correcto");
					alertGood();
				}
			} else {
				console.log("Incorrecto");
				this.errores = this.errores + 1;
				if (this.errores > 1) {
					Swal.fire({
						title: "Oops... Has perdido el juego",
						text: "¡Inténtalo de nuevo!",
						imageUrl: "../../img/img-juegos/loop.gif",
						imageHeight: 350,
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.reload();
						}
					});
				} else {
					alertBad();
				}
			}
		}

		//Funciones para guardar la respuesta elegida
		function guardarRespuestaA() {
			let res = document.getElementById("optA").value;
			seleccion = res;
			evaluarRespuesta();
		}

		function guardarRespuestaB() {
			let res = document.getElementById("optB").value;
			seleccion = res;
			evaluarRespuesta();
		}

		function guardarRespuestaC() {
			let res = document.getElementById("optC").value;
			seleccion = res;
			evaluarRespuesta();
		}

		//Alerta muestra que el juego fue completado
		function alertExcelent() {
			Swal.fire({
				title: "Excelente",
				text: "¡Buen trabajo!",
				imageUrl: "../../img/img-juegos/Thumbs-Up.gif",
				imageHeight: 350,
				backdrop: `
						rgba(0,143,255,0.6)
						url("../../img/img-juegos/fondo.gif")`,
				confirmButtonColor: "#a14cd9",
				confirmButtonText: "¡Genial!",
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = '../../../../../../rutas/ruta-vj-b.php';
				}
			});
			Correcto.play(); //Agregando sonido al juego completado
		}

		//Alerta, muestra que la respuesta fue correcta
		function alertGood() {
			Swal.fire({
				position: "center",
				icon: "success",
				title: "¡Respuesta Correcta!",
				//background: '#fff url(/img/fondo.gif)',
				showConfirmButton: false,
				timer: 1500,
			});
		}

		//Alerta, muestra que la respuesta fue incorrecta
		function alertBad() {
			Swal.fire({
				position: "center",
				icon: "error",
				title: "Incorrecto, te queda una oportunidad",
				showConfirmButton: false,
				timer: 1800,
			});
		}
	</script>
</body>

</html>