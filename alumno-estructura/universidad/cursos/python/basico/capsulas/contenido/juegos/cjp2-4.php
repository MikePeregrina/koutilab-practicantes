<?php
session_start();
$id_user = $_SESSION['id_alumno_universidad'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_universidad'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_universidad'];
$permiso = "capsula35";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_universidad c INNER JOIN detalle_capsulas_universidad d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 4");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: ../../../../basico/capsulas/acciones/capsulas.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 36;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_universidad WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 4");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_universidad WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 4");
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../../img/img-juegos/lgk.png" />
    <link rel="stylesheet" href="../../css/css-juegos/robot.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body onload="iniciarTiempo();">
    <!-- Parte que modifique Inicio -->
    <!-- Timer -->
    <div class="timer" id="timer">
        <b>Tiempo: <br>
            <p id="tiempo" style="margin: 0 0 0 0;"></p>
        </b>
    </div>

    <div class="titulo-gen">
        <h2 class="titulo"><b>ESTRUCTURAS CONDICIONALES</b></h2>
    </div>

    <div class="cont-st">
        <a href="#" onclick="history.back();"><button style="float: left; position: absolute; margin: 10px 0 0 10px;" class="btn-b" id="btn-cerrar-modalV">
                <i class="fas fa-reply"></i></button>
        </a>
        <h4 class="titulo"><b>Descubre la palabra o frase mediante la pista y da click sobre las letras para escribirla,
                si te equivocas se construirá Koubot y al finalizar perderás</b></h4>

        <div class="content-1">
            <canvas id="pantalla" width="1200px" height="650px" onload="iniciarTiempo();">
                <!-- etiqueta del canvas con sus medidas en la pantalla -->
            </canvas>
        </div>
        <!-- El boton que nos sirve para recargar la pagina y asi generar una nueva palabra y volver a jugar -->
    </div>

    <footer class="footerimga">
        <div class="imagen-footer">
            <img src="../../img/img-juegos/benvenida.png" alt="No-image">
        </div>
    </footer>
    <script>
        // var Correcto = document.createElement("audio");
        // Correcto.src = "../acciones/sonidos/correcto.mp3";
        // var Incorrecto = document.createElement("audio");
        // Incorrecto.src = "../acciones/sonidos/incorrecto.mp3";

        var segundos = 120;
        let puntos = 0;

        //Funcion que inicia el tiempo y verifica si acabo para dar anuncio de que perdió el jugador
        var count = 1000;
        //Agregando animacion a el timer
        function iniciarTiempo() {
            document.getElementById("tiempo").innerHTML =
                segundos + " segundos";
            if (segundos <= 60) {
                var div = document.getElementById("timer");
                div.style.cssText = "animation-name: animation1; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
            }
            if (segundos <= 30) {
                var div = document.getElementById("timer");
                div.style.cssText = "animation-name: animation2; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
            }
            if (segundos <= 10) {
                var div = document.getElementById("timer");
                div.style.cssText = "animation-name: animation2; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
            }
            if (segundos == 0) {
                var puntos = <?php echo $puntosGanados; ?>

                var xmlhttp = new XMLHttpRequest();
                var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 36 + "&id_curso=" + 4 + "&redireccion=" + '../contenido/juegos/cjp2-4.php'; //cancatenation
                xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
                xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlhttp.send(param);
                Swal.fire({
                    title: "Oops...",
                    text: "Se acabó el tiempo",
                    imageUrl: "../../img/img-juegos/loop.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
                Incorrecto.play(); //Agregando sonido al juego no completado

                loseText.setText("Juego terminado");
                player.setTint(0xff0000);
                player.anims.play("turn");
                gameoverSound();
                gameOver = true;
            } else {
                segundos--;
                setTimeout("iniciarTiempo()", count);
            }
        }
    </script>
    <script>
        /* Variables */
        var ctx;
        var canvas;
        var palabra;
        var letras = "QWERTYUIOPASDFGHJKLÑZXCVBNM";
        var colorTecla = "rgba(61, 172, 244)";
        var colorMargen = "white";
        var inicioX = 330;
        var inicioY = 450;
        var lon = 35;
        var margen = 20;
        var pistaText = "";

        /* Arreglos */
        var teclas_array = new Array();
        var letras_array = new Array();
        var palabras_array = new Array();

        /* Variables de control */
        var aciertos = 0;
        var errores = 0;

        /* Palabras */
        palabras_array.push("CONDICIONALES");
        palabras_array.push("IF");
        palabras_array.push("ELIF");
        palabras_array.push("ELSE");

        /* Objetos */
        function Tecla(x, y, ancho, alto, letra) {
            this.x = x;
            this.y = y;
            this.ancho = ancho;
            this.alto = alto;
            this.letra = letra;
            this.dibuja = dibujaTecla;
        }

        function Letra(x, y, ancho, alto, letra) {
            this.x = x;
            this.y = y;
            this.ancho = ancho;
            this.alto = alto;
            this.letra = letra;
            this.dibuja = dibujaCajaLetra;
            this.dibujaLetra = dibujaLetraLetra;
        }

        /* Funciones */

        /* Dibujar Teclas*/
        function dibujaTecla() {
            ctx.fillStyle = colorTecla;
            ctx.strokeStyle = colorMargen;
            ctx.fillRect(this.x, this.y, this.ancho, this.alto);
            ctx.strokeRect(this.x, this.y, this.ancho, this.alto);

            ctx.fillStyle = "white";
            ctx.font = "bold 20px arial";
            ctx.fillText(
                this.letra,
                this.x + this.ancho / 2 - 7,
                this.y + this.alto / 2 + 7
            );
        }

        /* Dibua la letra y su caja */
        function dibujaLetraLetra() {
            var w = this.ancho;
            var h = this.alto;
            ctx.fillStyle = "black";
            ctx.font = "bold 40px arial";
            ctx.fillText(this.letra, this.x + w / 2 - 12, this.y + h / 2 + 14);
        }

        function dibujaCajaLetra() {
            ctx.fillStyle = "white";
            ctx.strokeStyle = "gray";
            ctx.fillRect(this.x, this.y, this.ancho, this.alto);
            ctx.strokeRect(this.x, this.y, this.ancho, this.alto);
        }

        /// Funcion para dar una pista la usuario ////
        function pistaFunction(palabra) {
            let pista = ""; // Se crea la variable local pista que contendra nuestra frase de pista
            switch (
                palabra // Se crea un switch para poder controlar las pistas segun la palabra
            ) {
                case "CONDICIONALES": // Se debera hacer un case por cada palabra
                    pista = "El tema que hoy estamos aprendiendo se llama estructuras...";
                    break; // Es importante el break en cada case
                case "IF": // Se debera hacer un case por cada palabra
                    pista = "Es la estructura que nos indica que entra la primera condición de nuestro programa";
                    break; // Es importante el break en cada case
                case "ELIF": // Se debera hacer un case por cada palabra
                    pista = "Es la condición que sigue después de otra condición en caso de que la primera no se cumpla";
                    break; // Es importante el break en cada case
                case "ELSE": // Se debera hacer un case por cada palabra
                    pista = "Es la opción de respaldo en caso de que una condición no se cumpla";
                    break; // Es importante el break en cada case
                default: // El defaul se puede omitir //
                    pista = "No hay pista aun xP";
            }
            // Pintamos la palabra en el canvas , en este ejemplo se pinta arriba a la izquierda //
            ctx.fillStyle = "gray"; // Aqui ponemos el color de la letra
            ctx.font = "bold 15px arial"; // aqui ponemos el tipo y tamaño de la letra
            ctx.fillText("Pista: " + pista, 200, 50); // aqui ponemos la frase en nuestro caso la variable pista , seguido de la posx y posy
        }

        /* Distribuir nuestro teclado con sus letras respectivas al acomodo de nuestro array */
        function teclado() {
            var ren = 0;
            var col = 0;
            var letra = "";
            var miLetra;
            var x = inicioX;
            var y = inicioY;
            for (var i = 0; i < letras.length; i++) {
                letra = letras.substr(i, 1);
                miLetra = new Tecla(x, y, lon, lon, letra);
                miLetra.dibuja();
                teclas_array.push(miLetra);
                x += lon + margen;
                col++;
                if (col == 10) {
                    col = 0;
                    ren++;
                    if (ren == 2) {
                        x = 390;
                    } else {
                        x = inicioX;
                    }
                }
                y = inicioY + ren * 60;
            }
        }

        /* aqui obtenemos nuestra palabra aleatoriamente y la dividimos en letras */
        function pintaPalabra() {
            var p = Math.floor(Math.random() * palabras_array.length);
            palabra = palabras_array[p];

            pistaFunction(palabra);

            var w = canvas.width;
            var len = palabra.length;
            var ren = 0;
            var col = 0;
            var y = 370;
            var lon = 50;
            var x = (w - (lon + margen) * len) / 2;
            for (var i = 0; i < palabra.length; i++) {
                letra = palabra.substr(i, 1);
                miLetra = new Letra(x, y, lon, lon, letra);
                miLetra.dibuja();
                letras_array.push(miLetra);
                x += lon + margen;
            }
        }

        /* dibujar cadalzo y partes del pj segun sea el caso */
        function horca(errores) {
            var imagen = new Image();
            imagen.src = "../../img/img-juegos/ahorcado" + errores + ".png";
            imagen.onload = function() {
                ctx.drawImage(imagen, 450, 60, 450, 250);
            };
            /*************************************************
                        // Imagen 2 mas pequeña a un lado de la horca //       
                        var imagen = new Image();
                        imagen.src = "imagenes/ahorcado"+errores+".png";
                        imagen.onload = function(){
                            ctx.drawImage(imagen, 620, 0, 100, 100);
                        }
                        *************************************************/
        }

        /* ajustar coordenadas */
        function ajusta(xx, yy) {
            var posCanvas = canvas.getBoundingClientRect();
            var x = xx - posCanvas.left;
            var y = yy - posCanvas.top;
            return {
                x: x,
                y: y
            };
        }

        /* Detecta tecla clickeada y la compara con las de la palabra ya elegida al azar */
        function selecciona(e) {
            var pos = ajusta(e.clientX, e.clientY);
            var x = pos.x;
            var y = pos.y;
            var tecla;
            var bandera = false;
            for (var i = 0; i < teclas_array.length; i++) {
                tecla = teclas_array[i];
                if (tecla.x > 0) {
                    if (
                        x > tecla.x &&
                        x < tecla.x + tecla.ancho &&
                        y > tecla.y &&
                        y < tecla.y + tecla.alto
                    ) {
                        break;
                    }
                }
            }
            if (i < teclas_array.length) {
                for (var i = 0; i < palabra.length; i++) {
                    letra = palabra.substr(i, 1);
                    if (letra == tecla.letra) {
                        /* comparamos y vemos si acerto la letra */
                        caja = letras_array[i];
                        caja.dibujaLetra();
                        aciertos++;
                        bandera = true;
                    }
                }
                if (bandera == false) {
                    /* Si falla aumenta los errores y checa si perdio para mandar a la funcion gameover */
                    errores++;
                    horca(errores);
                    if (errores == 4) gameOver(errores);
                }
                /* Borra la tecla que se a presionado */
                ctx.clearRect(
                    tecla.x - 1,
                    tecla.y - 1,
                    tecla.ancho + 2,
                    tecla.alto + 2
                );
                tecla.x - 1;
                /* checa si se gano y manda a la funcion gameover */
                if (aciertos == palabra.length) gameOver(errores);
            }
        }
        var Correcto = document.createElement("audio");
        Correcto.src = "/juegoAhorcado-master/acciones/sonidos/correcto.mp3";
        var Incorrecto = document.createElement("audio");
        Incorrecto.src = "/juegoAhorcado-master/acciones/sonidos/incorrecto.mp3";

        /* Borramos las teclas y la palabra con sus cajas y mandamos msj segun el caso si se gano o se perdio */
        function gameOver(errores) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = "black";

            ctx.font = "bold 50px arial";
            if (errores < 4) {
                var puntos = <?php echo $puntosGanados; ?>

                var xmlhttp = new XMLHttpRequest();
                var param = "score=" + 10 + "&validar=" + 'correcto' + "&permiso=" + 36 + "&id_curso=" + 4 + "&redireccion=" + '../contenido/juegos/cjp2-4.php'; //cancatenation
                xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
                xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlhttp.send(param);
                Swal.fire({
                    title: "¡Bien hecho!",
                    text: "¡Buen trabajo! Obtienes " + puntos + " puntos de logros",
                    imageUrl: "../../img/img-juegos/Thumbs-Up.gif",
                    imageHeight: 350,
                    backdrop: `
							rgba(0,143,255,0.6)
							url("../../img/img-juegos/fondo.gif")
							`,
                    confirmButtonColor: "#a14cd9",
                    confirmButtonText: "Aceptar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../../../../../../rutas/ruta-py-b.php';
                    }
                });
                Correcto.play(); //Agregando sonido al juego completado
            } else {
                var puntos = <?php echo $puntosGanados; ?>

                var xmlhttp = new XMLHttpRequest();
                var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 36 + "&id_curso=" + 4 + "&redireccion=" + '../contenido/juegos/cjp2-4.php'; //cancatenation
                xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
                xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlhttp.send(param);
                Swal.fire({
                    title: "¡Error!",
                    text: "¡Vuelve a interntarlo!",
                    imageUrl: "../../img/img-juegos/loop.gif",
                    imageHeight: 350,
                    confirmButtonColor: "#a14cd9",
                    confirmButtonText: "Aceptar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
                Incorrecto.play();
            }
        }

        /* Detectar si se a cargado nuestro contexco en el canvas, iniciamos las funciones necesarias para jugar o se le manda msj de error segun sea el caso */
        window.onload = function() {
            canvas = document.getElementById("pantalla");
            if (canvas && canvas.getContext) {
                ctx = canvas.getContext("2d");
                if (ctx) {
                    teclado();
                    pintaPalabra();
                    horca(errores);
                    canvas.addEventListener("click", selecciona, false);
                } else {
                    alert("Error al cargar el contexto!");
                }
            }
            iniciarTiempo();
        };
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>