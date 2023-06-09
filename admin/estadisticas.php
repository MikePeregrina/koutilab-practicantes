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

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="img/lgk.png">
    <link rel="stylesheet" href="css/estadisticas.css" />
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Sidemenu -->
    <div id="sidemenu" class="menu-collapsed">
        <div id="header">
            <div id="title"><img src="img/koutilab3.png" alt="" /></div>
            <div id="menu-btn">
                <div class="btn-hamburger"></div>
                <div class="btn-hamburger"></div>
                <div class="btn-hamburger"></div>
            </div>
        </div>
        <div class="item separator"></div>
        <?php
        $id = $user["id_admin"];
        $name = $user["nombre"];
        $image = $user["image"];
        $username = $user["usuario"];
        ?>
        <div id="profile">
            <div id="photo"><img src="acciones/img/<?php echo $image; ?>" title="<?php echo $image; ?>"></div>
            <div id="name"><span><?php echo $name; ?></span></div>
        </div>

        <div id="menu-items">
            <div class="item separator"></div>
            <div class="item">
                <a href="dashboard.php" class="">
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="title">
                        <span>Dashboard</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
            <div class="item" style="background-color: rgba(61,172,244, .4);">
                <a href="estadisticas.php" class="">
                    <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <div class="title">
                        <span>Estadísticas</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
            <div class="item">
                <a href="ingresos.php" class="">
                    <div class="icon">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <div class="title">
                        <span>Ingresos</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
            <div class="item">
                <a href="administradores.php" class="">
                    <div class="icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="title">
                        <span>Agregar administrador</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
            <div class="item">
                <a href="escuelas.php" class="">
                    <div class="icon">
                        <i class='fa-solid fa-school'></i>
                    </div>
                    <div class="title">
                        <span>Escuelas</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
            <div class="item">
                <a href="preregistros.php" class="">
                    <div class="icon">
                        <i class='fa-solid fa-clipboard'></i>
                    </div>
                    <div class="title">
                        <span>Pre-registros</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
            <div class="item">
                <a href="bandeja.php" class="">
                    <div class="icon">
                        <i class='fas fa-envelope'></i>
                    </div>
                    <div class="title">
                        <span>Bandeja</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
        </div>
    </div>

    <div id="interface">
        <div class="navigation">
            <div class="n1" style="margin-left: 460px;">
                <img src="img/koutilab0.png">
            </div>
            <div class="perfil">
                <a href="../acciones/cerrarsesion.php"><i class="fa fa-sign-out"></i></a>
            </div>
        </div>
    </div>
    <div class="values ms-5 mt-3 pe-1">
        <h3 class="i-name">Estadísticas</h3>
    </div>

    <!-- Graficas -->

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
                <canvas id="G-Familias" width="450" height="280"></canvas>
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

    <dialog close id="modalA" style="background-image: url(img/bg1.png); border-radius: 20px; border: 2px solid #f1f2f3;">
        <div>
            <button style="float: right; background: white; width: 8%; scale: 70%;" class="btn-b" id="btn-cerrar-modalA"><i class="fas fa-close"></i></button>
            <br>
            <video width="520" height="250" controls>
                <source src="" type="video/mp4">
            </video>
        </div>
    </dialog>

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