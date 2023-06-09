<?php 

include('../../acciones/conexion.php');
session_start();

//Datos escuela
$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$contrasena = md5($_POST['contrasena']);
$pais = $_POST['pais'];

$insertar_admin = mysqli_query($conexion, "INSERT INTO admin(usuario, nombre, contrasena, pais) VALUES ('$usuario', '$nombre', '$contrasena', '$pais')");

//Datos claves
// $insertar_clave = mysqli_query($conexion, "INSERT INTO roles(clave, rol) VALUES ('$clave_admin', '5')");

if ($insertar_admin) {
    $alert = '<div class="alert alert-primary" role="alert">
                          Administrador registrado
                      </div>';
    header("Location: ../../admin/administradores.php");
  }
