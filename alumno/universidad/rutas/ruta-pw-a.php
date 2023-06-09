<?php
session_start();
$id_user = $_SESSION['id_alumno_universidad'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_universidad'])) {
    header('location: ../../../acciones/cerrarsesion.php');
}
include "../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_universidad'];
$permiso = "3";
$sql = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_universidad a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../cursos/programacion-web/avanzado/capsulas/acciones/acceso_cursos.php");
}

include "verificar-ruta-pw-b.php";

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 1 de html
$capsula_verificar_html1 = "capsula3";
$sql_verificar_html1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_universidad c INNER JOIN detalle_capsulas_universidad d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_html1' AND d.id_curso = 3");
$existe_verificar_html1 = mysqli_num_rows($sql_verificar_html1);

//Verificar si esta comprada la capsula 1 de html
$capsula_comprada_html1 = "capsulapago1";
$sql_comprada_html1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_universidad c INNER JOIN detalle_capsulas_pago_universidad d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_html1' AND d.id_curso = 3;");
$existe_comprada_html1 = mysqli_num_rows($sql_comprada_html1);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 2 de html
$capsula_verificar_html2 = "capsula12";
$sql_verificar_html2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_universidad c INNER JOIN detalle_capsulas_universidad d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_html2' AND d.id_curso = 3");
$existe_verificar_html2 = mysqli_num_rows($sql_verificar_html2);

//Verificar si esta comprada la capsula 2 de html
$capsula_comprada_html2 = "capsulapago2";
$sql_comprada_html2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_universidad c INNER JOIN detalle_capsulas_pago_universidad d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_html2' AND d.id_curso = 3;");
$existe_comprada_html2 = mysqli_num_rows($sql_comprada_html2);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 1 de css
$capsula_verificar_css1 = "capsula16";
$sql_verificar_css1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_universidad c INNER JOIN detalle_capsulas_universidad d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_css1' AND d.id_curso = 3");
$existe_verificar_css1 = mysqli_num_rows($sql_verificar_css1);

//Verificar si esta comprada la capsula 1 de css
$capsula_comprada_css1 = "capsulapago3";
$sql_comprada_css1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_universidad c INNER JOIN detalle_capsulas_pago_universidad d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_css1' AND d.id_curso = 3;");
$existe_comprada_css1 = mysqli_num_rows($sql_comprada_css1);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 2 de css
$capsula_verificar_css2 = "capsula29";
$sql_verificar_css2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_universidad c INNER JOIN detalle_capsulas_universidad d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_css2' AND d.id_curso = 3");
$existe_verificar_css2 = mysqli_num_rows($sql_verificar_css2);

//Verificar si esta comprada la capsula 2 de css
$capsula_comprada_css2 = "capsulapago4";
$sql_comprada_css2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_universidad c INNER JOIN detalle_capsulas_pago_universidad d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_css2' AND d.id_curso = 3;");
$existe_comprada_css2 = mysqli_num_rows($sql_comprada_css2);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 1 de js
$capsula_verificar_js1 = "capsula49";
$sql_verificar_js1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_universidad c INNER JOIN detalle_capsulas_universidad d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_js1' AND d.id_curso = 3");
$existe_verificar_cjs1 = mysqli_num_rows($sql_verificar_js1);

//Verificar si esta comprada la capsula 1 de js
$capsula_comprada_js1 = "capsulapago4";
$sql_comprada_js1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_universidad c INNER JOIN detalle_capsulas_pago_universidad d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_js1' AND d.id_curso = 3;");
$existe_comprada_js1 = mysqli_num_rows($sql_comprada_js1);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 2 de js
$capsula_verificar_js1 = "capsula49";
$sql_verificar_js1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_universidad c INNER JOIN detalle_capsulas_universidad d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_js1' AND d.id_curso = 3");
$existe_verificar_cjs1 = mysqli_num_rows($sql_verificar_js1);

//Verificar si esta comprada la capsula 2 de js
$capsula_comprada_js2 = "capsulapago4";
$sql_comprada_js2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_universidad c INNER JOIN detalle_capsulas_pago_universidad d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_js2' AND d.id_curso = 3;");
$existe_comprada_js2 = mysqli_num_rows($sql_comprada_js2);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 1 de js
$capsula_verificar_php1 = "capsula54";
$sql_verificar_php1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_universidad c INNER JOIN detalle_capsulas_universidad d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_js1' AND d.id_curso = 3");
$existe_verificar_cphp1 = mysqli_num_rows($sql_verificar_php1);

//Verificar si esta comprada la capsula 1 de js
$capsula_comprada_php1 = "capsulapago5";
$sql_comprada_php1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_universidad c INNER JOIN detalle_capsulas_pago_universidad d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_js1' AND d.id_curso = 3;");
$existe_comprada_php1 = mysqli_num_rows($sql_comprada_php1);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 2 de js
$capsula_verificar_php1 = "capsula54";
$sql_verificar_php1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_universidad c INNER JOIN detalle_capsulas_universidad d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_js1' AND d.id_curso = 3");
$existe_verificar_cphp1 = mysqli_num_rows($sql_verificar_php1);

//Verificar si esta comprada la capsula 2 de js
$capsula_comprada_php2 = "capsulapago5";
$sql_comprada_php2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_universidad c INNER JOIN detalle_capsulas_pago_universidad d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_js2' AND d.id_curso = 3;");
$existe_comprada_php2 = mysqli_num_rows($sql_comprada_php2);
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png">
    <link rel="stylesheet" href="../css/ruta-pw-a.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="body">
        <div class="containers">CURSO DE PROGRAMACIÓN WEB AVANZADO DE KOUTILAB
            <a href="../perfil.php"><button style="float: right;" class="btn-b" id="btn-cerrar-modalV"><i class="fas fa-reply"></i></button></a>
        </div>
        <div class="container">
            <img class="igm" src="../img/PPP.png">
            <img class="gif" src="../img/loop.gif">
            <img class="gif1" src="../img/foco.gif">
            <img class="gif2" src="../img/signo.gif">
            <div class="ruta">
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/bienvenida/cb1.php"><button class="btn0" id="bien"></button></a> <!--Capsula introduccion al curso-->
                <!-- HTML -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/introduccion/ci1html.php"><button class="btn1" id="intro"></button></a><!--Capsula introduccion a HTML-->
                <!-- TEMA 1 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct1html.php"><button class="btn2" id="teoria" <?php echo 'style="' . (($existe_capsula1 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 1-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp1html.php"><button class="btn3" id="prac" <?php echo 'style="' . (($existe_capsula2 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 1-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj1.php"><button class="btn4" id="game" <?php echo 'style="' . (($existe_capsula3 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 1-->
                <!-- TEMA 2 -->
                <!--ruta para teorica  -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct2html.php"><button class="btn5" id="teoria" <?php echo 'style="' . (($existe_capsula4 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 2-->
                <!-- ruta para practica -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp2html.php"><button class="btn6" id="prac" <?php echo 'style="' . (($existe_capsula5 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 2-->
                <!-- ruta para juego -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj2.php"><button class="btn7" id="game" <?php echo 'style="' . (($existe_capsula6 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 2-->
                <!-- TEMA 3 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct3html.php"><button class="btn8" id="teoria" <?php echo 'style="' . (($existe_capsula7 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 3-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp3html.php"><button class="btn9" id="prac" <?php echo 'style="' . (($existe_capsula8 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 3-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj3.php"><button class="btn10" id="game" <?php echo 'style="' . (($existe_capsula9 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 3-->
                <!-- TEMA 4 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct4html.php"><button class="btn11" id="teoria" <?php echo 'style="' . (($existe_capsula10 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 4-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp4html.php"><button class="btn12" id="prac" <?php echo 'style="' . (($existe_capsula11 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 4-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj4.php"><button class="btn13" id="game" <?php echo 'style="' . (($existe_capsula12 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 4-->
                <!-- TEMA 5 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct5html.php"><button class="btn14" id="teoria" <?php echo 'style="' . (($existe_capsula13 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 5-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp5html.php"><button class="btn15" id="prac" <?php echo 'style="' . (($existe_capsula14 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 5-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj5.php"><button class="btn16" id="game" <?php echo 'style="' . (($existe_capsula15 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 5-->
                <!-- EVALUATIVA HTML-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/evaluativas/ce1html.php"><button class="btn17" id="eva" <?php echo 'style="' . (($existe_capsula217 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula evaluativas HTML-->

                <!-- CSS -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/introduccion/ci1css.php"><button class="btn18" id="intro" <?php echo 'style="' . (($existe_capsula18 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula introduccion a CSS-->
                <!-- TEMA 1 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct1css.php"><button class="btn19" id="teoria" <?php echo 'style="' . (($existe_capsula19 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 1-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp1css.php"><button class="btn20" id="prac" <?php echo 'style="' . (($existe_capsula20 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 1-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj1.php"><button class="btn21" id="game" <?php echo 'style="' . (($existe_capsula21 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 1-->
                <!-- TEMA 2 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct2css.php"><button class="btn22" id="teoria" <?php echo 'style="' . (($existe_capsula22 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 2-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp2css.php"><button class="btn23" id="prac" <?php echo 'style="' . (($existe_capsula23 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 2-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj2.php"><button class="btn24" id="game" <?php echo 'style="' . (($existe_capsula24 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 2-->
                <!-- TEMA 3 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct3css.php"><button class="btn25" id="teoria" <?php echo 'style="' . (($existe_capsula25 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 3-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp3css.php"><button class="btn26" id="prac" <?php echo 'style="' . (($existe_capsula26 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 3-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj3.php"><button class="btn27" id="game" <?php echo 'style="' . (($existe_capsula27 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 3-->
                <!-- TEMA 4 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct4css.php"><button class="btn28" id="teoria" <?php echo 'style="' . (($existe_capsula28 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 4-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp4css.php"><button class="btn29" id="prac" <?php echo 'style="' . (($existe_capsula29 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 4-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj4.php"><button class="btn30" id="game" <?php echo 'style="' . (($existe_capsula30 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 4-->
                <!-- TEMA 5 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct5css.php"><button class="btn31" id="teoria" <?php echo 'style="' . (($existe_capsula31 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 5-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp5css.php"><button class="btn32" id="prac" <?php echo 'style="' . (($existe_capsula32 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 5-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj5.php"><button class="btn33" id="game" <?php echo 'style="' . (($existe_capsula33 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 5-->
                <!-- EVALUATIVA CSS-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/evaluativas/ce1css.php"><button class="btn34" id="eva" <?php echo 'style="' . (($existe_capsula34 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula evaluativas CSS-->

                <!-- JS -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/introduccion/ci1js.php"><button class="btn35" id="intro" <?php echo 'style="' . (($existe_capsula35 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula introduccion a JS-->
                <!-- TEMA 1 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct1js.php"><button class="btn36" id="teoria" <?php echo 'style="' . (($existe_capsula36 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 1-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp1js.php"><button class="btn37" id="prac" <?php echo 'style="' . (($existe_capsula37 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 1-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj1.php"><button class="btn38" id="game" <?php echo 'style="' . (($existe_capsula38 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 1-->
                <!-- TEMA 2 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct2js.php"><button class="btn39" id="teoria" <?php echo 'style="' . (($existe_capsula39 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 2-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp2js.php"><button class="btn40" id="prac" <?php echo 'style="' . (($existe_capsula40 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 2-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj2.php"><button class="btn41" id="game" <?php echo 'style="' . (($existe_capsula41 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 2-->
                <!-- TEMA 3 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct3js.php"><button class="btn42" id="teoria" <?php echo 'style="' . (($existe_capsula42 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 3-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp3js.php"><button class="btn43" id="prac" <?php echo 'style="' . (($existe_capsula43 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 3-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj3.php"><button class="btn44" id="game" <?php echo 'style="' . (($existe_capsula44 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 3-->
                <!-- TEMA 4 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct4js.php"><button class="btn45" id="teoria" <?php echo 'style="' . (($existe_capsula45 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 4-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp4js.php"><button class="btn46" id="prac" <?php echo 'style="' . (($existe_capsula46 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 4-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj4.php"><button class="btn47" id="game" <?php echo 'style="' . (($existe_capsula47 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 4-->
                <!-- TEMA 5 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct5js.php"><button class="btn48" id="teoria" <?php echo 'style="' . (($existe_capsula48 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 5-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp5js.php"><button class="btn49" id="prac" <?php echo 'style="' . (($existe_capsula49 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 5-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj5.php"><button class="btn50" id="game" <?php echo 'style="' . (($existe_capsula50 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 5-->
                <!-- EVALUATIVA JS -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/evaluativas/ce1js.php"><button class="btn51" id="eva" <?php echo 'style="' . (($existe_capsula51 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula evaluativas JS-->

                <!-- PHP -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/introduccion/ci1php.php"><button class="btn52" id="intro" <?php echo 'style="' . (($existe_capsula52 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula introduccion a PHP-->
                <!-- TEMA 1 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct1php.php"><button class="btn53" id="teoria" <?php echo 'style="' . (($existe_capsula53 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 1-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp1php.php"><button class="btn54" id="prac" <?php echo 'style="' . (($existe_capsula54 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 1-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj1.php"><button class="btn55" id="game" <?php echo 'style="' . (($existe_capsula55 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 1-->
                <!-- TEMA 2 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct2php.php"><button class="btn56" id="teoria" <?php echo 'style="' . (($existe_capsula56 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 2-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp2php.php"><button class="btn57" id="prac" <?php echo 'style="' . (($existe_capsula57 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 2-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj2.php"><button class="btn58" id="game" <?php echo 'style="' . (($existe_capsula58 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 2-->
                <!-- TEMA 3 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct3php.php"><button class="btn59" id="teoria" <?php echo 'style="' . (($existe_capsula59 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 3-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp3php.php"><button class="btn60" id="prac" <?php echo 'style="' . (($existe_capsula60 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 3-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj3.php"><button class="btn61" id="game" <?php echo 'style="' . (($existe_capsula61 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 3-->
                <!-- TEMA 4 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct4php.php"><button class="btn62" id="teoria" <?php echo 'style="' . (($existe_capsula62 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 4-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp4php.php"><button class="btn63" id="prac" <?php echo 'style="' . (($existe_capsula63 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 4-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj4.php"><button class="btn64" id="game" <?php echo 'style="' . (($existe_capsula64 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 4-->
                <!-- TEMA 5 -->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct5php.php"><button class="btn65" id="teoria" <?php echo 'style="' . (($existe_capsula65 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 5-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/practicas/cp5php.php"><button class="btn66" id="prac" <?php echo 'style="' . (($existe_capsula66 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 5-->
                <a href="../cursos/programacion-web/avanzado/capsulas/contenido/juegos/cj5.php"><button class="btn67" id="game" <?php echo 'style="' . (($existe_capsula67 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 5-->
                <!-- EVALUATIVA PHP -->
                <a href="../cursos/programacion-web/basico/capsulas/contenido/evaluativas/ce1php.php"><button class="btn68" id="eva" <?php echo 'style="' . (($existe_capsula68 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula evaluativas PHP-->
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>

    </script>
    <script>
        $(".step").click(function() {
            $(this).addClass("active").prevAll().addClass("active");
            $(this).nextAll().removeClass("active");
        });

        $(".step01").click(function() {
            $("#line-progress").css("width", "3%");
            $(".discovery").addClass("active").siblings().removeClass("active");
        });

        $(".step02").click(function() {
            $("#line-progress").css("width", "25%");
            $(".strategy").addClass("active").siblings().removeClass("active");
        });

        $(".step03").click(function() {
            $("#line-progress").css("width", "50%");
            $(".creative").addClass("active").siblings().removeClass("active");
        });

        $(".step04").click(function() {
            $("#line-progress").css("width", "75%");
            $(".production").addClass("active").siblings().removeClass("active");
        });

        $(".step05").click(function() {
            $("#line-progress").css("width", "100%");
            $(".analysis").addClass("active").siblings().removeClass("active");
        });
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
</body>