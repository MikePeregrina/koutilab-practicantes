<?php
session_start();
$id_user = $_SESSION['id_admin'];
if (empty($_SESSION['active']) || empty($_SESSION['id_admin'])) {
    header('location: ../acciones/cerrarsesion.php');
}
include('../acciones/conexion.php');
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM admin WHERE id_admin = $id_user"));

//Contar escuelas
$sqlescuelas = "SELECT COUNT(*) id_escuela FROM escuelas";
$resultescuelas = mysqli_query($conexion, $sqlescuelas);
$filaescuelas = mysqli_fetch_assoc($resultescuelas);


//Contar instituciones
$sqlinstituciones = "SELECT COUNT(*) id_escuela FROM escuelas";
$resultinsitituciones = mysqli_query($conexion, $sqlinstituciones);
$filainstituciones = mysqli_fetch_assoc($resultinsitituciones);

//Contar alumnos
$sqlalumnos = "SELECT COUNT(*) id_alumno FROM alumnos_primaria";
$resultalumnos = mysqli_query($conexion, $sqlalumnos);
$filaalumnos = mysqli_fetch_assoc($resultalumnos);

//Contar docentes
$sqldocentes = "SELECT COUNT(*) id_docente FROM docentes_primaria";
$resultdocentes = mysqli_query($conexion, $sqldocentes);
$filadocentes = mysqli_fetch_assoc($resultdocentes);

//Contar usuarios
$sqlusuarios = "SELECT COUNT(*) id_admin FROM admin";
$resultusuarios = mysqli_query($conexion, $sqlusuarios);
$filausuarios = mysqli_fetch_assoc($resultusuarios);

?>

<!DOCTYPE html>
<html lang="en">
<>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="img/lgk.png">
  <link rel="stylesheet" href="css/nav-barra.css">
  <link rel="stylesheet" href="css/estadisticas.css">
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
    <h1>Estadisticas</h1>  
  </div>

 


  <section>
    <div class="body">
        <div class="latd">
            <div class="grafica">
                <canvas id="G-Instituciones" width="450" height="280"></canvas>
                <hr style="opacity: 10%;">
                <div class="info">
                    <li><i class="fas fa-money-check-alt me-3"></i><b>Total de instituciones: </b><?php echo $filainstituciones['id_escuela']; ?></li>
                </div>
            </div>
        </div>

        <div class="latd1">
            <div class="grafica">
                <canvas id="G-Escuelas" width="450" height="280"></canvas>
                <hr style="opacity: 10%;">
                <div class="info">
                    <li><i class='fa-solid fa-school me-3'></i><b>Total de escuelas: </b><?php echo $filaescuelas['id_escuela']; ?></li>
                </div>
            </div>
        </div>
    </div>

    <div class="body" style="margin-top: -20px;">
        <div class="latd">
            <div class="grafica">
                <canvas id="G-Alumnos" width="450" height="280"></canvas>
                <hr style="opacity: 10%;">
                <div class="info">
                    <li><i class='fa-solid fa-school me-3'></i><b>Total de alumnos: </b><?php echo $filaalumnos['id_alumno']; ?></li>
                </div>
            </div>
        </div>

        <div class="latd1">
            <div class="grafica">
                <canvas id="G-Profesores" width="450" height="280"></canvas>
                <hr style="opacity: 10%;">
                <div class="info">
                    <li><i class='fa-solid fa-school me-3'></i><b>Total de profesores: </b><?php echo $filadocentes['id_docente']; ?></li>
                </div>
            </div>
        </div>
    </div>

    <div class="body" style="margin-top: -20px;">
        <div class="latd">
            <div class="grafica">
                <canvas id="G-Usuarios" width="450" height="280"></canvas>
                <hr style="opacity: 10%;">
                <div class="info">
                    <li><i class='fa-solid fa-school me-3'></i><b>Total de usuarios: </b>0</li>
                </div>
            </div>
        </div>

        <div class="latd1">
            <div class="grafica">
                <canvas id="G-Visitas" width="450" height="280"></canvas>
                <hr style="opacity: 10%;">
                <div class="info">
                    <li><i class='fa-solid fa-school me-3'></i><b>Total de visitas: </b>0</li> <!--Esta grafica aun no-->
                </div>
            </div>
        </div>
    </div>

    <div class="body" style="margin-top: -20px;">
        <div class="latd">
            <div class="grafica">
                <canvas id="G-Familias" width="470" height="280"></canvas>
                <hr style="opacity: 10%;">
                <div class="info">
                    <li><i class='fa-solid fa-school me-3'></i><b>Total de planes familiares: </b>0</li> <!--Esta grafica aun no-->
                </div>
            </div>
        </div>

        <div class="latd1">
            <div class="grafica">
                <canvas id="G-Personales" width="450" height="280"></canvas>
                <hr style="opacity: 10%;">
                <div class="info">
                    <li><i class='fa-solid fa-school me-3'></i><b>Total de cuentas personales: </b>0</li> <!--Esta grafica aun no-->
                </div>
            </div>
        </div>
    </div>

        <!-- Fin graficas -->
  </section>

            
  <?php include 'footer.php'; ?>
   
 
  <script>
        const btnAbrirModalA = document.querySelector("#btn-abrir-modalA");
        const btnCerrarModalA = document.querySelector("#btn-cerrar-modalA");
        const modalA = document.querySelector("#modalA");
        btnAbrirModalA.addEventListener("click", () => {
            modalA.showModal();
        })

        btnCerrarModalA.addEventListener("click", () => {
            modalA.close();
        })
    </script>

    <script>
        const btn = document.querySelector("#menu-btn");
        const menu = document.querySelector("#sidemenu");
        btn.addEventListener("click", (e) => {
            menu.classList.toggle("menu-expanded");
            menu.classList.toggle("menu-collapsed");

            document.querySelector("body").classList.toggle("body-expanded");
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('G-Usuarios');
        var Usuarios = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'junio'],
                datasets: [{
                    label: 'Usuarios',
                    data: [<?php echo $filausuarios['id_admin']; ?>, 0, 0, 0, 0, 0],
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
        var ctx = document.getElementById('G-Instituciones');
        var Instituciones = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'junio'],
                datasets: [{
                    label: 'Instituciones',
                    data: [<?php echo $filainstituciones['id_escuela']; ?>, 0, 0, 0, 0, 0],
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
        var ctx = document.getElementById('G-Visitas');
        var Visitas = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'junio'],
                datasets: [{
                    label: 'Visitas',
                    data: [0, 0, 0, 0, 0, 0],
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
        var ctx = document.getElementById('G-Escuelas');
        var Escuelas = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'junio'],
                datasets: [{
                    label: 'Escuelas',
                    data: [<?php echo $filainstituciones['id_escuela']; ?>, 0, 0, 0, 0, 0],
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
        var ctx = document.getElementById('G-Alumnos');
        var Alumnos = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'junio'],
                datasets: [{
                    label: 'Alumnos',
                    data: [<?php echo $filaalumnos['id_alumno']; ?>, 0, 0, 0, 0, 0],
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
        var ctx = document.getElementById('G-Profesores');
        var Profesores = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'junio'],
                datasets: [{
                    label: 'Profesores',
                    data: [<?php echo $filadocentes['id_docente']; ?>, 0, 0, 0, 0, 0],
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
        var ctx = document.getElementById('G-Familias');
        var Familias = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'junio'],
                datasets: [{
                    label: 'Familias',
                    data: [0, 0, 0, 0, 0, 0],
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
        var ctx = document.getElementById('G-Personales');
        var Personales = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'junio'],
                datasets: [{
                    label: 'Cuentas personales',
                    data: [0, 0, 0, 0, 0, 0],
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.min.js" integrity="sha512-v3ygConQmvH0QehvQa6gSvTE2VdBZ6wkLOlmK7Mcy2mZ0ZF9saNbbk19QeaoTHdWIEiTlWmrwAL4hS8ElnGFbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>