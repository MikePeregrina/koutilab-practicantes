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
$id_user = $_SESSION['id_admin_secundario'];
$insertar_escuela = mysqli_query($conexion, "INSERT INTO escuelas(nombre_escuela, cct, nombre_director, calle, num_exterior, estado, codigo_postal, nivel_educativo, pais, autorizacion, id_admin) VALUES ('$nombre_escuela', '$cct', '$nombre_director', '$calle', '$num_exterior', '$estado', '$codigo_postal', '$nivel_educativo', '$pais', '$autorizacion', '$id_user')");

//Datos claves
$clave_director = $_POST['clave_director'];
$clave_docente = $_POST['clave_docente'];
$clave_alumno = $_POST['clave_alumno'];
$insertar_clave = mysqli_query($conexion, "INSERT INTO roles(clave, rol) VALUES ('$clave_alumno', '2'),('$clave_docente', '3'),('$clave_director', '4')");

if ($insertar_escuela && $insertar_clave) {
  $alert = '<div class="alert alert-primary" role="alert">
                          Escuela registrada
                      </div>';
  header("Location: ../../adminsecundario/escuelas.php");
}
