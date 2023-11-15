<?php
include('../../acciones/conexion.php');

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
    $modelo = $_GET['modelo'];
    $clave_alumno = $_GET['clave_alumno'];
    $clave_docente = $_GET['clave_docente'];
    $clave_director = $_GET['clave_director'];

    // Preparar la consulta SQL para la inserción
    $sql = "INSERT INTO escuelas (nombre_escuela, cct, nombre_director, calle, num_exterior, estado, codigo_postal, nivel_educativo, pais, id_admin, tipo_escuela, tipo_modelo, modelo, clave_alumno, clave_docente, clave_director)
    VALUES ('$nombre_escuela', '$cct', '$nombre_director', '$calle', '$num_exterior', '$estado', '$codigo_postal', '$nivel_educativo', '$pais', '$id_admin', '$tipo_escuela', '$tipo_modelo', '$modelo', '$clave_alumno', '$clave_docente', '$clave_director')";

    // Ejecutar la consulta y verificar si se realizó correctamente
    if ($conexion->query($sql) === TRUE) {
        echo "success"; // Si la inserción fue exitosa
    } else {
        echo "error: " . $conn->error; // Si hubo un error en la inserción
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
