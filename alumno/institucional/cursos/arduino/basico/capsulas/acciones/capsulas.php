<!DOCTYPE html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KOUTILAB</title>
  <link rel="shortcut icon" href="../../../../../img/lgk.png">
  <link rel="stylesheet" href="../css/capsula-teoria.css" />
  <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdn.plyr.io/3.7.2/plyr.css" />
  <script src="https://cdn.plyr.io/3.7.2/plyr.js" defer></script>
</head>

<body>
  <div class="body">
    <div class="container">
      <section id="container-slider">
        <ul class="listslider">
          <!-- Agregar linea de código <li><a itlist="itList_X" href="#"></a></li> cada que se agrega una imagen más-->
          <li>
          </li>
        </ul>
        <ul id="slider">
          <li style="background-image: url('../img/PA2.gif'); z-index:0; opacity: 1;">
            <a href="../../../../../rutas/ruta-ar-b.php" style="text-decoration: none;"><button type="submit" class="btn-grd1" style="margin-left: 61.5%;">Regresar</button></a>
          </li>
        </ul>
      </section>
    </div>
  </div>

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
  <script defer src="../js/functions.js"></script>
</body>