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
    <!-- Titulo general del juego -->
    <div class="titulo-gen">
        <h2 class="titulo"><b>SELECCION DE RESPUESTA PARA UN ENUNCIADO</b></h2>
    </div>

    <!-- Timer -->
    <div class="timer" id="timer">
        <b>Tiempo: <br />
            <p id="tiempo"></p>
        </b>
    </div>

    <!-- Contenedor principal -->
    <div class="contenido">
        <!-- Boton para regresar -->
        <a href="#">
            <button class="btn-b">
                <i class="fas fa-reply"></i>
            </button>
        </a>
        <!-- Titulo secundario -->
        <h4 class="titulo"><b>El jugador deberá seleccionar una respuesta de las listas seleccionables</b></h4>
        <!--Generando contenedor que almacenara las preguntas y respuestas del juego-->
        <div class="container">
            <section><!--GENERANDO SECCION PARA PREGUNTAS Y RESPUESTAS-->
                <!--Generando pregunta 1-->
                <h3>
                    1. La formula de
                    <select class="select"
                        id="respuesta0"><!--Generando lista de opciones de respuesta de la pregunta 1-->
                        <option value="----">...</option>
                        <option value="incorrecto">max y min</option>
                        <option value="correcto">suma</option>
                        <option value="incorrecto">promedio</option>
                        <option value="incorrecto">contar</option>
                    </select>
                    nos ayuda calcular el total de suma entre un rango de celdas.
                </h3> <br>
                <!--Generando pregunta 2-->
                <h3>2. La formula de
                    <select class="select"
                        id="respuesta1"><!--Generando lista de opciones de respuesta de la pregunta 2-->
                        <option value="----">...</option>
                        <option value="correcto">max y min</option>
                        <option value="incorrecto">suma</option>
                        <option value="incorrecto">promedio</option>
                        <option value="incorrecto">contar</option>
                    </select>
                    encuentra el máximo o mínimo de un rango de celdas.
                </h3> <br>
                <!--Generando pregunta 3-->
                <h3>3. La formula de
                    <select class="select"
                        id="respuesta2"><!--Generando lista de opciones de respuesta de la pregunta 3-->
                        <option value="----">...</option>
                        <option value="incorrecto">max y min</option>
                        <option value="incorrecto">suma</option>
                        <option value="correcto">promedio</option>
                        <option value="incorrecto">contar</option>
                    </select>
                    puede calcular el promedio entre un rango de celdas.
                </h3> <br><!--Generando primer pregunta-->

                <h3>4. La formula de
                    <select class="select" id="respuesta3"><!--Generando opciones de respuesta de la pregunta-->
                        <option value="----">...</option>
                        <option value="incorrecto">max y min</option>
                        <option value="incorrecto">suma</option>
                        <option value="incorrecto">promedio</option>
                        <option value="correcto">contar</option>
                    </select>
                    nos ayuda a contar el número de celdas que contiene valores numéricos en un rango.
                </h3><!--Generando primer pregunta-->
            </section>
        </div>

        <!--Boton para verificar la respuesta-->
    <button class="verificar" onClick="verificar()">Comprobar respuestas</button>
    </div>
    <p id="resultado"></p>
    <script>
        //Contador de tiempo en segundos, si se acaba el tiempo sale alerta
        var segundos = 120;

        //funcion que permite definir el tiempo que tiene el jugador
        function iniciarTiempo() {
            document.getElementById("tiempo").innerHTML = segundos + " segundos";
            if (segundos <= 60) {
				var div = document.getElementById("timer");
				div.style.cssText = "animation-name: animation1; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
			}
			if (segundos <= 30) {
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

            if (respuesta0 == "correcto" && respuesta1 == "correcto" && respuesta2 == "correcto" && respuesta3 == "correcto" && respuesta1 == "correcto") {
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