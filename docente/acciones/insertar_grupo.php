<?php

include('../../acciones/conexion.php');
session_start();

//Datos grupo
$materia = $_POST['materia'];
$nombre_grupo = $_POST['nombre_grupo'];
$grado = $_POST['grado'];
$curso = $_POST['curso'];
$id_user = $_SESSION['id_docente_primaria'];
$insertar_grupo = mysqli_query($conexion, "INSERT INTO grupos_primaria(materia, nombre_grupo, grado, id_docente) VALUES ('$materia', '$nombre_grupo', '$grado', '$id_user')");

//Contar total de intentos
$consultaIdGrupo = mysqli_query($conexion, "SELECT * FROM grupos_primaria WHERE nombre_grupo = '$nombre_grupo' AND id_docente = $id_user");
$resultadoIdGrupo = mysqli_fetch_assoc($consultaIdGrupo);
$id_grupo = $resultadoIdGrupo['id_grupo'];

$insertar_detalle_grupo = mysqli_query($conexion, "INSERT INTO detalle_grupo_cursos_primaria(id_grupo, id_curso) VALUES ('$id_grupo', '$curso')");

if ($insertar_grupo && $insertar_detalle_grupo) {
  $alert = '<div class="alert alert-primary" role="alert">
                          Grupo registrado
                      </div>';
  header("Location: ../../docente/grupos.php");
}
