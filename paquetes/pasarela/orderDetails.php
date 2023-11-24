

<?php

include "../../acciones/conexion.php";

if (!empty($_GET['payment_id']) && !empty($_GET['item_number']) && !empty($_GET['item_name']) && !empty($_GET['payment_amount']) && !empty($_GET['payment_currency'])) {
	$payment_id = $_GET['payment_id'];
	$item_number = $_GET['item_number'];
	$item_name = $_GET['item_name'];
	$payment_amount = $_GET['payment_amount'];
	$payment_currency = $_GET['payment_currency'];

	// Recibir los datos del formulario
	$nombre_escuela = $_GET['nombre_escuela'];
	$cct = $_GET['cct'];
	$nombre_director = $_GET['nombre_director'];
	$nivel_educativo = $_GET['nivel_educativo'];
	$tipo_escuela = $_GET['tipo_escuela'];
	$pais = $_GET['pais'];
	$estado = $_GET['estado'];
	$calle = $_GET['calle'];
	$num_exterior = $_GET['num_exterior'];
	$codigo_postal = $_GET['codigo_postal'];
	$id_admin = $_GET['id_admin'];
	$tipo_modelo = $_GET['tipo_modelo'];
	$clave_alumno = $_GET['clave_alumno'];
	$clave_docente = $_GET['clave_docente'];
	$clave_director = $_GET['clave_director'];
	$usuarios = $_GET['usuarios'];

	// Obtener la fecha actual (fecha de compra)
	$fecha_compra = date("Y-m-d");

	// Calcular la fecha de expiración sumando 6 meses a la fecha de compra
	$fecha_expiracion = date("Y-m-d", strtotime("+6 months", strtotime($fecha_compra)));

	$query_insert = mysqli_query($conexion, "INSERT INTO payment(payment_id, item_number, item_name, payment_amount, payment_currency, create_at) VALUES ('$payment_id', '$item_number', '$item_name', '$payment_amount', '$payment_currency', current_timestamp())");
	$query_insert_escuela = mysqli_query($conexion, "INSERT INTO escuelas (nombre_escuela, cct, nombre_director, calle, num_exterior, estado, codigo_postal, nivel_educativo, pais, id_admin, tipo_escuela, tipo_modelo, modelo, clave_alumno, clave_docente, clave_director)
	VALUES ('$nombre_escuela', '$cct', '$nombre_director', '$calle', '$num_exterior', '$estado', '$codigo_postal', '$nivel_educativo', '$pais', '$id_admin', '$tipo_escuela', '$tipo_modelo', '$item_name', '$clave_alumno', '$clave_docente', '$clave_director')");
	if ($query_insert && $query_insert_escuela) {
		// Realizar la consulta SQL para obtener el id_escuela
		$query = "SELECT id_escuela FROM escuelas WHERE clave_alumno = '$clave_alumno'";
		$result = $conexion->query($query);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$id_escuela = $row['id_escuela'];
			$query = mysqli_query($conexion, "INSERT INTO tabla_claves (clave, usos_restantes, usos_totales, id_escuela, fecha_expiracion) VALUES ('$clave_alumno', $usuarios, '$usuarios', '$id_escuela', '$fecha_expiracion')");
			if ($query) {
				header("Location: orderCompleted.php?clave_alumno=$clave_alumno&clave_docente=$clave_docente&clave_director=$clave_director");
			}
		}
	}
}
?>
			
