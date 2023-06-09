<?php 

include('../../acciones/conexion.php');
session_start();

//Datos contacto
$nombre_escuela = $_POST['nombre_escuela'];
$nombre_usuario = $_POST['nombre_usuario'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];
$estado = $_POST['estado'];
$insertar_contacto = mysqli_query($conexion, "INSERT INTO sugerencias(nombre_escuela, nombre_usuario, asunto, mensaje, estado) VALUES ('$nombre_escuela', '$nombre_usuario', '$asunto', '$mensaje', '$estado')");

if ($insertar_contacto) {
    $alert = '<div class="alert alert-primary" role="alert">
                          Usuario registrado
                      </div>';
    header("Location: ../../docente/contacto.php");
  }

?>