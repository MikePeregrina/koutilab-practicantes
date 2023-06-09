<?php
session_start();
require("../../acciones/conexion.php");
$id_user = $_SESSION['id_admin'];

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "DELETE FROM admin  WHERE id_admin = $id");
    mysqli_close($conexion);
    header("Location: ../../admin/administradores.php");
}
