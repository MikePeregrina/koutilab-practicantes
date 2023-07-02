<?php
    include('../acciones/conexion.php');

    //$idProducto = $_GET['idProducto'];
    $fechaInicio = json_decode($_POST["fechaInicio"], true );
    $fechaFin = json_decode($_POST["fechaFin"], true );

    //echo $nombreProducto;
    $datosGrafica=array();
    /*while ($nombreProducto as $clave => $valor)*/
    //$producto = array();
    $sql = "SELECT * FROM precio as pre INNER JOIN producto AS pro ON pre.idProducto = pro.idProducto WHERE nombreProducto = '".$nombreProducto."'";

    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_object($result)){
        
        $datosGrafica = array('idProducto'=>"$row->idProducto",'nombreProducto'=>"$row->nombreProducto",'descripcion'=>"$row->descripcion",'costo'=>"$row->costo", 'existencia'=>$row->existencia);
    }

    //return $producto;
    echo json_encode($datosGrafica);


    //////pruebaaaaaaaaaaaaaaaaa
    if (isset($_POST['submitFecha'])) {
        //echo "La fecha de inicio fue: " . $_POST['fechaInicio'];
        if (isset($_POST['fechaFin'])) {
            //echo "La fecha de Fin fue: " . $_POST['fechaFin'];
            //echo "El id de usuario es :" . $_POST['id_user'];
            $fechaInicio = $_POST['fechaInicio'];
            $fechaFin = $_POST['fechaFin'];
    
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
    
    // Convertir los datos a formato JSON
    $datosJSON = json_encode($datosGrafica);
    //echo "Datos recuperados de la bd" . $datosJSON;
?>