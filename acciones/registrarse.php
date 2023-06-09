<?php

include('conexion.php');
$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$contrasena = md5($_POST['contrasena']);
$clave = $_POST['clave'];
$email = $_POST['email'];
$query = mysqli_query($conexion, "SELECT * FROM alumnos WHERE usuario = '$usuario'");
$result = mysqli_fetch_array($query);
$query1 = mysqli_query($conexion, "SELECT * FROM docentes WHERE usuario = '$usuario'");
$result1 = mysqli_fetch_array($query1);
$query2 = mysqli_query($conexion, "SELECT * FROM directores WHERE usuario = '$usuario'");
$result2 = mysqli_fetch_array($query2);

//Buscar si la clave pertenece a un alumno
$query_clave_alumno = mysqli_query($conexion, "SELECT * FROM escuelas WHERE clave_alumno = '$clave'");
$result_clave_alumno = mysqli_fetch_array($query_clave_alumno);

if ($result_clave_alumno == 0) {
  header("Location: ../login.php");
} else {
  $data_alumno = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM escuelas WHERE clave_alumno = '$clave'"));
  if (isset($data_alumno['id_escuela'])) {
    $id_escuela_alumno = $data_alumno['id_escuela'];
  }
  if (isset($data_alumno['nivel_educativo'])) {
    $nivel_educativo_alumno = $data_alumno['nivel_educativo'];
  }
}

//Buscar si la clave pertenece a un docente
$query_clave_docente = mysqli_query($conexion, "SELECT * FROM escuelas WHERE clave_docente = '$clave'");
$result_clave_docente = mysqli_fetch_array($query_clave_docente);

if ($result_clave_docente == 0) {
  header("Location: ../login.php");
} else {
  $data_docente = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM escuelas WHERE clave_docente = '$clave'"));
  if (isset($data_docente['id_escuela'])) {
    $id_escuela_docente = $data_docente['id_escuela'];
  }
}

//Buscar si la clave pertenece a un director
$query_clave_director = mysqli_query($conexion, "SELECT * FROM escuelas WHERE clave_director = '$clave'");
$result_clave_director = mysqli_fetch_array($query_clave_director);

if ($result_clave_director == 0) {
  header("Location: ../login.php");
} else {
  $data_director = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM escuelas WHERE clave_director = '$clave'"));
  if (isset($data_director['id_escuela'])) {
    $id_escuela_director = $data_director['id_escuela'];
  }
}

if ($result > 0  || $result1 > 0 || $result2 > 0) {
  $alert = '<div class="alert alert-warning" role="alert">
                      El usuario ya existe
                  </div>';
} else {

  if ($result_clave_alumno > 0) {
    $query_insert_alumno = mysqli_query($conexion, "INSERT INTO alumnos(nombre, usuario, contrasena, clave, id_escuela, nivel_educativo, email, image, fondo) values ('$nombre', '$usuario', '$contrasena', '$clave', $id_escuela_alumno, '$nivel_educativo_alumno', '$email', 'Mascota-Aerobot-01.png', 'portada-1.png')");
    if ($query_insert_alumno) {
      $alert = '<div class="alert alert-primary" role="alert">
                          Alumno registrado
                      </div>';
      header("Location: ../login.php");
    } else {
      $alert = '<div class="alert alert-danger" role="alert">
                      Error al registrar
                  </div>';
    }
  } else if ($result_clave_docente > 0) {
    $query_insert_docente = mysqli_query($conexion, "INSERT INTO docentes(nombre, usuario, contrasena, clave, id_escuela, email) values ('$nombre', '$usuario', '$contrasena', '$clave', $id_escuela_docente, '$email')");
    if ($query_insert_docente) {
      $alert = '<div class="alert alert-primary" role="alert">
                          Docente registrado
                      </div>';
      header("Location: ../login.php");
    } else {
      $alert = '<div class="alert alert-danger" role="alert">
                      Error al registrar
                  </div>';
    }
  } else if ($result_clave_director > 0) {
    $query_insert_director = mysqli_query($conexion, "INSERT INTO directores(nombre, usuario, contrasena, clave, id_escuela, email) values ('$nombre', '$usuario', '$contrasena', '$clave', $id_escuela_director, '$email')");
    if ($query_insert_director) {
      $alert = '<div class="alert alert-primary" role="alert">
                          Director registrado
                      </div>';
      header("Location: ../login.php");
    } else {
      $alert = '<div class="alert alert-danger" role="alert">
                      Error al registrar
                  </div>';
    }
  }
}
