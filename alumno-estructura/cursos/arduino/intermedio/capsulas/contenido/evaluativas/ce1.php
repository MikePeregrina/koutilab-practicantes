<?php
session_start();
$id_user = $_SESSION['id_alumno_preparatoria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_preparatoria'])) {
  header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_preparatoria'];
$permiso = "capsula7";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_preparatoria c INNER JOIN detalle_capsulas_preparatoria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 8");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
  header("Location: ../../../../intermedio/CAPSULAS/acciones/capsulas.php");
}
?>

<!DOCTYPE html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KOUTILAB</title>
  <link rel="shortcut icon" href="../../../../../../img/lgk.png">
  <link rel="stylesheet" href="../../css/capsula-evaluar.css" />
  <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="body">
    <div class="container">
      <a href="../../../../../../rutas/ruta-ar-i.php"><button style="float: left;" class="btn-b" id="btn-cerrar-modalV"><i class="fas fa-reply"></i></button></a>
      <div class="new-g" style="text-align: center;">Evaluación 1 Arduino Intermedio</div><br>
      <div class="quiz-wrapper">
        <hr>
        <p id="inform" class="question-description">Obtenga tantos puntajes como desee en el cuestionario de 5 preguntas. Arrastre y suelte las opciones en el cuadro de arriba.</p>
        <p id="question" style="display: none;" class="question-description"></p>
        <div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
        <div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
        <div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
        <div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
        <div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
        <button id="submit" class="button-15" role="button" style="display: none;">Contestar</button>
        <button id="next" class="button-15" role="button" style="display: none;">Siguiente pregunta</button>
        <button id="start" class="button-15" role="button">Iniciar evaluación</button>
        <button id="save" class="button-15" role="button" style="display: none;">Guardar puntaje</button>
        <p id="score" class="question-description"></p>
        <p id="error" class="question-description"></p>
        <div class="lightbox-bg"></div>
      </div>
    </div>
  </div>
  <script src="../../js/ce1.js"></script>
  <script>
    function disableIE() {
      if (document.all) {
        return false;
      }
    }

    function disableNS(e) {
      if (document.layers || (document.getElementById && !document.all)) {
        if (e.which == 2 || e.which == 3) {
          return false;
        }
      }
    }
    if (document.layers) {
      document.captureEvents(Event.MOUSEDOWN);
      document.onmousedown = disableNS;
    } else {
      document.onmouseup = disableNS;
      document.oncontextmenu = disableIE;
    }
    document.oncontextmenu = new Function("return false");
  </script>
  <script>
    onkeydown = e => {
      let tecla = e.which || e.keyCode;

      // Evaluar si se ha presionado la tecla Ctrl:
      if (e.ctrlKey) {
        // Evitar el comportamiento por defecto del nevagador:
        e.preventDefault();
        e.stopPropagation();

        // Mostrar el resultado de la combinación de las teclas:
        if (tecla === 85)
          console.log("Ha presionado las teclas Ctrl + U");

        if (tecla === 83)
          console.log("Ha presionado las teclas Ctrl + S");
      }
    }
  </script>
  <script src="sweetalert2.all.min.js"></script>
</body>