<?php
session_start();
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
include('../../../../../../../../../../acciones/conexion.php');
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

$id_capsula = $_GET['id_capsula'];
$id_curso = $_GET['id_curso'];
$estrellas = $_GET['estrellas'];

$consultaEstrellasCurso = mysqli_query($conexion, "SELECT estrellas FROM estrellas_preparatoria WHERE id_capsula = '$id_capsula' AND id_alumno = '$id_user' AND id_curso = '$id_curso'");
$resultadoEstrellasCurso = mysqli_fetch_assoc($consultaEstrellasCurso);
$totalEstrellasCurso = $resultadoEstrellasCurso['estrellas'];

// Calcular las estrellas que se insertarán sin exceder el límite de 15
$estrellas_a_insertar = min(15 - $totalEstrellasCurso, $estrellas);

//Verificar estrellas en la capsula
$sql = mysqli_query($conexion, "SELECT * FROM estrellas_preparatoria WHERE id_capsula = '$id_capsula' AND id_alumno = '$id_user' AND id_curso = '$id_curso'");
$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
    $insertarEstrellas = mysqli_query($conexion, "INSERT INTO estrellas_preparatoria(id_capsula, id_alumno, estrellas, id_curso) VALUES ($id_capsula, $id_user, $estrellas, $id_curso)");
    $insertarEstrellaTabla =  mysqli_query($conexion, "INSERT INTO total_estrellas_preparatoria (estrellas, id_alumno) 
   VALUES ('$estrellas_a_insertar', '$id_user')");
} else {
    //Contar total de estrellas
    $consultaEstrellas = mysqli_query($conexion, "SELECT estrellas FROM estrellas_preparatoria WHERE id_capsula = '$id_capsula' AND id_alumno = '$id_user' AND id_curso = '$id_curso'");
    $resultadoEstrellas = mysqli_fetch_assoc($consultaEstrellas);
    $totalEstrellas = $resultadoEstrellas['estrellas'];
    if ($estrellas_a_insertar > 0) {
        // Actualizar el total de estrellas acumuladas por alumno en el curso en la tabla estrellas_curso
        $actualizarEstrellasTabla = mysqli_query($conexion, "UPDATE total_estrellas_preparatoria SET estrellas = estrellas + '$estrellas_a_insertar' 
                                 WHERE id_alumno = '$id_user'");
    }
}

if ($totalEstrellas <= 15) {
    //Sumar estrellas
    $sumarEstrellas = $totalEstrellas + $estrellas;

    //Query para insertar estrellas en tabla de estrellas
    $insertarEstrellas = mysqli_query($conexion, "UPDATE estrellas_preparatoria SET estrellas = '$sumarEstrellas' WHERE id_capsula = '$id_capsula' AND id_alumno = $id_user AND id_curso = '$id_curso'");

    if ($insertarEstrellas) {
        header('location: ../../../../../../../../rutas/ruta-pw-a.php');
        exit();
    }
} else {
    header('location: ../../../../../../../../rutas/ruta-pw-a.php');
}
