<?php
session_start();
require("../../acciones/conexion.php");
$id_user = $_SESSION['id_admin'];

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "DELETE FROM formulario_institucional  WHERE id_formulario_institucional = $id");
    mysqli_close($conexion);
    header("Location: ../../adminsecundario/pre-registros-inst.php");
}
