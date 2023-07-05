<?php
session_start();
$id_user = $_SESSION['id_admin'];
if (empty($_SESSION['active']) || empty($_SESSION['id_admin'])) {
  header('location: ../acciones/cerrarsesion.php');
}
include('../acciones/conexion.php');
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM admin WHERE id_admin = $id_user"));

//Contar ingresos por escuelas
$sqlescuelas = "SELECT SUM(monto) AS total
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
) AS subquery";
$resultescuelas = mysqli_query($conexion, $sqlescuelas);
$filaescuelas = mysqli_fetch_assoc($resultescuelas);

//Contar ingresos por capsulas
$sqlcapsulas = "SELECT SUM(monto) AS total
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
) AS subquery";
$resultcapsulas = mysqli_query($conexion, $sqlcapsulas);
$filacapsulas = mysqli_fetch_assoc($resultcapsulas);

//Contar ingresos por cuentas personales
$sqlpersonales = "SELECT sum(payment_amount) as total from payment_personal";
$resultpersonales = mysqli_query($conexion, $sqlpersonales);
$filapersonales = mysqli_fetch_assoc($resultpersonales);

?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="img/lgk.png">
<link rel="stylesheet" href="css/nav-barra.css">
<link rel="stylesheet" href="css/ingresos.css">
<link rel="stylesheet" href="css/footer.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bulma.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>

<title>KOUTILAB</title>
</head>

<!-- Header nav -->
<?php include 'header-nav.php'; ?>

<div class="containers">
  <h1>Ingresos</h1>
</div>

<section>

  <div class="body">
    <div class="latd">
      <div class="tabla-ingr">
        <table id="" width="20%" class="table">
          <thead>
            <tr>
              <td><b>Escuela</b></td>
              <td><b>Tipo de escuela</b></td>
              <td><b>Ingresos del último mes</b></td>
              <td><b>Ingresos totales</b></td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Escuela 1</td>
              <td>Privada</td>
              <td>$6,000</td>
              <td>$10,000</td>
            </tr>
            <tr>
              <td>Escuela 2</td>
              <td>Pública</td>
              <td>$6,000</td>
              <td>$10,000</td>
            </tr>
            <tr>
              <td>Escuela 3</td>
              <td>Pública</td>
              <td>$6,000</td>
              <td>$10,000</td>
            </tr>
            <tr>
              <td>Escuela 4</td>
              <td>Pública</td>
              <td>$6,000</td>
              <td>$10,000</td>
            </tr>
            <tr>
              <td>Escuela 5</td>
              <td>Pública</td>
              <td>$6,000</td>
              <td>$10,000</td>
            </tr>
            <tr>
              <td>Escuela 6</td>
              <td>Pública</td>
              <td>$6,000</td>
              <td>$10,000</td>
            </tr>
            <tr>
              <td>Escuela 7</td>
              <td>Pública</td>
              <td>$6,000</td>
              <td>$10,000</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="grafica">
        <canvas id="G-IEscuelas" width="450" height="280"></canvas>
        <hr style="opacity: 10%;">
        <div class="info">
          <li><i class='fa-solid fa-school me-3'></i><b>Total de ingresos por escuelas: </b>$<?php echo $filaescuelas['total']; ?></li>
        </div>
        <div align="center" style="margin-top: 20px;">
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="fechaInicio" style="font-size: 13px; font-weight:bold;">De: </label>
            <input type="date" name="fechaInicio" id="fechaInicioIEscuelas" value="<?php echo $fechaInicio; ?>" style="margin-right: 50px; border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
            <label for="fechaFin" style="font-size: 13px; font-weight:bold;">A: </label>
            <input type="date" name="fechaFin" id="fechaFinIEscuelas" value="<?php echo $fechaFin; ?>" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
            <input type="hidden" name="id_user" name="id_user" value="<?php echo $id_user; ?>">
            <br><br>
            <input onclick="filtrarGIEscuelas()" name="submitFecha" type="button" value="Filtrar" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); font-weight: bold; font-size: 15px; margin-bottom:0; padding-bottom: 0">
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="body" style="margin-top: -20px;">
    <div class="latd">
      <div class="tabla-ingr">
        <table id="" width="20%" class="table">
          <thead>
            <tr>
              <td><b>Usuario</b></td>
              <td><b>Cápsula a desbloquear</b></td>
              <td><b>Costo</b></td>
              <td><b>Total gastado por el usuario</b></td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Usuario 1</td>
              <td>Cápsula 1</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
            <tr>
              <td>Usuario 2</td>
              <td>Cápsula 2</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
            <tr>
              <td>Usuario 3</td>
              <td>Cápsula 3</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
            <tr>
              <td>Usuario 4</td>
              <td>Cápsula 4</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
            <tr>
              <td>Usuario 5</td>
              <td>Cápsula 5</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
            <tr>
              <td>Usuario 6</td>
              <td>Cápsula 6</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
            <tr>
              <td>Usuario 7</td>
              <td>Cápsula 7</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="grafica">
        <canvas id="G-ICapsulas" width="450" height="280"></canvas>
        <hr style="opacity: 10%;">
        <div class="info">
          <li><i class='fa-solid fa-school me-3'></i><b>Total de ingresos por cápsulas: </b>$<?php echo $filacapsulas['total']; ?></li>
        </div>
        <div align="center" style="margin-top: 20px;">
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="fechaInicio" style="font-size: 13px; font-weight:bold;">De: </label>
            <input type="date" name="fechaInicio" id="fechaInicioICapsulas" value="<?php echo $fechaInicio; ?>" style="margin-right: 50px; border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
            <label for="fechaFin" style="font-size: 13px; font-weight:bold;">A: </label>
            <input type="date" name="fechaFin" id="fechaFinICapsulas" value="<?php echo $fechaFin; ?>" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
            <input type="hidden" name="id_user" name="id_user" value="<?php echo $id_user; ?>">
            <br><br>
            <input onclick="filtrarGICapsulas()" name="submitFecha" type="button" value="Filtrar" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); font-weight: bold; font-size: 15px; margin-bottom:0; padding-bottom: 0">
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="body" style="margin-top: -20px;">
    <div class="latd">
      <div class="tabla-ingr">
        <table id="" width="20%" class="table">
          <thead>
            <tr>
              <td><b>Usuario</b></td>
              <td><b>Paquete comprado</b></td>
              <td><b>Costo</b></td>
              <td><b>Total gastado por el usuario</b></td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Usuario 1</td>
              <td>Paquete 1</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
            <tr>
              <td>Usuario 2</td>
              <td>Paquete 2</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
            <tr>
              <td>Usuario 3</td>
              <td>Paquete 3</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
            <tr>
              <td>Usuario 4</td>
              <td>Paquete 4</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
            <tr>
              <td>Usuario 5</td>
              <td>Paquete 5</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
            <tr>
              <td>Usuario 6</td>
              <td>Paquete 6</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
            <tr>
              <td>Usuario 7</td>
              <td>Paquete 7</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="grafica">
        <canvas id="G-Personales" width="450" height="280"></canvas>
        <hr style="opacity: 10%;">
        <div class="info">
          <li><i class='fa-solid fa-school me-3'></i><b>Total de ingresos por cuentas personales: </b>$<?php echo $filapersonales['total']; ?></li>
        </div>
        <div align="center" style="margin-top: 20px;">
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="fechaInicio" style="font-size: 13px; font-weight:bold;">De: </label>
            <input type="date" name="fechaInicio" id="fechaInicioPersonales" value="<?php echo $fechaInicio; ?>" style="margin-right: 50px; border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
            <label for="fechaFin" style="font-size: 13px; font-weight:bold;">A: </label>
            <input type="date" name="fechaFin" id="fechaFinPersonales" value="<?php echo $fechaFin; ?>" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
            <input type="hidden" name="id_user" name="id_user" value="<?php echo $id_user; ?>">
            <br><br>
            <input onclick="filtrarGPersonales()" name="submitFecha" type="button" value="Filtrar" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); font-weight: bold; font-size: 15px; margin-bottom:0; padding-bottom: 0">
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="body" style="margin-top: -20px;">
    <div class="latd">
      <div class="tabla-ingr">
        <table id="" width="20%" class="table">
          <thead>
            <tr>
              <td><b>Usuario</b></td>
              <td><b>Paquete comprado</b></td>
              <td><b>Costo</b></td>
              <td><b>Total gastado por el usuario</b></td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Usuario 1</td>
              <td>Paquete 1</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
            <tr>
              <td>Usuario 2</td>
              <td>Paquete 2</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
            <tr>
              <td>Usuario 3</td>
              <td>Paquete 3</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
            <tr>
              <td>Usuario 4</td>
              <td>Paquete 4</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
            <tr>
              <td>Usuario 5</td>
              <td>Paquete 5</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
            <tr>
              <td>Usuario 6</td>
              <td>Paquete 6</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
            <tr>
              <td>Usuario 7</td>
              <td>Paquete 7</td>
              <td>$30</td>
              <td>$100</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="grafica">
        <canvas id="myChart7" width="450" height="280"></canvas>
        <hr style="opacity: 10%;">
        <div class="info">
          <li><i class='fa-solid fa-school me-3'></i><b>Total de ingresos por cuentas familiares: </b>$49,600</li>
        </div>
      </div>
    </div>
  </div>
</section>


<?php include 'footer.php'; ?>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  var ctx = document.getElementById('myChart7');
  var myChart7 = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'junio'],
      datasets: [{
        label: 'Ingresos por cuentas familiares',
        data: [5, 8, 4, 3, 5, 2],
        backgroundColor: [
          'rgba(61,172,244,.6)'
        ],
        borderColor: [
          'rgba(61,172,244,.6)'
        ],
        borderWidth: 1.5
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
</script>

<script>
  function disableIE() {
    if (document.all) {
      return false;
    }
  }

  function disableNS(e) {
    if (document.layers || (document.getElementById && !document.all)) {
      if (e.which == 2 || e.which == 3) {
        return false;
      }
    }
  }
  if (document.layers) {
    document.captureEvents(Event.MOUSEDOWN);
    document.onmousedown = disableNS;
  } else {
    document.onmouseup = disableNS;
    document.oncontextmenu = disableIE;
  }
  document.oncontextmenu = new Function("return false");
</script>
<script>
  onkeydown = e => {
    let tecla = e.which || e.keyCode;

    // Evaluar si se ha presionado la tecla Ctrl:
    if (e.ctrlKey) {
      // Evitar el comportamiento por defecto del nevagador:
      e.preventDefault();
      e.stopPropagation();

      // Mostrar el resultado de la combinación de las teclas:
      if (tecla === 85)
        console.log("Ha presionado las teclas Ctrl + U");

      if (tecla === 83)
        console.log("Ha presionado las teclas Ctrl + S");
    }
  }
</script>
<script>
  $(document).ready(function() {
    var table = $('#').DataTable({
      lengthChange: false,
      searching: true,
      paging: false,
      ordering: false,
      info: false,
      buttons: [{
        extend: 'pdf',
        split: ['excel', 'print'],
      }],
    });


    table.buttons().container().appendTo($('div.column.is-half', table.table().container()).eq(0));
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.min.js" integrity="sha512-v3ygConQmvH0QehvQa6gSvTE2VdBZ6wkLOlmK7Mcy2mZ0ZF9saNbbk19QeaoTHdWIEiTlWmrwAL4hS8ElnGFbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    filtrarGIEscuelas();
    filtrarGICapsulas();
    filtrarGPersonales();
    
  });

  let graficaIEscuelas;
  let graficaICapsulas;
  let graficaPersonales;

  function filtrarGIEscuelas() {
    //here
    var fechaInicio = document.getElementById('fechaInicioIEscuelas').value;
    var fechaFin = document.getElementById('fechaFinIEscuelas').value;
    var id_user = <?php echo $id_user; ?>;
    var tipo = "ingresoEscuelas";
    console.log(fechaInicio);
    console.log(fechaFin);
    console.log(id_user);
    console.log(tipo);

    var fechaInicio_json = JSON.stringify(fechaInicio);
    console.log(fechaInicio_json);

    var fechaFin_json = JSON.stringify(fechaFin);
    console.log(fechaFin_json);

    var tipo_json = JSON.stringify(tipo);
    console.log(tipo_json);

    $.post("graficas/consultaGrafica.php", {
      fechaInicio: fechaInicio_json,
      fechaFin: fechaFin_json,
      id_user: id_user,
      tipo: tipo_json
    }, function(data) {
      //alert(data); //COMENTADO TEMPORALMENTEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
      var arregloConvertido = JSON.parse(data);

      mostrarGIEscuelas(data);

    });

  }

  function mostrarGIEscuelas(data) {
    console.log(data);
    // Obtener el elemento canvas
    var canvas = document.getElementById('G-IEscuelas');

    // Obtener los datos JSON y procesarlos
    var datosJSON = JSON.parse(data);
    console.log(datosJSON);
    var labels = datosJSON.map(function(dato) {
      return dato.label;
      console.log(dato.label);
    });
    var datos = datosJSON.map(function(dato) {
      return dato.data;
      console.log(dato.data);
    });

    // Crear la instancia de la gráfica
    if (graficaIEscuelas) {
      graficaIEscuelas.destroy();
    }
    graficaIEscuelas = new Chart(canvas, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Ingresos De Escuelas',
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
  }

  function filtrarGICapsulas() {
    //here
    var fechaInicio = document.getElementById('fechaInicioICapsulas').value;
    var fechaFin = document.getElementById('fechaFinICapsulas').value;
    var id_user = <?php echo $id_user; ?>;
    var tipo = "ingresoCapsulas";
    console.log(fechaInicio);
    console.log(fechaFin);
    console.log(id_user);
    console.log(tipo);

    var fechaInicio_json = JSON.stringify(fechaInicio);
    console.log(fechaInicio_json);

    var fechaFin_json = JSON.stringify(fechaFin);
    console.log(fechaFin_json);

    var tipo_json = JSON.stringify(tipo);
    console.log(tipo_json);

    $.post("graficas/consultaGrafica.php", {
      fechaInicio: fechaInicio_json,
      fechaFin: fechaFin_json,
      id_user: id_user,
      tipo: tipo_json
    }, function(data) {
      //alert(data); //COMENTADO TEMPORALMENTEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
      var arregloConvertido = JSON.parse(data);

      mostrarGICapsulas(data);

    });

  }

  function mostrarGICapsulas(data) {
    console.log(data);
    // Obtener el elemento canvas
    var canvas = document.getElementById('G-ICapsulas');

    // Obtener los datos JSON y procesarlos
    var datosJSON = JSON.parse(data);
    console.log(datosJSON);
    var labels = datosJSON.map(function(dato) {
      return dato.label;
      console.log(dato.label);
    });
    var datos = datosJSON.map(function(dato) {
      return dato.data;
      console.log(dato.data);
    });

    // Crear la instancia de la gráfica
    if (graficaICapsulas) {
      graficaICapsulas.destroy();
    }
    graficaICapsulas = new Chart(canvas, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Ingresos De Capsulas',
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
  }

  function filtrarGPersonales() {
    //here
    var fechaInicio = document.getElementById('fechaInicioPersonales').value;
    var fechaFin = document.getElementById('fechaFinPersonales').value;
    var id_user = <?php echo $id_user; ?>;
    var tipo = "ingresoCPersonales";
    console.log(fechaInicio);
    console.log(fechaFin);
    console.log(id_user);
    console.log(tipo);

    var fechaInicio_json = JSON.stringify(fechaInicio);
    console.log(fechaInicio_json);

    var fechaFin_json = JSON.stringify(fechaFin);
    console.log(fechaFin_json);

    var tipo_json = JSON.stringify(tipo);
    console.log(tipo_json);

    $.post("graficas/consultaGrafica.php", {
      fechaInicio: fechaInicio_json,
      fechaFin: fechaFin_json,
      id_user: id_user,
      tipo: tipo_json
    }, function(data) {
      //alert(data); //COMENTADO TEMPORALMENTEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
      var arregloConvertido = JSON.parse(data);

      mostrarGPersonales(data);

    });

  }

  function mostrarGPersonales(data) {
    console.log(data);
    // Obtener el elemento canvas
    var canvas = document.getElementById('G-Personales');

    // Obtener los datos JSON y procesarlos
    var datosJSON = JSON.parse(data);
    console.log(datosJSON);
    var labels = datosJSON.map(function(dato) {
      return dato.label;
      console.log(dato.label);
    });
    var datos = datosJSON.map(function(dato) {
      return dato.data;
      console.log(dato.data);
    });

    // Crear la instancia de la gráfica
    if (graficaPersonales) {
      graficaPersonales.destroy();
    }
    graficaPersonales = new Chart(canvas, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Ingresos De Cuentas Personales',
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
  }
</script>

</body>

</html>