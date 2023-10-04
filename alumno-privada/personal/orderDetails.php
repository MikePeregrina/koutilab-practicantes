

<?php
session_start();
$id_user = $_SESSION['id_alumno_personal'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_personal'])) {
    header('location: ../../acciones/cerrarsesion.php');
}
include('../../acciones/conexion.php');


if (!empty($_GET['id_curso']) && !empty($_GET['id_alumno'])) {
    $id_curso = $_GET['id_curso'];
    $id_alumno = $_GET['id_alumno'];
    $query_insert = mysqli_query($conexion, "INSERT INTO acceso_cursos_personal(id_curso, id_alumno) VALUES ('$id_curso', '$id_alumno')");
    if ($query_insert) {
        header("Location: orderCompleted.php");
    }
} else {
    header('Location: perfil.php');
}
?>
			
