<?php
include('../../acciones/conexion.php');

$fechaInicio = json_decode($_POST["fechaInicio"], true);
$fechaFin = json_decode($_POST["fechaFin"], true);
$id_user = json_decode($_POST["id_user"], true); //id del admin
$tipo = json_decode($_POST["tipo"], true); //Define cuál consulta se realizará

if ($tipo == "alumnos") {
    if ($fechaInicio != null) {
        if ($fechaFin != null) {
            $consulta = "SELECT 
            COUNT(*) AS total_cuentas,
            'Primaria' AS nivel_educativo
        FROM
            alumnos_primaria
            WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'
        UNION ALL
        SELECT 
            COUNT(*) AS total_cuentas,
            'Secundaria' AS nivel_educativo
        FROM
            alumnos_secundaria
            WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'
        UNION ALL
        SELECT 
            COUNT(*) AS total_cuentas,
            'Preparatoria' AS nivel_educativo
        FROM
            alumnos_preparatoria
            WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'
        UNION ALL
        SELECT 
            COUNT(*) AS total_cuentas,
            'Universidad' AS nivel_educativo
        FROM
            alumnos_universidad
            WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'
        UNION ALL
        SELECT 
            COUNT(*) AS total_cuentas,
            'Personal' AS nivel_educativo
        FROM
            alumnos_personal
            WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'
        UNION ALL
        SELECT 
            COUNT(*) AS total_cuentas,
            'Institucional' AS nivel_educativo
        FROM
            temp_account
            WHERE fechaRegistro BETWEEN '$fechaInicio' AND '$fechaFin'";
        }
    } else {
        // Consulta para obtener los datos de alumnos
        $consulta = "SELECT 
            COUNT(*) AS total_cuentas,
            'Primaria' AS nivel_educativo
        FROM
            alumnos_primaria
        UNION ALL
        SELECT 
            COUNT(*) AS total_cuentas,
            'Secundaria' AS nivel_educativo
        FROM
            alumnos_secundaria
        UNION ALL
        SELECT 
            COUNT(*) AS total_cuentas,
            'Preparatoria' AS nivel_educativo
        FROM
            alumnos_preparatoria
        UNION ALL
        SELECT 
            COUNT(*) AS total_cuentas,
            'Universidad' AS nivel_educativo
        FROM
            alumnos_universidad
        UNION ALL
        SELECT 
            COUNT(*) AS total_cuentas,
            'Personal' AS nivel_educativo
        FROM
            alumnos_personal
        UNION ALL
        SELECT 
            COUNT(*) AS total_cuentas,
            'Institucional' AS nivel_educativo
        FROM
            temp_account";
    }
    // Ejecutar la consulta
    $resultado = $conexion->query($consulta);

    // Crear un arreglo para almacenar los datos
    $datos = array();

    // Recorrer los resultados y almacenarlos en el arreglo
    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();

    // Crear un arreglo para almacenar los alumnos por mes
    $gananciasPorMes = array();

    // Recorrer los datos y agrupar los alumnos por mes
    foreach ($datos as $dato) {
        //$fecha = strtotime($dato['nivel_educativo']);
        $mes = $dato['nivel_educativo'];
        $monto = floatval($dato['total_cuentas']);

        if (isset($gananciasPorMes[$mes])) {
            $gananciasPorMes[$mes] += $monto;
        } else {
            $gananciasPorMes[$mes] = $monto;
        }
    }

    // Crear un arreglo para almacenar los datos de la gráfica
    $datosGrafica = array();

    // Recorrer los alumnos por mes y generar los datos para la gráfica
    foreach ($gananciasPorMes as $mes => $ganancia) {
        // Obtener el nombre del mes y año a partir del formato Y-m
        $nombreMes = $mes;
        $datosGrafica[] = array(
            'label' => $nombreMes,
            'data' => $ganancia
        );
    }
    echo json_encode($datosGrafica);
}
