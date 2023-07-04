<?php
    include('../../acciones/conexion.php');

    //$idProducto = $_GET['idProducto'];
    $fechaInicio = json_decode($_POST["fechaInicio"], true );
    $fechaFin = json_decode($_POST["fechaFin"], true );
    $id_user = json_decode($_POST["id_user"], true );
    $tipo = json_decode($_POST["tipo"], true );
    //////pruebaaaaaaaaaaaaaaaaa

    if($tipo == "instituciones"){
        if ($fechaInicio != null) {
            if ($fechaFin != null) {
                $consulta = "SELECT count(id_escuela) as total, DATE_FORMAT(created_at,'%M %Y') as mes from escuelas WHERE id_admin = '$id_user' AND nivel_educativo != 'Institucional' AND created_at BETWEEN '$fechaInicio' and '$fechaFin' GROUP BY(mes) ORDER BY (mes)DESC";
            }
        } else {
            // Consulta para obtener los datos de ganancias
            $consulta = "SELECT count(id_escuela) as total, DATE_FORMAT(created_at,'%M %Y') as mes from escuelas WHERE id_admin = '$id_user' AND nivel_educativo = 'Institucional' GROUP BY(mes) ORDER BY (mes)DESC";
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
        
        // Crear un arreglo para almacenar las ganancias por mes
        $gananciasPorMes = array();
        
        // Recorrer los datos y agrupar las ganancias por mes
        foreach ($datos as $dato) {
            $fecha = strtotime($dato['mes']);
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
        
        // Recorrer las ganancias por mes y generar los datos para la gráfica
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

    if($tipo == "escuelas"){
        if ($fechaInicio != null) {
            if ($fechaFin != null) {
                $consulta = "SELECT count(id_escuela) as total, DATE_FORMAT(created_at,'%M %Y') as mes from escuelas WHERE id_admin = '$id_user' AND nivel_educativo != 'Institucional' AND created_at BETWEEN '$fechaInicio' and '$fechaFin' GROUP BY(mes) ORDER BY (mes)DESC";
            }
        } else {
            // Consulta para obtener los datos de ganancias
            $consulta = "SELECT count(id_escuela) as total, DATE_FORMAT(created_at,'%M %Y') as mes from escuelas WHERE id_admin = '$id_user' AND nivel_educativo != 'Institucional' GROUP BY(mes) ORDER BY (mes)DESC";
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
        
        // Crear un arreglo para almacenar las ganancias por mes
        $gananciasPorMes = array();
        
        // Recorrer los datos y agrupar las ganancias por mes
        foreach ($datos as $dato) {
            $fecha = strtotime($dato['mes']);
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
        
        // Recorrer las ganancias por mes y generar los datos para la gráfica
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

    if($tipo == "alumnos"){
        if ($fechaInicio != null) {
            if ($fechaFin != null) {
                $consulta = "SELECT count(id_alumno) as total, DATE_FORMAT(created_at,'%M %Y') as mes FROM alumnos_primaria AS apri INNER JOIN escuelas AS es ON apri.id_escuela = es.id_escuela UNION SELECT count(id_alumno) as total, DATE_FORMAT(created_at,'%M %Y') as mes FROM alumnos_secundaria AS ase INNER JOIN escuelas AS es ON ase.id_escuela = es.id_escuela UNION SELECT count(id_alumno) as total, DATE_FORMAT(created_at,'%M %Y') as mes FROM alumnos_preparatoria AS apre INNER JOIN escuelas AS es ON apre.id_escuela = es.id_escuela UNION SELECT count(id_alumno) as total, DATE_FORMAT(created_at,'%M %Y') as mes FROM alumnos_universidad AS au INNER JOIN escuelas AS es ON au.id_escuela = es.id_escuela WHERE id_admin = '$id_user' AND created_at BETWEEN '$fechaInicio' and '$fechaFin' GROUP BY(mes) ORDER BY (mes)DESC";

            }
        } else {
            // Consulta para obtener los datos de ganancias
            $consulta = "SELECT count(id_alumno) as total, DATE_FORMAT(created_at,'%M %Y') as mes FROM alumnos_primaria AS apri INNER JOIN escuelas AS es ON apri.id_escuela = es.id_escuela UNION SELECT count(id_alumno) as total, DATE_FORMAT(created_at,'%M %Y') as mes FROM alumnos_secundaria AS ase INNER JOIN escuelas AS es ON ase.id_escuela = es.id_escuela UNION SELECT count(id_alumno) as total, DATE_FORMAT(created_at,'%M %Y') as mes FROM alumnos_preparatoria AS apre INNER JOIN escuelas AS es ON apre.id_escuela = es.id_escuela UNION SELECT count(id_alumno) as total, DATE_FORMAT(created_at,'%M %Y') as mes FROM alumnos_universidad AS au INNER JOIN escuelas AS es ON au.id_escuela = es.id_escuela WHERE id_admin = '$id_user' GROUP BY(mes) ORDER BY (mes)DESC";
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
        
        // Crear un arreglo para almacenar las ganancias por mes
        $gananciasPorMes = array();
        
        // Recorrer los datos y agrupar las ganancias por mes
        foreach ($datos as $dato) {
            $fecha = strtotime($dato['mes']);
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
        
        // Recorrer las ganancias por mes y generar los datos para la gráfica
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
    
    
    // Convertir los datos a formato JSON
    //$datosJSON = json_encode($datosGrafica);
    
    //echo "Datos recuperados de la bd" . $datosJSON;
?>