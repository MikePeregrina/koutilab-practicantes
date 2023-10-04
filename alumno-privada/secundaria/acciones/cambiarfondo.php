<?php

include('../../../acciones/conexion.php');
session_start();
$id_user = $_SESSION['id_alumno_secundaria'];
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM alumnos_secundaria WHERE id_alumno = $id_user"));


$id = $user["id_alumno"];
$name = $user["nombre"];
$image = $user["image"];
$portada = $user["fondo"];

if (isset($_POST['portada-1'])) {
    $portada = 1;
} elseif (isset($_POST['portada-2'])) {
    $portada = 2;
} elseif (isset($_POST['portada-3'])) {
    $portada = 3;
} elseif (isset($_POST['portada-4'])) {
    $portada = 4;
} elseif (isset($_POST['portada-5'])) {
    $portada = 5;
} elseif (isset($_POST['portada-6'])) {
    $portada = 6;
} elseif (isset($_POST['portada-7'])) {
    $portada = 7;
} elseif (isset($_POST['portada-8'])) {
    $portada = 8;
}

switch ($portada) {
    case 1:
        $cambio = mysqli_query($conexion, "UPDATE alumnos_secundaria SET fondo = 'portada-1.png' WHERE id_alumno = '$id_user'");
        if ($cambio) {
            header("Location: ../../secundaria/perfil.php");
        }
        break;
    case 2:
        $cambio = mysqli_query($conexion, "UPDATE alumnos_secundaria SET fondo = 'portada-2.png' WHERE id_alumno = '$id_user'");
        if ($cambio) {
            header("Location: ../../secundaria/perfil.php");
        }
        break;
    case 3:
        $cambio = mysqli_query($conexion, "UPDATE alumnos_secundaria SET fondo = 'portada-3.png' WHERE id_alumno = '$id_user'");
        if ($cambio) {
            header("Location: ../../secundaria/perfil.php");
        }
        break;
    case 4:
        $cambio = mysqli_query($conexion, "UPDATE alumnos_secundaria SET fondo = 'portada-4.png' WHERE id_alumno = '$id_user'");
        if ($cambio) {
            header("Location: ../../secundaria/perfil.php");
        }
        break;
    case 5:
        $cambio = mysqli_query($conexion, "UPDATE alumnos_secundaria SET fondo = 'portada-5.png' WHERE id_alumno = '$id_user'");
        if ($cambio) {
            header("Location: ../../secundaria/perfil.php");
        }
        break;
    case 6:
        $cambio = mysqli_query($conexion, "UPDATE alumnos_secundaria SET fondo = 'portada-6.png' WHERE id_alumno = '$id_user'");
        if ($cambio) {
            header("Location: ../../secundaria/perfil.php");
        }
        break;
    case 7:
        $cambio = mysqli_query($conexion, "UPDATE alumnos_secundaria SET fondo = 'portada-7.png' WHERE id_alumno = '$id_user'");
        if ($cambio) {
            header("Location: ../../secundaria/perfil.php");
        }
        break;
    case 8:
        $cambio = mysqli_query($conexion, "UPDATE alumnos_secundaria SET fondo = 'portada-8.png' WHERE id_alumno = '$id_user'");
        if ($cambio) {
            header("Location: ../../secundaria/perfil.php");
        }
        break;
}
