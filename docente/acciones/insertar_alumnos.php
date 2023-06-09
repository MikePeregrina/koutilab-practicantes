<?php

include('../../acciones/conexion.php');
session_start();

//Datos grupo
$nivel_educativo = $_POST['nivel_educativo'];
$nombre_grupo = $_POST['nombre_grupo'];
$grado_escolar = $_POST['grado_escolar'];
$nombre = $_POST['nombre'];
$nombre_grupo = $_POST['nombre_grupo'];
$usuario = $_POST['usuario'];
$contrasena = md5($_POST['contrasena']);
$clave = $_POST['clave'];
$id_escuela = $_POST['id_escuela'];
$id_docente = $_POST['id_docente'];
$email = $_POST['email'];

$id_user = $_SESSION['id_docente_primaria'];

$consulta_curso = mysqli_query($conexion, "SELECT * FROM grupos_primaria WHERE nombre_grupo = '$nombre_grupo'");
$resultadoCurso = mysqli_fetch_assoc($consulta_curso);
$nombregrupo = $resultadoCurso['id_grupo'];

$insertar_alumno = mysqli_query($conexion, "INSERT INTO alumnos_primaria(
  nombre, usuario, contrasena, clave, 
  grado_escolar, id_escuela, id_docente, image, fondo, email) VALUES (
    '$nombre', '$usuario', '$contrasena', '$clave', '$grado_escolar', '$id_escuela', '$id_docente', 'Mascota-Aerobot-01.png', 'portada-1.png', '$email')");

$consulta_alumno = mysqli_query($conexion, "SELECT id_alumno FROM alumnos_primaria WHERE usuario = '$usuario'");
$resultadoAlumno = mysqli_fetch_assoc($consulta_alumno);
$idalumno = $resultadoAlumno['id_alumno'];

$insertar_grupo = mysqli_query($conexion, "INSERT INTO detalle_grupos_primaria(id_alumno, id_grupo) VALUES ('$idalumno', '$nombregrupo')");

$sql = "SELECT DISTINCT c.id_curso FROM grupos_primaria g JOIN detalle_grupo_cursos_primaria dg ON g.id_grupo = dg.id_grupo JOIN cursos_primaria c ON dg.id_curso = c.id_curso WHERE g.id_grupo = $nombregrupo;";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
  // Itera sobre los resultados de la consulta SELECT y ejecuta una consulta INSERT para insertar cada registro en la tabla de destino
  while ($fila = $resultado->fetch_assoc()) {
    $idcurso = $fila["id_curso"];
    $sql_insert = "INSERT INTO acceso_cursos_primaria(id_curso, id_alumno) VALUES ('$idcurso', $idalumno)";
    $conexion->query($sql_insert);
  }
  header("Location: ../../docente/grupos.php");
}

$insertar_acceso_curso = mysqli_query($conexion, "INSERT INTO acceso_cursos_primaria(curso, id_alumno) VALUES ('$accesoCurso', '$idalumno')");

if ($insertar_alumno && $insertar_grupo && $insertar_acceso_curso) {
  $alert = '<div class="alert alert-primary" role="alert">
                         Alumno registrado
                      </div>';
  header("Location: ../../docente/alumnos.php");
}
