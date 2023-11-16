<?php
include "../../acciones/conexion.php";
session_start();
$id_user = $_SESSION['id_docente_primaria'];
// Validar datos
if (empty($_REQUEST['id'])) {
    header("Location: ../../docente-primaria/grupos.php");
}
//Estadisticas
$idgrupo = $_REQUEST['id'];
$query1 = mysqli_query($conexion, "SELECT * FROM grupos_primaria WHERE id_grupo = $idgrupo");
$data1 = mysqli_fetch_assoc($query1);
$result_sql = mysqli_num_rows($query1);
if ($result_sql == 0) {
    header("Location: ../../docente-primaria/grupos.php");
}

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png">
    <link rel="stylesheet" href="css/showgroup.css">

    <link rel="stylesheet" href="../css/footer.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">

</head>

<body>
    <div class="containers">
        <h1>Lista de alumnos y puntajes</h1>
    </div>

    <section class="modal-1" id="modalPW">
        <div class="modal-1container">
            <div class="close-modal1" id="closeModalPW"><i class="fas fa-times"></i></div>
            <div class="titl">
                <h1>Resumen de programación web por niveles</h1>
            </div>
            <div class="res">
                <h2>Estadísticas totales</h2>
                <div class="estd">
                    <h3>Trofeos: 100</h3>
                    <h3>Puntaje: 100</h3>
                    <h3>Práctico: 100</h3>
                    <h3>Teórico: 100</h3>
                </div>
            </div>
            <hr style="background-color: rgba(61, 171, 244, 0.5); width: 90%; margin: 30px auto 0 auto;">
            <div class="cont-card">
                <div class="cardC">
                    <h3>Básico</h3>
                    <div class="estd1">
                        <h2>Trofeos: 100/N</h2>
                        <h2>Puntaje: 100/N</h2>
                        <h2>Práctico: 100/N</h3>
                            <h2>Teórico: 100/N</h2>
                    </div>
                </div>
                <div class="cardC">
                    <h3>Intermedio</h3>
                    <div class="estd1">
                        <h2>Trofeos: 100/N</h2>
                        <h2>Puntaje: 100/N</h2>
                        <h2>Práctico: 100/N</h3>
                            <h2>Teórico: 100/N</h2>
                    </div>
                </div>
                <div class="cardC">
                    <h3>Avanzado</h3>
                    <div class="estd1">
                        <h2>Trofeos: 100/N</h2>
                        <h2>Puntaje: 100/N</h2>
                        <h2>Práctico: 100/N</h3>
                            <h2>Teórico: 100/N</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="modal-1" id="modalPY">
        <div class="modal-1container">
            <div class="close-modal1" id="closeModalPY"><i class="fas fa-times"></i></div>
            <div class="titl">
                <h1>Resumen de python por niveles</h1>
            </div>
            <div class="res">
                <h2>Estadísticas totales</h2>
                <div class="estd">
                    <h3>Trofeos: 100</h3>
                    <h3>Puntaje: 100</h3>
                    <h3>Práctico: 100</h3>
                    <h3>Teórico: 100</h3>
                </div>
            </div>
            <hr style="background-color: rgba(61, 171, 244, 0.5); width: 90%; margin: 30px auto 0 auto;">
            <div class="cont-card">
                <div class="cardC">
                    <h3>Básico</h3>
                    <div class="estd1">
                        <h2>Trofeos: 100/N</h2>
                        <h2>Puntaje: 100/N</h2>
                        <h2>Práctico: 100/N</h3>
                            <h2>Teórico: 100/N</h2>
                    </div>
                </div>
                <div class="cardC">
                    <h3>Intermedio</h3>
                    <div class="estd1">
                        <h2>Trofeos: 100/N</h2>
                        <h2>Puntaje: 100/N</h2>
                        <h2>Práctico: 100/N</h3>
                            <h2>Teórico: 100/N</h2>
                    </div>
                </div>
                <div class="cardC">
                    <h3>Avanzado</h3>
                    <div class="estd1">
                        <h2>Trofeos: 100/N</h2>
                        <h2>Puntaje: 100/N</h2>
                        <h2>Práctico: 100/N</h3>
                            <h2>Teórico: 100/N</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section>
        <div class="board p-2" style="width: 95%;">
            <table id="alumnos" width="100%" class="table border-top">
                <thead>
                    <tr>
                        <td><b>Nombre</b></td>
                        <td><b>Nivel educativo</b></td>
                        <td><b>Grado escolar</b></td>
                        <td><b>Programación web básico</b></td>
                        <td><b>Programación web intermedio</b></td>
                        <td><b>Programación web avanzado</b></td>
                        <td><b>Python básico</b></td>
                        <td><b>Python intermedio</b></td>
                        <td><b>Python avanzado</b></td>
                        <td><b>Informática básico</b></td>
                        <td><b>Informática intermedio</b></td>
                        <td><b>Informática avanzado</b></td>
                        <td><b>Conexiones</b></td>
                        <td><b></b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../../acciones/conexion.php";
                    $alumnos = array(); // Almacena los IDs de los alumnos para evitar repeticiones

                    // Arreglo de máximos por curso
                    $maximos_por_curso = array(
                        "1" => array(
                            "trofeos" => 200,
                            "teoricos" => 200,
                            "practicos" => 200,
                            "evaluativos" => 20
                        ),
                        "2" => array(
                            "trofeos" => 210,
                            "teoricos" => 210,
                            "practicos" => 210,
                            "evaluativos" => 30
                        ),
                        "3" => array(
                            "trofeos" => 200,
                            "teoricos" => 200,
                            "practicos" => 200,
                            "evaluativos" => 20
                        ),
                        "4" => array(
                            "trofeos" => 200,
                            "teoricos" => 200,
                            "practicos" => 200,
                            "evaluativos" => 20
                        ),
                        "5" => array(
                            "trofeos" => 200,
                            "teoricos" => 200,
                            "practicos" => 200,
                            "evaluativos" => 20
                        ),
                        "6" => array(
                            "trofeos" => 200,
                            "teoricos" => 200,
                            "practicos" => 200,
                            "evaluativos" => 20
                        ),
                        "7" => array(
                            "trofeos" => 200,
                            "teoricos" => 200,
                            "practicos" => 200,
                            "evaluativos" => 20
                        ),
                        "8" => array(
                            "trofeos" => 200,
                            "teoricos" => 200,
                            "practicos" => 200,
                            "evaluativos" => 20
                        ),
                        "9" => array(
                            "trofeos" => 200,
                            "teoricos" => 200,
                            "practicos" => 200,
                            "evaluativos" => 20
                        )
                    );

                    $query_grupo = mysqli_query($conexion, "SELECT a.id_alumno, a.nombre, a.grado_escolar, a.conexiones, 
                    e.id_curso,
                    SUM(e.trofeos) as total_trofeos, 
                    SUM(e.puntos) as total_puntos, 
                    SUM(e.practico) as total_practico, 
                    SUM(e.teorico) as total_teorico
                FROM estadisticas_primaria e
                JOIN alumnos_primaria a ON e.id_alumno = a.id_alumno
                JOIN detalle_grupos_primaria dg ON dg.id_alumno = a.id_alumno
                WHERE dg.id_grupo = '$idgrupo'
                GROUP BY a.id_alumno, a.nombre, a.grado_escolar, e.id_curso;");

                    if (mysqli_num_rows($query_grupo) > 0) {
                        $alumnos = array(); // Almacena los IDs de los alumnos para evitar repeticiones

                        while ($data = mysqli_fetch_assoc($query_grupo)) {
                            $alumno_id = $data['id_alumno'];

                            // Si es la primera vez que se encuentra este alumno, crear una entrada en el arreglo
                            if (!array_key_exists($alumno_id, $alumnos)) {
                                $alumnos[$alumno_id] = array(
                                    'nombre' => $data['nombre'],
                                    'id_alumno' => $data['id_alumno'],
                                    'grado_escolar' => $data['grado_escolar'],
                                    'conexiones' => $data['conexiones'],
                                    'cursos' => array()
                                );
                            }

                            // Agregar los datos del curso actual al arreglo de cursos del alumno
                            $curso_id = $data['id_curso'];
                            $cursos = &$alumnos[$alumno_id]['cursos'];

                            $curso_data = array(
                                "trofeos" => $data['total_trofeos'],
                                "teoricos" => $data['total_teorico'],
                                "practicos" => $data['total_practico'],
                                "evaluativos" => $data['total_puntos']
                            );

                            $maximos = $maximos_por_curso[$curso_id];
                            $promedio = ($curso_data['teoricos'] + $curso_data['practicos'] + $curso_data['evaluativos'] + $curso_data['trofeos']) / 4;
                            $resultado = round(($promedio / ($maximos['trofeos'] + $maximos['teoricos'] + $maximos['practicos'] + $maximos['evaluativos'])) * 10, 2);

                            $cursos[$curso_id] = "$resultado/10";
                        }

                        // Mostrar los datos pivotados en la tabla
                        foreach ($alumnos as $alumno) {
                    ?>
                            <tr>
                                <td><?php echo $alumno['nombre']; ?></td>
                                <td>primaria</td>
                                <td><?php echo $alumno['grado_escolar']; ?></td>
                                <?php
                                // Mostrar los resultados por curso
                                for ($i = 1; $i <= 9; $i++) {
                                    if (array_key_exists($i, $alumno['cursos'])) {
                                        echo "<td>" . $alumno['cursos'][$i] . "</td>";
                                    } else {
                                        echo "<td>-</td>";
                                    }
                                }
                                ?>
                                <td><?php echo $alumno['conexiones']; ?></td>
                                <td id="td-group">
                                    <a href="mostrar_alumno.php?id=<?php echo $alumno['id_alumno']; ?>" class="btn btn-info" id="btn-group"><i class='fas fa-clipboard-list' style="color: white;" id="i-group"></i></a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="11">No hay registros disponibles</td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>




            </table>
            <a href="../grupos.php" class="btn btn-danger">Atrás</a>
        </div>
    </section>
    <?php include '../footer.php'; ?>

    <script>
        const openModal = document.getElementById('infoPWButton');
        const modalPW = document.getElementById('modalPW');
        const closeModal = document.getElementById('closeModalPW');

        openModal.addEventListener('click', () => {
            modalPW.style.cssText = 'opacity: 1; pointer-events: unset; transition: opacity .5s;';
        });

        closeModal.addEventListener('click', () => {
            modalPW.style.cssText = 'opacity: 0; pointer-events: none;  transition: opacity .5s;';
        });
    </script>

    <script>
        const openModalPY = document.getElementById('infoPYButton');
        const modalPY = document.getElementById('modalPY');
        const closeModalPY = document.getElementById('closeModalPY');

        openModalPY.addEventListener('click', () => {
            modalPY.style.cssText = 'opacity: 1; pointer-events: unset;  transition: opacity .5s;';
        });

        closeModalPY.addEventListener('click', () => {
            modalPY.style.cssText = 'opacity: 0; pointer-events: none;  transition: opacity .5s;';
        });
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#alumnos').DataTable({
                responsive: true,
                autoWidth: false,
                lengthChange: false,
                searching: false,
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


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bulma.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.bulma.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>

</body>