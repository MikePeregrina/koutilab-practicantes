<?php
session_start();
require("../../acciones/conexion.php");
$id_user = $_SESSION['id_docente_universidad'];

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "UPDATE grupos_universidad SET estado = 0 WHERE id_grupo = $id");
    mysqli_close($conexion);
    header("Location: ../../docente-universidad/grupos.php");
}
