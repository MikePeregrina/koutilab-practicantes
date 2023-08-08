<?php
session_start();
$id_user = $_SESSION['id_alumno_universidad'];
include('../../../../../../../../../../acciones/conexion.php');
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

$id_capsula = $_GET['id_capsula'];
$id_curso = $_GET['id_curso'];
$estrellas = $_GET['estrellas'];

//Verificar estrellas en la capsula
$sql = mysqli_query($conexion, "SELECT * FROM estrellas_universidad WHERE id_capsula = '$id_capsula' AND id_alumno = '$id_user' AND id_curso = '$id_curso'");
$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
    $insertarEstrellas = mysqli_query($conexion, "INSERT INTO detalle_intentos_universidad(id_capsula, id_alumno, intentos, id_curso) VALUES ($permiso, $id_user, 1, $id_curso)");
    //Contar total de estrellas
    $consultaEstrellas = mysqli_query($conexion, "SELECT estrellas FROM estrellas_universidad WHERE id_capsula = '$id_capsula' AND id_alumno = '$id_user' AND id_curso = '$id_curso'");
    $resultadoEstrellas = mysqli_fetch_assoc($consultaEstrellas);
    $totalIntentos = $resultadoEstrellas['estrellas'];
} else {
    //Contar total de estrellas
    $consultaEstrellas = mysqli_query($conexion, "SELECT estrellas FROM estrellas_universidad WHERE id_capsula = '$id_capsula' AND id_alumno = '$id_user' AND id_curso = '$id_curso'");
    $resultadoEstrellas = mysqli_fetch_assoc($consultaEstrellas);
    $totalEstrellas = $resultadoEstrellas['estrellas'];
}

if ($totalEstrellas <= 15) {
    //Sumar estrellas
    $sumarEstrellas = $totalEstrellas + $estrellas;

    //Query para insertar estrellas en tabla de estrellas
    $insertarEstrellas = mysqli_query($conexion, "UPDATE estrellas_universidad SET estrellas = '$sumarEstrellas' WHERE id_capsula = '$id_capsula' AND id_alumno = $id_user AND id_curso = '$id_curso'");

    if ($insertarEstrellas) {
        header('location: ../../../../../../../../rutas/ruta-pw-a.php');
        exit();
    }
} else {
    header('location: ../../../../../../../../rutas/ruta-pw-a.php');
}
