<?php
include('../../acciones/conexion.php');

    // Recibir los datos del formulario
    $nombre_escuela = $_POST['nombre_escuela'];
    $cct = $_POST['cct'];
    $nombre_director = $_POST['nombre_director'];
    $nivel_educativo = $_POST['nivel_educativo'];
    $tipo_escuela = $_POST['tipo_escuela'];
    $pais = $_POST['pais'];
    $estado = $_POST['estado'];
    $calle = $_POST['calle'];
    $num_exterior = $_POST['num_exterior'];
    $codigo_postal = $_POST['codigo_postal'];
    $id_admin = $_POST['id_admin'];
    $tipo_modelo = $_POST['tipo_modelo'];
    $clave_alumno = $_POST['clave_alumno'];
    $clave_docente = $_POST['clave_docente'];
    $clave_director = $_POST['clave_director'];

    // Preparar la consulta SQL para la inserción
    $sql = "INSERT INTO escuelas (nombre_escuela, cct, nombre_director, calle, num_exterior, estado, codigo_postal, nivel_educativo, pais, id_admin, tipo_escuela, tipo_modelo, clave_alumno, clave_docente, clave_director)
    VALUES ('$nombre_escuela', '$cct', '$nombre_director', '$calle', '$num_exterior', '$estado', '$codigo_postal', '$nivel_educativo', '$pais', '$id_admin', '$tipo_escuela', '$tipo_modelo', '$clave_alumno', '$clave_docente', '$clave_director')";

    // Ejecutar la consulta y verificar si se realizó correctamente
    if ($conexion->query($sql) === TRUE) {
        echo "success"; // Si la inserción fue exitosa
    } else {
        echo "error: " . $conn->error; // Si hubo un error en la inserción
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
