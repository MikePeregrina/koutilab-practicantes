<?php 
include('header.php');
include_once("../../acciones/conexion.php");
?>
<title>Koutilab</title>
<?php include('container.php');?>
<div class="container">
	<h2>Registro Koutilab</h2>		
	<div class="row well alert alert-success">		
	<?php
	if (isset($_POST['submit'])) {	
		$nombre_r = mysqli_real_escape_string($conexion, $_POST['nombre_r']);	
		$cargo = mysqli_real_escape_string($conexion, $_POST['cargo']);	
		$contacto = mysqli_real_escape_string($conexion, $_POST['contacto']);	
		$email = mysqli_real_escape_string($conexion, $_POST['email']);	
		$nombre_e = mysqli_real_escape_string($conexion, $_POST['nombre_e']);	
		$clave = mysqli_real_escape_string($conexion, $_POST['clave']);	
		$pais = mysqli_real_escape_string($conexion, $_POST['pais']);	
		$estado = mysqli_real_escape_string($conexion, $_POST['estado']);	
		$grado = mysqli_real_escape_string($conexion, $_POST['grado']);	
		$numero_a = mysqli_real_escape_string($conexion, $_POST['numero_a']);	
		$otro_c = mysqli_real_escape_string($conexion, $_POST['otro_c']);	
		if(mysqli_query($conexion, "INSERT INTO formulario(nombre_r, cargo, contacto, email, nombre_e, clave, pais, estado, grado, numero_a, otro_c) VALUES('".$nombre_r."', '" . $cargo . "', '". $contacto."', '".$email."', '".$nombre_e."', '". $clave."', '" . $pais . "', '". $estado."', '".$grado."', '".$numero_a."', '". $otro_c."')")) {
			echo "¡Está registrado con éxito!";
		} else {
			echo "Error al registrarte... ¡Vuelve a intentarlo más tarde!";
		}
	}	
	?>	
	</div>
	<div style="margin:50px 0px 0px 0px;">
		<a class="btn btn-default read-more" style="background:#3399ff;color:white" href="../../index.php" title="">Regresar a Koutilab</a>			
	</div>	
</div>	
<?php include('footer.php');?> 