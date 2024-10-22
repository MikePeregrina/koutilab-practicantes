
<?php
 session_start();
 $id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
 if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
 	header('location: ../../../../../../../../acciones/cerrarsesion.php');
 }
 include "../../../../../../../../../acciones/conexion.php";
 $id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
 $permiso = "capsulapago9";
 $sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 1;");
 $existe = mysqli_fetch_all($sql);
 if (empty($existe)) {
 	header("Location: ../../../../../intermedio/capsulas/contenido/alertas/paquete_premium9.php");
 }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/css-juegos/columnas.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../../../../../../img/lgk.png" />
</head>

<body onload="iniciarTiempo()">
    <!-- Timer -->
    <div class="timer" id="timer">
        <b>Tiempo: <br>
            <p id="tiempo" style="margin: 0 0 0 0;"></p>
        </b>
    </div>
    <!-- Titulo general del juego -->
    <div class="titulo-gen">
        <h2 class="titulo"><b>MANIPULACION DE ESTILOS Y TRIBUTOS EN CSS DESDE JAVASCRIPT</b></h2>
    </div>
    <!-- Contenedor principal -->
    <section>

        <div class="cont-st">
            <a href="../../../../../../rutas/ruta-pw-i-<?php echo $rol; ?>.php">
                <button class="btn-b">
                    <i class="fas fa-reply"></i>
                </button>
            </a>
            <h5 class="titulo"><b>Selecciona una palabra de lado izquierdo y relacionala con una del lado derecho</b></h5>
        </div>
        <br>
        <!-- contenido del juego -->
        <div class="container-all">
            <!-- Columna de lado izquierdo -->
            <div class="left-column">
                <!-- opciones estas son las principales -->
                <div class="word-box" id="css">Css</div>
                <div class="word-box" id="sql">Manipulacion</div>
                <div class="word-box" id="html">Metodo</div>
                <div class="word-box" id="javascript">JavaScript</div>
                <div class="word-box" id="php">Propiedad</div>
            </div>
            <!-- Mapeo donde se trazan las lineas -->
            <canvas id="canvas"> </canvas>

            <!-- columna de lado derecho -->
            <div class="right-column">
                <!-- Respuestas -->
                <div class="word-box" id="interactividad" onclick="checkAnswer('interactividad')">Interactividad</div>
                <div class="word-box" id="funcionalidad" onclick="checkAnswer('funcionalidad')"> Style </div>
                <div class="word-box" id="estructura" onclick="checkAnswer('estructura')">GetElementById();</div>
                <div class="word-box" id="estilos" onclick="checkAnswer('estilos')">Estilos</div>
                <div class="word-box" id="administrar" onclick="checkAnswer('administrar')">Dinamica</div>
            </div>
        </div>

        <!-- boton de verificar respuestas -->
        <button class="verificar">Comprobar respuestas</button>
    </section>
    <!-- CAMBIOS -->
    <footer class="footerimga">
        <div class="imagen-footer">
            <img src="../../img/img-juegos/benvenida.png" alt="No-image">
        </div>
    </footer>
    <!-- Linkeamos un documento donde tenemos todo lo relacionado a la relacion de columnas -->
    <script src="../../js/seleccionador-2.js"></script>

    <script>
        //Funcion que agrega el sonido al juego
        var correcto = document.createElement("audio");
        correcto.src = "../../../../../../../acciones/sonidos/correcto.mp3";
        var incorrecto = document.createElement("audio");
        incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

        //Contador de tiempo en segundos, si se acaba el tiempo sale alerta
        var segundos = 240;
        var puntos = <?php echo $puntosGanados; ?>
        var count = 1000;
        //Agregando animacion a el timer
        function iniciarTiempo() {
            document.getElementById("tiempo").innerHTML =
                segundos + " segundos";
            if (segundos <= 30) {
                var div = document.getElementById("timer");
                div.style.cssText = "animation-name: animation1; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
            }
            if (segundos <= 15) {
                var div = document.getElementById("timer");
                div.style.cssText = "animation-name: animation2; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
            }
            if (segundos <= 10) {
                var div = document.getElementById("timer");
                div.style.cssText = "animation-name: animation3; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
            }
            if (segundos == 0) {
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
                incorrecto.play(); //agregando sonido al juego no completado
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