<!-- Esta capsula debe de insertar el permiso 6 con insertar_cp6.php -->
<?php
session_start();
$id_user = $_SESSION['id_alumno_primaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_primaria'])) {
	header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_primaria'];
$permiso = "capsulapago2";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_primaria c INNER JOIN detalle_capsulas_pago_primaria d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 1;");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
	header("Location: ../../../../basico/capsulas/contenido/pasarela/capsula2html.php");
}

?>

<!DOCTYPE html>
<html>

<!-- 
		Manual de cambios para el crucigrama por pasos:
		1. Realizar el dibujo o diagrama de como va a quedar la matriz del crucigrama 
			(Ejemplo: una matriz de 3x5 o del tamaño necesario)
		2. Agregar las palabras necesarias a la matriz, definiendo asi si son verticales u orizontales para 
			posteriormente generar su enunciado y colorcarlo en su lugar
		3. Generar la matriz del tamaño que se haya definido, si es de 3x5 son tres filas por 5 casillas que 
			lleva cada fila
		4. Desactivar con el Style cada casilla que no se va a ocupar
		5. Cambiar el maximo de filas y el maximo de columnas en la primera condicional for, para deshabilitar 
			las casillas que no se ocupan 
		6. Generar las palabras en la matriz ubicando letra por letra con el codigo mencionado
			por ejemplo: var palabra1_letra1 = document.getElementById("fila1C1"); y asi letra por letra
			con todas las palabras
		7. Posteriormente, habilitar las casillas necesarias para editar quitando el readOnly, por ejemplo:
			palabra1_letra1.readOnly =false; y asi con todas las letras y palabras necesarias
		8. Cabiar el maximo de filas y columnas que en la segunda condicinal for, esto para pintar de color azul
			las nuevas palabras que hayamos definido antes 
		9. Generar palabra por palabra sumando todas las letras que la conforman, al incio de la funcion verificar,
			por ejemplo: palabra1 = palabra1_letra1.value + palabra1_letra2.value + palabra1_letra3.value;
			y asi con todas las palabras necesarias
		10. Modificar la condicional siguiente para que la suma de las palabras sean igual al enunciado que se definio,
			por ejemplo: if(palabra1.toLowerCase()=="body" && palabra2.toLowerCase()=="input") { }
			y asi ir agregando las demas palabras dentro del crucigrama
		11. Modificar la serie de if que siguen despues de ese agregando las palabras que haya definido, esto 
			para identificar si estan vacias
		12. (Opcional) Modificar el corrector de palabras, en caso de que la palabra 1 este mal pero contenga 
			una letra de la palabra 2 que este bien, entonces indicar dentro de la condicional que letra es para que
			el corrector lo agregue por si solo.
		13. Modificar la posicion de los numeros conforme sea la necesidad del crucigrama, ya sea arriba si la palabra 
			es vertical o a la izquierda si la palabra es horizontal, esto se hace atraves del css modificando los
			margin.
	 -->

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>KOUTILAB</title>
	<link rel="shortcut icon" href="../../../../../../img/lgk.png">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" href="../../css/css-juegos/crucigrama.css">
</head>

<body onload="iniciarTiempo();">
	<!-- Titulo general -->
	<div class="titulo-gen">
		<h2 class="titulo" style="margin-left: 480px;"><b>CRUCIGRAMA</b></h2>
	</div>

	<!-- Alerta -->
	<div id="mensaje" style="position: absolute;"></div>

	<div class="timer">
		<b style="margin-top: 10px;">Tiempo: <br>
			<p id="tiempo"></p>
		</b>
	</div>

	<!-- Contenido donde está el crucigrama y las frases que desacriben la palabra buscada -->
	<div class="contenido" style="height: 510px;">
		<a href="#" onclick="history.back(); return false;"><button style="float: left; position: relative; margin: 10px 0 0 10px;" class="btn-b" id="btn-cerrar-modalV">
				<i class="fas fa-reply"></i></button></a>
		<!-- Titulo secundario -->
		<h5 class="titulo"><b>Busca la palabra que describe el texto</b></h5>
		<br>

		<!-- Apartado donde van las frases a buscar por el usuario -->
		<div class="words">
			<table>
				<tr>
					<b style="margin-left: 80px;">Horizontales:</b>
					<td>
						<div class="horizontal" style="margin-top: 40px;">
							1. Es lo que nos permite crear la etiqueta de HTML < ul>.
								<br><br>
								2. Nombre de la etiqueta de HTML que nos permite crear una barra de herramientas.
						</div>
					</td>
					<b style="margin-left: 160px;">Verticales:</b>
					<td>
						<div class="vertical">
							1. Nombre de la etiqueta de HTML que nos permite crear cada elemento de nuestra lista.
							<br><br>
							2. Nombre de la etiqueta de HTML que nos permite crear una barra de navegación.
						</div>
					</td>
				</tr>
			</table>
		</div>

		<div class="linea" style="height: 340px;"></div>

		<!-- Apartado del crucigrama junto con sus casillas -->
		<div class="crucigrama" style="margin-top: 100px;">
			<div class="numero1" style="margin-top: 95px;">1.</div>
			<div class="numero2" style="margin: 25px 0 0 125px">2.</div>
			<div class="numero1-1" style="margin: 45px 0 0 30px;">1.</div>
			<div class="numero2-2" style="margin: -25px 0 0 320px;">2.</div>
			<table>
				<tr>
					<td>
						<input class="casilla" type="text" maxlength="1" id="fila1C1" style="border-style: none; background-color: rgba(255, 255, 255, 0); width: 70px; height: 70px;" />
					</td>
					<td>
						<input class="casilla" type="text" maxlength="1" id="fila1C2" style="border-style: none; background-color: rgba(255, 255, 255, 0); width: 70px; height: 70px;" />
					</td>
					<td>
						<input class="casilla" type="text" maxlength="1" id="fila1C3" style="width: 70px; height: 70px;" />
					</td>
					<td>
						<input class="casilla" type="text" maxlength="1" id="fila1C4" style="width: 70px; height: 70px;" />
					</td>
					<td>
						<input class="casilla" type="text" maxlength="1" id="fila1C5" style="width: 70px; height: 70px;" />
					</td>
					<td>
						<input class="casilla" type="text" maxlength="1" id="fila1C6" style="width: 70px; height: 70px;" />
					</td>
				</tr>
				<tr>
					<td>
						<input class="casilla" type="text" maxlength="1" id="fila2C1" style="width: 70px; height: 70px;" />
					</td>
					<td>
						<input class="casilla" type="text" maxlength="1" id="fila2C2" style="width: 70px; height: 70px;" />
					</td>
					<td>
						<input class="casilla" type="text" maxlength="1" id="fila2C3" style="width: 70px; height: 70px;" />
					</td>
					<td>
						<input class="casilla" type="text" maxlength="1" id="fila2C4" style="width: 70px; height: 70px;" />
					</td>
					<td>
						<input class="casilla" type="text" maxlength="1" id="fila2C5" style="width: 70px; height: 70px;" />
					</td>
					<td>
						<input class="casilla" type="text" maxlength="1" id="fila2C6" style="border-style: none; background-color: rgba(255, 255, 255, 0); width: 70px; height: 70px;" />
					</td>
				</tr>
				<tr>
					<td>
						<input class="casilla" type="text" maxlength="1" id="fila3C1" style="width: 70px; height: 70px;" />
					</td>
					<td>
						<input class="casilla" type="text" maxlength="1" id="fila3C2" style="border-style: none; background-color: rgba(255, 255, 255, 0); width: 70px; height: 70px;" />
					</td>
					<td>
						<input class="casilla" type="text" maxlength="1" id="fila3C3" style="border-style: none; background-color: rgba(255, 255, 255, 0); width: 70px; height: 70px;" />
					</td>
					<td>
						<input class="casilla" type="text" maxlength="1" id="fila3C4" style="border-style: none; background-color: rgba(255, 255, 255, 0); width: 70px; height: 70px;" />
					</td>
					<td>
						<input class="casilla" type="text" maxlength="1" id="fila3C5" style="width: 70px; height: 70px;" />
					</td>
					<td>
						<input class="casilla" type="text" maxlength="1" id="fila3C6" style="border-style: none; background-color: rgba(255, 255, 255, 0); width: 70px; height: 70px;" />
					</td>
				</tr>
			</table>
		</div>

		<!-- boton de verificar respuestas -->
		<button class="verificar" style="margin-top: 500px;" onClick="verificar()">Comprobar respuestas</button>

	</div>

	<script>
		//se esta llamando los sonidos de la carpeta "sonidos"
		var Correcto = document.createElement("audio");
		Correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
		var Incorrecto = document.createElement("audio");
		Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

		var segundos = 240;

		let puntos = 0;

		function iniciarTiempo() {
			document.getElementById('tiempo').innerHTML = segundos + " segundos";
			if (segundos == 0) {
				//se llama a "sonido" y reproducimos el sonido de que esta incorrecto
				Incorrecto.play();

				var xmlhttp = new XMLHttpRequest();

				var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 6 + "&id_curso=" + 1; //cancatenation
				Swal.fire({
					title: 'Oops...',
					text: '¡Verifica tu respuesta!',
					imageUrl: "../../../../../../img/signo.gif",
					imageHeight: 350,
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = 'cj10.php';
					}
				});
				xmlhttp.open("POST", "../../acciones/insertar_cp6.php", true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send(param);
			} else {
				segundos--;
				setTimeout("iniciarTiempo()", 1000);
			}
		}
	</script>

	<script>
		// Deshabilitar todas las casillas
		for (fila = 1; fila <= 3; fila++) {
			for (columna = 1; columna <= 6; columna++) {
				document.getElementById("fila" + fila + "C" + columna).readOnly = true;
			}
		}

		//Palabra nav
		var palabra1_letra1 = document.getElementById("fila1C5");
		var palabra1_letra2 = document.getElementById("fila2C5");
		var palabra1_letra3 = document.getElementById("fila3C5");

		//Palabra menu
		var palabra2_letra1 = document.getElementById("fila1C3");
		var palabra2_letra2 = document.getElementById("fila1C4");
		var palabra2_letra3 = document.getElementById("fila1C5");
		var palabra2_letra4 = document.getElementById("fila1C6");

		//Palabra lista
		var palabra3_letra1 = document.getElementById("fila2C1");
		var palabra3_letra2 = document.getElementById("fila2C2");
		var palabra3_letra3 = document.getElementById("fila2C3");
		var palabra3_letra4 = document.getElementById("fila2C4");
		var palabra3_letra5 = document.getElementById("fila2C5");

		//Palabra li
		var palabra4_letra1 = document.getElementById("fila2C1");
		var palabra4_letra2 = document.getElementById("fila3C1");

		//Habilitar las casillas necesarias (horizontales)
		palabra2_letra1.readOnly = false;
		palabra2_letra2.readOnly = false;
		palabra2_letra3.readOnly = false;
		palabra2_letra4.readOnly = false;

		palabra3_letra1.readOnly = false;
		palabra3_letra2.readOnly = false;
		palabra3_letra3.readOnly = false;
		palabra3_letra4.readOnly = false;
		palabra3_letra5.readOnly = false;

		//Habilitar las casillas necesarias (verticales)

		palabra1_letra1.readOnly = false;
		palabra1_letra2.readOnly = false;
		palabra1_letra3.readOnly = false;

		palabra4_letra1.readOnly = false;
		palabra4_letra2.readOnly = false;

		for (fila = 1; fila <= 3; fila++) {
			for (columna = 1; columna <= 6; columna++) {
				if (document.getElementById("fila" + fila + "C" + columna).readOnly == false) {
					document.getElementById("fila" + fila + "C" + columna).style.backgroundColor = "rgba(61, 172, 244)";
				}
			}
		}

		//Mensaje de verificar respuesta en caso de haber respuestas erroneas
		var errorActivo = 0;

		function error() {
			//se llama a "sonido" y reproducimos el sonido de que esta incorrecto
			Incorrecto.play();
			Swal.fire({
				title: "Verifica tus respuestas",
				text: "Corrige tus respuestas antes de que termine el tiempo",
				icon: "info",
				confirmButtonColor: "#3085d6",
				confirmButtonText: "Continuar",
			})
			errorActivo = 1;
		}

		//Esta funcion es para ejecutarse cada 5 segundos en caso de haber errores
		setInterval('ocultarError()', 5000);

		function ocultarError() {
			if (errorActivo == 1) {
				document.getElementById("mensaje").innerHTML = "";
				document.getElementById("mensaje").className = "";
				errorActivo = 0;
			}
		}

		//Verificar las palabras por casillas sumando sus letras y formar la palabra
		function verificar() {
			document.getElementById("mensaje").innerHTML = "";
			palabra1 = palabra1_letra1.value + palabra1_letra2.value + palabra1_letra3.value;
			palabra2 = palabra2_letra1.value + palabra2_letra2.value + palabra2_letra3.value + palabra2_letra4.value;
			palabra3 = palabra3_letra1.value + palabra3_letra2.value + palabra3_letra3.value + palabra3_letra4.value + palabra3_letra5.value;
			palabra4 = palabra4_letra1.value + palabra4_letra2.value;

			//Condicional para regresar que las repuestas sean correctas, en caso de no serlo, regresará error en la palabra que este mal
			if (palabra1.toLowerCase() == "nav" && palabra2.toLowerCase() == "menu" && palabra3.toLowerCase() == "lista" && palabra4.toLowerCase() == "li") {
				var xmlhttp = new XMLHttpRequest();
				var param = "score=" + 10 + "&validar=" + 'correcto' + "&permiso=" + 6 + "&id_curso=" + 1; //cancatenation

				xmlhttp.onreadystatechange = function() {
					//se llama a "sonido" y reproducimos el sonido de que esta correcto
					Correcto.play();

					Swal.fire({
						title: '¡Bien hecho! ',
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
				xmlhttp.open("POST", "../../acciones/insertar_cp6.php", true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send(param);
			} else {
				if (palabra1.toLowerCase() != "nav") {
					palabra1_letra1.value = "";
					palabra1_letra2.value = "";
					palabra1_letra3.value = "";
					error();
				}

				if (palabra2.toLowerCase() != "menu") {
					palabra2_letra1.value = "";
					palabra2_letra2.value = "";
					palabra2_letra3.value = "";
					palabra2_letra4.value = "";
					error();
				}

				if (palabra3.toLowerCase() != "lista") {
					palabra3_letra1.value = "";
					palabra3_letra2.value = "";
					palabra3_letra3.value = "";
					palabra3_letra4.value = "";
					palabra3_letra5.value = "";
					error();
				}

				if (palabra4.toLowerCase() != "li") {
					palabra4_letra1.value = "";
					palabra4_letra2.value = "";
					error();
				}

				//Corrector de palabras agregando la letra que estaba bien de las que palabras ya agregadas
				if (palabra1.toLowerCase() == "nav") {
					palabra2_letra3.value = "n";
					palabra3_letra5.value = "a";
				}

				if (palabra2.toLowerCase() == "menu") {
					palabra1_letra1.value = "n";
				}

				if (palabra3.toLowerCase() == "lista") {
					palabra4_letra1.value = "l";
					palabra1_letra2.value = "a";
				}

				if (palabra4.toLowerCase() == "controls") {
					palabra3_letra1.value = "l";
				}
			}
		}
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>