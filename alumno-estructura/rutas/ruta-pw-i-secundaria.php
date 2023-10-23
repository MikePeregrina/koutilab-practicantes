<?php
session_start();
$id_user = $_SESSION['id_alumno'];
$rol = $_SESSION['rol'];
$id_escuela = $_SESSION['id_escuela'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
    header('location: ../../acciones/cerrarsesion.php');
}
include "../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno'];
$permiso = "2";
$sql = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../cursos/programacion-web/intermedio/capsulas/acciones/acceso_cursos.php");
}

include "verificar-ruta-pw-i-secundaria.php";

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 1 de html
$capsula_verificar_html1 = "capsula3";
$sql_verificar_html1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_html1' AND d.id_curso = 2");
$existe_verificar_html1 = mysqli_num_rows($sql_verificar_html1);

//Verificar si esta comprada la capsula 1 de html
$capsula_comprada_html1 = "capsulapago1";
$sql_comprada_html1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_html1' AND d.id_curso = 2;");
$existe_comprada_html1 = mysqli_num_rows($sql_comprada_html1);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 2 de html
$capsula_verificar_html2 = "capsula9";
$sql_verificar_html2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_html2' AND d.id_curso = 2");
$existe_verificar_html2 = mysqli_num_rows($sql_verificar_html2);

//Verificar si esta comprada la capsula 2 de html
$capsula_comprada_html2 = "capsulapago2";
$sql_comprada_html2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_html2' AND d.id_curso = 2;");
$existe_comprada_html2 = mysqli_num_rows($sql_comprada_html2);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 1 de css
$capsula_verificar_css1 = "capsula16";
$sql_verificar_css1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_css1' AND d.id_curso = 2");
$existe_verificar_css1 = mysqli_num_rows($sql_verificar_css1);

//Verificar si esta comprada la capsula 1 de css
$capsula_comprada_css1 = "capsulapago3";
$sql_comprada_css1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_css1' AND d.id_curso = 2;");
$existe_comprada_css1 = mysqli_num_rows($sql_comprada_css1);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 2 de css
$capsula_verificar_css2 = "capsula28";
$sql_verificar_css2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_css2' AND d.id_curso = 2");
$existe_verificar_css2 = mysqli_num_rows($sql_verificar_css2);

//Verificar si esta comprada la capsula 2 de css
$capsula_comprada_css2 = "capsulapago4";
$sql_comprada_css2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_css2' AND d.id_curso = 2;");
$existe_comprada_css2 = mysqli_num_rows($sql_comprada_css2);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 1 de js
$capsula_verificar_js1 = "capsula39";
$sql_verificar_js1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_js1' AND d.id_curso = 2");
$existe_verificar_js1 = mysqli_num_rows($sql_verificar_js1);

//Verificar si esta comprada la capsula 1 de js
$capsula_comprada_js1 = "capsulapago5";
$sql_comprada_js1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_js1' AND d.id_curso = 2;");
$existe_comprada_js1 = mysqli_num_rows($sql_comprada_js1);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 2 de js
$capsula_verificar_js2 = "capsula48";
$sql_verificar_js2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_js2' AND d.id_curso = 2");
$existe_verificar_js2 = mysqli_num_rows($sql_verificar_js2);

//Verificar si esta comprada la capsula 2 de js
$capsula_comprada_js2 = "capsulapago6";
$sql_comprada_js2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_js2' AND d.id_curso = 2;");
$existe_comprada_js2 = mysqli_num_rows($sql_comprada_js2);

//Verificar si es escuela licencia o freemium
$sql_modelo = "SELECT tipo_modelo FROM escuelas WHERE id_escuela = $id_escuela";
$result_modelo = $conexion->query($sql_modelo);
$row_modelo = $result_modelo->fetch_assoc();
$tipo_modelo = $row_modelo['tipo_modelo'];

// Función para actualizar conexiones a ruta
function actualizarConexiones($permiso, $conexion, $rol)
{
    // Consulta para obtener el número de conexiones
    $sql = "SELECT conexiones FROM conexiones_curso_$rol WHERE id_curso = $permiso";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_conexiones = $row['conexiones'];

        if ($total_conexiones >= 0) {
            $id_escuela = $_SESSION['id_escuela'];
            $sql_curso =  mysqli_query($conexion, "INSERT INTO conexiones_cursos(id_curso, id_escuela) values ($permiso, $id_escuela)");
            // Si no es múltiplo de 20, actualizar el campo estrellas en la tabla total_estrellas_$rol
            $sql =  mysqli_query($conexion, "UPDATE conexiones_curso_$rol SET conexiones = conexiones + 1 WHERE id_curso = $permiso");
        }
    }
}

// Verifica si la variable de sesión "actualizacion_realizada" no está definida
if (!isset($_SESSION['actualizacion_realizada_pwi'])) {
    // Llama a la función para actualizar las conexiones
    actualizarConexiones($permiso, $conexion, $rol);

    // Establece la variable de sesión "actualizacion_realizada" para indicar que la actualización ya se hizo
    $_SESSION['actualizacion_realizada_pwi'] = true;
}
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png">
    <link rel="stylesheet" href="../css_secundaria/ruta-pw-i.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        #intro {
            background-image: url(../img/btn/BTNINTRO2.png);
        }

        #teoria {
            background-image: url(../img/btn/BTNTEO2.png);
        }

        #prac {
            background-image: url(../img/btn/BTNPRA2.png);
        }

        #game {
            background-image: url(../img/btn/BTNJU2.png);
        }

        #eva {
            background-image: url(../img/btn/BTNEV2.png);
        }
    </style>
</head>

<body>
    <audio id="popAudio" preload="auto">
        <source src="../../acciones/sonidos/pop.mp3" type="audio/mpeg">
    </audio>
    <audio id="hoverAudio" preload="auto">
        <source src="../../acciones/sonidos/pop2.mp3" type="audio/mpeg">
    </audio>
    <div class="containers">
        <a href="../perfil.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn-b"><i class="fas fa-reply"></i></button></a>
        <h1>CURSO DE PROGRAMACIÓN INTERMEDIO DE KOUTILAB</h1>
    </div>
    <aside class="sidebar">
        <div class="circle" style="background-image:url(../img/btn/BTNINTRO2.png); background-size:cover;background-position:center ">
            <p>Introducción</p>
        </div>
        <div class="circle" style="background-image:url(../img/btn/BTNPRA2.png); background-size:cover;background-position:center ">
            <p>Práctica</p>
        </div>
        <div class="circle" style="background-image:url(../img/btn/BTNTEO2.png); background-size:cover;background-position:center ">
            <p>Teórica</p>
        </div>
        <div class="circle" style="background-image:url(../img/btn/BTNJU2.png); background-size:cover;background-position:center ">
            <p>Juegos</p>
        </div>
        <div class="circle" style="background-image:url(../img/btn/BTNEV2.png); background-size:cover;background-position:center ">
            <p>Evaluativa</p>
        </div>
    </aside>

    <section>
        <div class="main-content">
            <div class="label">
                <span>HTML</span>
            </div>
            <a href="../acciones/estadisticas_pw-i.php" style="text-decoration: none;color: inherit;">
                <div class="graphics-buttoon"><i class="fa-solid fa-chart-line fa-2xl"></i></div>
            </a>
            <!-- HTML -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/introduccion/ci1html.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn1" id="intro"></button></a><!--Capsula introduccion a HTML-->
            <!-- TEMA 1 -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct1html.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn2" id="teoria" <?php echo 'style="' . (($existe_capsula1 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 1-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp1html.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn3" id="prac" <?php echo 'style="' . (($existe_capsula2 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 1-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/cjhtml1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn4" id="game" <?php echo 'style="' . (($existe_capsula3 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 1-->
            <!-- TEMA 2 -->
            <!-- <div class="container-premium1" <?php echo 'style="' . (($tipo_modelo == 1) ? 'display: none;' : 'display: block;') . '"'; ?>> -->
            <!-- <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct2html.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn5" id="teoriap" <?php echo 'style="' . (($existe_verificar_html1 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_html1 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a>Capsula teorica 2 -->
            <!-- <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp2html.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn6" id="pracp" <?php echo 'style="' . (($existe_verificar_html1 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_html1 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a>Capsula practica 2 -->
            <!-- <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/plataforma-pwi/lvl-1/lvl1-1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn7" id="gamep" <?php echo 'style="' . (($existe_verificar_html1 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_html1 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a>Capsula juego 2 -->
            <!-- </div> -->
            <!-- TEMA 3 -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct3html.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn8" id="teoria" <?php echo 'style="' . (($existe_capsula4 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 3-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp3html.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn9" id="prac" <?php echo 'style="' . (($existe_capsula5 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 3-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/cjhtml2.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn10" id="game" <?php echo 'style="' . (($existe_capsula6 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 3-->
            <!-- TEMA 4 -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct4html.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn11" id="teoria" <?php echo 'style="' . (($existe_capsula7 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 4-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp4html.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn12" id="prac" <?php echo 'style="' . (($existe_capsula8 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 4-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/cjhtml3.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn13" id="game" <?php echo 'style="' . (($existe_capsula9 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 4-->
            <!-- TEMA 5 -->
            <!-- <div class="container-premium2" <?php echo 'style="' . (($tipo_modelo == 1) ? 'display: none;' : 'display: block;') . '"'; ?>> -->
            <!-- <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct5html.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn17" id="pracp" <?php echo 'style="' . (($existe_verificar_html2 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_html2 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a>Capsula teorica 5 -->
            <!-- <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp5html.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn18" id="pracp" <?php echo 'style="' . (($existe_verificar_html2 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_html2 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a>Capsula practica 5 -->
            <!-- <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/plataforma-pwi/lvl-2/lvl2-1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn19" id="gamep" <?php echo 'style="' . (($existe_verificar_html2 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_html2 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button> </a>Capsula juego 5 -->
            <!-- </div> -->
            <!-- TEMA 6 -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct6html.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn14" id="teoria" <?php echo 'style="' . (($existe_capsula10 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button> </a><!--Capsula teorica 6-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp6html.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn15" id="prac" <?php echo 'style="' . (($existe_capsula11 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button> </a><!--Capsula practica 6-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/cjhtml4.php"> <button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn16" id="game" <?php echo 'style="' . (($existe_capsula12 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 6-->
            <!-- TEMA 7 -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct7html.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn20" id="teoria" <?php echo 'style="' . (($existe_capsula13 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 7-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp7html.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn21" id="prac" <?php echo 'style="' . (($existe_capsula14 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 7-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/cjhtml5.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn22" id="game" <?php echo 'style="' . (($existe_capsula15 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 7-->
            <!-- EVALUATIVA HTML-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/evaluativas/ce1html.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn23" id="eva" <?php echo 'style="' . (($existe_capsula16 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula evaluativas HTML-->

            <div class="label-css">
                <span>CSS</span>
            </div>

            <!-- CSS -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/introduccion/ci2css.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn24" id="intro" <?php echo 'style="' . (($existe_capsula17 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula introduccion a CSS-->
            <!-- TEMA 1 -->
            <!-- cambiar -->
            <!-- <div class="container-premium3" <?php echo 'style="' . (($tipo_modelo == 1) ? 'display: none;' : 'display: block;') . '"'; ?>> -->
            <!-- <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct3css.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn25" id="teoriap" <?php echo 'style="' . (($existe_verificar_css1 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_css1 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a>Capsula teorica 1 -->
            <!-- <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp3css.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn26" id="pracp" <?php echo 'style="' . (($existe_verificar_css1 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_css1 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a>Capsula practica 1 -->
            <!-- <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/plataforma-pwi/lvl-3/lvl3-1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn27" id="gamep" <?php echo 'style="' . (($existe_verificar_css1 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_css1 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a>Capsula juego 1 -->
            <!-- </div> -->
            <!-- TEMA 2 -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct1css.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn28" id="teoria" <?php echo 'style="' . (($existe_capsula18 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 2-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp1css.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn29" id="prac" <?php echo 'style="' . (($existe_capsula19 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 2-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/cjcss1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn30" id="game" <?php echo 'style="' . (($existe_capsula20 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 2-->
            <!-- TEMA 3 -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct2css.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn31" id="teoria" <?php echo 'style="' . (($existe_capsula21 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 3-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp2css.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn32" id="prac" <?php echo 'style="' . (($existe_capsula22 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 3-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/cjcss2.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn33" id="game" <?php echo 'style="' . (($existe_capsula23 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 3-->
            <!-- TEMA 4 -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct4css.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn34" id="teoria" <?php echo 'style="' . (($existe_capsula24 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 4-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp4css.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn35" id="prac" <?php echo 'style="' . (($existe_capsula25 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 4-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/cjcss3.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn36" id="game" <?php echo 'style="' . (($existe_capsula26 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 4-->
            <!-- TEMA 5 -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct5css.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn37" id="teoria" <?php echo 'style="' . (($existe_capsula27 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 5-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp5css.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn38" id="prac" <?php echo 'style="' . (($existe_capsula28 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 5-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/cjcss4.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn39" id="game" <?php echo 'style="' . (($existe_capsula29 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 5-->
            <!-- TEMA 6 -->
            <!-- <div class="container-premium4" <?php echo 'style="' . (($tipo_modelo == 1) ? 'display: none;' : 'display: block;') . '"'; ?>> -->
            <!-- <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct6css.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn40" id="teoriap" <?php echo 'style="' . (($existe_verificar_css2 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_css2 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a>Capsula teorica 6 -->
            <!-- <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp6css.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn41" id="pracp" <?php echo 'style="' . (($existe_verificar_css2 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_css2 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a>Capsula practica 6 -->
            <!-- <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/plataforma-pwi/lvl-4/lvl4-1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn42" id="gamep" <?php echo 'style="' . (($existe_verificar_css2 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_css2 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a>Capsula juego 6 -->
            <!-- </div> -->
            <!-- TEMA 7 -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct7css.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn43" id="teoria" <?php echo 'style="' . (($existe_capsula30 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 7-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp7css.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn44" id="prac" <?php echo 'style="' . (($existe_capsula31 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 7-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/cjcss5.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn45" id="game" <?php echo 'style="' . (($existe_capsula32 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 7-->
            <!-- EVALUATIVA CSS-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/evaluativas/ce2css.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn46" id="eva" <?php echo 'style="' . (($existe_capsula33 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula evaluativas CSS-->

            <div class="label-js">
                <span>JS</span>
            </div>

            <!-- JS -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/introduccion/ci3js.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn47" id="intro" <?php echo 'style="' . (($existe_capsula34 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula introduccion a JS-->
            <!-- TEMA 1 -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct1js.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn48" id="teoria" <?php echo 'style="' . (($existe_capsula35 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 1-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp1js.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn49" id="prac" <?php echo 'style="' . (($existe_capsula36 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 1-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/cjjs1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn50" id="game" <?php echo 'style="' . (($existe_capsula37 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 1-->
            <!-- TEMA 2 -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct2js.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn51" id="teoria" <?php echo 'style="' . (($existe_capsula38 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 2-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp2js.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn52" id="prac" <?php echo 'style="' . (($existe_capsula39 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 2-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/cjjs2.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn53" id="game" <?php echo 'style="' . (($existe_capsula40 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 2-->
            <!-- TEMA 3 -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct3js.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn54" id="teoria" <?php echo 'style="' . (($existe_capsula41 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 3-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp3js.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn55" id="prac" <?php echo 'style="' . (($existe_capsula42 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 3-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/cjjs3.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn56" id="game" <?php echo 'style="' . (($existe_capsula43 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 3-->
            <!-- TEMA 4 -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct4js.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn57" id="teoria" <?php echo 'style="' . (($existe_capsula44 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 4-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp4js.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn58" id="prac" <?php echo 'style="' . (($existe_capsula45 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 4-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/cjjs4.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn59" id="game" <?php echo 'style="' . (($existe_capsula46 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 4-->
            <!-- TEMA 5 -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct5js.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn60" id="teoria" <?php echo 'style="' . (($existe_capsula47 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 5-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp5js.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn61" id="prac" <?php echo 'style="' . (($existe_capsula48 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 5-->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/cjjs5.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn62" id="game" <?php echo 'style="' . (($existe_capsula49 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 5-->
            <!-- TEMA 6 -->
            <!-- <div class="container-premium5" <?php echo 'style="' . (($tipo_modelo == 1) ? 'display: none;' : 'display: block;') . '"'; ?>> -->
            <!-- <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct6js.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn63" id="teoriap" <?php echo 'style="' . (($existe_verificar_js1 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_js1 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a>Capsula teorica 6 -->
            <!-- <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp6js.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn64" id="pracp" <?php echo 'style="' . (($existe_verificar_js1 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_js1 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a>Capsula practica 6 -->
            <!-- <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/plataforma-pwi/lvl-5/lvl5-1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn65" id="gamep" <?php echo 'style="' . (($existe_verificar_js1 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_js1 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a>Capsula juego 6 -->
            <!-- </div> -->
            <!-- TEMA 7 -->
            <!-- <div class="container-premium6" <?php echo 'style="' . (($tipo_modelo == 1) ? 'display: none;' : 'display: block;') . '"'; ?>> -->
            <!-- <a href="../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct7js.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn66" id="teoriap" <?php echo 'style="' . (($existe_verificar_js2 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_js2 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a>Capsula teorica 7 -->
            <!-- <a href="../cursos/programacion-web/intermedio/capsulas/contenido/practicas/cp7js.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn67" id="pracp" <?php echo 'style="' . (($existe_verificar_js2 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_js2 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a>Capsula practica 7 -->
            <!-- <a href="../cursos/programacion-web/intermedio/capsulas/contenido/juegos/plataforma-pwi/lvl-6/lvl6-1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn68" id="gamep" <?php echo 'style="' . (($existe_verificar_js2 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_js2 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a>Capsula juego 7 -->
            <!-- </div> -->
            <!-- EVALUATIVA JS -->
            <a href="../cursos/programacion-web/intermedio/capsulas/contenido/evaluativas/ce3js.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn69" id="eva" <?php echo 'style="' . (($existe_capsula50 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula evaluativas JS-->

        </div>
    </section>
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
    <script>
        // Funciones para reproducir sonidos
        function playHoverSound() {
            var popAudio = document.getElementById("popAudio");
            popAudio.currentTime = 0; // Reiniciar el sonido si ya se está reproduciendo
            var hoverAudio = document.getElementById("hoverAudio");
            hoverAudio.currentTime = 0; // Reiniciar el sonido si ya se está reproduciendo
            hoverAudio.play();
        }

        function playClickSound() {
            var hoverAudio = document.getElementById("hoverAudio");
            hoverAudio.currentTime = 0; // Reiniciar el sonido si ya se está reproduciendo
            var popAudio = document.getElementById("popAudio");
            popAudio.currentTime = 0; // Reiniciar el sonido si ya se está reproduciendo
            popAudio.play();
        }
    </script>
</body>