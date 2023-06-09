<?php
session_start();
$id_user = $_SESSION['id_alumno_secundaria'];
include('../../../../../../../acciones/conexion.php');
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

//Datos permisos
$permiso = $_POST['permiso'];
$id_curso = $_POST['id_curso'];
$insertarPermisos = mysqli_query($conexion, "INSERT INTO detalle_capsulas_secundaria(id_alumno, id_capsula, id_curso) VALUES ($id_user, $permiso, $id_curso)");

//inseratar valores cero para el correcto funcionamiento de logica despues
$query = "INSERT INTO estadisticas_secundaria(trofeos, progreso, puntos, practico, teorico, id_alumno, id_curso) VALUES ('0','0','0','0','0','$id_user','$id_curso')";
$query_run = mysqli_query($conexion, $query);

if ($insertarPermisos) {
    header('location: ../../../../../rutas/ruta-pw-a.php');
    exit();
}
