<?php

include('../../acciones/conexion.php');
session_start();

//Datos grupo
$id_user = $_SESSION['id_docente_primaria'];
$contrasena = md5($_POST['contrasena']);

$sql_update = mysqli_query($conexion, "UPDATE docentes_primaria SET contrasena = '$contrasena' WHERE id_docente = '$id_user'");

if ($sql_update) {
  $alert = '<div class="alert alert-primary" role="alert">
                         Contraseña editada
                      </div>';
  header("Location: ../../docente-primaria/dashboard.php");
}
