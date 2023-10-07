<?php
session_start();
$id_user = $_SESSION['id'];
if (empty($_SESSION['active']) || empty($_SESSION['id'])) {
    header('location: ../../../acciones/cerrarsesion.php');
}
include "../../../acciones/conexion.php";
$permiso = "5";
$sql = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_personal a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../cursos/python/intermedio/capsulas/acciones/acceso_cursos.php");
}

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png">
    <link rel="stylesheet" href="../css/ruta-py-i.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="body">
        <div class="containers">CURSO DE PYTHON INTERMEDIO DE KOUTILAB
            <a href="../perfil.php"><button style="float: right;" class="btn-b" id="btn-cerrar-modalV"><i class="fas fa-reply"></i></button></a>
        </div>
        <div class="container">
            <img class="igm" src="../img/PPP.png">
            <img class="gif" src="../img/loop.gif">
            <img class="gif1" src="../img/foco.gif">
            <div class="ruta">
                <a href="../cursos/python/intermedio/capsulas/contenido/introduccion/ci1.php"><button class="btn1"></button></a>
                <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/ct1.php"><button class="btn2"></button></a>
                <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp1.php"><button class="btn3"></button></a>
                <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cj6.php"><button class="btn4"></button></a>
                <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp2.php"><button class="btn5"></button></a>
                <a href="../cursos/python/intermedio/capsulas/contenido/introduccion/ci2.php"><button class="btn6"></button></a>
                <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/ct2.php"><button class="btn7"></button></a>
                <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp3.php"><button class="btn8"></button></a>
                <a href="../cursos/python/intermedio/capsulas/contenido/evaluativas/ce1.php"><button class="btn9"></button></a>
                <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp4.php"><button class="btn10"></button></a>
                <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cj6.php"><button class="btn11"></button></a>
                <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp5.php"><button class="btn12"></button></a>
                <a href="../cursos/python/intermedio/capsulas/contenido/teoricas/ct3.php"><button class="btn13"></button></a>
                <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp6.php"><button class="btn14"></button></a>
                <a href="../cursos/python/intermedio/capsulas/contenido/juegos/cj6.php"><button class="btn15"></button></a>
                <a href="../cursos/python/intermedio/capsulas/contenido/practicas/cp7.php"><button class="btn16"></button></a>
                <a href="../cursos/python/intermedio/capsulas/contenido/evaluativas/ce2.php"><button class="btn17"></button></a>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="../js/rutas.js"></script>
</body>