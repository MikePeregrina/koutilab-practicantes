<!-- Permisos para TEORICO -->

<?php
session_start();
$id_user = $_SESSION['id_alumno_universidad'];
include('../../../../../../../acciones/conexion.php');
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

$pregunta = $_POST['validar'];
$permiso = $_POST['permiso'];
$id_curso = $_POST['id_curso'];


//Verificar si la pregunta es correcta
if ($pregunta != 'correcto') {
    $sumaIntentos = ($totalIntentos) + 1;
    $insertarIntentos = mysqli_query($conexion, "UPDATE detalle_intentos_universidad SET intentos = '$sumaIntentos' WHERE id_capsula = '$permiso' AND id_alumno = $id_user AND id_curso = '$id_curso'");
    header('location: ../contenido/teoricas/ct2html.php');
}

//Verificar si la pregunta es correcta
if ($pregunta != 'correcto') {
    header('location: ../contenido/teoricas/ct2html.php');
}

if ($pregunta == 'correcto') {

    $query = "INSERT INTO detalle_estadisticas_universidad (progreso, teorico, id_alumno, id_curso) VALUES ('2', '" . $_POST['teorico'] . "', '$id_user', $id_curso)";
    $query_run = mysqli_query($conexion, $query);
    //Sumar trofeos
    $consultaEstadistica = mysqli_query($conexion, "SELECT trofeos, SUM(trofeos) AS total_trofeos, progreso, SUM(progreso) AS total_progreso, puntos, SUM(puntos) AS total_puntos, practico, SUM(practico) AS total_practico, teorico, SUM(teorico) AS total_teorico FROM detalle_estadisticas_universidad WHERE id_alumno = $id_user AND id_curso = '$id_curso'");
    $resultadoEstadistica = mysqli_fetch_assoc($consultaEstadistica);
    $totalTrofeos = $resultadoEstadistica['total_trofeos'];
    $totalProgreso = $resultadoEstadistica['total_progreso'];
    $totalPuntos = $resultadoEstadistica['total_puntos'];
    $totalPractico = $resultadoEstadistica['total_practico'];
    $totalTeorico = $resultadoEstadistica['total_teorico'];
    $insertarEstadisticas = mysqli_query($conexion, "UPDATE estadisticas_universidad SET trofeos = '$totalTrofeos', progreso = '$totalProgreso', puntos = '$totalPuntos', practico = '$totalPractico', teorico = '$totalTeorico' WHERE id_alumno = $id_user AND id_curso = '$id_curso'");

    if ($insertarEstadisticas) {
        header('location: ../../../../../rutas/ruta-pw-i.php');
        exit();
    }
}
