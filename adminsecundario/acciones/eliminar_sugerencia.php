<?php
session_start();
require("../../acciones/conexion.php");
$id_user = $_SESSION['id_admin_secundario'];

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "UPDATE sugerencias SET estado = 0 WHERE id_sugerencia = $id");
    mysqli_close($conexion);
    header("Location: ../../adminsecundario/bandeja.php");
}
