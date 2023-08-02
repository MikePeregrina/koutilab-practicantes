<?php
session_start();
$id_user = $_SESSION['id_docente_primaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_docente_primaria'])) {
    header('location: ../acciones/cerrarsesion.php');
}
include('../acciones/conexion.php');
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM docentes_primaria d
JOIN escuelas e 
ON d.id_escuela = e.id_escuela
WHERE d.id_docente = $id_user"));

//Información para director - escuela
$user_escuela = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT e.* FROM directores_primaria a
JOIN escuelas e 
ON a.id_escuela = e.id_escuela
WHERE a.id_director = $id_user"));

/* PARA LOS DATOS DE LA GRÁFICA */
if (isset($_POST['submitFecha'])) {
    //echo "La fecha de inicio fue: " . $_POST['fechaInicio'];
    if (isset($_POST['fechaFin'])) {
        //echo "La fecha de Fin fue: " . $_POST['fechaFin'];
        //echo "El id de usuario es :" . $_POST['id_user'];
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFin = $_POST['fechaFin'];
        /*CONSULTA MODIFICADA */
        $consulta = "SELECT COUNT(co.id_conexion) as total, DATE_FORMAT(co.created_at,'%M %Y') as mes from conexiones as co INNER JOIN alumnos_primaria ap ON co.id_usuario = ap.id_alumno INNER JOIN docentes_primaria as dp ON ap.id_escuela = dp.id_escuela WHERE dp.id_docente = '$id_user' AND tipo = 'alumno_primaria' AND co.created_at BETWEEN '$fechaInicio' and '$fechaFin' GROUP BY(mes) ORDER BY (mes)DESC";
    }
} else {
    /*CONSULTA MODIFICADA */
    $consulta = "SELECT COUNT(co.id_conexion) as total, DATE_FORMAT(co.created_at,'%M %Y') as mes from conexiones as co INNER JOIN alumnos_primaria ap ON co.id_usuario = ap.id_alumno INNER JOIN docentes_primaria as dp ON ap.id_escuela = dp.id_escuela WHERE dp.id_docente = '$id_user' AND tipo = 'alumno_primaria' GROUP BY(mes) ORDER BY (mes)DESC";
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

<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/nav-barra.css">
<link rel="stylesheet" href="css/conexiones.css">
<link rel="stylesheet" href="css/footer.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<title>KOUTILAB</title>
</head>

<body>

    <!-- Header nav -->
    <?php include 'header-nav.php'; ?>

    <div class="containers">
        <h1>CONEXIONES DE ALUMNOS</h1>
    </div>

    <div class="studens-add-bar">
        <div class="left-student">
            <i class="fas fa-users"></i>
            <h2>Alumno(s)</h2>
        </div>
    </div>

    <section>
        <br><br>
        <div id="graficaContainer">
            <canvas id="grafica"></canvas>
        </div>
        <div align="center">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <h4>Filtro </h4><br>
                <label for="fechaInicio" style="font-size: 13px; font-weight:bold;">De: </label>
                <input type="date" name="fechaInicio" id="fechaInicio" value="<?php echo $fechaInicio; ?>" style="margin-right: 50px; border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                <label for="fechaFin" style="font-size: 13px; font-weight:bold;">A: </label>
                <input type="date" name="fechaFin" id="fechaFin" value="<?php echo $fechaFin; ?>" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                <input type="hidden" name="id_user" name="id_user" value="<?php echo $id_user; ?>">
                <br><br>
                <input name="submitFecha" type="submit" value="Filtrar" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); font-weight: bold; font-size: 15px; margin-bottom: 2%;">
            </form>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Código de inicialización de la gráfica
            console.log(<?php echo $datosJSON; ?>);
            // Obtener el elemento canvas
            var canvas = document.getElementById('grafica');

            // Obtener los datos JSON y procesarlos
            var datosJSON = JSON.parse('<?php echo $datosJSON; ?>');
            var labels = datosJSON.map(function(dato) {
                return dato.label;
            });
            var datos = datosJSON.map(function(dato) {
                return dato.data;
            });

            // Crear la instancia de la gráfica
            var grafica = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Conexiones',
                        data: datos,
                        //backgroundColor: 'rgba(54, 162, 235, 0.5)', // Cambia el color de fondo
                        //borderColor: 'rgba(54, 162, 235, 1)', // Cambia el color del borde
                        //borderWidth: 1, // Cambia el ancho del borde
                        backgroundColor: [
                            'rgba(255,99,132,0.2)',
                            'rgba(54,162,235,0.2)',
                            'rgba(255,206,86,0.2)',
                            'rgba(75,192,192,0.2)',
                            'rgba(255,159,64,0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54,162,235,1)',
                            'rgba(255,206,86,1)',
                            'rgba(75,192,192,1)',
                            'rgba(255,159,64,1)'
                        ],
                        borderWidth: 1.5
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>