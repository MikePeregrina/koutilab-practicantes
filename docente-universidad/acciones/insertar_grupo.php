<?php

include('../../acciones/conexion.php');
session_start();

//Datos grupo
$materia = $_POST['materia'];
$nombre_grupo = $_POST['nombre_grupo'];
$grado = $_POST['grado'];
$curso = $_POST['curso'];
$clave = $_POST['clave'];
$id_user = $_SESSION['id_docente_universidad'];
$insertar_grupo = mysqli_query($conexion, "INSERT INTO grupos_universidad(materia, nombre_grupo, grado, clave, id_docente) VALUES ('$materia', '$nombre_grupo', '$grado', '$clave', '$id_user')");

//Contar total de intentos
$consultaIdGrupo = mysqli_query($conexion, "SELECT * FROM grupos_universidad WHERE clave = '$clave' AND id_docente = $id_user");
$resultadoIdGrupo = mysqli_fetch_assoc($consultaIdGrupo);
$id_grupo = $resultadoIdGrupo['id_grupo'];

$insertar_detalle_grupo = mysqli_query($conexion, "INSERT INTO detalle_grupo_cursos_universidad(id_grupo, id_curso) VALUES ('$id_grupo', '$curso')");

if ($insertar_grupo && $insertar_detalle_grupo) {
  $alert = '<div class="alert alert-primary" role="alert">
                          Grupo registrado
                      </div>';
  header("Location: ../../docente-universidad/grupos.php");
}
