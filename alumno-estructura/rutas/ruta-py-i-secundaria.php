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
$permiso = "5";
$sql = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../cursos/python/intermedio/capsulas/acciones/acceso_cursos.php");
}

include "verificar-ruta-py-i-secundaria.php";

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 1 de python
$capsula_verificar_py1 = "capsula7";
$sql_verificar_py1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_py1' AND d.id_curso = 5");
$existe_verificar_py1 = mysqli_num_rows($sql_verificar_py1);

//Verificar si esta comprada la capsula 1 de python
$capsula_comprada_py1 = "capsulapago1";
$sql_comprada_py1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_py1' AND d.id_curso = 5;");
$existe_comprada_py1 = mysqli_num_rows($sql_comprada_py1);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 2 de python
$capsula_verificar_py2 = "capsula10";
$sql_verificar_py2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_py2' AND d.id_curso = 5");
$existe_verificar_py2 = mysqli_num_rows($sql_verificar_py2);

//Verificar si esta comprada la capsula 2 de python
$capsula_comprada_py2 = "capsulapago2";
$sql_comprada_py2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_py2' AND d.id_curso = 5;");
$existe_comprada_py2 = mysqli_num_rows($sql_comprada_py2);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 3 de python
$capsula_verificar_py3 = "capsula19";
$sql_verificar_py3 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_py3' AND d.id_curso = 5");
$existe_verificar_py3 = mysqli_num_rows($sql_verificar_py3);

//Verificar si esta comprada la capsula 3 de python
$capsula_comprada_py3 = "capsulapago3";
$sql_comprada_py3 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_py3' AND d.id_curso = 5;");
$existe_comprada_py3 = mysqli_num_rows($sql_comprada_py3);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 4 de python
$capsula_verificar_py4 = "capsula38";
$sql_verificar_py4 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_py4' AND d.id_curso = 5");
$existe_verificar_py4 = mysqli_num_rows($sql_verificar_py4);

//Verificar si esta comprada la capsula 4 de python
$capsula_comprada_py4 = "capsulapago4";
$sql_comprada_py4 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_py4' AND d.id_curso = 5;");
$existe_comprada_py4 = mysqli_num_rows($sql_comprada_py4);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 5 de python
$capsula_verificar_py5 = "capsula41";
$sql_verificar_py5 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_py5' AND d.id_curso = 5");
$existe_verificar_py5 = mysqli_num_rows($sql_verificar_py5);

//Verificar si esta comprada la capsula 5 de python
$capsula_comprada_py5 = "capsulapago5";
$sql_comprada_py5 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_py5' AND d.id_curso = 5;");
$existe_comprada_py5 = mysqli_num_rows($sql_comprada_py5);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 6 de python
$capsula_verificar_py6 = "capsula44";
$sql_verificar_py6 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_py6' AND d.id_curso = 5");
$existe_verificar_py6 = mysqli_num_rows($sql_verificar_py6);

//Verificar si esta comprada la capsula 6 de python
$capsula_comprada_py6 = "capsulapago6";
$sql_comprada_py6 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_py6' AND d.id_curso = 5;");
$existe_comprada_py6 = mysqli_num_rows($sql_comprada_py6);

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
if (!isset($_SESSION['actualizacion_realizada_pyi'])) {
    // Llama a la función para actualizar las conexiones
    actualizarConexiones($permiso, $conexion, $rol);

    // Establece la variable de sesión "actualizacion_realizada" para indicar que la actualización ya se hizo
    $_SESSION['actualizacion_realizada_pyi'] = true;
}
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png">
    <link rel="stylesheet" href="../css_secundaria/ruta-py-i.css">
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
        <h1>CURSO DE PHYTON INTERMEDIO DE KOUTILAB</h1>
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
            <div class="snake">
                <div class="label">
                    <span>CAPITULO 1</span>
                </div>
                <a href="../acciones/estadisticas_py-i.php" style="text-decoration: none;color: inherit;">
                    <div class="graphics-buttoon"><i class="fa-solid fa-chart-line fa-2xl"></i></div>
                </a>
                <!-- PY -->
                <a href="../cursos/python/intermedio/capsulas/contenido/introduccion/ci1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn1" id="intro"></button></a><!--Capsula introduccion a PY-->
                <!-- TEMA 1 -->
                <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P1/ct1python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn2" id="teoria" <?php echo 'style="' . (($existe_capsula1 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 1-->
                <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn3" id="prac" <?php echo 'style="' . (($existe_capsula2 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 1-->
                <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjp1-1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn4" id="game" <?php echo 'style="' . (($existe_capsula3 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 1-->
                <!-- TEMA 2 -->
                <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P1/ct2python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn5" id="teoria" <?php echo 'style="' . (($existe_capsula4 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 2-->
                <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp2.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn6" id="prac" <?php echo 'style="' . (($existe_capsula5 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 2-->
                <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjp1-2.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn7" id="game" <?php echo 'style="' . (($existe_capsula6 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 2-->
                <!-- TEMA 3 -->
                <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P1/ct3python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn8" id="teoria" <?php echo 'style="' . (($existe_capsula7 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 4-->
                <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp3.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn9" id="prac" <?php echo 'style="' . (($existe_capsula8 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 4-->
                <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjp1-3.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn10" id="game" <?php echo 'style="' . (($existe_capsula9 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 4-->
                <!-- TEMA 4 -->
                <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P1/ct4python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn11" id="teoria" <?php echo 'style="' . (($existe_capsula10 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 6-->
                <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp5.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn12" id="prac" <?php echo 'style="' . (($existe_capsula11 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 6-->
                <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjp1-4.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn13" id="game" <?php echo 'style="' . (($existe_capsula12 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 6-->
                <!-- TEMA 5 -->
                <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P1/ct5python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn14" id="teoria" <?php echo 'style="' . (($existe_capsula13 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 7-->
                <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp7.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn15" id="prac" <?php echo 'style="' . (($existe_capsula14 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 7-->
                <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjp1-5.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn16" id="game" <?php echo 'style="' . (($existe_capsula15 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 7-->
                <!-- TEMA 6 -->
                <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P1/ct6python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn17" id="teoria" <?php echo 'style="' . (($existe_capsula16 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 8-->
                <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp8.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn18" id="prac" <?php echo 'style="' . (($existe_capsula17 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 8-->
                <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjp1-6.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn19" id="game" <?php echo 'style="' . (($existe_capsula18 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 8-->
                <!-- TEMA 7 -->
                <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P1/ct7python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn20" id="teoria" <?php echo 'style="' . (($existe_capsula19 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 10-->
                <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp9.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn21" id="prac" <?php echo 'style="' . (($existe_capsula20 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 10-->
                <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjp1-7.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn22" id="game" <?php echo 'style="' . (($existe_capsula21 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 10-->
            </div>
            <!-- EVALUATIVA PY-->
            <a href="../cursos/python/intermedio/capsulas/contenido/evaluativas/ce1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn23" id="eva" <?php echo 'style="' . (($existe_capsula22 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula evaluativas PY-->
            <!-- CAPSULAS PREMIUM -->
            <!-- TEMA 2.5 -->
            <div class="container-premium1" <?php echo 'style="' . (($tipo_modelo == 1) ? 'display: none;' : 'display: block;') . '"'; ?>> 
                <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P1/ct2-5python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="prem1" id="teoriap" <?php echo 'style="' . (($existe_verificar_py1 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_py1 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a><!-- Capsula teorica 3 -->
                <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp4.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="prem2" id="pracp" <?php echo 'style="' . (($existe_verificar_py1 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_py1 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a><!-- Capsula practica 3 -->
                <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjpp1/index.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="prem3" id="gamep" <?php echo 'style="' . (($existe_verificar_py1 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_py1 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a><!-- Capsula juego 3 -->
            </div> 
            <!-- TEMA 3.5 -->
            <div class="container-premium2" <?php echo 'style="' . (($tipo_modelo == 1) ? 'display: none;' : 'display: block;') . '"'; ?>> 
                <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P1/ct3-5python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="prem4" id="teoriap" <?php echo 'style="' . (($existe_verificar_py2 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_py2 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a><!-- Capsula teorica 5 -->
                <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp6.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="prem5" id="pracp" <?php echo 'style="' . (($existe_verificar_py2 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_py2 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a><!-- Capsula practica 5 -->
                <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjpp2.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="prem6" id="gamep" <?php echo 'style="' . (($existe_verificar_py2 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_py2 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a><!-- Capsula juego 5 -->
            </div> 
            <!-- TEMA 6.5 -->
            <div class="container-premium3" <?php echo 'style="' . (($tipo_modelo == 1) ? 'display: none;' : 'display: block;') . '"'; ?>> 
                <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P1/ct6-5python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="prem7" id="teoriap" <?php echo 'style="' . (($existe_verificar_py3 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_py3 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a><!-- Capsula teorica 9 -->
                <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp10.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="prem8" id="pracp" <?php echo 'style="' . (($existe_verificar_py3 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_py3 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a><!-- Capsula practica 9 -->
                <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjpp3.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="prem9" id="gamep" <?php echo 'style="' . (($existe_verificar_py3 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_py3 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a><!-- Capsula juego 9 -->
            </div> 
            <!-- PARTE 2 -->
            <div class="label-2">
                <span>CAPITULO 2</span>
            </div>
            <!-- PY -->
            <a href="../cursos/python/intermedio/capsulas/contenido/introduccion/ci2.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn24" id="intro" <?php echo 'style="' . (($existe_capsula23 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula introduccion a PY-->
            <!-- TEMA 1 -->
            <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P2/ct1python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn25" id="teoria" <?php echo 'style="' . (($existe_capsula24 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 1-->
            <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp11.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn26" id="prac" <?php echo 'style="' . (($existe_capsula25 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 1-->
            <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjp2-1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn27" id="game" <?php echo 'style="' . (($existe_capsula26 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 1-->
            <!-- TEMA 2 -->
            <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P2/ct2python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn28" id="teoria" <?php echo 'style="' . (($existe_capsula27 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 2-->
            <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp12.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn29" id="prac" <?php echo 'style="' . (($existe_capsula28 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 2-->
            <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjp2-2.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn30" id="game" <?php echo 'style="' . (($existe_capsula29 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 2-->
            <!-- TEMA 3 -->
            <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P2/ct3python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn31" id="teoria" <?php echo 'style="' . (($existe_capsula30 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 3-->
            <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp13.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn32" id="prac" <?php echo 'style="' . (($existe_capsula31 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 3-->
            <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjp2-3.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn33" id="game" <?php echo 'style="' . (($existe_capsula32 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 3-->
            <!-- TEMA 4 -->
            <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P2/ct4python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn34" id="teoria" <?php echo 'style="' . (($existe_capsula33 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 4-->
            <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp14.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn35" id="prac" <?php echo 'style="' . (($existe_capsula34 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 4-->
            <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjp2-4.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn36" id="game" <?php echo 'style="' . (($existe_capsula35 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 4-->
            <!-- TEMA 5 -->
            <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P2/ct5python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn37" id="teoria" <?php echo 'style="' . (($existe_capsula36 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 5-->
            <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp15.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn38" id="prac" <?php echo 'style="' . (($existe_capsula37 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 5-->
            <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjp2-5.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn39" id="game" <?php echo 'style="' . (($existe_capsula38 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 5-->
            <!-- TEMA 6 -->
            <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P2/ct6python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn40" id="teoria" <?php echo 'style="' . (($existe_capsula39 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 7-->
            <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp17.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn41" id="prac" <?php echo 'style="' . (($existe_capsula40 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 7-->
            <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjp2-6.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn42" id="game" <?php echo 'style="' . (($existe_capsula41 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 7-->
            <!-- TEMA 7 -->
            <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P2/ct7python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn43" id="teoria" <?php echo 'style="' . (($existe_capsula42 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 9-->
            <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp19.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn44" id="prac" <?php echo 'style="' . (($existe_capsula43 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 9-->
            <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjp2-7.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn45" id="game" <?php echo 'style="' . (($existe_capsula44 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 9-->
            <!-- EVALUATIVA PY-->
            <a href="../cursos/python/intermedio/capsulas/contenido/evaluativas/ce2.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn46" id="eva" <?php echo 'style="' . (($existe_capsula45 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula evaluativas PY-->
            <!-- CAPSULAS PREMIUM -->
            <!-- TEMA 5.5 -->
            <div class="container-premium4" <?php echo 'style="' . (($tipo_modelo == 1) ? 'display: none;' : 'display: block;') . '"'; ?>> 
            <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P2/ct5-5python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="prem10" id="teoriap" <?php echo 'style="' . (($existe_verificar_py4 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_py4 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a><!-- Capsula teorica 6 -->
            <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp16.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="prem11" id="pracp" <?php echo 'style="' . (($existe_verificar_py4 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_py4 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a><!-- Capsula practica 6 -->
            <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjpp4/index.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="prem12" id="gamep" <?php echo 'style="' . (($existe_verificar_py4 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_py4 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a><!-- Capsula juego 6 -->
            </div>
            <!-- TEMA 6.5 -->
            <div class="container-premium5" <?php echo 'style="' . (($tipo_modelo == 1) ? 'display: none;' : 'display: block;') . '"'; ?>> 
            <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P2/ct6-5python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="prem13" id="teoriap" <?php echo 'style="' . (($existe_verificar_py5 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_py5 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a><!-- Capsula teorica 8 -->
            <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp18.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="prem14" id="pracp" <?php echo 'style="' . (($existe_verificar_py5 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_py5 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a><!-- Capsula practica 8 -->
            <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjpp5.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="prem15" id="gamep" <?php echo 'style="' . (($existe_verificar_py5 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_py5 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a><!-- Capsula juego 8 -->
            </div> 
            <!-- TEMA 7.5 -->
            <div class="container-premium6" <?php echo 'style="' . (($tipo_modelo == 1) ? 'display: none;' : 'display: block;') . '"'; ?>> 
            <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/P2/ct7-5python.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="prem16" id="teoriap" <?php echo 'style="' . (($existe_verificar_py6 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_py6 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a><!-- Capsula teorica 10 -->
            <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp20.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn" id="pracp" <?php echo 'style="' . (($existe_verificar_py6 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_py6 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a><!-- Capsula practica 10 -->
            <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cjpp6.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn18" id="gamep" <?php echo 'style="' . (($existe_verificar_py6 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_py6 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a><!-- Capsula juego 10 -->
            </div> 
        </div>
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