<?php
session_start();
require("../../acciones/conexion.php");
$id_user = $_SESSION['id_admin_secundario'];

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "DELETE FROM formulario  WHERE id = $id");
    mysqli_close($conexion);
    header("Location: ../../adminsecundario/preregistros.php");
}
