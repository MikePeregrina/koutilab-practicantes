<?php
session_start();
$id_user = $_SESSION['id_alumno_preparatoria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_preparatoria'])) {
    header('location: ../../acciones/cerrarsesion.php');
}
include('../../acciones/conexion.php');
// $query = mysqli_query($conexion, "SELECT * FROM cursos_preparatoria WHERE id_alumno = $id_user");
// $data = mysqli_fetch_assoc($query);

//Verificar si ya se tiene permiso en ruta 1
$permiso_ruta_r1 = "1";
$sql_verificar_r1 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_preparatoria a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r1'");
$existe_verificar_r1 = mysqli_num_rows($sql_verificar_r1);

//Verificar si ya se tiene permiso en ruta 2
$permiso_ruta_r2 = "2";
$sql_verificar_r2 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_preparatoria a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r2'");
$existe_verificar_r2 = mysqli_num_rows($sql_verificar_r2);

//Verificar si ya se tiene permiso en ruta 3
$permiso_ruta_r3 = "3";
$sql_verificar_r3 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_preparatoria a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r3'");
$existe_verificar_r3 = mysqli_num_rows($sql_verificar_r3);

//Verificar si ya se tiene permiso en ruta 4
$permiso_ruta_r4 = "4";
$sql_verificar_r4 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_preparatoria a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r4'");
$existe_verificar_r4 = mysqli_num_rows($sql_verificar_r4);

//Verificar si ya se tiene permiso en ruta 5
$permiso_ruta_r5 = "5";
$sql_verificar_r5 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_preparatoria a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r5'");
$existe_verificar_r5 = mysqli_num_rows($sql_verificar_r5);

//Verificar si ya se tiene permiso en ruta 6
$permiso_ruta_r6 = "6";
$sql_verificar_r6 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_preparatoria a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r6'");
$existe_verificar_r6 = mysqli_num_rows($sql_verificar_r6);


//Estadisticas de todos los cursos del alumno
$consultaEstadistica = mysqli_query($conexion, "SELECT trofeos, SUM(trofeos) AS total_trofeos, progreso, SUM(progreso) AS total_progreso, puntos, SUM(puntos) AS total_puntos, practico, SUM(practico) AS total_practico, teorico, SUM(teorico) AS total_teorico FROM estadisticas_preparatoria WHERE id_alumno = $id_user");
$resultadoEstadistica = mysqli_fetch_assoc($consultaEstadistica);

//Estadisticas programacion web basica
$query_programacion_web_basica = mysqli_query($conexion, "SELECT * FROM estadisticas_preparatoria WHERE id_alumno = $id_user AND id_curso = 1");
$data_programacion_web_basica = mysqli_fetch_assoc($query_programacion_web_basica);

//Estadisticas programacion web intermedio
$query_programacion_web_intermedio = mysqli_query($conexion, "SELECT * FROM estadisticas_preparatoria WHERE id_alumno = $id_user AND id_curso = 2");
$data_programacion_web_intermedio = mysqli_fetch_assoc($query_programacion_web_intermedio);

//Estadisticas programacion web avanzado
$query_programacion_web_avanzado = mysqli_query($conexion, "SELECT * FROM estadisticas_preparatoria WHERE id_alumno = $id_user AND id_curso = 3");
$data_programacion_web_avanzado = mysqli_fetch_assoc($query_programacion_web_avanzado);

//Estadisticas python basico
$query_python_basico = mysqli_query($conexion, "SELECT * FROM estadisticas_preparatoria WHERE id_alumno = $id_user AND id_curso = 4");
$data_python_basico = mysqli_fetch_assoc($query_python_basico);

//Estadisticas python intermedio
$query_python_intermedio = mysqli_query($conexion, "SELECT * FROM estadisticas_preparatoria WHERE id_alumno = $id_user AND id_curso = 5");
$data_python_intermedio = mysqli_fetch_assoc($query_python_intermedio);

//Estadisticas python avanzado
$query_python_avanzado = mysqli_query($conexion, "SELECT * FROM estadisticas_preparatoria WHERE id_alumno = $id_user AND id_curso = 6");
$data_python_avanzado = mysqli_fetch_assoc($query_python_avanzado);

//Estadisticas arduino basico
$query_arduino_basico = mysqli_query($conexion, "SELECT * FROM estadisticas_preparatoria WHERE id_alumno = $id_user AND id_curso = 7");
$data_arduino_basico = mysqli_fetch_assoc($query_arduino_basico);

//Estadisticas arduino intermedio
$query_arduino_intermedio = mysqli_query($conexion, "SELECT * FROM estadisticas_preparatoria WHERE id_alumno = $id_user AND id_curso = 8");
$data_arduino_intermedio = mysqli_fetch_assoc($query_arduino_intermedio);

//Estadisticas arduino avanzado
$query_arduino_avanzado = mysqli_query($conexion, "SELECT * FROM estadisticas_preparatoria WHERE id_alumno = $id_user AND id_curso = 9");
$data_arduino_avanzado = mysqli_fetch_assoc($query_arduino_avanzado);

//Información solo de alumno
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM alumnos_preparatoria a JOIN escuelas e ON a.id_escuela = e.id_escuela  WHERE id_alumno = $id_user"));

//Información para alumno - escuela
$user_escuela = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT e.* FROM alumnos_preparatoria a
JOIN escuelas e 
ON a.id_escuela = e.id_escuela
WHERE a.id_alumno = $id_user"));

//Información para alumno - docente
$user_docente = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT d.* FROM alumnos_preparatoria a
JOIN docentes_preparatoria d 
ON a.id_docente = d.id_docente
WHERE a.id_alumno = $id_user"));

//Conteo de cursos
$sql = "SELECT COUNT(*) id_alumno FROM acceso_cursos_preparatoria
WHERE id_alumno = $id_user";
$result = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($result);

$totalTrofeos = ((int)$fila['id_alumno']) * 600;
$totalPuntaje = ((int)$fila['id_alumno']) * 300;
$totalPractico = ((int)$fila['id_alumno']) * 1000;
$totalTeorico = ((int)$fila['id_alumno']) * 1000;

?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="img/lgk.png">
    <link rel="stylesheet" href="css/perfil-alumno.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <section class="seccion-perfil-usuario">
        <div class="perfil-usuario-header">
            <div class="perfil-usuario-portada">
                <?php
                $id = $user["id_alumno"];
                $name = $user["nombre"];
                $image = $user["image"];
                $portada = $user["fondo"];
                ?>
                <img src="acciones/img/<?php echo $portada; ?>" class="fondo" id="imgchange">
                <div class="perfil-usuario-avatar">
                    <form class="form" id="btn-abrir-modalFP" enctype="multipart/form-data" method="">
                        <div class="upload" style="margin-right: 1px; margin-top: 0.5px;">
                            <img src="acciones/img/<?php echo $image; ?>" id="imgchange1">
                            <div class="round">
                                <i class="fa fa-camera" style="color: rgba(61, 172, 244);"></i>
                            </div>
                        </div>
                    </form>
                </div>
                <button type="button" class="boton-portada" id="btn-abrir-modalP">
                    <i class="far fa-image"></i> Cambiar fondo
                </button>
            </div>
        </div>
        <div class="perfil-usuario-body">
            <div class="perfil-usuario-bio">
                <button type="button" class="boton-avatar" id="btn-abrir-modalA">
                    <a href="../../acciones/cerrarsesion.php"><i class="fa fa-sign-out" style="color: white;">&nbsp;&nbsp;Cerrar sesión</i></a>
                </button>
                <?php
                $data2 = mysqli_query($conexion, "SELECT * FROM alumnos_preparatoria WHERE id_alumno = '$id_user'");
                while ($consulta = mysqli_fetch_array($data2)) {
                    echo " <h3 class='titulo'>" . $consulta['nombre'] . "</h3>";
                }
                ?>
            </div>
        </div>
    </section>

    <div class="body">
        <div class="lati">
            <div class="dos">
                <ul class="lista-datos">
                    <li><i class="fas fa-school"></i> <b>&nbsp;Escuela:</b> <?php echo $user_escuela["nombre_escuela"] ?></li>
                    <li><i class="fas fa-graduation-cap"></i> <b>&nbsp;Nivel educativo:</b> <?php echo $user["nivel_educativo"] ?></li>
                    <li><i class="fas fa-fingerprint"></i> <b>&nbsp;&nbsp;CCT:</b> <?php echo $user_escuela["cct"] ?></li>
                    <li><i class="fas fa-user-tie"></i> <b>&nbsp; Profesor:</b> <?php if (isset($user_docente)) echo $user_docente["nombre"]; ?></li>
                </ul>
            </div>

            <div class="dos1">
                <ul class="lista-datos">
                    <li><b>&nbsp;Unirse a un grupo:</b></li>
                    <li>
                        <form enctype="multipart/form-data" action="" method="post">
                            <div class="user-details1">
                                <div class="input-box1" style="width: auto; scale: 80%; margin-top:-20px; margin-left: -25px;">
                                    <input type="text" name="clavegrupo" value="" placeholder="Clave de grupo">
                                    <input type="submit" name="enviarclave" value="Unirse" class="btn-grd" style="scale: 80%; width: 60%;">
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>

            <div class="dos1">
                <ul class="lista-datos">
                    <div class="val-box">
                        <canvas id="myChart1" style="margin-left: 5%;"></canvas>
                    </div>
                </ul>
            </div>
            <div class="dos1">
                <ul class="lista-datos">
                    <li><i class="fas fa-award"></i> &nbsp;<b>Trofeos:</b> <?php echo $resultadoEstadistica["trofeos"] ?> de <?php echo $totalTrofeos ?> <i class="fas fa-trophy-alt"></i> <i class="fas fa-trophy-alt"></i> <i class="fas fa-trophy-alt"></i></li><br>
                    <li><i class='fas fa-chart-line'></i></i> &nbsp;<b>Puntaje:</b> <?php echo $resultadoEstadistica["puntos"] ?> de <?php echo $totalPuntaje ?> </li><br>
                    <li><i class='fab fa-joomla'></i></i>&nbsp; <b>Práctico:</b> <?php echo $resultadoEstadistica["practico"] ?> de <?php echo $totalPractico ?> </li><br>
                    <li><i class='fas fa-file-alt'></i></i> &nbsp;<b>Teórico:</b> <?php echo $resultadoEstadistica["teorico"] ?> de <?php echo $totalTeorico ?> </li>
                </ul>
            </div>
            <div class="dos1">
                <ul class="lista-datos">
                    <li><b>&nbsp;Contraseña:</b></li>
                    <li>
                        <form enctype="multipart/form-data" action="" method="post">
                            <div class="user-details1">
                                <div class="input-box1" style="width: auto; scale: 80%; margin-top:-20px; margin-left: -25px;">
                                    <input type="text" name="contrasena" value="" placeholder="Nueva contraseña">
                                    <input type="submit" name="enviarcontrasena" value="Actualizar" class="btn-grd" style="scale: 80%; width: 60%;">
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
        <div class="latd">
            <div class="titlec">
                <h2>CURSOS</h2>
            </div>
            <div class="card" <?php echo 'style="' . (($existe_verificar_r1 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                <a href="rutas/ruta-pw-b.php">
                    <div class="container">
                        <div class="box">
                            <div class="chart" data-percent="<?php if (isset($data_programacion_web_basica)) echo $data_programacion_web_basica['progreso']; ?>" data-scale-color="#ffb400">
                                <?php if (isset($data_programacion_web_basica)) echo $data_programacion_web_basica['progreso']; ?>%
                            </div>
                            <h2>Diseño web básico</h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="card" <?php echo 'style="' . (($existe_verificar_r2 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                <a href="rutas/ruta-pw-i.php">
                    <div class="container">
                        <div class="box">
                            <div class="chart" data-percent="<?php if (isset($data_programacion_web_intermedio)) echo $data_programacion_web_intermedio['progreso']; ?>" data-scale-color="#ffb400">
                                <?php if (isset($data_programacion_web_intermedio)) echo $data_programacion_web_intermedio['progreso']; ?>%
                            </div>
                            <h2>Diseño web intermedio</h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="card" <?php echo 'style="' . (($existe_verificar_r3 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                <a href="rutas/ruta-pw-a.php">
                    <div class="container">
                        <div class="box">
                            <div class="chart" data-percent="<?php if (isset($data_programacion_web_avanzado)) echo $data_programacion_web_avanzado['progreso']; ?>" data-scale-color="#ffb400">
                                <?php if (isset($data_programacion_web_avanzado)) echo $data_programacion_web_avanzado['progreso']; ?>%
                            </div>
                            <h2>Diseño web avanzado</h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="card" <?php echo 'style="' . (($existe_verificar_r4 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                <a href="rutas/ruta-py-b.php">
                    <div class="container">
                        <div class="box">
                            <div class="chart" data-percent="<?php if (isset($data_python_basica)) echo $data_python_basica['progreso']; ?>" data-scale-color="#ffb400">
                                <?php if (isset($data_python_basica)) echo $data_python_basica['progreso']; ?>%
                            </div>
                            <h2>Python básico</h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="card" <?php echo 'style="' . (($existe_verificar_r5 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                <a href="rutas/ruta-py-i.php">
                    <div class="container">
                        <div class="box">
                            <div class="chart" data-percent="<?php if (isset($data_python_intermedio)) echo $data_python_intermedio['progreso']; ?>" data-scale-color="#ffb400">
                                <?php if (isset($data_python_intermedio)) echo $data_python_intermedio['progreso']; ?>%
                            </div>
                            <h2>Python intermedio</h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="card" <?php echo 'style="' . (($existe_verificar_r6 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                <a href="rutas/ruta-py-a.php">
                    <div class="container">
                        <div class="box">
                            <div class="chart" data-percent="<?php if (isset($data_python_avanzado)) echo $data_python_avanzado['progreso']; ?>" data-scale-color="#ffb400">
                                <?php if (isset($data_python_avanzado)) echo $data_python_avanzado['progreso']; ?>%
                            </div>
                            <h2>Python avanzado</h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx1 = document.getElementById('myChart1');
        new Chart(ctx1, {
            type: 'radar',
            data: {
                labels: ['Trofeos', 'Puntos', 'Práctico', 'Teórico'],
                datasets: [{
                    label: 'Estadísticas',
                    data: [<?php echo $resultadoEstadistica["trofeos"] ?>, <?php echo $resultadoEstadistica["puntos"] ?>, <?php echo $resultadoEstadistica["practico"] ?>, <?php echo $resultadoEstadistica["teorico"] ?>],
                    fill: true,
                    borderWidth: 1
                }]
            },
        });
    </script>
    <script src="js/bar.js"></script>

    <!-- Cambiar foto de perfil -->

    <script type="text/javascript">
        document.getElementById("image").onchange = function() {
            document.getElementById("form").submit();
        };
    </script>
    <?php
    if (isset($_FILES["image"]["name"])) {
        $id = $_POST["id"];
        $name = $_POST["name"];

        $imageName = $_FILES["image"]["name"];
        $imageSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        // Image validation
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $imageName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            echo
            "
        <script>
        Swal.fire({
            title: '¡Advertencia!',
            text: 'Extensión de imágen invalida',
            icon: 'info',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Reintentar',
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'perfil.php';
            }
          });
        </script>
        ";
        } elseif ($imageSize > 1200000) {
            echo
            "
        <script>
        Swal.fire({
            title: '¡Advertencia!',
            text: 'Tamaño de imágen demasiado larga',
            icon: 'info',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Reintentar',
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'perfil.php';
              window.location.reload();
            }
          });
          
        </script>
        ";
        } else {
            $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
            $newImageName .= '.' . $imageExtension;
            $query = "UPDATE alumnos_preparatoria SET image = '$newImageName' WHERE id_alumno = $id";
            mysqli_query($conexion, $query);
            move_uploaded_file($tmpName, 'acciones/img/' . $newImageName);
            echo
            "
        <script>
        Swal.fire({
            title: '¡Excelente!',
            text: 'Cambio de imágen exitoso',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'perfil.php';
            }
          });
        </script>
        ";
        }
    }
    ?>
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

    <dialog close id="modalP" style="border: none; border-radius: 10px; margin-top: 80px; margin-left: 370px; background: url(img/bg1.png);">
        <button style="float: right; background-color: rgba(132, 196, 44, 0.6); padding-left: 7px; padding-right: 7px; padding-top: 6px; padding-bottom: 5px; scale: 110%; border-radius: 50%; outline: none; border: 0px; margin: 10px 10px;" id="btn-cerrar-modalP"><i class="fas fa-close"></i></button><br>
        <div class="portada" style="width: 500px; height: 40px; margin: 10px 30px 10px 30px; box-shadow: 0 0 12px rgba(61,172,244,.6); border-radius: 10px; background: rgba(255,255,255, .8);">
            <h4 style="display: block; width: 100%; font-size: 1.75em; margin-bottom: 0.5rem; text-align: center;">Selecciona un nuevo fondo</h4>
        </div>
        <div class="portada" style="width: 500px; height: 300px; margin: 0px 30px 30px 30px; box-shadow: 0 0 12px rgba(61,172,244,.6); border-radius: 10px; background: rgba(255,255,255, .8); overflow-y: scroll;">
            <form id="cambiarportada1" action="acciones/cambiarfondo.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <input type="hidden" name="portada-1" value="portada-1">
                <img src="img/portada-1.png" alt="" style="width: 450px; margin-left: 18px; margin-top: 15px; border-radius: 5px;"><br>
                <button onclick="miPortada1(); return false;" type="submit" style="width: 100px; margin-left: 200px; padding: 5px; border-radius: 5px; border: none; background-color: rgba(132, 196, 44, 0.6); color:white;">Seleccionar</button>
            </form>
            <hr style="margin-left: 15px; width: 457px; margin-top: 10px; color: grey; opacity: 25%;">
            <form id="cambiarportada2" action="acciones/cambiarfondo.php" method="post" style="margin-top:15px;">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <input type="hidden" name="portada-2" value="portada-2">
                <img src="img/portada-2.png" alt="" style="width: 450px; margin-left: 18px; border-radius: 5px;"><br>
                <button onclick="miPortada2(); return false;" type="submit" style="width: 100px; margin-left: 200px; padding: 5px; border-radius: 5px; border: none; background-color: rgba(132, 196, 44, 0.6); color:white;">Seleccionar</button>
            </form>
            <hr style="margin-left: 15px; width: 457px; margin-top: 10px; color: grey; opacity: 25%;">
            <form id="cambiarportada3" action="acciones/cambiarfondo.php" method="post" style="margin-top:15px;">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <input type="hidden" name="portada-3" value="portada-3">
                <img src="img/portada-3.png" alt="" style="width: 450px; margin-left: 18px; border-radius: 5px;"><br>
                <button onclick="miPortada3(); return false;" type="submit" style="width: 100px; margin-left: 200px; padding: 5px; border-radius: 5px; border: none; background-color: rgba(132, 196, 44, 0.6); color:white;">Seleccionar</button>
            </form>
            <hr style="margin-left: 15px; width: 457px; margin-top: 10px; color: grey; opacity: 25%;">
            <form id="cambiarportada4" action="acciones/cambiarfondo.php" method="post" style="margin-top:15px;">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <input type="hidden" name="portada-4" value="portada-4">
                <img src="img/portada-4.png" alt="" style="width: 450px; margin-left: 18px; border-radius: 5px;"><br>
                <button onclick="miPortada4(); return false;" type="submit" style="width: 100px; margin-left: 200px; padding: 5px; border-radius: 5px; border: none; background-color: rgba(132, 196, 44, 0.6); color:white;">Seleccionar</button>
            </form>
            <hr style="margin-left: 15px; width: 457px; margin-top: 10px; color: grey; opacity: 25%;">
            <form id="cambiarportada5" action="acciones/cambiarfondo.php" method="post" style="margin-top:15px;">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <input type="hidden" name="portada-5" value="portada-5">
                <img src="img/portada-5.png" alt="" style="width: 450px; margin-left: 18px; border-radius: 5px;"><br>
                <button onclick="miPortada5(); return false;" type="submit" style="width: 100px; margin-left: 200px; padding: 5px; border-radius: 5px; border: none; background-color: rgba(132, 196, 44, 0.6); color:white;">Seleccionar</button>
            </form>
            <hr style="margin-left: 15px; width: 457px; margin-top: 10px; color: grey; opacity: 25%;">
            <form id="cambiarportada6" action="acciones/cambiarfondo.php" method="post" style="margin-top:15px;">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <input type="hidden" name="portada-6" value="portada-6">
                <img src="img/portada-6.png" alt="" style="width: 450px; margin-left: 18px; border-radius: 5px;"><br>
                <button onclick="miPortada6(); return false;" type="submit" style="width: 100px; margin-left: 200px; padding: 5px; border-radius: 5px; border: none; background-color: rgba(132, 196, 44, 0.6); color:white;">Seleccionar</button>
            </form>
            <hr style="margin-left: 15px; width: 457px; margin-top: 10px; color: grey; opacity: 25%;">
            <form id="cambiarportada7" action="acciones/cambiarfondo.php" method="post" style="margin-top:15px;">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <input type="hidden" name="portada-7" value="portada-7">
                <img src="img/portada-7.png" alt="" style="width: 450px; margin-left: 18px; border-radius: 5px;"><br>
                <button onclick="miPortada7(); return false;" type="submit" style="width: 100px; margin-left: 200px; padding: 5px; border-radius: 5px; border: none; background-color: rgba(132, 196, 44, 0.6); color:white;">Seleccionar</button>
            </form>
            <hr style="margin-left: 15px; width: 457px; margin-top: 10px; color: grey; opacity: 25%;">
            <form id="cambiarportada8" action="acciones/cambiarfondo.php" method="post" style="margin-top:15px; margin-bottom: 15px;">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <input type="hidden" name="portada-8" value="portada-8">
                <img src="img/portada-8.png" alt="" style="width: 450px; margin-left: 18px; border-radius: 5px;"><br>
                <button onclick="miPortada8(); return false;" type="submit" style="width: 100px; margin-left: 200px; padding: 5px; border-radius: 5px; border: none; background-color: rgba(132, 196, 44, 0.6); color:white;">Seleccionar</button>
            </form>
        </div>
    </dialog>

    <script>
        const btnAbrirModalP = document.querySelector("#btn-abrir-modalP");
        const btnCerrarModalP = document.querySelector("#btn-cerrar-modalP");
        const modalP = document.querySelector("#modalP");
        btnAbrirModalP.addEventListener("click", () => {
            modalP.showModal();
        })

        btnCerrarModalP.addEventListener("click", () => {
            modalP.close();
        })
    </script>

    <script>
        function miPortada1() {
            modalP.close();
            Swal.fire({
                title: '¡Excelente!',
                text: 'Cambio de portada exitosa',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cambiarportada1').submit();
                }
            });
        }

        function miPortada2() {
            modalP.close();
            Swal.fire({
                title: '¡Excelente!',
                text: 'Cambio de portada exitosa',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cambiarportada2').submit();
                }
            });
        }

        function miPortada3() {
            modalP.close();
            Swal.fire({
                title: '¡Excelente!',
                text: 'Cambio de portada exitosa',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cambiarportada3').submit();
                }
            });
        }

        function miPortada4() {
            modalP.close();
            Swal.fire({
                title: '¡Excelente!',
                text: 'Cambio de portada exitosa',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cambiarportada4').submit();
                }
            });
        }

        function miPortada5() {
            modalP.close();
            Swal.fire({
                title: '¡Excelente!',
                text: 'Cambio de portada exitosa',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cambiarportada5').submit();
                }
            });
        }

        function miPortada6() {
            modalP.close();
            Swal.fire({
                title: '¡Excelente!',
                text: 'Cambio de portada exitosa',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cambiarportada6').submit();
                }
            });
        }

        function miPortada7() {
            modalP.close();
            Swal.fire({
                title: '¡Excelente!',
                text: 'Cambio de portada exitosa',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cambiarportada7').submit();
                }
            });
        }

        function miPortada8() {
            modalP.close();
            Swal.fire({
                title: '¡Excelente!',
                text: 'Cambio de portada exitosa',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cambiarportada8').submit();
                }
            });
        }
    </script>

    <dialog close id="modalFP" style="border: none; border-radius: 10px; margin-top: 80px; margin-left: 370px; background: url(img/bg1.png);">
        <button style="float: right; background-color: rgba(132, 196, 44, 0.6); padding-left: 7px; padding-right: 7px; padding-top: 6px; padding-bottom: 5px; scale: 110%; border-radius: 50%; outline: none; border: 0px; margin: 10px 10px;" id="btn-cerrar-modalFP"><i class="fas fa-close"></i></button><br>
        <div style="width: 500px; height: 40px; margin: 10px 30px 10px 30px; box-shadow: 0 0 12px rgba(61,172,244,.6); border-radius: 10px; background: rgba(255,255,255, .8);">
            <h4 style="display: block; width: 100%; font-size: 1.75em; margin-bottom: 0.5rem; text-align: center;">Selecciona un avatar</h4>
        </div>
        <div class="portada" style="width: 500px; height: 300px; margin: 0px 30px 30px 30px; box-shadow: 0 0 12px rgba(61,172,244,.6); border-radius: 10px; background: rgba(255,255,255, .8); overflow-y: scroll; display: flex; justify-content: space-between;">
            <div>
                <form id="cambiaravatar1" action="acciones/cambiaravatar.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="Mascota-Aerobot-01" value="Mascota-Aerobot-01">
                    <img src="img/Mascota-Aerobot-01.png" alt="" style="width: 100px; margin-left: 28px; margin-top: 10px; border-radius: 50%; border: rgba(61, 172, 244);"><br>
                    <button onclick="miAvatar1(); return false;" type="submit" style="width: 100px; margin-left: 27px; padding: 3px; border-radius: 5px; border: none; background-color: rgba(132, 196, 44, 0.6); color:white;" id="Mascota-Aerobot-01" name="Mascota-Aerobot-01">Seleccionar</button>
                </form>
                <hr style="margin-left: 20px; width: 115px; margin-top: 10px; color: grey; opacity: 20%;">
                <form id="cambiaravatar2" action="acciones/cambiaravatar.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="Mascota-Aerobot-02" value="Mascota-Aerobot-02">
                    <img src="img/Mascota-Aerobot-02.png" alt="" style="width: 100px; margin-left: 28px; margin-top: 10px; border-radius: 50%; border: rgba(61, 172, 244);"><br>
                    <button onclick="miAvatar2(); return false;" type="submit" style="width: 100px; margin-left: 27px; padding: 3px; border-radius: 5px; border: none; background-color: rgba(132, 196, 44, 0.6); color:white;" id="Mascota-Aerobot-02" name="Mascota-Aerobot-02">Seleccionar</button>
                </form>
                <hr style="margin-left: 20px; width: 115px; margin-top: 10px; color: grey; opacity: 20%;">
                <form id="cambiaravatar3" action="acciones/cambiaravatar.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="Mascota-Aerobot-03" value="Mascota-Aerobot-03">
                    <img src="img/Mascota-Aerobot-03.png" alt="" style="width: 100px; margin-left: 28px; margin-top: 10px; border-radius: 50%; border: rgba(61, 172, 244);"><br>
                    <button onclick="miAvatar3(); return false;" type="submit" style="width: 100px; margin-left: 27px; padding: 3px; border-radius: 5px; border: none; background-color: rgba(132, 196, 44, 0.6); color:white;" id="Mascota-Aerobot-03" name="Mascota-Aerobot-03">Seleccionar</button>
                </form>
            </div>
            <div>
                <form id="cambiaravatar4" action="acciones/cambiaravatar.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="Mascota-Aerobot-04" value="Mascota-Aerobot-04">
                    <img src="img/Mascota-Aerobot-04.png" alt="" style="width: 100px; margin-left: 28px; margin-top: 10px; border-radius: 50%; border: rgba(61, 172, 244);"><br>
                    <button onclick="miAvatar4(); return false;" type="submit" style="width: 100px; margin-left: 27px; padding: 3px; border-radius: 5px; border: none; background-color: rgba(132, 196, 44, 0.6); color:white;" id="Mascota-Aerobot-04" name="Mascota-Aerobot-04">Seleccionar</button>
                </form>
                <hr style="margin-left: 10px; width: 115px; margin-top: 10px; color: grey; opacity: 20%;">
                <form id="cambiaravatar5" action="acciones/cambiaravatar.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="Mascota-Aerobot-05" value="Mascota-Aerobot-05">
                    <img src="img/Mascota-Aerobot-05.png" alt="" style="width: 100px; margin-left: 28px; margin-top: 10px; border-radius: 50%; border: rgba(61, 172, 244);"><br>
                    <button onclick="miAvatar5(); return false;" type="submit" style="width: 100px; margin-left: 27px; padding: 3px; border-radius: 5px; border: none; background-color: rgba(132, 196, 44, 0.6); color:white;" id="Mascota-Aerobot-05" name="Mascota-Aerobot-05">Seleccionar</button>
                </form>
                <hr style="margin-left: 10px; width: 115px; margin-top: 10px; color: grey; opacity: 20%;">
                <form id="cambiaravatar6" action="acciones/cambiaravatar.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="Mascota-Aerobot-06" value="Mascota-Aerobot-06">
                    <img src="img/Mascota-Aerobot-06.png" alt="" style="width: 100px; margin-left: 28px; margin-top: 10px; border-radius: 50%; border: rgba(61, 172, 244);"><br>
                    <button onclick="miAvatar6(); return false;" type="submit" style="width: 100px; margin-left: 27px; padding: 3px; border-radius: 5px; border: none; background-color: rgba(132, 196, 44, 0.6); color:white;" id="Mascota-Aerobot-06" name="Mascota-Aerobot-06">Seleccionar</button>
                </form>
            </div>
            <div>
                <form id="cambiaravatar7" action="acciones/cambiaravatar.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="Mascota-Aerobot-07" value="Mascota-Aerobot-07">
                    <img src="img/Mascota-Aerobot-07.png" alt="" style="width: 100px; margin-left: 28px; margin-top: 10px; border-radius: 50%; border: rgba(61, 172, 244);"><br>
                    <button onclick="miAvatar7(); return false;" type="submit" style="width: 100px; margin-left: 27px; padding: 3px; border-radius: 5px; border: none; background-color: rgba(132, 196, 44, 0.6); color:white;" id="Mascota-Aerobot-07" name="Mascota-Aerobot-07">Seleccionar</button>
                </form>
                <hr style="margin-left: 10px; width: 115px; margin-top: 10px; color: grey; opacity: 20%;">
                <form id="cambiaravatar8" action="acciones/cambiaravatar.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="Mascota-Aerobot-08" value="Mascota-Aerobot-08">
                    <img src="img/Mascota-Aerobot-08.png" alt="" style="width: 100px; margin-left: 28px; margin-top: 10px; border-radius: 50%; border: rgba(61, 172, 244);"><br>
                    <button onclick="miAvatar8(); return false;" type="submit" style="width: 100px; margin-left: 27px; padding: 3px; border-radius: 5px; border: none; background-color: rgba(132, 196, 44, 0.6); color:white;" id="Mascota-Aerobot-08" name="Mascota-Aerobot-08">Seleccionar</button>
                </form>
                <hr style="margin-left: 10px; width: 115px; margin-top: 10px; color: grey; opacity: 20%;">
                <form id="cambiaravatar9" action="acciones/cambiaravatar.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="Mascota-Aerobot-09" value="Mascota-Aerobot-09">
                    <img src="img/Mascota-Aerobot-09.png" alt="" style="width: 100px; margin-left: 28px; margin-top: 10px; border-radius: 50%; border: rgba(61, 172, 244);"><br>
                    <button onclick="miAvatar9(); return false;" type="submit" style="width: 100px; margin-left: 27px; padding: 3px; border-radius: 5px; border: none; background-color: rgba(132, 196, 44, 0.6); color:white;" id="Mascota-Aerobot-09" name="Mascota-Aerobot-09">Seleccionar</button>
                </form>
            </div>
        </div>
    </dialog>

    <script>

    </script>

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

    <script>
        function miAvatar1() {
            modalFP.close();
            Swal.fire({
                title: '¡Excelente!',
                text: 'Cambio de avatar exitoso',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cambiaravatar1').submit();
                }
            });
        }

        function miAvatar2() {
            modalFP.close();
            Swal.fire({
                title: '¡Excelente!',
                text: 'Cambio de avatar exitoso',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cambiaravatar2').submit();
                }
            });
        }

        function miAvatar3() {
            modalFP.close();
            Swal.fire({
                title: '¡Excelente!',
                text: 'Cambio de avatar exitoso',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cambiaravatar3').submit();
                }
            });
        }

        function miAvatar4() {
            modalFP.close();
            Swal.fire({
                title: '¡Excelente!',
                text: 'Cambio de avatar exitoso',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cambiaravatar4').submit();
                }
            });
        }

        function miAvatar5() {
            modalFP.close();
            Swal.fire({
                title: '¡Excelente!',
                text: 'Cambio de avatar exitoso',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cambiaravatar5').submit();
                }
            });
        }

        function miAvatar6() {
            modalFP.close();
            Swal.fire({
                title: '¡Excelente!',
                text: 'Cambio de avatar exitoso',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cambiaravatar6').submit();
                }
            });
        }

        function miAvatar7() {
            modalFP.close();
            Swal.fire({
                title: '¡Excelente!',
                text: 'Cambio de avatar exitoso',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cambiaravatar7').submit();
                }
            });
        }

        function miAvatar8() {
            modalFP.close();
            Swal.fire({
                title: '¡Excelente!',
                text: 'Cambio de avatar exitoso',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cambiaravatar8').submit();
                }
            });
        }

        function miAvatar9() {
            modalFP.close();
            Swal.fire({
                title: '¡Excelente!',
                text: 'Cambio de avatar exitoso',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cambiaravatar9').submit();
                }
            });
        }
    </script>

    <?php
    if (isset($_POST['enviarcontrasena'])) {
        $idalumno = $_SESSION['id_alumno_preparatoria'];
        $contrasena = md5($_POST['contrasena']);

        $sql_update = mysqli_query($conexion, "UPDATE alumnos_preparatoria SET contrasena = '$contrasena' WHERE id_alumno = '$idalumno'");

        if ($sql_update) {
            echo
            "
      <script>
      Swal.fire({
          title: 'Excelente!',
          text: 'Cambio de contraseña exitosa',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'perfil.php';
          }
        });
      </script>
        ";
        } else {
            echo
            "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: 'Cambio de contraseña no exitosa',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'perfil.php';
          }
        });
      </script>
        ";
        }
    }
    ?>

    <?php
    if (isset($_POST['enviarclave'])) {
        $idalumno = $_SESSION['id_alumno_preparatoria'];
        $clavegrupo = $_POST['clavegrupo'];

        $data_alumno = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM grupos_preparatoria WHERE clave = '$clavegrupo'"));
        if (isset($data_alumno['id_grupo'])) {
            $id_grupo_alumno = $data_alumno['id_grupo'];
            $insertar_grupo = mysqli_query($conexion, "INSERT INTO detalle_grupos_preparatoria(id_alumno, id_grupo) VALUES ($idalumno, $id_grupo_alumno)");
        }
        if (isset($data_alumno['id_docente'])) {
            $id_docente_alumno = $data_alumno['id_docente'];
            $sql_update = mysqli_query($conexion, "UPDATE alumnos_preparatoria SET id_docente = $id_docente_alumno WHERE id_alumno = $idalumno");
        }

        if (isset($data_alumno['id_grupo'])) {
            $sql = "SELECT DISTINCT c.id_curso FROM grupos_preparatoria g JOIN detalle_grupo_cursos_preparatoria dg ON g.id_grupo = dg.id_grupo JOIN cursos_preparatoria c ON dg.id_curso = c.id_curso WHERE g.clave = '$clavegrupo'";
            $resultado = $conexion->query($sql);

            if ($resultado->num_rows > 0) {
                // Itera sobre los resultados de la consulta SELECT y ejecuta una consulta INSERT para insertar cada registro en la tabla de destino
                while ($fila = $resultado->fetch_assoc()) {
                    $idcurso = $fila["id_curso"];
                    $insertar_acceso_curso = "INSERT INTO acceso_cursos_preparatoria(id_curso, id_alumno) VALUES ('$idcurso', $idalumno)";
                    $conexion->query($insertar_acceso_curso);
                }
            }
        }

        if ($insertar_grupo && $insertar_acceso_curso && $sql_update) {
            echo
            "
      <script>
      Swal.fire({
          title: 'Excelente!',
          text: 'Registro de grupo exitoso',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'perfil.php';
          }
        });
      </script>
        ";
        } else {
            echo
            "
      <script>
      Swal.fire({
          title: '¡Revisa bien tu clave!',
          text: 'Registro de grupo no exitoso',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'perfil.php';
          }
        });
      </script>
        ";
        }
    }
    ?>

</body>