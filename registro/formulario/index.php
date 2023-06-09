<?php
include('header.php');
?>
<title>Koutilab</title>
<script type="text/javascript" src="../script/form.js"></script>
<style type="text/css">
	#register_form fieldset:not(:first-of-type) {
		display: none;
	}
</style>
<?php include('container.php'); ?>
<div class="container">
	<nav class="navbar navbar-light bg-light">
		<a class="navbar-brand" href="../../index.php">
			<img src="../img/koutilab.png" class="nav-logo" alt="">
		</a>
	</nav>
	<!-- <div class="progress">
		<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
	</div> -->
	<div class="alert alert-success hide"></div>
	<div class="row">
		<div class="col-sm-8" style="scale: 110%; margin-top: 50px; width: 1000px; height: 450px; margin-left: 70px;">
		<div style="background-color: #00ffff; z-index: 5; width: 1000px; height: 20px; position: absolute; margin-left: -15px;"></div>
			<form id="register_form" style="padding: 30px;" novalidate action="multi_form_action.php" method="post" class="form">
				<fieldset>
					<div class="form-group">
						<label for="nombre_r" class="text-f">Nombre del responsable</label>
						<input type="text" class="form-control" required id="nombre_r" name="nombre_r" placeholder="Escribe tu nombre completo">
					</div>
					<div class="form-group">
						<label for="cargo" class="text-f">Cargo</label>
						<input type="text" class="form-control" required id="cargo" name="cargo" placeholder="Director, Maestro, TI, etc">
					</div>
					<div class="form-group">
						<label for="contacto" class="text-f">Whatsapp de contacto</label>
						<input type="text" class="form-control" required id="contacto" name="contacto" placeholder="222-222-2222">
					</div>
					<div class="form-group">
						<label for="email" class="text-f">Correo electrónico</label>
						<input type="email" class="form-control" required id="email" name="email" placeholder="usuario@ejemplo.com">
					</div>
					<input type="button" class="next-form btn btn-info" style="margin-left: -137px;" value="Siguiente" />
					<div class="col-sm-2">
						<img src="../img/mascota-2.png" class="img-rounded" style="margin: -420px 0px 0px 460px; scale: 90%; position:absolute; z-index: 5;" alt="Cinque Terre" height="500">
					</div>
				</fieldset>
				<fieldset>
					<div class="form-group">
						<label for="nombre_e" class="text-f">Nombre de la escuela</label>
						<input type="text" class="form-control" required id="nombre_e" name="nombre_e" placeholder="Escribe el nombre de tu institución">
					</div>
					<div class="form-group">
						<label for="clave" class="text-f">Clave centro del trabajo</label>
						<input type="text" class="form-control" required id="clave" name="clave" placeholder="eee1415e4e1">
					</div>
					<div class="form-group">
						<label for="pais" class="text-f">País</label>
						<input type="text" class="form-control" required id="pais" name="pais" placeholder="México">
					</div>
					<div class="form-group">
						<label for="estado" class="text-f">Estado</label>
						<input type="text" class="form-control" required id="estado" name="estado" placeholder="Puebla">
					</div>
					<input type="button" name="previous" class="previous-form btn btn-default" style="margin-left: -137px;" value="Previo" />
					<input type="button" name="next" class="next-form btn btn-info" value="Siguiente" />
					<div class="col-sm-2">
						<img src="../img/school.png" class="img-rounded" style="margin: -420px 0px 0px 260px; scale: 70%; position:absolute; z-index: 5;" alt="Cinque Terre" height="500">
					</div>
				</fieldset>
				<fieldset>
					<div class="form-group">
						<label for="grado">Grado escolar</label>
						<input type="text" class="form-control" name="grado" id="grado" placeholder="Primaria">
					</div>
					<div class="form-group">
						<label for="numero_a" class="text-f">Número de alumnos para iniciar</label>
						<input type="number" class="form-control" required id="numero_a" name="numero_a" placeholder="15">
					</div>
					<div class="form-group">
						<label for="otro_c" class="text-f">¿Qué otro curso te gustaría añadir con <br>esta tecnología a tu escuela?</label>
						<input type="text" class="form-control" id="otro_c" name="otro_c" placeholder="Ejemplo: Robótica, Finanzas, etc">
					</div>
					<input type="button" name="previous" class="previous-form btn btn-default" style="margin-left: -137px;" value="Previo" />
					<input type="submit" name="submit" class="submit btn btn-success" value="Enviar" />
					<div class="col-sm-2">
						<img src="../img/board.png" class="img-rounded" style="margin: -370px 0px 0px 375px; scale: 80%; position:absolute; z-index: 5;" alt="Cinque Terre" height="500">
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
<?php include('footer.php'); ?>