<?php
session_start();
$id_user = $_SESSION['id_director_licencia'];
if (empty($_SESSION['active']) || empty($_SESSION['id_director_licencia'])) {
    header('location: ../acciones/cerrarsesion.php');
}
include('../acciones/conexion.php');
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM directores d
JOIN escuelas e 
ON d.id_escuela = e.id_escuela
WHERE d.id_director = $id_user"));

// Obtener el ID de la escuela del director
$id_escuela = $user['id_escuela'];

//Información para director - escuela
$user_escuela = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT e.* FROM directores a
JOIN escuelas e 
ON a.id_escuela = e.id_escuela
WHERE a.id_director = $id_user"));


if (isset($_POST['submitFecha'])) {
    if (isset($_POST['fechaFin'])) {
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFin = $_POST['fechaFin'];
        $consulta = "SELECT COUNT(id_visita) as total, tipo, DATE_FORMAT(fecha_registro, '%M %Y') as mes 
                     FROM visitas 
                     WHERE id_escuela = '$id_escuela' AND fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'
                     GROUP BY mes, tipo 
                     ORDER BY mes DESC";
    }
} else {
    $consulta = "SELECT COUNT(id_visita) as total, tipo, DATE_FORMAT(fecha_registro, '%M %Y') as mes 
                 FROM visitas 
                 WHERE id_escuela = '$id_escuela'
                 GROUP BY mes, tipo 
                 ORDER BY mes DESC";
}



// Ejecutar la consulta
$resultado = $conexion->query($consulta);

// Crear un arreglo para almacenar los datos
$datos = array();

// Recorrer los resultados y almacenarlos en el arreglo
while ($fila = $resultado->fetch_assoc()) {
    $nombreMes = date('F Y', strtotime($fila['mes']));
    $tipo = $fila['tipo'];
    $total = intval($fila['total']);

    if (!isset($datosGrafica[$nombreMes])) {
        $datosGrafica[$nombreMes] = array(
            'label' => $nombreMes,
            'docente' => 0,
            'alumno' => 0,
        );
    }

    if ($tipo === 'docente') {
        $datosGrafica[$nombreMes]['docente'] += $total;
    } else {
        $datosGrafica[$nombreMes]['alumno'] += $total;
    }
}

$datosJSON = json_encode(array_values($datosGrafica));


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
        <h1>CONEXIONES DE ALUMNOS Y DOCENTES</h1>
    </div>

    <!-- <div class="studens-add-bar">
        <div class="left-student">
            <i class="fas fa-users"></i>
            <h2>Conexiones</h2>
        </div>
    </div> -->

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

            var datosDocentes = datosJSON.map(function(dato) {
                return dato.docente;
            });

            var datosAlumnos = datosJSON.map(function(dato) {
                return dato.alumno;
            });

            // Crear la instancia de la gráfica
            var grafica = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Conexiones de Docentes',
                        data: datosDocentes,
                        backgroundColor: 'rgba(255,99,132,0.2)',
                        borderColor: 'rgba(255,99,132,1)',
                        borderWidth: 1.5
                    }, {
                        label: 'Conexiones de Alumnos',
                        data: datosAlumnos,
                        backgroundColor: 'rgba(54,162,235,0.2)',
                        borderColor: 'rgba(54,162,235,1)',
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