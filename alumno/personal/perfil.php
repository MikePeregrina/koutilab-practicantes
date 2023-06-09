<?php
session_start();
$id_user = $_SESSION['id_alumno_personal'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_personal'])) {
    header('location: ../../acciones/cerrarsesion.php');
}

include('../../acciones/conexion.php');

//Estadisticas de todos los cursos del alumno
$consultaEstadistica = mysqli_query($conexion, "SELECT trofeos, SUM(trofeos) AS total_trofeos, progreso, SUM(progreso) AS total_progreso, puntos, SUM(puntos) AS total_puntos, practico, SUM(practico) AS total_practico, teorico, SUM(teorico) AS total_teorico FROM estadisticas_personal WHERE id_alumno = $id_user");
$resultadoEstadistica = mysqli_fetch_assoc($consultaEstadistica);

//Estadisticas programacion web basica
$query_programacion_web_basica = mysqli_query($conexion, "SELECT * FROM estadisticas_personal WHERE id_alumno = $id_user AND id_curso = 1");
$data_programacion_web_basica = mysqli_fetch_assoc($query_programacion_web_basica);

//Estadisticas programacion web intermedio
$query_programacion_web_intermedio = mysqli_query($conexion, "SELECT * FROM estadisticas_personal WHERE id_alumno = $id_user AND id_curso = 2");
$data_programacion_web_intermedio = mysqli_fetch_assoc($query_programacion_web_intermedio);

//Estadisticas programacion web avanzado
$query_programacion_web_avanzado = mysqli_query($conexion, "SELECT * FROM estadisticas_personal WHERE id_alumno = $id_user AND id_curso = 3");
$data_programacion_web_avanzado = mysqli_fetch_assoc($query_programacion_web_avanzado);

//Estadisticas python basico
$query_python_basico = mysqli_query($conexion, "SELECT * FROM estadisticas_personal WHERE id_alumno = $id_user AND id_curso = 4");
$data_python_basico = mysqli_fetch_assoc($query_python_basico);

//Estadisticas python intermedio
$query_python_intermedio = mysqli_query($conexion, "SELECT * FROM estadisticas_personal WHERE id_alumno = $id_user AND id_curso = 5");
$data_python_intermedio = mysqli_fetch_assoc($query_python_intermedio);

//Estadisticas python avanzado
$query_python_avanzado = mysqli_query($conexion, "SELECT * FROM estadisticas_personal WHERE id_alumno = $id_user AND id_curso = 6");
$data_python_avanzado = mysqli_fetch_assoc($query_python_avanzado);

//Estadisticas arduino basico
$query_arduino_basico = mysqli_query($conexion, "SELECT * FROM estadisticas_personal WHERE id_alumno = $id_user AND id_curso = 7");
$data_arduino_basico = mysqli_fetch_assoc($query_arduino_basico);

//Estadisticas arduino intermedio
$query_arduino_intermedio = mysqli_query($conexion, "SELECT * FROM estadisticas_personal WHERE id_alumno = $id_user AND id_curso = 8");
$data_arduino_intermedio = mysqli_fetch_assoc($query_arduino_intermedio);

//Estadisticas arduino avanzado
$query_arduino_avanzado = mysqli_query($conexion, "SELECT * FROM estadisticas_personal WHERE id_alumno = $id_user AND id_curso = 9");
$data_arduino_avanzado = mysqli_fetch_assoc($query_arduino_avanzado);

//Información solo de alumno
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM alumnos_personal a WHERE id_alumno = $id_user"));

//Conteo de cursos
$sql = "SELECT COUNT(*) id_alumno FROM acceso_cursos_personal
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
    <script src="http://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script> <!--Libreria de javaScript para consultas dinámicas-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<script type="text/javascript">
    //Función que realiza la busqueda mediante campo de texto, búsqueda por proximidad
    $(document).ready(function() {
        (function($) {
            $('#FiltrarContenido').keyup(function() { //input que contiene la búsqueda deseada
                var ValorBusqueda = new RegExp($(this).val(), 'i');
                $('.latd .filterDiv').hide();
                $('.latd .filterDiv').filter(function() {
                    return ValorBusqueda.test($(this).text());
                }).show();
            })
        }(jQuery));
    });
</script>

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
                <!--Se cambio el recuadro del btn que se tenía anteriormente por una opcion redonda
                como el que se muestra en la opcion del perfil, al igual cabe recalcar que se hizo la
                modificacion del icono de imagen que tenia por el icono de camara-->
                <div class="boton-portada">
                    <form class="form" id="btn-abrir-modalP" method="">
                        <div class="upload" style="margin-right: 1px; margin-top: 0.5px;">
                            <div class="round">
                                <i class="fa fa-camera" style="color: rgba(61, 172, 244);"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="perfil-usuario-body">
            <div class="perfil-usuario-bio">
                <button type="button" class="boton-avatar" id="btn-abrir-modalA">
                    <!--Se modifico el icono del btn de cerrar sesion-->
                    <div class="upload logout" style="margin-right: 80px;">
                        <a href="../../acciones/cerrarsesion.php"><img src="img/logout3.png" alt="LogOut" width="20px"><br>Cerrar Sesión</i></a><!--Se cambio el logo de Cierre de Sesión-->
                    </div>
                </button>
                <?php
                $data2 = mysqli_query($conexion, "SELECT * FROM alumnos_personal WHERE id_alumno = '$id_user'");
                while ($consulta = mysqli_fetch_array($data2)) {
                    echo " <h3 class='titulo'>" . $consulta['nombre'] . "</h3>";
                }
                ?>
            </div>
        </div>
    </section>

    <div class="body">
        <div class="all-ctn">
            <div class="lati">

                <!--Apartado de estadísticas-->
                <div class="dos1" style="margin-top: 20px;">
                    <ul class="lista-datos">
                        <div class="val-box">
                            <canvas id="myChart1" style="margin-left: 5%;"></canvas>
                        </div>
                    </ul>
                </div>

                <!--Apartado de trofeos-->
                <!--<div class="dos1">
                <ul class="lista-datos">
                    <li><i class="fas fa-award"></i> &nbsp;<b>Trofeos:</b> <?php echo $resultadoEstadistica["trofeos"] ?> de <?php echo $totalTrofeos ?> <i class="fas fa-trophy-alt"></i> <i class="fas fa-trophy-alt"></i> <i class="fas fa-trophy-alt"></i></li><br>
                    <li><i class='fas fa-chart-line'></i></i> &nbsp;<b>Puntaje:</b> <?php echo $resultadoEstadistica["puntos"] ?> de <?php echo $totalPuntaje ?> </li><br>
                    <li><i class='fab fa-joomla'></i></i>&nbsp; <b>Práctico:</b> <?php echo $resultadoEstadistica["practico"] ?> de <?php echo $totalPractico ?> </li><br>
                    <li><i class='fas fa-file-alt'></i></i> &nbsp;<b>Teórico:</b> <?php echo $resultadoEstadistica["teorico"] ?> de <?php echo $totalTeorico ?> </li>
                </ul>
            </div>-->

                <!--Apartado de contraseña-->
                <div class="dos1" style="margin-top: 30px; margin-bottom: 30px;">
                    <ul class="lista-datos">
                        <li><b>Cambiar contraseña:</b></li>
                        <li>
                            <form enctype="multipart/form-data" action="" method="post">
                                <div class="user-details1">
                                    <div class="input-box1" style="width: auto; scale: 85%; margin-top:8px; margin-left: -45px;">
                                        <input type="text" name="contrasena" value="" placeholder="Nueva contraseña">
                                        <input type="submit" name="enviarcontrasena" value="Actualizar" class="btn" style="width: 80px; font-size: 15px; text-align: center;">
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="adquirido">
                <div class="titlec">
                    <h2>CURSOS ADQUIRIDOS</h2>
                </div> <br>
                <div class="cursos-adq">
                    <div class="filterDiv"> <!--Se añaden nuevas clases necesarias para la filtración-->
                        <a href="rutas/ruta-pw-b.php">
                            <div class="container">
                                <div class="box">
                                    <!--<div class="chart" style="width: 100px;" data-percent="<?php if (isset($data_programacion_web_basica)) echo $data_programacion_web_basica['progreso']; ?>" data-scale-color="#ffb400">
                                <?php if (isset($data_programacion_web_basica)) echo $data_programacion_web_basica['progreso']; ?>%
                            </div>-->
                                    <h2>Diseño web básico</h2>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="filterDiv">
                        <a href="rutas/ruta-pw-i.php">
                            <div class="container">
                                <div class="box">
                                    <!--<div class="chart" data-percent="<?php if (isset($data_programacion_web_intermedio)) echo $data_programacion_web_intermedio['progreso']; ?>" data-scale-color="#ffb400">
                                <?php if (isset($data_programacion_web_intermedio)) echo $data_programacion_web_intermedio['progreso']; ?>%
                            </div>-->
                                    <h2>Diseño web intermedio</h2>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="filterDiv">
                        <a href="rutas/ruta-pw-a.php">
                            <div class="container">
                                <div class="box">
                                    <!--<div class="chart" data-percent="<?php if (isset($data_programacion_web_avanzado)) echo $data_programacion_web_avanzado['progreso']; ?>" data-scale-color="#ffb400">
                                <?php if (isset($data_programacion_web_avanzado)) echo $data_programacion_web_avanzado['progreso']; ?>%
                            </div>-->
                                    <h2>Diseño web avanzado</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="latd">
                <div class="titlec">
                    <h2>GALERÍA DE CURSOS</h2><!--Se modifico el titulo del contenedor-->
                </div>
                <!--Filtrando por categorías predefinidas-->
                <div id="btnFilterContainer" class="btn-filter-ctn">
                    <button class="btn active" onclick="filterSelection('todos')"> Todos</button>
                    <button class="btn" onclick="filterSelection('programacion')">Programación</button>
                    <button class="btn" onclick="filterSelection('Arduino')">Arduino</button>
                    <button class="btn" onclick="filterSelection('basico')">Básico</button>
                    <button class="btn" onclick="filterSelection('intermedio')">Intermedio</button>
                    <button class="btn" onclick="filterSelection('avanzado')">Avanzado</button>
                </div>
                <!--Implementando buscador-->
                <div class="search-ctn">
                    <span><img class="img" src="img/lupa.png" alt="lupa" width="25px"></span>
                    <input id="FiltrarContenido" type="text" placeholder="Nombre de curso..." aria-label="Curso">
                </div>
                <div class="BusquedaRapida"> <!--Para implementar la búsqueda dinámica-->
                    <?php
                    $consulta = "SELECT * FROM cursos_personal";
                    $resultado = mysqli_query($conexion, $consulta);
                    $contador = 0;

                    while ($curso = mysqli_fetch_assoc($resultado)) { //Agregando cada curso de la BD
                        $contador++; ?>
                        <div class="filterDiv programacion {{<?php echo $curso["curso"] ?>}}" id="galeria">
                            <a href="#">
                                <div class="container" style="color: darkslategray;">
                                    <div class="box">
                                        <h2><?php echo $curso["curso"] ?></h2>
                                        <br>
                                        <img src="img/basePortada.jpeg" alt="ilustración curso" width="100px">
                                        <p>Aquí va la descripción de cada curso</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                    <?php } ?>

                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        //Inicio de proceso de filtración
        filterSelection("todos") //Cuando se elije ver todos

        function filterSelection(c) { //Cuando se filtra por categorías, paso de parámetro
            var x, i;
            x = document.getElementsByClassName("filterDiv");
            if (c == "todos") c = "";
            for (i = 0; i < x.length; i++) {
                RemoveClass(x[i], "show"); //Si la clase no coincide con la elegida, se elimina la clase show para dejar de mostrar, o de lo contrario, se agrega
                if (x[i].className.indexOf(c) > -1) AddClass(x[i], "show");
            }
        }

        function AddClass(element, name) { //Función para añadir clase show a los elementos que coincidan
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) {
                if (arr1.indexOf(arr2[i]) == -1) {
                    element.className += " " + arr2[i];
                }
            }
        }

        function RemoveClass(element, name) { //Función para eliminar clase show a los elementos que coincidan
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) {
                while (arr1.indexOf(arr2[i]) > -1) {
                    arr1.splice(arr1.indexOf(arr2[i]), 1);
                }
            }
            element.className = arr1.join(" ");
        }

        // Añadiento la clase "active" al botón pulsado para usar diseño predefinido y distinto
        var btnContainer = document.getElementById("btnFilterContainer");
        var btns = btnContainer.getElementsByClassName("btn");
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";
            });
        }
    </script>
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
                window.location.href = 'perfil.php';
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
                window.location.href = 'perfil.php';
            }
          });
          
        </script>
        ";
        } else { //Si se cumplen las condiciones
            $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generando nuevo nombre de imagen
            $newImageName .= '.' . $imageExtension; //agregando extensión
            $query = "UPDATE alumnos_personal SET image = '$newImageName' WHERE id_alumno = $id"; //Actualizando imagen en BD
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
                window.location.href = 'perfil.php';
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


    <?php
    if (isset($_POST['enviarcontrasena'])) {
        $idalumno = $_SESSION['id_alumno_personal'];
        $contrasena = md5($_POST['contrasena']);

        $sql_update = mysqli_query($conexion, "UPDATE alumnos_personal SET contrasena = '$contrasena' WHERE id_alumno = '$idalumno'");

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

</body>