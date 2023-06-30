<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/css-juegos/seleccionar-respuestas.css">
    <link rel="stylesheet" href="../../css/css-juegos/gameStyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../../img/img-juegos/lgk.png">
</head>

<body onload="iniciarTiempo(), iniciar() ">
    <!-- Titulo general del juego -->
    <div class="titulo-gen">
        <h2 class="titulo"><b>PRIMEROS PASOS CON EL  CORREO ELECTRÓNICO</b></h2>
    </div>

    <!-- Timer -->
    <div class="timer" id="timer">
        <b>Tiempo: <br>
            <p id="tiempo" style="margin: 0 0 0 0;"></p>
        </b>
    </div>


    <!-- Contenedor principal -->
    <div class="contenido">

        <!-- Boton para regresar -->
        <a href="#"><button style="float: left; position: absolute; margin: 10px 0 0 10px;" class="btn-b"
                id="btn-cerrar-modalV">
                <i class="fas fa-reply"></i></button>
        </a>

        <!-- Titulo secundario -->
        <h4 class="titulo"><b>El juego consiste en responder correctamente una serie de preguntas pierde si se acaba el
                tiempo o responde mal</b></h4>
        <br>


        <!-- Tenoch Moises -->
        <!--contenedor principal-->
        <div class="contenedor">
            <!--para mostrar la puntuacion-->
            <div class="puntaje" id="puntaje"></div>
            <!--es el encabezado donde se muestra la categoria, numero, pregunta e imagen-->
            <div class="encabezado">
                <!--es opcional la parte de mostrar categoria y esta implementado para funcionar sin ella tambien-->
                <div class="categoria" id="categoria"></div>
                <!--No se muestra en la pantalla pero permite que se generen las preguntas "NO MOVER" -->
                <div class="numero" id="numero"></div>
                <!--es donde se muestra la pregunta-->
                <h3><b><div class="pregunta" id="pregunta">
                </div></b></h3>
                <!--muestra una imagen ilustrativa para dar pista de la respuesta pero igual es implementado para  funcionar sin la imagen-->
                <img src="#" class="imagen" id="imagen">
            </div>
            <!--Funcionan con un "onclick" y solo tiene una respuesta correcta-->

            <div class="btn" id="btn1" onclick="oprimir_btn(0)"></div>
            <div class="btn" id="btn2" onclick="oprimir_btn(1)"></div>
            <div class="btn" id="btn3" onclick="oprimir_btn(2)"></div>
            <div class="btn" id="btn4" onclick="oprimir_btn(3)"></div>
            <!--script donde se le da funcionalidad al juego-->
            <script src="../../js/index.js"></script>
        
        </div>
        <!-- boton de verificar respuestas-->
        <!-- NOTA: SE MANDO A LLAMAR LA FUNCION "marcador()" DONDE SE LLEVA LA PUNTUACION
            EN ESA FUNCION SE MANDA A LLAMAR LA FUNCION ORIGINAL "alertExcelent()" -->
        <!-- <button class="verificar" onclick="marcador()  ">Finalizar</button> -->
    </div>
    <!-- Tenoch Moises -->

    <script>
        //Funcion que agrega el sonido al juego
		var correcto = document.createElement("audio");
		correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
		var incorrecto = document.createElement("audio");
		incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

        //ambos
        //funciona para mostrar el resultado al presionar el boton "comprobar respuestas"
        function marcador() {
            if (mostrar_pantalla_juego_términado) {
                swal.fire({
                    title: "Juego finalizado",
                    text:
                        "Puntuación: " + preguntas_correctas + "/" + "5",//preguntas_hechas
                    icon: "success",
                    confirmButtonText: '¡Genial!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        alertExcelent();
                    }
                });
            }
        }
        //funciona para mostrar el resultado al agotarse el tiempo
        function marcadorTiempoAgotado() {
            if (mostrar_pantalla_juego_términado) {
                swal.fire({
                    title: "Juego finalizado",
                    text:
                        "Puntuación: " + preguntas_correctas + "/" + "5",//preguntas_hechas
                    icon: "success",
                    confirmButtonText: '¡Genial!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        tiempoAgotado();
                    }
                });
                incorrecto.play(); //agregando sonido de juego no completado
            }
        }

        //sirve para mostrar cuando el tiempo se ha acabado al final del juego y recarga la pagina
        function tiempoAgotado() {
            Swal.fire({
                title: 'Mala Suerte',
                text: '¡Mejora tu Tiempo!',
                imageUrl: "../../img/img-juegos/loop.gif",
                imageHeight: 350,
                backdrop: `
						rgba(0,143,255,0.6)
						url("../../img/img-juegos/fondo.gif")`,
                confirmButtonColor: '#a14cd9',
                confirmButtonText: '¡Genial!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        }
        //ambos


        //Contador de tiempo en segundos, si se acaba el tiempo sale alerta
        var segundos = 240;

        let puntos = 0;

        function iniciarTiempo() {
            document.getElementById('tiempo').innerHTML = segundos + " segundos";
        /*declarando condiciones que permiten cambiar el color de fondo del timer*/
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
                Swal.fire({
                    title: 'Oops...',
                    text: '¡El tiempo se acabo!',
                    imageUrl: "../../img/img-juegos/loop.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        marcadorTiempoAgotado();
                        // window.location.reload();
                    }
                });
                
            } else {
                segundos--;
                setTimeout("iniciarTiempo()", 1000);
            }
        }

        //Alerta muestra de que el juego fue completado
        function alertExcelent() {
            Swal.fire({
                title: 'Excelente',
                text: '¡Buen trabajo!',
                imageUrl: "../../img/img-juegos/Thumbs-Up.gif",
                imageHeight: 350,
                backdrop: `
						rgba(0,143,255,0.6)
						url("../../img/img-juegos/fondo.gif")`,
                confirmButtonColor: '#a14cd9',
                confirmButtonText: '¡Genial!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
            correcto.play(); //agregando sonido de juego completado
        }
    </script>


</body>

</html>