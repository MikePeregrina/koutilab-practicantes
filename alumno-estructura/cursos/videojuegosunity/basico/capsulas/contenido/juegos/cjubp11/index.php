<?php
session_start();
$id_user = $_SESSION['id_alumno'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
    header('location: ../../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno'];
$permiso = "capsulapago11";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 10;");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../../../../../basico/capsulas/contenido/alertas/paquete_premium11.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>KOUTILAB</title>
</head>

<body onload="iniciarTiempo()">
    <!-- Parte que modifique Inicio -->
    <!-- Timer -->
    <div class="timer">
        <b>Tiempo: <br>
            <p id="tiempo" style="margin: 0 0 0 0;"></p>
        </b>
    </div>

    <!-- Titulo general del juego -->
    <div class="titulo-gen">
        <h2 class="titulo"><b>MANTENIMIENTO DEL JUEGO</b></h2>
    </div>

    <!-- Contenedor principal -->
    <section>

        <!-- Boton para regresar -->
        <div class="cont-st">
            <a href="#" onclick="history.back();">
                <button class="btn-b">
                    <i class="fas fa-reply"></i>
                </button>
            </a>
            <h4 class="titulo"><b>Copia el fragmento de código del lado izquierdo al lado derecho</b></h4>
        </div>
        <!-- Parte que modifique Final -->

        <!--CONTENEDOR DEL JUEGO-->
        <div class="mjuego">

            <!--EJEMPLO DE CODIGO-->
            <div class="ejemplo">
                <p id="textoej">
                </p>
            </div>

            <!--CCUADRO DE TEXTO DONDE SE COPIARA EL CODIGO-->
            <div class="copia">
                <textarea id="escrito" oncontextmenu="return false"></textarea>
            </div>

        </div>
        <!-- Parte que modifique Inicio -->
        <!-- boton de verificar respuestas -->
        <div class="btn-v">
            <button class="verificar" onClick="alertExcelent()">Comprobar respuestas</button>
        </div>

    </section>


    <footer class="footerimga">
        <div class="imagen-footer">
            <img src="../../../img/img-juegos/benvenida.png" alt="No-image">
        </div>
    </footer>


    <!-- Parte que modifique Final -->

    <script>
        //Contador de tiempo en segundos, si se acaba el tiempo sale alerta
        var segundos = 240;

        let puntos = 0;

        //ASIGNA EL TEXTO AL CUADRO DE EJEMPLO DEL JUEGO
        document.getElementById(
            "textoej"
        ).innerHTML = `
        public void Pausa() { </br>
            &nbsp;&nbsp;&nbsp;&nbsp;Time.timeScale = 0f; </br>
        } </br></br>

        public void Reanudar() { </br>
            &nbsp;&nbsp;&nbsp;&nbsp;Time.timeScale = 1f;</br>
        }
        `;
        //Entidades para que html no reconosca las etiquetas
        //&lt; representa (<).
        //&gt; representa (>).
        //&quot; representa (").

        //Funcion para bloquear copiar y pegar
        document.addEventListener("keydown", function(event) {
            //con event se detecta si se presiono la tecla control y la tecla c o C
            if (event.ctrlKey && (event.key === "c" || event.key === "C")) {
                event.preventDefault(); //con prevent defaul el navegador bloquea la accion
            }

            if (event.ctrlKey && (event.key === "v" || event.key === "V")) {
                event.preventDefault();
            }
        });

        //Funcion que borra lo escrito dentro del textarea cuando se actualiza la pagina
        window.onbeforeunload = function() {
            document.getElementById("escrito").value = "";
        };

        function iniciarTiempo() {
            document.getElementById("tiempo").innerHTML = segundos + " segundos";
            if (segundos == 0) {
                //Borra el texto escrito
                escrito.value = "";
                Swal.fire({
                    title: "Oops...",
                    text: "¡Se te ha agotado el tiempo!",
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

        //Alerta muestra de que el juego fue completado
        function alertExcelent() {
            //Obtiene el texto escrito en la pagina
            var textoejemplo = document.getElementById("textoej");
            var textoejemplof = textoejemplo.textContent;
            var textoescrito = document.getElementById("escrito").value;
            //Elimina los espacios que existen en los textos para que la comparacion sea mas exacta
            var text1 = textoescrito.replace(/\s/g, "");
            var text2 = textoejemplof.replace(/\s/g, "");
            //Compara y valida si el texto es igual o no y muestra mensajes.
            if (text1 === text2) {
                Swal.fire({
                    title: "Excelente",
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
                        //Borra el texto escrito
                        escrito.value = "";
                        window.location.href = "./nivel2.php";
                    }
                });
            } else {
                Swal.fire({
                    title: "Oops...",
                    text: "¡Verifica tu respuesta!",
                    imageUrl: "img/loop.gif",
                    imageHeight: 350,
                    backdrop: `
                rgba(0,143,255,0.6)
                url("img/fondo.gif")`,
                    confirmButtonColor: "#a14cd9",
                    confirmButtonText: "Reintentar",
                });
            }
        }
    </script>
</body>

</html>