<?php
    include('../../acciones/conexion.php');

    $fechaInicio = json_decode($_POST["fechaInicio"], true );
    $fechaFin = json_decode($_POST["fechaFin"], true );
    $id_user = json_decode($_POST["id_user"], true ); //id del admin
    $tipo = json_decode($_POST["tipo"], true ); //Define cuál consulta se realizará

    if($tipo == "alumnos"){
        if ($fechaInicio != null) {
            if ($fechaFin != null) {
                $consulta = "SELECT COUNT(*) AS total, DATE_FORMAT(fecha_registro, '%M %Y') AS mes_anio
                FROM (
                  SELECT COUNT(*) AS alumnos, fecha_registro
                  FROM alumnos_personal AS aper
                  WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'

                  UNION ALL

                  SELECT COUNT(*) AS alumnos, fecha_registro
                  FROM alumnos_primaria AS apri
                  INNER JOIN escuelas AS es ON apri.id_escuela = es.id_escuela
                  WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'
                
                  UNION ALL
                
                  SELECT COUNT(*) AS alumnos, fecha_registro
                  FROM alumnos_secundaria AS ase
                  INNER JOIN escuelas AS es ON ase.id_escuela = es.id_escuela
                  WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'
                
                  UNION ALL
                
                  SELECT COUNT(*) AS alumnos, fecha_registro
                  FROM alumnos_preparatoria AS apre
                  INNER JOIN escuelas AS es ON apre.id_escuela = es.id_escuela
                  WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'
                
                  UNION ALL
                
                  SELECT COUNT(*) AS alumnos, fecha_registro
                  FROM alumnos_universidad AS au
                  INNER JOIN escuelas AS es ON au.id_escuela = es.id_escuela
                  WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'
                ) AS subquery
                GROUP BY DATE_FORMAT(fecha_registro, '%Y-%m')
                ORDER BY fecha_registro ASC";

            }
        } else {
            // Consulta para obtener los datos de alumnos
            $consulta = "SELECT COUNT(*) AS total, DATE_FORMAT(fecha_registro, '%M %Y') AS mes_anio
                FROM (
                  SELECT fecha_registro
                  FROM alumnos_personal AS aper

                  UNION ALL 

                  SELECT fecha_registro
                  FROM alumnos_primaria AS apri
                  INNER JOIN escuelas AS es ON apri.id_escuela = es.id_escuela
                
                  UNION ALL
                
                  SELECT fecha_registro
                  FROM alumnos_secundaria AS ase
                  INNER JOIN escuelas AS es ON ase.id_escuela = es.id_escuela
                
                  UNION ALL
                
                  SELECT fecha_registro
                  FROM alumnos_preparatoria AS apre
                  INNER JOIN escuelas AS es ON apre.id_escuela = es.id_escuela
                
                  UNION ALL
                
                  SELECT fecha_registro
                  FROM alumnos_universidad AS au
                  INNER JOIN escuelas AS es ON au.id_escuela = es.id_escuela
                ) AS subquery
                GROUP BY DATE_FORMAT(fecha_registro, '%Y-%m')
                ORDER BY fecha_registro ASC";
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
            $fecha = strtotime($dato['mes_anio']);
            $mes = date('Y-m', $fecha);
            $monto = floatval($dato['total']);
        
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
            $nombreMes = date('F Y', strtotime($mes));
            $datosGrafica[] = array(
                'label' => $nombreMes,
                'data' => $ganancia
            );
        }
        echo json_encode($datosGrafica);
    }

