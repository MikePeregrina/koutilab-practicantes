<!-- PERMISOS PARA JUEGOS -->
<?php
session_start();
$id_user = $_SESSION['id_alumno_primaria'];
include('../../../../../../../acciones/conexion.php');
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

$pregunta = $_POST['validar'];
$permiso = $_POST['permiso'];
$id_curso = $_POST['id_curso'];
$puntos = $_POST['score'];

//Verificar si ya se tiene permiso y no dar puntos de más
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_primaria WHERE id_capsula = '$permiso' AND id_alumno = '$id_user' AND id_curso = '$id_curso'");
$result_sql_permisos = mysqli_num_rows($sql_permisos);

//Verificar si la pregunta es correcta
if ($pregunta != 'correcto') {
    header('location: ../contenido/juegos/cj9.php');
}

if ($pregunta == 'correcto' && $result_sql_permisos <= 4) {
    //Datos permisos
    $insertarPermisos = mysqli_query($conexion, "INSERT INTO detalle_capsulas_primaria(id_alumno, id_capsula, id_curso) VALUES ($id_user, $permiso, $id_curso)");

    $query = "INSERT INTO detalle_estadisticas_primaria (progreso, trofeos, id_alumno, id_curso) VALUES ('2', $puntos, '$id_user', $id_curso)";
    $query_run = mysqli_query($conexion, $query);
    //Sumar trofeos
    $consultaEstadistica = mysqli_query($conexion, "SELECT trofeos, SUM(trofeos) AS total_trofeos, progreso, SUM(progreso) AS total_progreso, puntos, SUM(puntos) AS total_puntos, practico, SUM(practico) AS total_practico, teorico, SUM(teorico) AS total_teorico FROM detalle_estadisticas_primaria WHERE id_alumno = $id_user AND id_curso = '$id_curso'");
    $resultadoEstadistica = mysqli_fetch_assoc($consultaEstadistica);
    $totalTrofeos = $resultadoEstadistica['total_trofeos'];
    $totalProgreso = $resultadoEstadistica['total_progreso'];
    $totalPuntos = $resultadoEstadistica['total_puntos'];
    $totalPractico = $resultadoEstadistica['total_practico'];
    $totalTeorico = $resultadoEstadistica['total_teorico'];
    $insertarEstadisticas = mysqli_query($conexion, "UPDATE estadisticas_primaria SET trofeos = '$totalTrofeos', progreso = '$totalProgreso', puntos = '$totalPuntos', practico = '$totalPractico', teorico = '$totalTeorico' WHERE id_alumno = $id_user AND id_curso = '$id_curso'");

    if ($insertarPermisos && $insertarEstadisticas) {
        header('location: ../../../../../rutas/ruta-pw-b.php');
        exit();
    }
} else if ($pregunta == 'correcto' && $result_sql_permisos > 4) {
    header('location: ../../../../../rutas/ruta-pw-b.php');
}
