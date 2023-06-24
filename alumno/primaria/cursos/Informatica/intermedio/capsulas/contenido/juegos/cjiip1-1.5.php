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
	<link rel="shortcut icon" href="img/lgk.png">
</head>

<body onload="iniciarTiempo()">
	<!-- Titulo general del juego -->
	<div class="titulo-gen">
		<h2 class="titulo"><b>PREGUNTAS ÁGILES</b></h2>
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
					"¿Por qué es importante mantener seguro nuestro correo electrónico?",
				opA: "Por qué dan alamacenamiento en la nube de manera gratuito",
				opB: "Por qué en el correo electrónico se suele manejar información delicada",
				opC: "Por qué me fácilita la navegación en páginas desconocidas",
				correcta: "B",
				tiempo: "30",
			},
			{
				num: 2,
				pregunta:
					"Selecciona las características de una contraseña segura",
				opA: "Mayores a 8 carácteres, Mayúsculas, Mínusculas, Símbolos, Números",
				opB: "Mayores a 5 carácteres, Mínusculas",
				opC: "Números, Menores a 6 carácteres",
				correcta: "A",
				tiempo: "30",
			},
			{
				num: 3,
				pregunta:
					"¿Por qué no se recomienda usar contraseñas poco seguras?",
				opA: "No existe la probabilidad del desiframiento de la clave",
				opB: "Por que suelen ser contraseñas menos populares",
				opC: "Por qué suele ser muy fácil de decifrar por personal no autorizado",
				correcta: "C",
				tiempo: "30",
			},
			{
				num: 4,
				pregunta:
					"¿Qué es la autenticación en dos pasos?",
				opA: "Compartir de manera fácil la contraseña a personal diferente",
				opB: "Medida de seguridad adicional",
				opC: "Es una aplicación que permite colocar un pin al momento de ingresar a la cuenta",
				correcta: "B",
				tiempo: "30",
			},
			{
				num: 5,
				pregunta:
					"¿Cuál es la característica de la autenticación en dos pasos?",
				opA: "Genera QR fáciles de compartir",
				opB: "Genera un código de verificación",
				opC: "Permite restaurar la contraseña",
				correcta: "B",
				tiempo: "30",
			},
			{
				num: 6,
				pregunta:
					"¿Por qué es importante tener la autenticación en dos pasos en nuestras cuentas de correo?",
				opA: "Para recordar fácilmente la contraseña",
				opB: "Para compartir la contraseña de manera rápida con personal ajeno",
				opC: "Para evitar ser hakeado por personas no autorizadas",
				correcta: "C",
				tiempo: "30",
			},
			{
				num: 7,
				pregunta:
					"¿Qué es el uso del cifrado en el correo?",
				opA: "Es un permiso que se le da a la empresa de correo para crear la cuenta",
				opB: "Es el cifrado de extremo a extremo",
				opC: "Es la autorización de lectura a terceros",
				correcta: "B",
				tiempo: "30",
			},
			{
				num: 8,
				pregunta:
					"¿Cómo cuidar la seguridad del correo?",
				opA: "Actualizando el programa de correo, sitema operativo, cambio frecuente de contraseña",
				opB: "Compartiendo el usuario y la contraseña a amigos",
				opC: "Compartiendo la información de seguridad a terceros (teléfono, correos de recuperación, etc.)",
				correcta: "A",
				tiempo: "30",
			},
			{
				num: 9,
				pregunta:
					"¿Cuál es el uso adecuado del correo educativo y personal?",
				opA: "Compartir mis cuentas de correo a personas ajenas",
				opB: "Usar la misma cuenta para evitar el cambio de sesión",
				opC: "Usar cuentas de correo diferentes",
				correcta: "C",
				tiempo: "30",
			},
			{
				num: 10,
				pregunta:
					"¿Cuántas medidas de seguridad se pueden implementar en el correo electrónico?",
				opA: "1 medida de seguridad",
				opB: "4 medidas de seguridad",
				opC: "2 medidas de seguridad",
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

		function ponerPregunta() {
			//Actualiza las preguntas
			document.getElementById("main-ctn").innerHTML =
				'<p style="text-align: right; font-weight: bold; font-size: 25px; margin-top: 5px; padding-bottom:0; margin-bottom:0;">' +
				this.contador +
				"/10</p>" +
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
		var noRepeat = 0; //necesaria para evitar el cambio de preguntas durante la duración de cada una
		function iniciarTiempo() {
			noRepeat++;
			if (noRepeat < 2) {
				this.random = getRandomInt(10); //Elige la primera pregunta a mostrar
				prePas.push(random); //Guarda la pregunta mostrada en el arreglo
				ponerPregunta(); //Muestra la pregunta
			}
			document.getElementById("tiempo").innerHTML = segundos + " segundos";
			/*declarando condiciones que permiten cambiar el color de fondo del timer*/
        if (segundos <= 10) {
          var div = document.getElementById("timer");
          div.style.cssText =
		  "animation-name: animation1; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
        }
        if (segundos <= 5) {
          var div = document.getElementById("timer");
          div.style.cssText =
            "animation-name: animation2; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
        }
			if (segundos == 0) {
				Swal.fire({
					title: "Oops... Te has quedado sin tiempo",
					text: "¡Intentalo de nuevo!",
					imageUrl: "img/loop.gif",
					imageHeight: 350,
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.reload();
					}
				});
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

				if (this.puntos == 10) {
					//Cuando haya acertado las 10 preguntas
					alertExcelent();
				} else {
					this.random = getRandomInt(10);
					let found = prePas.find((element) => element == this.random);
					while (found == this.random) {
						//Si el random corresponde a una pregunta ya mostrada, se genera un nuevo random
						this.random = getRandomInt(10);
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
						imageUrl: "img/loop.gif",
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
				imageUrl: "img/Thumbs-Up.gif",
				imageHeight: 350,
				backdrop: `
						rgba(0,143,255,0.6)
						url("img/fondo.gif")`,
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