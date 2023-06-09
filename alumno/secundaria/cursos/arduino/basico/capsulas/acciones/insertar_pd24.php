<?php
session_start();
$id_user = $_SESSION['id_alumno_secundaria'];
include('../../../../../../../acciones/conexion.php');
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

//Datos permisos
$permiso = 20;
$insertarPermisos = mysqli_query($conexion, "INSERT INTO detalle_capsulas_secundaria(id_alumno, id_capsula) VALUES ($id_user, $permiso)");

if ($insertarPermisos) {
    header('location: ../../../../../rutas/ruta-ar-b.php');

    exit();
}
