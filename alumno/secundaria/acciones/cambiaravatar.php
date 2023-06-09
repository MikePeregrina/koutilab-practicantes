<?php

include('../../../acciones/conexion.php');
session_start();
$id_user = $_SESSION['id_alumno_secundaria'];
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM alumnos_secundaria WHERE id_alumno = $id_user"));


$id = $user["id_alumno"];
$name = $user["nombre"];
$image = $user["image"];
$portada = $user["fondo"];

if (isset($_POST['Mascota-Aerobot-01'])) {
    $portada = 1;
} elseif (isset($_POST['Mascota-Aerobot-02'])) {
    $portada = 2;
} elseif (isset($_POST['Mascota-Aerobot-03'])) {
    $portada = 3;
} elseif (isset($_POST['Mascota-Aerobot-04'])) {
    $portada = 4;
} elseif (isset($_POST['Mascota-Aerobot-05'])) {
    $portada = 5;
} elseif (isset($_POST['Mascota-Aerobot-06'])) {
    $portada = 6;
} elseif (isset($_POST['Mascota-Aerobot-07'])) {
    $portada = 7;
} elseif (isset($_POST['Mascota-Aerobot-08'])) {
    $portada = 8;
} elseif (isset($_POST['Mascota-Aerobot-09'])) {
    $portada = 9;
}

switch ($portada) {
    case 1:
        $cambio = mysqli_query($conexion, "UPDATE alumnos_secundaria SET image = 'Mascota-Aerobot-01.png' WHERE id_alumno = '$id_user'");
        if ($cambio) {
            header("Location: ../../secundaria/perfil.php");
        }
        break;
    case 2:
        $cambio = mysqli_query($conexion, "UPDATE alumnos_secundaria SET image = 'Mascota-Aerobot-02.png' WHERE id_alumno = '$id_user'");
        if ($cambio) {
            header("Location: ../../secundaria/perfil.php");
        }
        break;
    case 3:
        $cambio = mysqli_query($conexion, "UPDATE alumnos_secundaria SET image = 'Mascota-Aerobot-03.png' WHERE id_alumno = $id_user");
        if ($cambio) {
            header("Location: ../../secundaria/perfil.php");
        }
        break;
    case 4:
        $cambio = mysqli_query($conexion, "UPDATE alumnos_secundaria SET image = 'Mascota-Aerobot-04.png' WHERE id_alumno = $id_user");
        if ($cambio) {
            header("Location: ../../secundaria/perfil.php");
        }
        break;
    case 5:
        $cambio = mysqli_query($conexion, "UPDATE alumnos_secundaria SET image = 'Mascota-Aerobot-05.png' WHERE id_alumno = $id_user");
        if ($cambio) {
            header("Location: ../../secundaria/perfil.php");
        }
        break;
    case 6:
        $cambio = mysqli_query($conexion, "UPDATE alumnos_secundaria SET image = 'Mascota-Aerobot-06.png' WHERE id_alumno = $id_user");
        if ($cambio) {
            header("Location: ../../secundaria/perfil.php");
        }
        break;
    case 7:
        $cambio = mysqli_query($conexion, "UPDATE alumnos_secundaria SET image = 'Mascota-Aerobot-07.png' WHERE id_alumno = $id_user");
        if ($cambio) {
            header("Location: ../../secundaria/perfil.php");
        }
        break;
    case 8:
        $cambio = mysqli_query($conexion, "UPDATE alumnos_secundaria SET image = 'Mascota-Aerobot-08.png' WHERE id_alumno = $id_user");
        if ($cambio) {
            header("Location: ../../secundaria/perfil.php");
        }
        break;
    case 9:
        $cambio = mysqli_query($conexion, "UPDATE alumnos_secundaria SET image = 'Mascota-Aerobot-09.png' WHERE id_alumno = $id_user");
        if ($cambio) {
            header("Location: ../../secundaria/perfil.php");
        }
        break;
}
