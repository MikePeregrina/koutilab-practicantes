<?php
session_start();
$id_user = $_SESSION['id_admin'];
if (empty($_SESSION['active']) || empty($_SESSION['id_admin'])) {
  header('location: ../acciones/cerrarsesion.php');
}
include('../acciones/conexion.php');
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM admin WHERE id_admin = $id_user"));

?>

<!DOCTYPE html>
<html lang="en">
<>
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
            <canvas id="myChart1" width="450" height="280"></canvas>
            <hr style="opacity: 10%;">
            <div class="info">
            <li><i class='fa-solid fa-school me-3'></i><b>Total de ingresos por escuelas: </b>$149,600</li>
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
            <canvas id="myChart" width="450" height="280"></canvas>
            <hr style="opacity: 10%;">
            <div class="info">
            <li><i class='fa-solid fa-school me-3'></i><b>Total de ingresos por cápsulas: </b>$49,600</li>
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
            <canvas id="myChart5" width="450" height="280"></canvas>
            <hr style="opacity: 10%;">
            <div class="info">
            <li><i class='fa-solid fa-school me-3'></i><b>Total de ingresos por cuentas personales: </b>$49,600</li>
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
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'junio'],
        datasets: [{
          label: 'Ingresos por cápsulas',
          data: [3, 5, 7, 6, 8, 7],
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
    var ctx = document.getElementById('myChart1');
    var myChart1 = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'junio'],
        datasets: [{
          label: 'Ingresos por escuelas',
          data: [20000, 25000, 20600, 27000, 28000, 29000],
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
    var ctx = document.getElementById('myChart5');
    var myChart5 = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'junio'],
        datasets: [{
          label: 'Ingresos por cuentas personales',
          data: [20, 60, 40, 30, 50, 20],
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

 
</body>
</html>