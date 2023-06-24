<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/css-juegos/seleccion-palabras.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="img/lgk.png">  <!--icono de koutilab al comienzo de la página-->
</head>

<body onload="iniciarTiempo()">
    <!-- Titulo general del juego -->
    <div class="titulo-gen">
        <h2 class="titulo"><b>SELECCION DE RESPUESTA PARA UN ENUNCIADO</b></h2>
    </div>

    <!-- Timer -->
    <div class="timer" id="timer">
        <b>Tiempo: <br />
            <p id="tiempo" style="margin: 0 0 0 0"></p>
        </b>
    </div>

    <!-- Contenedor principal -->
    <div class="contenido">
        <!-- Boton para regresar -->
        <a href="#"><button style="float: left; position: absolute; margin: 10px 0 0 10px" class="btn-b"
                id="btn-cerrar-modalV">
                <i class="fas fa-reply"></i>
            </button>
        </a>
        <!-- Titulo secundario -->
        <h4 class="titulo"><b>El jugador deberá seleccionar una respuesta de las listas seleccionables</b></h4>
        <!--Generando contenedor que almacenara las preguntas y respuestas del juego-->
        <div class="container">
            <section ><!--GENERANDO SECCION PARA PREGUNTAS Y RESPUESTAS-->
                <!--Generando pregunta 1-->
                <h3>1- ¿Cuál es el navegador que se encuentra predeterminado en cualquier equipo con sistema operativo windows?
                    <select class="select"
                        id="respuesta0"><!--Generando lista de opciones de respuesta de la pregunta 1-->
                        <option value="----">...</option>
                        <option value="incorrecto">YAHOO!</option>
                        <option value="incorrecto">OPERA</option>
                        <option value="correcto">BING</option>
                    </select>
                </h3>
                <!--Generando pregunta 2-->
                <h3>2- ¿En qué año fué lanzado al mercado el navegador bing?
                    <select class="select"
                        id="respuesta1"><!--Generando lista de opciones de respuesta de la pregunta 2-->
                        <option value="----">...</option>
                        <option value="incorrecto">2023</option>
                        <option value="correcto">2009</option>
                        <option value="incorrecto">2006</option>
                    </select><br><br><br>
                </h3>
                <!--Generando pregunta 3-->
                <h3>3- ¿Cuál es el motor de búsqueda que se conoce como proveedor de correo electrónico?
                    <select class="select"
                        id="respuesta2"><!--Generando lista de opciones de respuesta de la pregunta 3-->
                        <option value="----">...</option>
                        <option value="correcto">YAHOO!</option>
                        <option value="incorrecto">EDGE</option>
                        <option value="incorrecto">GOOGLE CHROME</option>
                    </select><br>
                </h3>
                <!--Generando pregunta 4-->
                <h3>4- ¿Qué es un motor de búsqueda?
                    <select class="select" id="respuesta3"><!--Generando opciones de respuesta de la pregunta-->
                        <option value="----">...</option>
                        <option value="incorrecto">COOKIES</option>
                        <option value="incorrecto">CACHÉ</option>
                        <option value="correcto">RECOPILADOR DE INFORMACIÓN</option>
                    </select><br></br><br></br>
                </h3>
                <!--Generando pregunta 5-->
                <h3>5- ¿Cuále es el navegador más uilizado por el mundo?
                    <select class="select" id="respuesta4"><!--Generando opciones de respuesta de la pregunta-->
                        <option value="----">...</option>
                        <option value="incorrecto">YAHOO!</option>
                        <option value="incorrecto">EDGE;</option>
                        <option value="correcto">GOOGLE CHROME</option>
                    </select><br><br><br>
                </h3>
            </section>
        </div>

        <!--Boton para verificar la respuesta-->
    <button class="verificar" onClick="verificar()">Comprobar respuestas</button>
    </div>
    <p id="resultado"></p>
    <script>
        //Contador de tiempo en segundos, si se acaba el tiempo sale alerta
        var segundos = 240;

        //funcion que permite definir el tiempo que tiene el jugador
        function iniciarTiempo() {
            document.getElementById("tiempo").innerHTML = segundos + " segundos";
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
                    title: "Oops...Intentalo nuevamente, te has quedado sin tiempo",
                    text: "",
                    imageUrl: "img/loop.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            } else {
                segundos--;
                setTimeout("iniciarTiempo()", 1000);
            }
        }

        //funcion Error, determina que las respuestas sean correctas
        function error() {
            Swal.fire({
                title: "¡Oh no!",
                text: "Comprueba tus respuestas, e intentalo nuevamente",
                imageUrl: "img/loop.gif",
                imageHeight: 350,
                backdrop: `
						rgba(0,143,255,0.6)
						url("img/fondo.gif")`,
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
            Swal.fire({
                title: "¡Felicidades!",
                text: "¡Buen trabajo!",
                imageUrl: "img/Thumbs-Up.gif",
                imageHeight: 350,
                backdrop: `
						rgba(0,143,255,0.6)
						url("img/fondo.gif")`,
                confirmButtonColor: "#a14cd9",
                confirmButtonText: "¡Genial!",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        }

        //funcion de validar respuestas
        function verificar() {
            var respuesta0 = document.getElementById("respuesta0").value; //valida la respuesta 1
            var respuesta1 = document.getElementById("respuesta1").value; //valida la respuesta 2
            var respuesta2 = document.getElementById("respuesta2").value; //valida la respuesta 3
            var respuesta3 = document.getElementById("respuesta3").value; //valida la respuesta 4
            var respuesta4 = document.getElementById("respuesta4").value; //valida la respuesta 5

            if (respuesta0 == "correcto" && respuesta1 == "correcto" && respuesta2 == "correcto" && respuesta3 == "correcto" && respuesta4 == "correcto") {
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