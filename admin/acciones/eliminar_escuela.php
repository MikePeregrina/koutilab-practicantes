<?php
session_start();
require("../../acciones/conexion.php");
$id_user = $_SESSION['id_admin'];

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "UPDATE escuelas SET estatus = 0 WHERE id_escuela = $id");
    mysqli_close($conexion);
    header("Location: ../../admin/escuelas.php");
}
