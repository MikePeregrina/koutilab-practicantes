<?php
session_start();
$id_user = $_SESSION['id_alumno'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
  header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno'];
$permiso = "capsula12";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_preparatoria c INNER JOIN detalle_capsulas_preparatoria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 7");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
  header("Location: ../../../../basico/capsulas/acciones/capsulas.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 13;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_preparatoria WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 7");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_preparatoria WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 7");
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
  <link rel="stylesheet" href="../../css/css-juegos/select-word.css" />
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
    <h2 class="titulo"><b>CONOCIMIENTO DE DISPOSITIVOS</b></h2>
  </div>

  <!-- Contenedor principal -->
  <div class="contenido">
    <div class="cont-st">
      <a href="../../../../../../rutas/ruta-in-b.php">
        <button class="btn-b">
          <i class="fas fa-reply"></i>
        </button>
      </a>
      <h4 class="titulo"><b>Desliza las tarjetas haciendo click en ellas para desplazarlas y descubrir la imagen real</b></h4>
    </div>
    <!--Generando contenedor que almacenara las preguntas y respuestas del juego-->
    <div class="container">
      <section>
        <!--GENERANDO SECCION PARA PREGUNTAS Y RESPUESTAS-->
        <!--Generando pregunta 1-->


        <h3>1- ¿Es una máquina especialmente diseñada para procesar información en código, una máquina electrónica automática, que puede realizar operaciones simples y complejas?
          <select class="select" id="respuesta0"><!--Generando lista de opciones de respuesta de la pregunta 1-->
            <option value="----">...</option>
            <option value="incorrecto">Dispositivos de entrada</option>
            <option value="incorrecto">Sistema Operativo</option>
            <option value="correcto">Computadoras</option>
          </select>
        </h3>
        <!--Generando pregunta 2-->
        <h3>2- ¿Unidad central de proceso o CPU, monitor y teclado son componentes de...?
          <select class="select" id="respuesta1"><!--Generando lista de opciones de respuesta de la pregunta 2-->
            <option value="----">...</option>
            <option value="incorrecto">Sistema Operativo</option>
            <option value="incorrecto">Software</option>
            <option value="correcto">Hadware</option>
          </select>
        </h3>
        <!--Generando pregunta 3-->
        <h3>3- ¿Son los programas encargados de administrar y gestionar de manera eficiente todos los recursos de un ordenador y otros dispositivos?
          <select class="select" id="respuesta2"><!--Generando lista de opciones de respuesta de la pregunta 3-->
            <option value="----">...</option>
            <option value="correcto">Sistema Operativo</option>
            <option value="incorrecto">Software</option>
            <option value="incorrecto"> Hadware</option>
          </select>
        </h3>
        <!--Generando primer pregunta-->

        <h3>4- ¿Es un dispositivo electrónico,swe conectan través de diferentes protocolos como Bluetooth, NFC, Wi-Fi,que funcionan de forma interactiva y autónoma?
          <select class="select" id="respuesta3"><!--Generando opciones de respuesta de la pregunta-->
            <option value="----">...</option>
            <option value="incorrecto">Sistema Operativo</option>
            <option value="incorrecto">Hadware</option>
            <option value="correcto">Dispositivos Inteligentes</option>
          </select>
        </h3>






        <!--Generando primer pregunta-->
      </section>
    </div>

    <!--Boton para verificar la respuesta-->
    <div class="btn-ctn">
      <button class="verificar" onClick="verificar()">
        Comprobar respuestas
      </button>
    </div>

  </div>
  <p id="resultado"></p>

  <!-- CAMBIOS -->
  <footer class="footerimga">
    <div class="imagen-footer">
      <img src="../../img/img_juegos/benvenida.png" alt="No-image">
    </div>
  </footer>
  <!-- fIN CAMBIOS -->

  <script>
    var correcto = document.createElement("audio");
    correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
    var incorrecto = document.createElement("audio");
    incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

    //Contador de tiempo en segundos, si se acaba el tiempo sale alerta
    var segundos = 120; //120

    //funcion que permite definir el tiempo que tiene el jugador
    function iniciarTiempo() {
      document.getElementById("tiempo").innerHTML = segundos + " segundos";
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

      if (segundos == 0) {
        var xmlhttp = new XMLHttpRequest();
        var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 13 + "&id_curso=" + 7 + "&redireccion=" + '../contenido/juegos/cjib1-4.php'; //cancatenation
        xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(param);
        Swal.fire({
          title: "Oops...Inténtalo nuevamente, te has quedado sin tiempo",
          text: "",
          imageUrl: "../../img/img_juegos/loop.gif",
          imageHeight: 350,
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.reload();
          }
        });
        incorrecto.play(); //agregando sonido al juego no completado

      } else {
        segundos--;
        setTimeout("iniciarTiempo()", 1000);
      }
    }

    //funcion Error, determina que las respuestas sean correctas
    function error() {
      var xmlhttp = new XMLHttpRequest();
      var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 13 + "&id_curso=" + 7 + "&redireccion=" + '../contenido/juegos/cjib1-4.php'; //cancatenation
      xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xmlhttp.send(param);
      Swal.fire({
        title: "¡Oh no!",
        text: "Comprueba tus respuestas, e intentalo nuevamente",
        imageUrl: "../../img/img_juegos/loop.gif",
        imageHeight: 350,
        backdrop: `
						rgba(0,143,255,0.6)
						url("../../img/img_juegos/fondo.gif")`,
        confirmButtonColor: "#a14cd9",
        confirmButtonText: "¡Sigue intentando",
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.reload();
        }
      });
    }

    //Alerta muestra de que el juego fue completado
    function alertExcelent() {
      var xmlhttp = new XMLHttpRequest();
      var param = "score=" + 10 + "&validar=" + 'correcto' + "&permiso=" + 13 + "&id_curso=" + 7 + "&redireccion=" + '../contenido/juegos/cjib1-4.php'; //cancatenation
      xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xmlhttp.send(param);
      Swal.fire({
        title: "¡Felicidades!",
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
          window.location.href = '../../../../../../rutas/ruta-in-b.php';
        }
      });
      correcto.play(); //agregando sonido al juego completado
    }

    //funcion de validar respuestas
    function verificar() {
      var respuesta0 = document.getElementById("respuesta0").value; //valida la respuesta 1
      var respuesta1 = document.getElementById("respuesta1").value; //valida la respuesta 2
      var respuesta2 = document.getElementById("respuesta2").value; //valida la respuesta 3
      var respuesta3 = document.getElementById("respuesta3").value; //valida la respuesta 4

      if (
        respuesta0 == "correcto" &&
        respuesta1 == "correcto" &&
        respuesta2 == "correcto" &&
        respuesta3 == "correcto" &&
        respuesta1 == "correcto"
      ) {
        document.getElementById("resultado").innerHTML = "";
        alertExcelent(); //mandando a traer la funcion alertExelent para que se muestre cuando el usuario haya capturado las respuestas correctas
      } else {
        document.getElementById("resultado").innerHTML = "";
        error(); //mandando a llamar la funcion alertBad para indicarle al jugador que sus respuestas son incorrectas
      }
    }
  </script>
</body>

</html>