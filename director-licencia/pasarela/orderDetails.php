

<?php

include "../../acciones/conexion.php";

if (!empty($_GET['payment_id']) && !empty($_GET['item_number']) && !empty($_GET['item_name']) && !empty($_GET['payment_amount']) && !empty($_GET['payment_currency'])) {
	$payment_id = $_GET['payment_id'];
	$item_number = $_GET['item_number'];
	$item_name = $_GET['item_name'];
	$payment_amount = $_GET['payment_amount'];
	$payment_currency = $_GET['payment_currency'];

	// Recibir los datos del formulario
	$clave_alumno = $_GET['clave_alumno'];
	$clave_docente = $_GET['clave_docente'];
	$clave_director = $_GET['clave_director'];
	$usuarios = $_GET['usuarios'];

	// Obtener la fecha actual (fecha de compra)
	$fecha_compra = date("Y-m-d");

	// Calcular la fecha de expiración sumando 6 meses a la fecha de compra
	$fecha_expiracion = date("Y-m-d", strtotime("+6 months", strtotime($fecha_compra)));

	$query_insert = mysqli_query($conexion, "INSERT INTO payment(payment_id, item_number, item_name, payment_amount, payment_currency, create_at) VALUES ('$payment_id', '$item_number', '$item_name', '$payment_amount', '$payment_currency', current_timestamp())");
	if ($query_insert) {

		// Consulta para obtener la fecha de expiración actual
		$query_fecha = "SELECT fecha_expiracion, usos_restantes, usos_totales FROM tabla_claves WHERE clave = '$clave_alumno'";
		$result_fecha = $conexion->query($query_fecha);

		if ($result_fecha->num_rows > 0) {
			$row = $result_fecha->fetch_assoc();
			$fecha_expiracion_actual = $row['fecha_expiracion'];
			$usos_restantes = $row['usos_restantes'];
			$usos_totales = $row['usos_totales'];

			// Obtener la fecha actual (fecha de compra)
			$fecha_compra = date("Y-m-d");

			// Calcular la fecha de expiración sumando 6 meses a la fecha de compra
			$fecha_expiracion_nueva = date("Y-m-d", strtotime("+6 months", strtotime($fecha_compra)));

			// Actualizar la tabla con la nueva fecha de expiración y los usos
			$query_update = "UPDATE tabla_claves 
                     SET fecha_expiracion = '$fecha_expiracion_nueva', 
                         usos_restantes = $usos_restantes + $usuarios, 
                         usos_totales = $usos_totales + $usuarios 
                     WHERE clave = '$clave_alumno'";

			if ($conexion->query($query_update) === TRUE) {
				header("Location: orderCompleted.php?clave_alumno=$clave_alumno&clave_docente=$clave_docente&clave_director=$clave_director");
			} else {
				echo "Error al actualizar: " . $conexion->error;
			}
		} else {
			echo "No se encontraron resultados para la clave proporcionada.";
		}
	}
}


?>
			
