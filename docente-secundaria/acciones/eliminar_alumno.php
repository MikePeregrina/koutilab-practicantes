<?php
session_start();
require("../../acciones/conexion.php");
$id_user = $_SESSION['id_docente_secundaria'];

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "DELETE FROM alumnos  WHERE id_alumno = $id");
    mysqli_close($conexion);
    header("Location: ../../docente/alumnos.php");
}
