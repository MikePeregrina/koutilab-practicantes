<?php
session_start();
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
if (empty($_SESSION['active'])) {
    header('location: ../../../../../../../../index.php');
}
include "../../../../../../../acciones/conexion.php";

if (!empty($_GET['id_alumno']) && !empty($_GET['id_capsula']) && !empty($_GET['id_curso']) && !empty($_GET['payment_amount'])) {
    $payment_amount = $_GET['payment_amount'];
    $id_alumno = $_GET['id_alumno'];
    $id_capsula = $_GET['id_capsula'];
    $id_curso = $_GET['id_curso'];

    // Verificar si el usuario tiene al menos 50 estrellas
    $sql_estrellas = "SELECT estrellas FROM total_estrellas_$rol WHERE id_alumno = $id_user";
    $result_estrellas = $conexion->query($sql_estrellas);

    if ($result_estrellas->num_rows > 0) {
        $row = $result_estrellas->fetch_assoc();
        $cantidad_estrellas = $row['estrellas'];

        if ($cantidad_estrellas >= 50) {
            // Actualizar la cantidad de estrellas restando 50
            $nueva_cantidad_estrellas = $cantidad_estrellas - 50;
            $query_update_estrellas = mysqli_query($conexion, "UPDATE total_estrellas_$rol SET estrellas = '$nueva_cantidad_estrellas' WHERE id_alumno = '$id_user'");

            // Insertar en detalle_capsulas_pago_$rol
            $query_insert_permiso = mysqli_query($conexion, "INSERT INTO detalle_capsulas_pago_$rol(id_capsula, id_alumno, id_curso) VALUES ('$id_capsula', '$id_alumno', '$id_curso')");

            if ($query_update_estrellas && $query_insert_permiso) {
                header("Location: orderCompleted.php");
            }
        } else {
            header('Location: ../../../../../../rutas/ruta-vj-i.php');
        }
    } else {
        header('Location: ../../../../../../rutas/ruta-vj-i.php');
    }
} else {
    header('Location: ../../../../../../rutas/ruta-vj-i.php');
}
