<?php
session_start();
$id_user = $_SESSION['id_admin'];
if (empty($_SESSION['active']) || empty($_SESSION['id_admin'])) {
    header('location: ../acciones/cerrarsesion.php');
}
include('../acciones/conexion.php');
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM admin WHERE id_admin = $id_user"));

//Contar escuelas
$sqlescuelas = "SELECT count(id_escuela) id_escuela from escuelas WHERE nivel_educativo != 'Institucional'";
$resultescuelas = mysqli_query($conexion, $sqlescuelas);
$filaescuelas = mysqli_fetch_assoc($resultescuelas);

//Contar instituciones
$sqlinstituciones = "SELECT count(id_escuela) id_escuela from escuelas WHERE nivel_educativo = 'Institucional'";
$resultinsitituciones = mysqli_query($conexion, $sqlinstituciones);
$filainstituciones = mysqli_fetch_assoc($resultinsitituciones);

//Contar alumnos
$sqlalumnos = "SELECT COUNT(id_alumno) id_alumno
FROM (
  SELECT id_alumno
  FROM alumnos_personal AS aper

  UNION ALL 

  SELECT id_alumno
  FROM alumnos_primaria AS apri

  UNION ALL

  SELECT id_alumno
  FROM alumnos_secundaria AS ase

  UNION ALL

  SELECT id_alumno
  FROM alumnos_preparatoria AS apre

  UNION ALL

  SELECT id_alumno
  FROM alumnos_universidad AS au
) AS subquery";
$resultalumnos = mysqli_query($conexion, $sqlalumnos);
$filaalumnos = mysqli_fetch_assoc($resultalumnos);

//Contar docentes
$sqldocentes = "SELECT COUNT(id_docente) id_docente
FROM (
  SELECT id_docente
  FROM docentes_personal AS aper

  UNION ALL

  SELECT id_docente
  FROM docentes_primaria AS apri

  UNION ALL

  SELECT id_docente
  FROM docentes_secundaria AS ase

  UNION ALL

  SELECT id_docente
  FROM docentes_preparatoria AS apre

  UNION ALL

  SELECT id_docente
  FROM docentes_universidad AS au
) AS subquery";
$resultdocentes = mysqli_query($conexion, $sqldocentes);
$filadocentes = mysqli_fetch_assoc($resultdocentes);

//Contar usuarios
$sqlusuarios = "SELECT COUNT(id_admin) id_admin FROM admin";
$resultusuarios = mysqli_query($conexion, $sqlusuarios);
$filausuarios = mysqli_fetch_assoc($resultusuarios);

//Contar visitas
$sqlvisitas = "SELECT COUNT(id_conexion) total_conexiones
FROM conexiones";
$resultvisitas = mysqli_query($conexion, $sqlvisitas);
$filavisitas = mysqli_fetch_assoc($resultvisitas);

//Contar cuentas personales
$sqlpersonales = "SELECT COUNT(id_alumno) id_alumno FROM alumnos_personal";
$resultpersonales = mysqli_query($conexion, $sqlpersonales);
$filapersonales = mysqli_fetch_assoc($resultpersonales);

?>

<!DOCTYPE html>
<html lang="en">
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>


<title>KOUTILAB</title>
</head>

<!-- Header nav -->
<?php include 'header-nav.php'; ?>

<div class="containers">
    <h1>Estadísticas</h1>
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
                <div align="center" style="margin-top: 20px;">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <label for="fechaInicio" style="font-size: 13px; font-weight:bold;">De: </label>
                        <input type="date" name="fechaInicio" id="fechaInicioInstituciones" value="<?php echo $fechaInicio; ?>" style="margin-right: 50px; border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                        <label for="fechaFin" style="font-size: 13px; font-weight:bold;">A: </label>
                        <input type="date" name="fechaFin" id="fechaFinInstituciones" value="<?php echo $fechaFin; ?>" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                        <input type="hidden" name="id_user" name="id_user" value="<?php echo $id_user; ?>">
                        <br><br>
                        <input onclick="filtrarGInstituciones()" name="submitFecha" type="button" value="Filtrar" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); font-weight: bold; font-size: 15px; margin-bottom:0; padding-bottom: 0">
                    </form>
                </div>
            </div>
        </div>

        <div class="latd1">
            <div class="grafica">
                <canvas id="G-Escuelas" width="450" height="280"></canvas>
                <hr style="opacity: 10%;">
                <div class="info">
                    <li><i class='fas fa-school me-3'></i><b>Total de escuelas: </b><?php echo $filaescuelas['id_escuela']; ?></li>
                </div>
                <div align="center" style="margin-top: 20px;" class="form-ctn">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <label for="fechaInicio" style="font-size: 13px; font-weight:bold;">De: </label>
                        <input type="date" name="fechaInicio" id="fechaInicioEscuelas" value="<?php echo $fechaInicio; ?>" style="margin-right: 50px; border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                        <label for="fechaFin" style="font-size: 13px; font-weight:bold;">A: </label>
                        <input type="date" name="fechaFin" id="fechaFinEscuelas" value="<?php echo $fechaFin; ?>" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                        <input type="hidden" name="id_user" name="id_user" value="<?php echo $id_user; ?>">
                        <br><br>
                        <input onclick="filtrarGEscuelas()" name="submitFecha" type="button" value="Filtrar" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); font-weight: bold; font-size: 15px; margin-bottom:0; padding-bottom: 0">
                    </form>
                </div>
            </div>

        </div>
    </div>
    <script>
        function filtrarGInstituciones() {
            //here
            var fechaInicio = document.getElementById('fechaInicioInstituciones').value;
            var fechaFin = document.getElementById('fechaFinInstituciones').value;
            var id_user = <?php echo $id_user; ?>;
            var tipo = "instituciones";
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

                mostrarGInstituciones(data);

            });

        }

        function filtrarGEscuelas() {
            //here
            var fechaInicio = document.getElementById('fechaInicioEscuelas').value;
            var fechaFin = document.getElementById('fechaFinEscuelas').value;
            var id_user = <?php echo $id_user; ?>;
            var tipo = "escuelas";
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

                mostrarGEscuelas(data);

            });

        }

        function filtrarGAlumnos() {
            //here
            var fechaInicio = document.getElementById('fechaInicioAlumnos').value;
            var fechaFin = document.getElementById('fechaFinAlumnos').value;
            var id_user = <?php echo $id_user; ?>;
            var tipo = "alumnos";
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

                mostrarGAlumnos(data);

            });

        }

        function filtrarGProfesores() {
            //here
            var fechaInicio = document.getElementById('fechaInicioProfesores').value;
            var fechaFin = document.getElementById('fechaFinProfesores').value;
            var id_user = <?php echo $id_user; ?>;
            var tipo = "profesores";
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

                mostrarGProfesores(data);

            });

        }

        function filtrarGUsuarios() {
            //here
            var fechaInicio = document.getElementById('fechaInicioUsuarios').value;
            var fechaFin = document.getElementById('fechaFinUsuarios').value;
            var id_user = <?php echo $id_user; ?>;
            var tipo = "usuarios";
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

                mostrarGUsuarios(data);

            });

        }

        function filtrarGVisitas() {
            //here
            var fechaInicio = document.getElementById('fechaInicioVisitas').value;
            var fechaFin = document.getElementById('fechaFinVisitas').value;
            var id_user = <?php echo $id_user; ?>;
            var tipo = "visitas";
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

                mostrarGVisitas(data);

            });

        }

        function filtrarGAPersonales() {
            //here
            var fechaInicio = document.getElementById('fechaInicioAPersonales').value;
            var fechaFin = document.getElementById('fechaFinAPersonales').value;
            var id_user = <?php echo $id_user; ?>;
            var tipo = "APersonales";
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

                mostrarGAPersonales(data);

            });

        }

        function filtrarGCursos() {
            //here
            var fechaInicio = document.getElementById('fechaInicioCursos').value;
            var fechaFin = document.getElementById('fechaFinCursos').value;
            var id_user = <?php echo $id_user; ?>;
            var tipo = "Cursos";
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

                mostrarGCursos(data);

            });

        }
    </script>
    <script>
        let graficaInstituciones;
        let graficaEscuelas;
        let graficaAlumnos;
        let graficaProfesores;
        let graficaUsuarios;
        let graficaVisitas;
        let graficaAPersonales;
        let graficaCursos

        function mostrarGInstituciones(data) {
            console.log(data);
            // Obtener el elemento canvas
            var canvas = document.getElementById('G-Instituciones');

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
            if (graficaInstituciones) {
                graficaInstituciones.destroy();
            }
            graficaInstituciones = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Instituciones',
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

        function mostrarGEscuelas(data) {
            console.log(data);
            // Obtener el elemento canvas
            var canvas = document.getElementById('G-Escuelas');

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
            if (graficaEscuelas) {
                graficaEscuelas.destroy();
            }
            graficaEscuelas = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Escuelas',
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

        function mostrarGAlumnos(data) {
            console.log(data);
            // Obtener el elemento canvas
            var canvas = document.getElementById('G-Alumnos');

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
            if (graficaAlumnos) {
                graficaAlumnos.destroy();
            }
            graficaAlumnos = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Alumnos',
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

        function mostrarGProfesores(data) {
            console.log(data);
            // Obtener el elemento canvas
            var canvas = document.getElementById('G-Profesores');

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
            if (graficaProfesores) {
                graficaProfesores.destroy();
            }
            graficaProfesores = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Profesores',
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

        function mostrarGUsuarios(data) {
            console.log(data);
            // Obtener el elemento canvas
            var canvas = document.getElementById('G-Usuarios');

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
            if (graficaUsuarios) {
                graficaUsuarios.destroy();
            }
            graficaUsuarios = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Usuarios',
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

        function mostrarGVisitas(data) {
            console.log(data);
            // Obtener el elemento canvas
            var canvas = document.getElementById('G-Visitas');

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
            if (graficaVisitas) {
                graficaVisitas.destroy();
            }
            graficaVisitas = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Visitas',
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

        function mostrarGAPersonales(data) {
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
            if (graficaAPersonales) {
                graficaAPersonales.destroy();
            }
            graficaAPersonales = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Cuentas Personales',
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

        function mostrarGCursos(data) {
            console.log(data);
            // Obtener el elemento canvas
            var canvas = document.getElementById('G-Cursos');

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
            if (graficaCursos) {
                graficaCursos.destroy();
            }
            graficaCursos = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Cursos',
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            filtrarGInstituciones();
            filtrarGEscuelas();
            filtrarGAlumnos();
            filtrarGProfesores();
            filtrarGUsuarios();
            filtrarGVisitas();
            filtrarGAPersonales();
            filtrarGCursos();
        });
    </script>
    <div class="body" style="margin-top: -20px;">
        <div class="latd">
            <div class="grafica">
                <canvas id="G-Alumnos" width="450" height="280"></canvas>
                <hr style="opacity: 10%;">
                <div class="info">
                    <li><i class='fa-solid fa-school me-3'></i><b>Total de alumnos: </b><?php echo $filaalumnos['id_alumno']; ?></li>
                </div>
                <div align="center" style="margin-top: 20px;">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <label for="fechaInicio" style="font-size: 13px; font-weight:bold;">De: </label>
                        <input type="date" name="fechaInicio" id="fechaInicioAlumnos" value="<?php echo $fechaInicio; ?>" style="margin-right: 50px; border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                        <label for="fechaFin" style="font-size: 13px; font-weight:bold;">A: </label>
                        <input type="date" name="fechaFin" id="fechaFinAlumnos" value="<?php echo $fechaFin; ?>" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                        <input type="hidden" name="id_user" name="id_user" value="<?php echo $id_user; ?>">
                        <br><br>
                        <input onclick="filtrarGAlumnos()" name="submitFecha" type="button" value="Filtrar" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); font-weight: bold; font-size: 15px; margin-bottom:0; padding-bottom: 0">
                    </form>
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
                <div align="center" style="margin-top: 20px;">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <label for="fechaInicio" style="font-size: 13px; font-weight:bold;">De: </label>
                        <input type="date" name="fechaInicio" id="fechaInicioProfesores" value="<?php echo $fechaInicio; ?>" style="margin-right: 50px; border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                        <label for="fechaFin" style="font-size: 13px; font-weight:bold;">A: </label>
                        <input type="date" name="fechaFin" id="fechaFinProfesores" value="<?php echo $fechaFin; ?>" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                        <input type="hidden" name="id_user" name="id_user" value="<?php echo $id_user; ?>">
                        <br><br>
                        <input onclick="filtrarGProfesores()" name="submitFecha" type="button" value="Filtrar" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); font-weight: bold; font-size: 15px; margin-bottom:0; padding-bottom: 0">
                    </form>
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
                    <li><i class='fa-solid fa-school me-3'></i><b>Total de usuarios: </b><?php echo $filausuarios['id_admin']; ?></li>
                </div>
                <div align="center" style="margin-top: 20px;">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <label for="fechaInicio" style="font-size: 13px; font-weight:bold;">De: </label>
                        <input type="date" name="fechaInicio" id="fechaInicioUsuarios" value="<?php echo $fechaInicio; ?>" style="margin-right: 50px; border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                        <label for="fechaFin" style="font-size: 13px; font-weight:bold;">A: </label>
                        <input type="date" name="fechaFin" id="fechaFinUsuarios" value="<?php echo $fechaFin; ?>" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                        <input type="hidden" name="id_user" name="id_user" value="<?php echo $id_user; ?>">
                        <br><br>
                        <input onclick="filtrarGUsuarios()" name="submitFecha" type="button" value="Filtrar" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); font-weight: bold; font-size: 15px; margin-bottom:0; padding-bottom: 0">
                    </form>
                </div>
            </div>
        </div>

        <div class="latd1">
            <div class="grafica">
                <canvas id="G-Visitas" width="450" height="280"></canvas>
                <hr style="opacity: 10%;">
                <div class="info">
                    <li><i class='fa-solid fa-school me-3'></i><b>Total de visitas: </b><?php echo $filavisitas['total_conexiones']; ?></li> <!--Esta grafica aun no-->
                </div>
                <div align="center" style="margin-top: 20px;">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <label for="fechaInicio" style="font-size: 13px; font-weight:bold;">De: </label>
                        <input type="date" name="fechaInicio" id="fechaInicioVisitas" value="<?php echo $fechaInicio; ?>" style="margin-right: 50px; border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                        <label for="fechaFin" style="font-size: 13px; font-weight:bold;">A: </label>
                        <input type="date" name="fechaFin" id="fechaFinVisitas" value="<?php echo $fechaFin; ?>" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                        <input type="hidden" name="id_user" name="id_user" value="<?php echo $id_user; ?>">
                        <br><br>
                        <input onclick="filtrarGVisitas()" name="submitFecha" type="button" value="Filtrar" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); font-weight: bold; font-size: 15px; margin-bottom:0; padding-bottom: 0">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="body" style="margin-top: -20px;">
        <!--<div class="latd">
            <div class="grafica">
                <canvas id="G-Familias" width="470" height="280"></canvas>
                <hr style="opacity: 10%;">
                <div class="info">
                    <li><i class='fa-solid fa-school me-3'></i><b>Total de planes familiares: </b>0</li>--> <!--Esta grafica aun no-->
                <!--</div>
                <div align="center" style="margin-top: 20px;">
                    <form method="POST" action="<?php //echo $_SERVER['PHP_SELF']; ?>">
                        <label for="fechaInicio" style="font-size: 13px; font-weight:bold;">De: </label>
                        <input type="date" name="fechaInicio" id="fechaInicioFamiliares" value="<?php //echo $fechaInicio; ?>" style="margin-right: 50px; border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                        <label for="fechaFin" style="font-size: 13px; font-weight:bold;">A: </label>
                        <input type="date" name="fechaFin" id="fechaFinFamiliares" value="<?php //echo $fechaFin; ?>" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                        <input type="hidden" name="id_user" name="id_user" value="<?php //echo $id_user; ?>">
                        <br><br>
                        <input onclick="filtrarGFamiliares()" name="submitFecha" type="button" value="Filtrar" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); font-weight: bold; font-size: 15px; margin-bottom:0; padding-bottom: 0">
                    </form>
                </div>
            </div>
        </div>-->
        <div class="latd">
            <div class="grafica">
                <canvas id="G-Cursos" width="470" height="280"></canvas>
                <hr style="opacity: 10%;">
                <div class="info">
                    <li><i class='fa-solid fa-school me-3'></i><b>Curso más utilizado: </b>-</li> <!--Esta grafica aun no-->
                </div>
                <div align="center" style="margin-top: 20px;">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <label for="fechaInicio" style="font-size: 13px; font-weight:bold;">De: </label>
                        <input type="date" name="fechaInicio" id="fechaInicioCursos" value="<?php echo $fechaInicio; ?>" style="margin-right: 50px; border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                        <label for="fechaFin" style="font-size: 13px; font-weight:bold;">A: </label>
                        <input type="date" name="fechaFin" id="fechaFinCursos" value="<?php echo $fechaFin; ?>" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                        <input type="hidden" name="id_user" name="id_user" value="<?php echo $id_user; ?>">
                        <br><br>
                        <input onclick="filtrarGCursos()" name="submitFecha" type="button" value="Filtrar" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); font-weight: bold; font-size: 15px; margin-bottom:0; padding-bottom: 0">
                    </form>
                </div>
            </div>
        </div>
        <div class="latd1">
            <div class="grafica">
                <canvas id="G-Personales" width="450" height="280"></canvas>
                <hr style="opacity: 10%;">
                <div class="info">
                    <li><i class='fa-solid fa-school me-3'></i><b>Total de cuentas personales: </b><?php echo $filapersonales['id_alumno']; ?></li> <!--Esta grafica aun no-->
                </div>
                <div align="center" style="margin-top: 20px;">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <label for="fechaInicio" style="font-size: 13px; font-weight:bold;">De: </label>
                        <input type="date" name="fechaInicio" id="fechaInicioAPersonales" value="<?php echo $fechaInicio; ?>" style="margin-right: 50px; border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                        <label for="fechaFin" style="font-size: 13px; font-weight:bold;">A: </label>
                        <input type="date" name="fechaFin" id="fechaFinAPersonales" value="<?php echo $fechaFin; ?>" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
                        <input type="hidden" name="id_user" name="id_user" value="<?php echo $id_user; ?>">
                        <br><br>
                        <input onclick="filtrarGAPersonales()" name="submitFecha" type="button" value="Filtrar" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); font-weight: bold; font-size: 15px; margin-bottom:0; padding-bottom: 0">
                    </form>
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
    var ctx = document.getElementById('G-Familias');
    var Familias = new Chart(ctx, {
        type: 'bar',
                data: {
                    labels: [],
            datasets: [{
                label: 'Familias',
                data: [],
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
</script>

<script>/*
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
*/</script>

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