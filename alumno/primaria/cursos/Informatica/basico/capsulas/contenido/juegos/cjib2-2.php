<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/css-juegos/cjib2-2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="../../img/img_juegos/lgk.png">
    <title>KOUTILAB</title>
</head>

<body onload="iniciarTiempo()">
    <!-- Titulo general del juego -->
    <div class="titulo-gen">
        <h1 class="titulo"><b>PARTES Y USO DEL TECLADO</b></h1>
    </div>

    <!-- Timer -->
    <div  class="timer" id="timer" >
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
        <h4 class="titulo"><b>Selecciona una palabra de lado izquierdo y relacionala con una del lado derecho</b></h4>

        <br>
        <!-- contenido del juego -->
        <div class="container-all">
            <!-- Columna de lado izquierdo -->
            <div class="left-column">
                <!-- opciones estas son las principales -->
                <div class="word-box" id="especiales">Especiales</div>                
                <div class="word-box" id="numerico">Númerico</div>
                <div class="word-box" id="funcion">Función</div>
                <div class="word-box" id="alfanumerico">Alfanumerico</div>                
                <div class="word-box" id="direccionales">Direccionales </div>
            </div>
            <!-- Mapeo donde se trazan las lineas -->
            <canvas id="canvas"> </canvas>

            <!-- columna de lado derecho -->
            <div class="right-column">
                <!-- Respuestas -->
                <div class="word-box" id="supr" onclick="checkAnswer('supr')">Supr</div> 
                <div class="word-box" id="izq" onclick="checkAnswer('izq')"> -></div> 
                <div class="word-box" id="fun" onclick="checkAnswer('fun')">f5</div> 
                <div class="word-box" id="num" onclick="checkAnswer('num')">8</div>
                <div class="word-box" id="alf" onclick="checkAnswer('alf')"> > </div>             
                 
            </div>
        </div>

        <!-- boton de verificar respuestas -->
        <button class="verificar">Comprobar respuestas</button>
    </div>

    <!-- Linkeamos un documento donde tenemos todo lo relacionado a la relacion de columnas -->
    <script src="../../js/cjib2-2.js"></script>

    <script>
        //Contador de tiempo en segundos, si se acaba el tiempo sale alerta
        var segundos = 240;

        let puntos = 0;

        function iniciarTiempo() {
            document.getElementById('tiempo').innerHTML = segundos + " segundos";
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
            if (segundos == 0) {
                Swal.fire({
                    title: 'Oops...',
                    text: '¡Tiempo Agotado! Vuelve a intentarlo',
                    imageUrl: "../../img/img_juegos/loop.gif",
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

        // //Alerta muestra de que el juego fue completado
        // function alertExcelent() {
        //     Swal.fire({
        //         title: 'Excelente',
        //         text: '¡Buen trabajo!',
        //         imageUrl: "img/Thumbs-Up.gif",
        //         imageHeight: 350,
        //         backdrop: `
		// 				rgba(0,143,255,0.6)
		// 				url("img/fondo.gif")`,
        //         confirmButtonColor: '#a14cd9',
        //         confirmButtonText: '¡Genial!',
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             window.location.reload();
        //         }
        //     });

        // }


    </script>
</body>

</html>