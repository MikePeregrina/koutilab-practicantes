<?php
    include('../../acciones/conexion.php');

    $fechaInicio = json_decode($_POST["fechaInicio"], true );
    $fechaFin = json_decode($_POST["fechaFin"], true );
    $id_user = json_decode($_POST["id_user"], true ); //id del admin
    $tipo = json_decode($_POST["tipo"], true ); //Define cuál consulta se realizará

    if($tipo == "instituciones"){
        if ($fechaInicio != null) {
            if ($fechaFin != null) {
                $consulta = "SELECT count(id_escuela) as total, DATE_FORMAT(created_at,'%M %Y') as mes from escuelas WHERE nivel_educativo != 'Institucional' AND created_at BETWEEN '$fechaInicio' and '$fechaFin' GROUP BY(mes) ORDER BY (created_at)ASC";
            }
        } else {
            // Consulta para obtener los datos de instituciones
            $consulta = "SELECT count(id_escuela) as total, DATE_FORMAT(created_at,'%M %Y') as mes from escuelas WHERE nivel_educativo = 'Institucional' GROUP BY(mes) ORDER BY (created_at)ASC";
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
        
        // Crear un arreglo para almacenar instituciones por mes
        $gananciasPorMes = array();
        
        // Recorrer los datos y agrupar instituciones por mes
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
        
        // Recorrer instituciones por mes y generar los datos para la gráfica
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
                $consulta = "SELECT count(id_escuela) as total, DATE_FORMAT(created_at,'%M %Y') as mes from escuelas WHERE nivel_educativo != 'Institucional' AND created_at BETWEEN '$fechaInicio' and '$fechaFin' GROUP BY(mes) ORDER BY (created_at)ASC";
            }
        } else {
            // Consulta para obtener los datos de escuelas
            $consulta = "SELECT count(id_escuela) as total, DATE_FORMAT(created_at,'%M %Y') as mes from escuelas WHERE nivel_educativo != 'Institucional' GROUP BY(mes) ORDER BY (created_at)ASC";
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
        
        // Crear un arreglo para almacenar las escuelas por mes
        $gananciasPorMes = array();
        
        // Recorrer los datos y agrupar las escuelas por mes
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
        
        // Recorrer las escuelas por mes y generar los datos para la gráfica
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
                $consulta = "SELECT COUNT(*) AS total, DATE_FORMAT(fecha_registro, '%M %Y') AS mes_anio
                FROM (
                  SELECT fecha_registro
                  FROM alumnos_personal AS aper
                  WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'

                  UNION ALL

                  SELECT fecha_registro
                  FROM alumnos_primaria AS apri
                  INNER JOIN escuelas AS es ON apri.id_escuela = es.id_escuela
                  WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'
                
                  UNION ALL
                
                  SELECT fecha_registro
                  FROM alumnos_secundaria AS ase
                  INNER JOIN escuelas AS es ON ase.id_escuela = es.id_escuela
                  WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'
                
                  UNION ALL
                
                  SELECT fecha_registro
                  FROM alumnos_preparatoria AS apre
                  INNER JOIN escuelas AS es ON apre.id_escuela = es.id_escuela
                  WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'
                
                  UNION ALL
                
                  SELECT fecha_registro
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
    
    if($tipo == "profesores"){
        if ($fechaInicio != null) {
            if ($fechaFin != null) {
                $consulta = "SELECT COUNT(*) AS total, DATE_FORMAT(fecha_registro, '%M %Y') AS mes_anio
                FROM (
                  SELECT fecha_registro
                  FROM docentes_personal AS aper
                  WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'

                  UNION ALL

                  SELECT fecha_registro
                  FROM docentes_primaria AS apri
                  INNER JOIN escuelas AS es ON apri.id_escuela = es.id_escuela
                  WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'
                
                  UNION ALL
                
                  SELECT fecha_registro
                  FROM docentes_secundaria AS ase
                  INNER JOIN escuelas AS es ON ase.id_escuela = es.id_escuela
                  WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'
                
                  UNION ALL
                
                  SELECT fecha_registro
                  FROM docentes_preparatoria AS apre
                  INNER JOIN escuelas AS es ON apre.id_escuela = es.id_escuela
                  WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'
                
                  UNION ALL
                
                  SELECT fecha_registro
                  FROM docentes_universidad AS au
                  INNER JOIN escuelas AS es ON au.id_escuela = es.id_escuela
                  WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'
                ) AS subquery
                GROUP BY DATE_FORMAT(fecha_registro, '%Y-%m')
                ORDER BY fecha_registro ASC";

            }
        } else {
            // Consulta para obtener los datos de docentes
            $consulta = "SELECT COUNT(*) AS total, DATE_FORMAT(fecha_registro, '%M %Y') AS mes_anio
                FROM (
                  SELECT fecha_registro
                  FROM docentes_personal AS aper

                  UNION ALL

                  SELECT fecha_registro
                  FROM docentes_primaria AS apri
                  INNER JOIN escuelas AS es ON apri.id_escuela = es.id_escuela
                
                  UNION ALL
                
                  SELECT fecha_registro
                  FROM docentes_secundaria AS ase
                  INNER JOIN escuelas AS es ON ase.id_escuela = es.id_escuela
                
                  UNION ALL
                
                  SELECT fecha_registro
                  FROM docentes_preparatoria AS apre
                  INNER JOIN escuelas AS es ON apre.id_escuela = es.id_escuela
                
                  UNION ALL
                
                  SELECT fecha_registro
                  FROM docentes_universidad AS au
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
        
        // Crear un arreglo para almacenar los docentes por mes
        $gananciasPorMes = array();
        
        // Recorrer los datos y agrupar los docentes por mes
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
        
        // Recorrer los docentes por mes y generar los datos para la gráfica
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

    if($tipo == "usuarios"){
        if ($fechaInicio != null) {
            if ($fechaFin != null) {
                $consulta = "SELECT count(id_admin) as total, DATE_FORMAT(fecha_registro,'%M %Y') as mes from admin WHERE fecha_registro BETWEEN '$fechaInicio' and '$fechaFin' GROUP BY(mes) ORDER BY (fecha_registro)ASC";

            }
        } else {
            // Consulta para obtener los datos de usuarios
            $consulta = "SELECT count(id_admin) as total, DATE_FORMAT(fecha_registro,'%M %Y') as mes from admin GROUP BY(mes) ORDER BY (fecha_registro)ASC";
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
        
        // Crear un arreglo para almacenar los usuarios por mes
        $gananciasPorMes = array();
        
        // Recorrer los datos y agrupar los usuarios por mes
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
        
        // Recorrer los usuarios por mes y generar los datos para la gráfica
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

    if($tipo == "visitas"){
        if ($fechaInicio != null) {
            if ($fechaFin != null) {
                $consulta = "SELECT COUNT(id_conexion) AS total, DATE_FORMAT(created_at, '%M %Y') AS mes_anio
                FROM conexiones
                WHERE created_at BETWEEN '$fechaInicio' AND '$fechaFin'
                GROUP BY DATE_FORMAT(created_at, '%Y-%m')
                ORDER BY created_at ASC";

            }
        } else {
            // Consulta para obtener los datos de visitas
            $consulta = "SELECT COUNT(id_conexion) AS total, DATE_FORMAT(created_at, '%M %Y') AS mes_anio
                FROM conexiones
                GROUP BY DATE_FORMAT(created_at, '%Y-%m')
                ORDER BY created_at ASC";
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
        
        // Crear un arreglo para almacenar las visitas por mes
        $gananciasPorMes = array();
        
        // Recorrer los datos y agrupar las visitas por mes
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
        
        // Recorrer las visitas por mes y generar los datos para la gráfica
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

    if($tipo == "APersonales"){
        if ($fechaInicio != null) {
            if ($fechaFin != null) {
                $consulta = "SELECT count(id_alumno) as total, DATE_FORMAT(fecha_registro,'%M %Y') as mes from alumnos_personal WHERE fecha_registro BETWEEN '$fechaInicio' and '$fechaFin' GROUP BY(mes) ORDER BY (fecha_registro)ASC";
            }
        } else {
            // Consulta para obtener los datos de instituciones
            $consulta = "SELECT count(id_alumno) as total, DATE_FORMAT(fecha_registro,'%M %Y') as mes from alumnos_personal GROUP BY(mes) ORDER BY (fecha_registro)ASC";
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
        
        // Crear un arreglo para almacenar las visitas por mes
        $gananciasPorMes = array();
        
        // Recorrer los datos y agrupar las visitas por mes
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
        
        // Recorrer las visitas por mes y generar los datos para la gráfica
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

    if($tipo == "ingresoEscuelas"){
        if ($fechaInicio != null) {
            if ($fechaFin != null) {
                $consulta = "SELECT SUM(monto) AS total, nombre_escuela
                FROM (
                  SELECT payment_amount AS monto, apri.id_alumno, nombre_escuela
                  FROM payment_primaria AS ppri
                  INNER JOIN alumnos_primaria AS apri ON ppri.id_alumno = apri.id_alumno
                  INNER JOIN escuelas esc ON apri.id_escuela = esc.id_escuela
                  WHERE create_at BETWEEN '$fechaInicio' AND '$fechaFin'

                  UNION ALL 

                  SELECT payment_amount AS monto, asec.id_alumno, nombre_escuela
                  FROM payment_secundaria AS psec
                  INNER JOIN alumnos_secundaria AS asec ON psec.id_alumno = asec.id_alumno
                  INNER JOIN escuelas esc ON asec.id_escuela = esc.id_escuela
                  WHERE create_at BETWEEN '$fechaInicio' AND '$fechaFin'

                  UNION ALL 

                  SELECT payment_amount AS monto, apre.id_alumno, nombre_escuela
                  FROM payment_preparatoria AS ppre
                  INNER JOIN alumnos_preparatoria AS apre ON ppre.id_alumno = apre.id_alumno
                  INNER JOIN escuelas esc ON apre.id_escuela = esc.id_escuela
                  WHERE create_at BETWEEN '$fechaInicio' AND '$fechaFin'
                
                  UNION ALL
                
                  SELECT payment_amount AS monto, auni.id_alumno, nombre_escuela
                  FROM payment_universidad AS puni
                  INNER JOIN alumnos_universidad AS auni ON puni.id_alumno = auni.id_alumno
                  INNER JOIN escuelas esc ON auni.id_escuela = esc.id_escuela
                  WHERE create_at BETWEEN '$fechaInicio' AND '$fechaFin'

                  UNION ALL

                  SELECT payment_amount AS monto, taco.id AS id_alumno, nombre_escuela
                  FROM payment_institucional AS pins
                  INNER JOIN temp_account AS taco ON pins.id = taco.id
                  INNER JOIN escuelas esc ON taco.id_escuela = esc.id_escuela
                  WHERE create_at BETWEEN '$fechaInicio' AND '$fechaFin'
                ) AS subquery
                GROUP BY nombre_escuela
                ORDER BY nombre_escuela ASC";

            }
        } else {
            // Consulta para obtener los datos de ingresos de escuelas
            $consulta = "SELECT SUM(monto) AS total, nombre_escuela
            FROM (
              SELECT payment_amount AS monto, apri.id_alumno, nombre_escuela
              FROM payment_primaria AS ppri
              INNER JOIN alumnos_primaria AS apri ON ppri.id_alumno = apri.id_alumno
              INNER JOIN escuelas esc ON apri.id_escuela = esc.id_escuela

              UNION ALL 

              SELECT payment_amount AS monto, asec.id_alumno, nombre_escuela
              FROM payment_secundaria AS psec
              INNER JOIN alumnos_secundaria AS asec ON psec.id_alumno = asec.id_alumno
              INNER JOIN escuelas esc ON asec.id_escuela = esc.id_escuela

              UNION ALL 

              SELECT payment_amount AS monto, apre.id_alumno, nombre_escuela
              FROM payment_preparatoria AS ppre
              INNER JOIN alumnos_preparatoria AS apre ON ppre.id_alumno = apre.id_alumno
              INNER JOIN escuelas esc ON apre.id_escuela = esc.id_escuela
            
              UNION ALL
            
              SELECT payment_amount AS monto, auni.id_alumno, nombre_escuela
              FROM payment_universidad AS puni
              INNER JOIN alumnos_universidad AS auni ON puni.id_alumno = auni.id_alumno
              INNER JOIN escuelas esc ON auni.id_escuela = esc.id_escuela

              UNION ALL
                    
              SELECT payment_amount AS monto, taco.id AS id_alumno, nombre_escuela
              FROM payment_institucional AS pins
              INNER JOIN temp_account AS taco ON pins.id = taco.id
              INNER JOIN escuelas esc ON taco.id_escuela = esc.id_escuela
            
            ) AS subquery
            GROUP BY nombre_escuela
            ORDER BY nombre_escuela ASC";
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
        
        // Crear un arreglo para almacenar los ingresos de escuelas por mes
        $gananciasPorMes = array();
        
        // Recorrer los datos y agrupar los ingresos de escuelas por mes
        foreach ($datos as $dato) {
            $mes = $dato['nombre_escuela'];
            $monto = floatval($dato['total']);
        
            if (isset($gananciasPorMes[$mes])) {
                $gananciasPorMes[$mes] += $monto;
            } else {
                $gananciasPorMes[$mes] = $monto;
            }
        }
        
        // Crear un arreglo para almacenar los datos de la gráfica
        $datosGrafica = array();
        
        // Recorrer los ingresos de escuelas por mes y generar los datos para la gráfica
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

    if($tipo == "ingresoCapsulas"){
        if ($fechaInicio != null) {
            if ($fechaFin != null) {
                $consulta = "SELECT SUM(monto) AS total, DATE_FORMAT(create_at, '%M %Y') AS mes_anio
                FROM (
                    SELECT payment_amount AS monto, create_at
                  FROM payment_primaria AS ppri
                  INNER JOIN capsulas_pago_primaria AS apri ON ppri.item_number = apri.id_capsula_pago
                  WHERE create_at BETWEEN '$fechaInicio' AND '$fechaFin'

                  UNION ALL

                  SELECT payment_amount AS monto, create_at
                  FROM payment_secundaria AS psec
                  INNER JOIN capsulas_pago_secundaria AS asec ON psec.item_number = asec.id_capsula_pago
                  WHERE create_at BETWEEN '$fechaInicio' AND '$fechaFin'
                
                  UNION ALL
                
                  SELECT payment_amount AS monto, create_at
                  FROM payment_preparatoria AS ppre
                  INNER JOIN capsulas_pago_preparatoria AS apre ON ppre.item_number = apre.id_capsula_pago
                  WHERE create_at BETWEEN '$fechaInicio' AND '$fechaFin'
                
                  UNION ALL
                
                  SELECT payment_amount AS monto, create_at
                  FROM payment_universidad AS puni
                  INNER JOIN capsulas_pago_universidad AS auni ON puni.item_number = auni.id_capsula_pago
                  WHERE create_at BETWEEN '$fechaInicio' AND '$fechaFin'
                ) AS subquery
                GROUP BY DATE_FORMAT(create_at, '%Y-%m')
                ORDER BY create_at ASC";

            }
        } else {
            // Consulta para obtener los datos de alumnos
            $consulta = "SELECT SUM(monto) AS total, DATE_FORMAT(create_at, '%M %Y') AS mes_anio
            FROM (
                SELECT payment_amount AS monto, create_at
              FROM payment_primaria AS ppri
              INNER JOIN capsulas_pago_primaria AS apri ON ppri.item_number = apri.id_capsula_pago

              UNION ALL

              SELECT payment_amount AS monto, create_at
              FROM payment_secundaria AS psec
              INNER JOIN capsulas_pago_secundaria AS asec ON psec.item_number = asec.id_capsula_pago
            
              UNION ALL
            
              SELECT payment_amount AS monto, create_at
              FROM payment_preparatoria AS ppre
              INNER JOIN capsulas_pago_preparatoria AS apre ON ppre.item_number = apre.id_capsula_pago
            
              UNION ALL
            
              SELECT payment_amount AS monto, create_at
              FROM payment_universidad AS puni
              INNER JOIN capsulas_pago_universidad AS auni ON puni.item_number = auni.id_capsula_pago
            ) AS subquery
            GROUP BY DATE_FORMAT(create_at, '%Y-%m')
            ORDER BY create_at ASC";
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

    if($tipo == "ingresoCPersonales"){
        if ($fechaInicio != null) {
            if ($fechaFin != null) {
                $consulta = "SELECT sum(payment_amount) as total, DATE_FORMAT(create_at,'%M %Y') as mes from payment_personal WHERE create_at BETWEEN '$fechaInicio' and '$fechaFin' GROUP BY(mes) ORDER BY (create_at)ASC";
            }
        } else {
            // Consulta para obtener los datos de payment_personal
            $consulta = "SELECT sum(payment_amount) as total, DATE_FORMAT(create_at,'%M %Y') as mes from payment_personal GROUP BY(mes) ORDER BY (create_at)ASC";
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
        
        // Crear un arreglo para almacenar las escuelas por mes
        $gananciasPorMes = array();
        
        // Recorrer los datos y agrupar las escuelas por mes
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
        
        // Recorrer las escuelas por mes y generar los datos para la gráfica
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

    if($tipo == "Cursos"){
        if ($fechaInicio != null) {
            if ($fechaFin != null) {

            }
        } else {
            // Consulta para obtener los datos de visitas
            $consulta = "SELECT SUM(total) as total, mes_anio FROM (SELECT conexiones AS total, nombre AS mes_anio
            FROM conexiones_curso_primaria
            UNION
            SELECT conexiones AS total, nombre AS mes_anio
            FROM conexiones_curso_secundaria
            UNION
            SELECT conexiones AS total, nombre AS mes_anio
            FROM conexiones_curso_preparatoria
            UNION
            SELECT conexiones AS total, nombre AS mes_anio
            FROM conexiones_curso_universidad)as subquery
           
            GROUP BY mes_anio
            ORDER BY mes_anio;";
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
        
        // Crear un arreglo para almacenar las visitas por mes
        $gananciasPorMes = array();
        
        // Recorrer los datos y agrupar las visitas por mes
        foreach ($datos as $dato) {
            $fecha = $dato['mes_anio'];
            $mes = $fecha;
            $monto = floatval($dato['total']);
        
            if (isset($gananciasPorMes[$mes])) {
                $gananciasPorMes[$mes] += $monto;
            } else {
                $gananciasPorMes[$mes] = $monto;
            }
        }
        
        // Crear un arreglo para almacenar los datos de la gráfica
        $datosGrafica = array();
        
        // Recorrer las visitas por mes y generar los datos para la gráfica
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