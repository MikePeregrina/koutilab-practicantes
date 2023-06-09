<!-- PERMISOS PARA PRACTICA -->
<?php
session_start();
$id_user = $_SESSION['id_alumno_universidad'];
include('../../../../../../../acciones/conexion.php');
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

$pregunta = $_GET['validar'];
$permiso = $_GET['permiso'];
$id_curso = $_GET['id_curso'];
$puntos = $_GET['practico'];

//Verificar si ya hay intentos en la capsula
$sql = mysqli_query($conexion, "SELECT * FROM detalle_intentos_universidad WHERE id_capsula = '$permiso' AND id_alumno = '$id_user' AND id_curso = '$id_curso'");
$result_sql = mysqli_num_rows($sql);

//Verificar si ya se tiene permiso y no dar puntos de más
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_universidad WHERE id_capsula = '$permiso' AND id_alumno = '$id_user' AND id_curso = '$id_curso'");
$result_sql_permisos = mysqli_num_rows($sql_permisos);

if ($result_sql == 0) {
    $insertarIntentos = mysqli_query($conexion, "INSERT INTO detalle_intentos_universidad(id_capsula, id_alumno, intentos, id_curso) VALUES ($permiso, $id_user, 1, $id_curso)");
    //Contar total de intentos
    $consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_universidad WHERE id_capsula = '$permiso' AND id_alumno = $id_user AND id_curso = '$id_curso'");
    $resultadoIntentos = mysqli_fetch_assoc($consultaIntentos);
    $totalIntentos = $resultadoIntentos['intentos'];
} else {
    //Contar total de intentos
    $consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_universidad WHERE id_capsula = '$permiso' AND id_alumno = $id_user AND id_curso = '$id_curso'");
    $resultadoIntentos = mysqli_fetch_assoc($consultaIntentos);
    $totalIntentos = $resultadoIntentos['intentos'];
}

//Verificar si la pregunta es correcta
if ($pregunta != 'correcto') {
    $sumaIntentos = ($totalIntentos) + 1;
    $insertarIntentos = mysqli_query($conexion, "UPDATE detalle_intentos_universidad SET intentos = '$sumaIntentos' WHERE id_capsula = '$permiso' AND id_alumno = $id_user AND id_curso = '$id_curso'");
    header('location: ../contenido/practicas/cp12.php');
}

if ($pregunta == 'correcto' && $totalIntentos == 1 && $result_sql_permisos == 0) {
    //Datos permisos
    $insertarPermisos = mysqli_query($conexion, "INSERT INTO detalle_capsulas_universidad(id_alumno, id_capsula, id_curso) VALUES ($id_user, $permiso, $id_curso)");

    $query = "INSERT INTO detalle_estadisticas_universidad (progreso, practico, id_alumno, id_curso) VALUES ('2', $puntos, '$id_user', $id_curso)";
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

    if ($insertarPermisos && $insertarEstadisticas) {
        header('location: ../../../../../rutas/ruta-py-a.php');
        exit();
    }
} else if ($pregunta == 'correcto' && $totalIntentos == 2 && $result_sql_permisos == 0) {
    //Datos permisos
    $insertarPermisos = mysqli_query($conexion, "INSERT INTO detalle_capsulas_universidad(id_alumno, id_capsula, id_curso) VALUES ($id_user, $permiso, $id_curso)");

    $query = "INSERT INTO detalle_estadisticas_universidad (progreso, practico, id_alumno, id_curso) VALUES ('2', $puntos - 2, '$id_user', $id_curso)";
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

    if ($insertarPermisos && $insertarEstadisticas) {
        header('location: ../../../../../rutas/ruta-py-a.php');
        exit();
    }
} else if ($pregunta == 'correcto' && $totalIntentos == 3 && $result_sql_permisos == 0) {
    //Datos permisos
    $insertarPermisos = mysqli_query($conexion, "INSERT INTO detalle_capsulas_universidad(id_alumno, id_capsula, id_curso) VALUES ($id_user, $permiso, $id_curso)");

    $query = "INSERT INTO detalle_estadisticas_universidad (progreso, practico, id_alumno, id_curso) VALUES ('2', $puntos - 4, '$id_user', $id_curso)";
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

    if ($insertarPermisos && $insertarEstadisticas) {
        header('location: ../../../../../rutas/ruta-py-a.php');
        exit();
    }
} else if ($pregunta == 'correcto' && $totalIntentos >= 4 && $result_sql_permisos == 0) {
    //Datos permisos
    $insertarPermisos = mysqli_query($conexion, "INSERT INTO detalle_capsulas_universidad(id_alumno, id_capsula, id_curso) VALUES ($id_user, $permiso, $id_curso)");

    $query = "INSERT INTO detalle_estadisticas_universidad (progreso, id_alumno, id_curso) VALUES ('2', '$id_user', $id_curso)";
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

    if ($insertarPermisos && $insertarEstadisticas) {
        header('location: ../../../../../rutas/ruta-py-a.php');
        exit();
    }
} else if ($pregunta == 'correcto' && $totalIntentos >= 1 && $result_sql_permisos > 0) {
    header('location: ../../../../../rutas/ruta-py-a.php');
}
