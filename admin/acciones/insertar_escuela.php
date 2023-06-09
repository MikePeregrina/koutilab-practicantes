<?php

include('../../acciones/conexion.php');
session_start();

//Datos escuela
$nombre_escuela = $_POST['nombre_escuela'];
$cct = $_POST['cct'];
$nombre_director = $_POST['nombre_director'];
$calle = $_POST['calle'];
$num_exterior = $_POST['num_exterior'];
$estado = $_POST['estado'];
$pais = $_POST['pais'];
$codigo_postal = $_POST['codigo_postal'];
$nivel_educativo = $_POST['nivel_educativo'];
$autorizacion = $_POST['autorizacion'];
$id_user = $_SESSION['id_admin'];

//Claves
$clave_director = $_POST['clave_director'];
$clave_docente = $_POST['clave_docente'];
$clave_alumno = $_POST['clave_alumno'];

//Query para insertar escuela
$insertar_escuela = mysqli_query($conexion, "INSERT INTO escuelas(nombre_escuela, cct, nombre_director, calle, num_exterior, estado, codigo_postal, nivel_educativo, pais, autorizacion, id_admin, clave_alumno, clave_docente, clave_director) VALUES ('$nombre_escuela', '$cct', '$nombre_director', '$calle', '$num_exterior', '$estado', '$codigo_postal', '$nivel_educativo', '$pais', '$autorizacion', '$id_user', '$clave_alumno', '$clave_docente', '$clave_director')");

if ($insertar_escuela) {
  $alert = '<div class="alert alert-primary" role="alert">
                          Escuela registrada
                      </div>';
  header("Location: ../../admin/escuelas.php");
}
