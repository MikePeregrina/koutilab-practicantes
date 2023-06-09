<?php
session_start();
$id_user = $_SESSION['id_alumno_secundaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_secundaria'])) {
  header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_secundaria'];
$permiso = "capsula5";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_secundaria c INNER JOIN detalle_capsulas_secundaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 4");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
  header("Location: ../../../../basico/capsulas/acciones/capsulas.php");
}
?>

<!DOCTYPE html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KOUTILAB</title>
  <link rel="shortcut icon" href="../../../../../../img/lgk.png">
  <link rel="stylesheet" href="../../css/capsula-juego.css" />
  <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="body">
    <div class="container">
      <a href="#" onclick="history.back(); return false;"><button style="float: left; position: relative" class="btn-b" id="btn-cerrar-modalV">
          <i class="fas fa-reply"></i></button></a><br /><br />
      <div class="new-g" style="text-align: center">Memorama</div>
      <br />
      <!-- CSS -->
      <!-- efectos visuales -->
      <div class="" style="
          display: flex;
          align-items: center;
          justify-content: center;
          margin: 0 auto;
          position: relative;
          top: 180px;
        ">
        <h1>
          Tiempo
          <h1 id="tiempo"></h1>
        </h1>
      </div>
      <style>
        :root {
          --w: calc(70vw / 6);
          --h: calc(70vh / 4);
        }

        * {
          transition: all 0.5s;
        }

        div {
          display: inline-block;
        }

        .area-tarjeta,
        .tarjeta,
        .cara {
          cursor: pointer;
          width: var(--w);
          min-width: 100px;
          height: var(--h);
        }

        .tarjeta {
          position: relative;
          transform-style: preserve-3d;
          animation: iniciar 5s;
        }

        .cara {
          position: absolute;
          backface-visibility: hidden;
          box-shadow: inset 0 0 0 5px white;
          font-size: 500%;
          display: flex;
          justify-content: center;
          align-items: center;
        }

        .trasera {
          background-color: lightcyan;
          transform: rotateY(180deg);
        }

        .superior {
          background: linear-gradient(orange, darkorange);
        }

        .nuevo-juego {
          cursor: pointer;
          background: linear-gradient(orange, darkorange);
          padding: 20px;
          border-radius: 50px;
          border: white 5px solid;
          font-size: 130%;
          display: flex;
          align-items: center;
          justify-content: center;
          margin: 0 auto;
          position: relative;
          top: 180px;
          width: 150px;
        }

        @keyframes iniciar {

          20%,
          90% {
            transform: rotateY(180deg);
          }

          0%,
          100% {
            transform: rotateY(0deg);
          }
        }
      </style>

      <!-- HTML -->
      <!-- estructura visual -->

      <div id="tablero"></div>

      <br />

      <div class="nuevo-juego" onclick="generarTablero()">Nuevo Juego</div>
    </div>
  </div>

  <!-- JS -->
  <!-- parte lógica -->
  <script>
    //se esta llamando los sonidos de la carpeta "sonidos"
    var Correcto = document.createElement("audio");
    Correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
    var Incorrecto = document.createElement("audio");
    Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

    let iconos = [];
    let selecciones = [];
    let tiempo = 60000;
    let intentos = 0;
    let puntos = 0;
    let reloj = 0;
    let total = 0;
    let final = Date.now() + 60000;
    let gano = false;
    // generarTablero()
    let nombreJugador = "";
    let {
      value: nombre
    } = Swal.fire({
      title: "Juego de memoria",
      input: "text",
      inputLabel: "Ingresa tu nombre",
      inputPlaceholder: "Nombre",
    }).then((result) => {
      nombreJugador = result.value;
      console.log(result.value);
      // generarTablero()
    });

    function cargarIconos() {
      iconos = [
        '<i class="fa-solid fa-wifi"></i>',
        '<i class="fa-solid fa-globe"></i>',
        '<i class="fa-solid fa-circle-info"></i>',
        '<i class="fa-brands fa-html5"></i>',
        '<i class="fa-solid fa-laptop-code"></i>',
        '<i class="fa-brands fa-edge-legacy"></i>',
        '<i class="fa-brands fa-chrome"></i>',
        '<i class="fa-brands fa-safari"></i>',
        '<i class="fa-brands fa-firefox-browser"></i>',
        '<i class="fa-solid fa-list-ol"></i>',
        '<i class="fa-solid fa-list"></i>',
        '<i class="fa-solid fa-code"></i>'
      ];
    }

    function generarTablero() {
      cargarIconos();
      tiempo = 60000;
      intentos = 0;
      reloj = 0;
      total = 0;
      final = Date.now() + 60000;
      selecciones = [];
      let tablero = document.getElementById("tablero");
      let tarjetas = [];
      for (let i = 0; i < 24; i++) {
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
                `);
        if (i % 2 == 1) {
          iconos.splice(0, 1);
        }
      }
      tarjetas.sort(() => Math.random() - 0.5);
      tablero.innerHTML = tarjetas.join(" ");
      document.getElementById("tiempo").innerHTML = "" + reloj;

      // setTimeout(() => {

      //     reloj++;

      //     document.getElementById("tiempo").innerHTML = ": " + reloj
      // }, 1000);
      tiempoRes();
      // setTimeout(() => {
      //     Swal.fire({
      //         title: 'Perdiste',
      //         text: "se te acabo el tiempo",
      //         icon: 'info',
      //         confirmButtonColor: '#3085d6',
      //         confirmButtonText: 'Reintentar'
      //     }).then((result) => {
      //         if (result.isConfirmed) {
      //             window.location.reload()
      //         }
      //     })
      //     // generarTablero();
      // }, tiempo);
    }

    function tiempoRes() {
      let cronometro = document.getElementById("tiempo");

      let elcrono = setInterval(tiempo, 10);

      function tiempo() {
        if (gano) {} else {
          let diferencia = final - Date.now();
          let sg = diferencia / 1000;
          if (diferencia <= 0) {
            clearInterval(elcrono);
            cronometro.classList.add("rojo");
            sg = 0.0;
          }
          cronometro.innerHTML = sg;
          if (sg == 0) {
            //se llama a "sonido" y reproducimos el sonido de que esta incorrecto
            Incorrecto.play();
            Swal.fire({
              title: "Perdiste",
              text: "se te acabo el tiempo, Puntos" + puntos,
              icon: "info",
              confirmButtonColor: "#3085d6",
              confirmButtonText: "Reintentar",
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.reload();
              }
            });
          }
        }
      }
    }

    function seleccionarTarjeta(i) {
      let tarjeta = document.getElementById("tarjeta" + i);
      if (tarjeta.style.transform != "rotateY(180deg)") {
        tarjeta.style.transform = "rotateY(180deg)";
        selecciones.push(i);
      }
      if (selecciones.length == 2) {
        deseleccionar(selecciones);
        selecciones = [];
      }
    }

    function deseleccionar(selecciones) {
      setTimeout(() => {
        let trasera1 = document.getElementById("trasera" + selecciones[0]);
        let trasera2 = document.getElementById("trasera" + selecciones[1]);
        if (trasera1.innerHTML != trasera2.innerHTML) {
          intentos++;

          let tarjeta1 = document.getElementById("tarjeta" + selecciones[0]);
          let tarjeta2 = document.getElementById("tarjeta" + selecciones[1]);
          tarjeta1.style.transform = "rotateY(0deg)";
          tarjeta2.style.transform = "rotateY(0deg)";
        } else {
          intentos++;
          puntos += 8.3;
          total++;
          if (total == 12) {
            gano = true;
            //Guardar puntaje
            var xmlhttp = new XMLHttpRequest();
            var param = "score=" + 10 + "&validar=" + 'correcto' + "&permiso=" + 9 + "&id_curso=" + 4; //cancatenation
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                //se llama a "sonido" y reproducimos el sonido de que esta correcto
                Correcto.play();
                Swal.fire({
                  title: '¡Bien hecho!',
                  text: '¡Puntuación guardada con éxito!',
                  icon: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Aceptar',
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = '../../../../../../rutas/ruta-py-b.php';
                  }
                });
              }
            }
            xmlhttp.open("POST", "../../acciones/insertar_pd9.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send(param);
            Swal.fire({
              title: "Ganaste " + nombreJugador,
              text: "ganaste en " + intentos + " intentos puntuaje total 100",
              icon: "info",
              confirmButtonColor: "#3085d6",
              confirmButtonText: "Siguiente",
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.reload();
              }
            });
            // alert();
            // generarTablero()
          }
          trasera1.style.background = "plum";
          trasera2.style.background = "plum";
        }
        console.log(
          "🚀 ~ file: index.html ~ line 295 ~ setTimeout ~ intentos",
          intentos
        );
      }, 1000);
    }
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
    onkeydown = (e) => {
      let tecla = e.which || e.keyCode;

      // Evaluar si se ha presionado la tecla Ctrl:
      if (e.ctrlKey) {
        // Evitar el comportamiento por defecto del nevagador:
        e.preventDefault();
        e.stopPropagation();

        // Mostrar el resultado de la combinación de las teclas:
        if (tecla === 85) console.log("Ha presionado las teclas Ctrl + U");

        if (tecla === 83) console.log("Ha presionado las teclas Ctrl + S");
      }
    };
  </script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  <script defer src="../../js/functions.js"></script>
</body>