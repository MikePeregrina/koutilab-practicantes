<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="../../css/css-juegos/cjib2-4.css" /><!--Linkeo de la hoja de estilos-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="shortcut icon" href="../../img/img_juegos/lgk.png">
	<title>KOUTILAB</title>
</head>

<body onload="iniciarTiempo()">
	<!-- Titulo general del juego -->
	<div class="titulo-gen">
		<h2 class="titulo"><b>ANDROID</b></h2>
	</div>

	<!-- Timer -->
	<div class="timer" id="timer">
		<b>Tiempo: <br />
			<p id="tiempo" style="margin: 0 0 0 0"></p>
		</b>
	</div>

	<!-- Contenedor principal -->
	<div class="contenido">
		<!-- Boton para regresar -->
		<a href="#"><button style="float: left; position: absolute; margin: 10px 0 0 10px" class="btn-b"
				id="btn-cerrar-modalV">
				<i class="fas fa-reply"></i>
			</button>
		</a>

		<!-- Titulo secundario -->
		<h4 class="titulo">
			<b>Selecciona la opción que corresponda a la línea en blanco o que
				encaje con la definición dada.</b>
		</h4>
		<br />
		<!--Contenedor de las preguntas y respuestas-->
		<div class="main-ctn" id="main-ctn">
			<div class="opt-ctn" id="opt-ctn"></div>
		</div>
		<!-- boton de verificar respuestas - No necesario para la sección-->
		<!--<button class="verificar" onClick="alertExcelent()">Siguiente Sección</button>-->
	</div>

	<script>
		//Arreglo de preguntas
		var preguntas = [
			{
				num: 1,
				pregunta:
					"Android es el sistema operativo que utilizan algunos dispositivos ________",
				opA: "Computacionales",
				opB: "Moviles",
				opC: "Inteligentes",
				correcta: "B",
				tiempo: "30",
			},
			{
				num: 2,
				pregunta:
					"Android es el sistema operativo que utilizan algunos dispositivos móviles para poder ______",
				opA: "Funcionar",
				opB: "Hablar",
				opC: "Comunicarse",
				correcta: "A",
				tiempo: "20",
			},
			{
				num: 3,
				pregunta:
					"Es decir, se trata de todo aquello que puedes _________",
				opA: "Oler",
				opB: "Tocar",
				opC: "Ver",
				correcta: "C",
				tiempo: "30",
			},
			{
				num: 4,
				pregunta:
					"El hecho de que convierta cualquier teléfono en prácticamente un ordenador de bolsillo lo hace ",
				opA: "Gratis",
				opB: "Comodo",
				opC: "Bonito",
				correcta: "B",
				tiempo: "30",
			},
			{
				num: 5,
				pregunta:
					"Por lo que lanzar un teléfono o aplicación con Android tiene un bajo",
				opA: "Rendimiento",
				opB: "Coste",
				opC: "Tamaño",
				correcta: "B",
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
					trasera1.style.background = "rgba(149, 255, 0, 0.45)"/*Se cambia el color de la tarjeta cuando es el par en color verde*/
					trasera2.style.background = "rgba(149, 255, 0, 0.45)"/*Se cambia el color de la tarjeta cuando es el par en color verde*/
				}
				if (verificar()) {
					Swal.fire({
						title: '¡Bien hecho!',
						text: '¡Puntuación guardada con éxito!',
						imageUrl: "img/Thumbs-Up.gif",
						imageHeight: 300,
						backdrop: `
									rgba(0,143,255,0.6)
									url("../../img/img_juegos/loop.gif")
									`,
						confirmButtonColor: '#a14cd9',
						confirmButtonText: 'Aceptar',
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href = '#';
						}
					});


				}
				ponerRespuesta();
				this.resPas.push(randomRes); //Se agrega el random al arreglo para evitar repetir la respuesta
			}
			var segundos = (this.segundos = this.preguntas[random].tiempo); //Contador de tiempo en segundos, si se acaba el tiempo sale alerta
		}
	</script>

	<script>
		var segundos = 300;//tiempo original 300s
		let puntos = 0;

		//Funcion que inicia el tiempo y verifica si acabo para dar anuncio de que perdió el jugador
		function iniciarTiempo() {
			noRepeat++;
			if (noRepeat < 2) {
				this.random = getRandomInt(5); //Elige la primera pregunta a mostrar
				prePas.push(random); //Guarda la pregunta mostrada en el arreglo
				ponerPregunta(); //Muestra la pregunta
			}
			document.getElementById("tiempo").innerHTML = segundos + " segundos";
			if (segundos > 15) {
                var div = document.getElementById("timer");
                div.style.cssText = "  background-color: rgba(129, 179, 243, 0.7); border-color: #c42c2c;";
            }
			if (segundos <= 15) {
                var div = document.getElementById("timer");
                div.style.cssText = " animation-name: animation1; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
            } 
            if (segundos <= 10) {
                var div = document.getElementById("timer");
                div.style.cssText = "animation-name: animation3; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
            }
			if (segundos == 0) {
				Swal.fire({
					title: "Oops... Te has quedado sin tiempo",
					text: "¡Intentalo de nuevo!",
					imageUrl: "../../img/img_juegos/loop.gif",
					imageHeight: 350,
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.reload();
					}
				});
				incorrecto.play(); //asignando sonido al juego no completado
			} else {
				segundos--;
				setTimeout("iniciarTiempo()", 1000);
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
						imageUrl: "../../img/img_juegos/loop.gif",
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
				imageUrl: "../../img/img_juegos/Thumbs-Up.gif",
				imageHeight: 350,
				backdrop: `
						rgba(0,143,255,0.6)
						url("../../img/img_juegos/fondo.gif")`,
				confirmButtonColor: "#a14cd9",
				confirmButtonText: "¡Genial!",
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.reload();
				}
			});
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




