

<?php
session_start();
$id_user = $_SESSION['id_director'];
if (empty($_SESSION['active'])) {
	header('location: ../../../../../../../../index.php');
}
include "../../acciones/conexion.php";


if (!empty($_GET['payment_id']) && !empty($_GET['item_number']) && !empty($_GET['item_name']) && !empty($_GET['payment_amount']) && !empty($_GET['payment_currency']) && !empty($_GET['id_director']) && !empty($_GET['cupo']) && !empty($_GET['clave']) && !empty($_GET['nombrePaquete']) && !empty($_GET['image'])) {
	$payment_id = $_GET['payment_id'];
	$item_number = $_GET['item_number'];
	$item_name = $_GET['item_name'];
	$payment_amount = $_GET['payment_amount'];
	$payment_currency = $_GET['payment_currency'];
	$id = trim($_GET['id_director']);
	$cupo = trim($_GET['cupo']);
	$clave = trim($_GET['clave']);
	$nombrePaquete = ($_GET['nombrePaquete']);
	$image = trim($_GET['image']);
	$query_insert = mysqli_query($conexion, "INSERT INTO payment_institucional(payment_id, item_number, item_name, payment_amount, payment_currency,id, create_at) VALUES ('$payment_id', '$item_number', '$item_name', '$payment_amount', '$payment_currency',$id, current_timestamp())");
	if ($query_insert) {

		$sql = "INSERT INTO paquete_director(id_director, nombre_paquete, clave, cupo, image) VALUES ($id, '$nombrePaquete', '$clave', $cupo, '$image')";

		$query = mysqli_query($conexion, $sql);


		if ($query) {

			header("Location: orderCompleted.php");
		} else {
			echo '<script type="text/javascript">
            alert("No se pudo registrar al paquete"); 
            </script>';
		}
	}
} else {
	header('Location: index.php');
}
?>
			
