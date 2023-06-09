

<?php
session_start();
$id_user = $_SESSION['id_alumno_preparatoria'];
if (empty($_SESSION['active'])) {
	header('location: ../../../../../../../../index.php');
}
include "../../../../../../../../acciones/conexion.php";

if (!empty($_GET['payment_id']) && !empty($_GET['item_number']) && !empty($_GET['item_name']) && !empty($_GET['payment_amount']) && !empty($_GET['payment_currency'])) {
	$payment_id = $_GET['payment_id'];
	$item_number = $_GET['item_number'];
	$item_name = $_GET['item_name'];
	$payment_amount = $_GET['payment_amount'];
	$payment_currency = $_GET['payment_currency'];
	$id_alumno = $_GET['id_alumno'];
	$id_capsula = $_GET['id_capsula'];
	$id_curso = $_GET['id_curso'];
	$query_insert = mysqli_query($conexion, "INSERT INTO payment(payment_id, item_number, item_name, payment_amount, payment_currency, create_at) VALUES ('$payment_id', '$item_number', '$item_name', '$payment_amount', '$payment_currency', current_timestamp())");
	$query_insert_permiso = mysqli_query($conexion, "INSERT INTO detalle_capsulas_pago(id_capsula, id_alumno, id_curso) VALUES ('$id_capsula', '$id_alumno', '$id_curso')");
	if ($query_insert && $query_insert_permiso) {
		header("Location: orderCompleted.php");
	}
} else {
	header('Location: index.php');
}
?>
			
