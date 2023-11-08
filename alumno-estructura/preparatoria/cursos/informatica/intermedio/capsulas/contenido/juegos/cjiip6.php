<?php
session_start();
$id_user = $_SESSION['id_alumno_preparatoria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_preparatoria'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_preparatoria'];
$permiso = "capsulapago6";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_preparatoria c INNER JOIN detalle_capsulas_pago_preparatoria d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 8");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../../../../intermedio/capsulas/contenido/alertas/paquete_premium6.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/css-juegos/copy-code.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../../../../../../img/lgk.png" />
</head>

<body onload="iniciarTiempo()">
    <!-- Parte que modifique Inicio -->
    <!-- Timer -->
    <div class="timer" id="timer">
        <b>Tiempo: <br>
            <p id="tiempo" style="margin: 0 0 0 0;"></p>
        </b>
    </div>

    <!-- Titulo general del juego -->
    <div class="titulo-gen">
        <h2 class="titulo"><b>SEGURIDAD EN LAS TRANSACCIONES</b></h2>
    </div>

    <!-- Contenedor principal -->
    <section>

        <!-- Boton para regresar -->
        <div class="cont-st">
            <a href="../../../../../../rutas/ruta-py-a.php">
                <button class="btn-b">
                    <i class="fas fa-reply"></i>
                </button>
            </a>
            <h4 class="titulo"><b>Copia el código del lado izquierdo al lado derecho para poder ganar el juego</b></h4>
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
            <img src="../../img/benvenida.png" alt="No-image">
        </div>
    </footer>


    <!-- Parte que modifique Final -->
    <script>
    </script>
    <script src="../../js/copy-code-1.js"></script>
</body>

</html>