<?php
session_start();
$id_user = $_SESSION['id_alumno_primaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_primaria'])) {
	header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_primaria'];
$permiso = "capsula43";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 7");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
	header("Location: ../../../../basico/capsulas/acciones/capsulas.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 44;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_primaria WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 7");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_primaria WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 7");
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

	<link rel="stylesheet" type="text/css" href="../../css/css-juegos/cjib2-5.css"> <!--Linkeo de la hoja de estilos-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

	<!-- Titulo general -->
	<div class="titulo-gen">
<<<<<<< HEAD
		<h4 class="titulo" style="margin-left: 550px;"><b>LINUX</b></h4>
        
=======
		<h2 class="titulo" style="margin-left: 240px;"><b>LOCALIZACIÓN DE LOS BOTONES DE ENCENDIDO</b></h2>

>>>>>>> 8ba5f193ec911bac613dd03573a53cb807fc660a
	</div>

	<!-- Tiempo -->
	<div class="timer" id="timer">
		<b style="margin-top: 10px;">Tiempo: <br>
			<p id="tiempo"></p>
		</b>
	</div>

	<div class="contenido">

		<a href="../../../../../../rutas/ruta-in-b.php"><button style="float: left; position: relative; margin: 10px 0 0 10px;" class="btn-b">
				<i class="fas fa-reply"></i></button>
		</a>

		<!-- Titulo secundario -->
		<h4 class="titulo"><b>Encuentra todos los pares de tarjetas para poder ganar el juego</b></h4>
		<br>

		<!-- Boton de iniciar juego, al iniciar, desaparece -->
		<div class="nuevo-juego" id="generar" onclick="generarTablero()">
			Iniciar juego
		</div>

		<!-- Generador del tablero -->
		<div id="tablero"></div>

	</div>

	<script>
		let cantidadTarjetas = 24;
		let iconos = []
		let selecciones = []

		//Iconos pertenecientes a las tarjetas
		function cargarIconos() {
			iconos = [
				'<i><img src="../::/../../img/img_juegos/l1.png" width= "50px"></i>',
				'<i ><img src="../::/../../img/img_juegos/l2.png" width= "50px"></i>',
				'<i><img src="../::/../../img/img_juegos/l3.png" width= "50px" ></i>',
				'<i><img src="../::/../../img/img_juegos/l4.png" width= "50px" ></i></i>',
				'<i><img src="../::/../../img/img_juegos/l5.png" width= "50px" ></i>',
				'<i ><img src="../::/../../img/img_juegos/l6.png" width= "50px"  ></i>',
				'<i><img src="../::/../../img/img_juegos/l7.png" width= "50px" ></i>',
				'<i ><img src="../::/../../img/img_juegos/btnE10.png" width= "50px"  ></i>',
				'<i><img src="../::/../../img/img_juegos/l9.png" width= "50px"  ></i>',
				'<i><img src="../::/../../img/img_juegos/l10.png" width= "50px"></i>',
				'<i><img src="../::/../../img/img_juegos/l11.png" width= "50px"></i>',
				'<i><img src="../::/../../img/img_juegos/l12.png" width= "50px"></i>'
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
					var param = "score=" + 10 + "&validar=" + 'correcto' + "&permiso=" + 44 + "&id_curso=" + 7; //cancatenation
					xmlhttp.open("POST", "../../acciones/insertar_pd44.php", true);
					xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xmlhttp.send(param);
					Swal.fire({
						title: '¡Bien hecho!',
						text: '¡Puntuación guardada con éxito!',
						imageUrl: "../../img/img_juegos/Thumbs-Up.gif",
						imageHeight: 300,
						backdrop: `
									rgba(0,143,255,0.6)
									url("../../img/img_juegos/fondo.gif")
									`,
						confirmButtonColor: '#a14cd9',
						confirmButtonText: 'Aceptar',
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href = '../../../../../../rutas/ruta-in-b.php';
						}
					});
					correcto.play(); //asignando sonido al juego completado
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
		var segundos = 300; //tiempo original 300s
		let puntos = 0;

		//Funcion que inicia el tiempo y verifica si acabo para dar anuncio de que perdió el jugador
		function iniciarTiempo() {
			document.getElementById("tiempo").innerHTML =
<<<<<<< HEAD
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
=======
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
				div.style.cssText = "animation-name: animation2; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
			}
>>>>>>> 8ba5f193ec911bac613dd03573a53cb807fc660a
			//document.getElementById('tiempo').innerHTML = segundos + " segundos";
			if (segundos == 0) {
				var xmlhttp = new XMLHttpRequest();
				var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 44 + "&id_curso=" + 7; //cancatenation
				xmlhttp.open("POST", "../../acciones/insertar_pd44.php", true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send(param);
				Swal.fire({
					title: 'Oops...',
					text: '¡Verifica tu respuesta!',
					imageUrl: "../../img/img_juegos/loop.gif",
					imageHeight: 300,
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.reload();
					}

				});
				incorrecto.play();
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