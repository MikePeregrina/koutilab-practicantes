<!-- Permisos para BIENVENIDA -->
<?php
session_start();
$id_user = $_SESSION['id_alumno_preparatoria'];
include('../../../../../../../acciones/conexion.php');
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

//Datos permisos
$permiso = $_POST['permiso'];
$id_curso = $_POST['id_curso'];
$insertarPermisos = mysqli_query($conexion, "INSERT INTO detalle_capsulas_preparatoria(id_alumno, id_capsula, id_curso) VALUES ($id_user, $permiso, $id_curso)");

if ($insertarPermisos) {
    header('location: ../../../../../rutas/ruta-vj-i.php');
    exit();
}
