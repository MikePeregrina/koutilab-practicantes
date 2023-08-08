<?php
session_start();
$id_user = $_SESSION['id_alumno_primaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_primaria'])) {
  header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
?>

<!DOCTYPE html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KOUTILAB</title>
  <link rel="shortcut icon" href="../../../../../../img/lgk.png">
  <link rel="stylesheet" href="../../css/capsula-teoria.css" />
  <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdn.plyr.io/3.7.2/plyr.css" />
  <script src="https://cdn.plyr.io/3.7.2/plyr.js" defer></script>
</head>

<body>
  <div class="body">
    <div class="container">
      <a href="#" onclick="history.back(); return false;"><button style="float: left;" class="btn-b" id="btn-cerrar-modalV"><i class="fas fa-reply"></i></button></a>
      <div class="new-g" style="text-align:center;">Bienvenido al curso</div><br>
      <video class="js-player" poster="thumbnail.jpg" playsinline controls>
        <source src="../../vid/B.mp4" type="video/mp4" />
      </video>
    </div>
  </div>
  <script>
    /*<![CDATA[*/
    window.addEventListener("DOMContentLoaded", () => {
      const players = Array.from(document.querySelectorAll(".js-player")).map(
        (p) =>
        new Plyr(p, {
          youtube: {
            noCookie: true
          },
          i18n: {
            quality: "Calidad",
            speed: "Velocidad",
            captions: "Subtítulos",
            disabled: "Desactivar",
            enabled: "Activar",
          },
        })
      );
    }); /*]]>*/
  </script>
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
</body>