<?php
session_start();
$id_user = $_SESSION['id_alumno_preparatoria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_preparatoria'])) {
	header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_preparatoria'];
$permiso = "capsula49";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_preparatoria c INNER JOIN detalle_capsulas_preparatoria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 8");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
	header("Location: ../../../../basico/capsulas/acciones/capsulas.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 62;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_preparatoria WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 11");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_preparatoria WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 11");
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
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="../../css/css-juegos/preguntas-agiles.css" /><!--Linkeo de la hoja de estilos-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<title>KOUTILAB</title>
</head>

<body onload="iniciarTiempo()">
	<!-- CAMBIOS -->
	<!-- Timer -->
    <div class="timer" id="timer">
        <b>Tiempo: <br>
            <p id="tiempo" style="margin: 0 0 0 0;"></p>
        </b>
    </div>

	<!-- Titulo general -->
	<div class="titulo-gen">
		<h2 class="titulo"><b>BARRA DE VIDA</b></h2>
	</div>

    <section>

		<div class="cont-st">
            <a href="#" onclick="history.back();">
              <button class="btn-b">
                <i class="fas fa-reply"></i>
              </button>
            </a>
            <h4 class="titulo"><b>Desliza las tarjetas haciendo click en ellas para desplazarlas y descubrir la imagen real</b></h4>
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
					"Se puede agragar barra de vida a un personaje en unity",
				opA: "No",
				opB: "Si",
				opC: "Tal vez",
				correcta: "B",
				tiempo: "30",
			},
			{
				num: 2,
				pregunta:
					"Una barra de vida es una  común en ___________ muchos juegos",
				opA: "caracteristica",
				opB: "Image",
				opC: "Vida",
				correcta: "A",
				tiempo: "20",
			},
			{
				num: 3,
				pregunta:
					"En Unity, puedes crear una barra de vida visualmente atractiva y ________ utilizando las características y herramientas proporcionadas por el motor de juego.",
				opA: "carateristica",
				opB: "Etiquetas",
				opC: "funcional",
				correcta: "C",
				tiempo: "30",
			},
			{
				num: 4,
				pregunta:
					"Crea un nuevo script llamado ______________ para manejar la lógica de la vida.",
				opA: "Juego",
				opB: "HealthManager",
				opC: "Barra",
				correcta: "B",
				tiempo: "30",
			},
			{
				num: 5,
				pregunta:
					"En el ______, define una variable para representar la vida actual y otra para la vida máxima.",
				opA: "CSS",
				opB: "SCRIP",
				opC: "JavaScript",
				correcta: "B",
				tiempo: "30",
			},
			{
				num: 6,
				pregunta:
					"Utiliza métodos para aumentar o disminuir la vida según los eventos y acciones del juego.",
				opA: "link",
				opB: "stylesheet",
				opC: "metodo",
				correcta: "C",
				tiempo: "30",
			},
			{
				num: 7,
				pregunta:
					"Asegúrate de tener un componente de imagen _________ en el lienzo de la interfaz de usuario para representar la barra de vida.",
				opA: "public",
				opB: "(UI Image)",
				opC: "link",
				correcta: "B",
				tiempo: "30",
			},
			{
				num: 8,
				pregunta:
					"En los eventos o acciones del juego donde la vida cambie, utiliza los métodos _________ o Heal del script HealthManager.",
				opA: "TakeDamage",
				opB: "Java",
				opC: "HTML",
				correcta: "A",
				tiempo: "25",
			},
			{
				num: 9,
				pregunta:
					"En el método ______________ del script HealthManager, calcula el porcentaje de vida actual en relación con la vida máxima.",
				opA: "fillAmount",
				opB: "TakeDamage",
				opC: "UpdateHealthBar",
				correcta: "C",
				tiempo: "30",
			},
			{
				num: 10,
				pregunta:
					"Utiliza este porcentaje para ajustar el valor de _____________ de la imagen de la barra de vida. Un valor de 1 representa la vida completa, y 0 representa la vida vacía.",
				opA: "var",
				opB: "fillAmount",
				opC: "UpdateHealthBar",
				correcta: "B",
				tiempo: "25",
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
			if(segundos > 15){
			var div = document.getElementById("timer");
			div.style.cssText = "background-color: rgba(129, 179, 243, 0.7); border-color: #c42c2c;";
           }else if(segundos == 15){
			var div = document.getElementById("timer");
            div.style.cssText = " animation-name: animation1; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";

		   }else if(segundos < 10){
			var div = document.getElementById("timer");
            div.style.cssText = " animation-name: animation2; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
   			}	var correcto = document.createElement("audio");
		correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
		var incorrecto = document.createElement("audio");
		incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

			if (segundos == 0) {
				Swal.fire({
					title: "Oops... Te has quedado sin tiempo",
					text: "¡Intentalo de nuevo!",
					imageUrl: "../../img/img-juegos/loop.gif",
					imageHeight: 350,
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.reload();
					}
				});incorrecto.play();
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
						imageUrl: "../../img/img-juegos/loop.gif",
						imageHeight: 350,
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.reload();
						}
					});incorrecto.play();
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
					window.location.href = '../../../../../../rutas/ruta-vj-i.php';
				}
			});correcto.play();
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