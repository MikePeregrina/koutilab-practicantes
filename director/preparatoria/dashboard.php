<?php
session_start();
$id_user = $_SESSION['id_director_preparatoria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_director_preparatoria'])) {
  header('location: ../../acciones/cerrarsesion.php');
}

include('../../acciones/conexion.php');

/*$conexion = new mysqli("localhost", "root", "", "aerobotp_beta");

// Verificar si hay errores en la conexión
if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}*/

//Información solo de director
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM directores_preparatoria a JOIN escuelas e ON a.id_escuela = e.id_escuela WHERE id_director = $id_user"));

//Información para director - escuela
$user_escuela = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT e.* FROM directores_preparatoria a
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

    $consulta = "SELECT SUM(payment_amount * 0.1) as total, DATE_FORMAT(create_at,'%M %Y') as mes from payment_preparatoria as pp INNER JOIN alumnos_preparatoria as ap ON pp.id_alumno = ap.id_alumno INNER JOIN directores_preparatoria as dp ON ap.id_escuela = dp.id_escuela WHERE dp.id_director = '$id_user' AND create_at BETWEEN '$fechaInicio' and '$fechaFin' GROUP BY(mes) ORDER BY (mes)DESC";
  }
} else {

  // Consulta para obtener los datos de ganancias
  $consulta = "SELECT SUM(payment_amount * 0.1) as total, DATE_FORMAT(create_at,'%M %Y') as mes from payment_preparatoria as pp INNER JOIN alumnos_preparatoria as ap ON pp.id_alumno = ap.id_alumno INNER JOIN directores_preparatoria as dp ON ap.id_escuela = dp.id_escuela WHERE dp.id_director = '$id_user' GROUP BY(mes) ORDER BY (mes)DESC";
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
<?php
function actualizarGrafica()
{
  $id_user = $_POST['id_user'];
  $fechaInicio = $_POST['fechaInicio'];
  $fechaFin = $_POST['fechaFin'];

  /* PARA LOS DATOS DE LA GRÁFICA */

  include('../../acciones/conexion.php');


  // Verificar si hay errores en la conexión
  if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
  }

  // Consulta para obtener los datos de ganancias
  $consulta = "SELECT SUM(payment_amount * 0.1) as total, DATE_FORMAT(create_at,'%M %Y') as mes from payment_preparatoria as pp INNER JOIN alumnos_preparatoria as ap ON pp.id_alumno = ap.id_alumno INNER JOIN directores_preparatoria as dp ON ap.id_escuela = dp.id_escuela WHERE dp.id_director = '$id_user' AND create_at BETWEEN '.$fechaInicio.' and '.$fechaFin.' GROUP BY(mes) ORDER BY (mes)DESC";
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
}
?>

<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/nav-barra.css">
<link rel="stylesheet" href="css/dashboard.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script> <!--Libreria de javaScript para consultas dinámicas-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<title>KOUTILAB</title>
</head>

<body>

  <!-- Header nav -->
  <?php include 'header-nav.php'; ?>

  <div class="containers">
    <h1>DASHBOARD</h1>
  </div>
  <?php
  $id = $user["id_director"];
  $name = $user["nombre"];
  $image = $user["image"];
  ?>
  <section>
    <div class="left-content">
      <div class="titlec">
        <h2>Usuario</h2>
      </div>
      <br>

      <div class="perfil-usuario-avatar">
        <div class="avatar-img">
          <img src="acciones/img/<?php echo $image; ?>" id="imgchange1">
        </div>

        <div class="camera-icon">
          <form class="form" id="btn-abrir-modalFP" enctype="multipart/form-data" method="">
            <i class="fa fa-camera" style="color: rgba(0,201,255,2556); font-size:25px;"></i>
          </form>
        </div>
      </div>

      <hr style="background-color: lightgray; width:60%; height:2px; margin-left:20%; margin-top:4%">

      <div class="container-info">
        <?php
        $data2 = mysqli_query($conexion, "SELECT * FROM directores_preparatoria d INNER JOIN escuelas e WHERE d.id_escuela = e.id_escuela AND id_director = '$id_user'");
        while ($consulta = mysqli_fetch_array($data2)) {
          echo "  <h3 class='info-heading'>Nombre: <span>" . $consulta['nombre'] . "</h3>";
          echo "  <h3 class='info-heading'>Usuario: <span>" . $consulta['usuario'] . "</h3>";
          echo "  <h3 class='info-heading'>Escuela: <span>" . $consulta['nombre_escuela'] . "</h3>";
          echo "  <h3 class='info-heading'>CCT: <span>" . $consulta['nombre'] . "</h3>";
        }
        ?>
      </div>

    </div>

    <div class="right-content">
      <div class="titlec">
        <h2>Datos de compras</h2>
      </div>

      <div id="graficaContainer">
        <canvas id="grafica"></canvas>
      </div>

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
                label: 'Ganancias',
                data: datos,
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
      <div align="center">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <h4>Filtro </h4><br>
          <label for="fechaInicio" style="font-size: 13px; font-weight:bold;">De: </label>
          <input type="date" name="fechaInicio" id="fechaInicio" value="<?php echo $fechaInicio; ?>" style="margin-right: 50px; border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
          <label for="fechaFin" style="font-size: 13px; font-weight:bold;">A: </label>
          <input type="date" name="fechaFin" id="fechaFin" value="<?php echo $fechaFin; ?>" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
          <input type="hidden" name="id_user" name="id_user" value="<?php echo $id_user; ?>">
          <br><br>
          <input name="submitFecha" type="submit" value="Filtrar" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); font-weight: bold; font-size: 15px">
        </form>
      </div>
  </section>

  <script>
    /*
    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, "rgba(203,12,159,0.2)");
    gradientStroke1.addColorStop(0.2, "rgba(72,72,176,0.0)");
    gradientStroke1.addColorStop(0, "rgba(203,12,159,0)"); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, "rgba(20,23,39,0.2)");
    gradientStroke2.addColorStop(0.2, "rgba(72,72,176,0.0)");
    gradientStroke2.addColorStop(0, "rgba(20,23,39,0)"); //purple colors

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: self.dashboard.meses.map((m) => m.mes),
        datasets: [{
            label: "Ventas",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#cb0c9f",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            fill: true,
            data: [100,250,150,120,200],//self.dashboard.meses.map((m) => m.total),
            maxBarThickness: 6,
          },
          {
            label: "Compras",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#5a8fc0",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            fill: true,
            data: ["Enero","Febrero","Marzo","Abril","Mayo"],//self.dashboard.meses2.map((m) => m.total),
            maxBarThickness: 6,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          },
        },
        interaction: {
          intersect: false,
          mode: "index",
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
            },
            ticks: {
              display: true,
              padding: 10,
              color: "#b2b9bf",
              font: {
                size: 11,
                family: "Open Sans",
                style: "normal",
                lineHeight: 2,
              },
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5],
            },
            ticks: {
              display: true,
              color: "#b2b9bf",
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: "normal",
                lineHeight: 2,
              },
            },
          },
        },
      },
    });
  */
  </script>
  <dialog close id="modalFP" style="border: none; border-radius: 10px; margin-top: 80px; margin-left: 370px; background: url(img/bg1.png); text-align: center;">
    <button style="float: right; background-color: rgba(132, 196, 44, 0.6); padding-left: 7px; padding-right: 7px; padding-top: 6px; padding-bottom: 5px; scale: 110%; border-radius: 50%; outline: none; border: 0px; margin: 10px 10px;" id="btn-cerrar-modalFP"><i class="fas fa-close"></i></button><br>
    <div style="color:darkslategray; width: 500px; height: 40px; margin: 10px 30px 10px 30px; box-shadow: 0 0 12px rgba(61,172,244,.6); border-radius: 10px; background: rgba(255,255,255, .8);">
      <h4 style="display: block; width: 100%; font-size: 1.75em; margin-bottom: 0.5rem; text-align: center;">Selecciona una imagen</h4>
    </div>
    <div class="portada" style="width: 500px; height: 300px; margin: 0px 30px 30px 30px; box-shadow: 0 0 12px rgba(61,172,244,.6); border-radius: 10px; background: rgba(255,255,255, .8); overflow-y: scroll; display: flex; justify-content: space-between;">
      <div class="upload-img">
        <form id="cambiaravatar" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="hidden" name="name" value="<?php echo $name; ?>">
          <input type="file" name="image" id="image" style="margin-left: 20%;">
          <button type="submit" style="width: 150px; margin-left: 27px; border: none; background-color: #85c32e; color:white; font-size: 15px;" id="cambiarFoto" name="cambiarFoto">Actualizar Foto</button>
        </form>
      </div>
    </div>
  </dialog>

  <!-- Cambiar foto de perfil -->
  <script type="text/javascript">
    document.getElementById("image").onchange = function() {
      document.getElementById("form").submit();
    };
  </script>
  <?php
  if (isset($_FILES["image"]["name"])) { /*Si el archivo existe */
    $id = $_POST["id"];
    $name = $_POST["name"];

    $imageName = $_FILES["image"]["name"]; //Nombre de la imagen
    $imageSize = $_FILES["image"]["size"]; //Tamaño de la imagen
    $tmpName = $_FILES["image"]["tmp_name"]; //Nombre temporal

    // Validación de la imagen
    $validImageExtension = ['jpg', 'jpeg', 'png', 'avif', 'webp']; //Extensiones válidas
    $imageExtension = explode('.', $imageName); //array - nombre de imagen
    $imageExtension = strtolower(end($imageExtension)); //conversión a minúsculas para validación
    if (!in_array($imageExtension, $validImageExtension)) {
      echo
      "
        <script>
        Swal.fire({
            title: '¡Advertencia!',
            text: 'Extensión de imagen inválida.',
            icon: 'info',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Reintentar',
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'dashboard.php';
            }
          });
        </script>
        ";
    } else if ($imageSize > 1200000) { //Si la imagen supera 1.2Mb
      echo
      "
        <script>
        Swal.fire({
            title: '¡Advertencia!',
            text: 'Tamaño de imagen demasiado largo.',
            icon: 'info',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Reintentar',
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'dashboard.php';
            }
          });
          
        </script>
        ";
    } else { //Si se cumplen las condiciones
      $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generando nuevo nombre de imagen
      $newImageName .= '.' . $imageExtension; //agregando extensión
      $query = "UPDATE directores_preparatoria SET image = '$newImageName' WHERE id_director = $id"; //Actualizando imagen en BD
      mysqli_query($conexion, $query); //Ejecutando
      move_uploaded_file($tmpName, 'acciones/img/' . $newImageName); //añadiendo archivo al direcctorio indicado
      echo
      "
        <script>
        Swal.fire({
            title: '¡Excelente!',
            text: 'Cambio de avatar exitoso.',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'dashboard.php';
            }
          });
        </script>
        ";
    }
  }
  ?>
  <script>
    const btnAbrirModalFP = document.querySelector("#btn-abrir-modalFP");
    const btnCerrarModalFP = document.querySelector("#btn-cerrar-modalFP");
    const modalFP = document.querySelector("#modalFP");
    btnAbrirModalFP.addEventListener("click", () => {
      modalFP.showModal();
    })

    btnCerrarModalFP.addEventListener("click", () => {
      modalFP.close();
    })
  </script>

</body>

</html>