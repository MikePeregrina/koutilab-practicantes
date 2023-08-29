<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png">
    <link rel="stylesheet" href="../css/alumnos.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bulma.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    require "../../acciones/conexion.php";
    session_start();
    $id_user = $_SESSION['id_docente_universidad'];
    // Validar datos
    if (empty($_REQUEST['id'])) {
        header("Location: ../../docente-universidad/alumnos.php");
    }
    //Estadisticas
    $idalumno = $_REQUEST['id'];

    $query1 = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $idalumno");
    $result_sql = mysqli_num_rows($query1);
    if ($result_sql == 0) {
        header("Location: ../../docente-universidad/alumnos.php");
    }

    $query2 = mysqli_query($conexion, "SELECT DISTINCT e.id_curso, c.curso
                                   FROM estadisticas_universidad e
                                   JOIN cursos_universidad c ON e.id_curso = c.id_curso
                                   WHERE e.id_alumno = $idalumno");
    $cursos = mysqli_fetch_all($query2, MYSQLI_ASSOC);

    $query3 = mysqli_query($conexion, "SELECT * FROM alumnos_universidad WHERE id_alumno = $idalumno");
    $data3 = mysqli_fetch_assoc($query3);

    ?>

    <div class="containers">
        <h1>Puntaje del Alumno</h1>
    </div>
    <section>
        <div class="d-flex justify-content-center">
            <div class="board p-4" style="width: 90%;">
                <table id="alumnos" width="100%" class="table border-top">
                    <thead>
                        <tr>
                            <td><b></b></td>
                            <?php
                            foreach ($cursos as $curso) {
                                echo '<td><b>' . $curso["curso"] . '</b></td>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <h5>Conocimientos</h5>
                            </td>
                            <?php
                            foreach ($cursos as $curso) {
                                $queryCurso = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $idalumno AND id_curso = " . $curso["id_curso"]);
                                $dataCurso = mysqli_fetch_assoc($queryCurso);
                                echo '<td><h5>' . $dataCurso["teorico"] . '</h5></td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>
                                <h5>Coding</h5>
                            </td>
                            <?php
                            foreach ($cursos as $curso) {
                                $queryCurso = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $idalumno AND id_curso = " . $curso["id_curso"]);
                                $dataCurso = mysqli_fetch_assoc($queryCurso);
                                echo '<td><h5>' . $dataCurso["practico"] . '</h5></td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>
                                <h5>Logros</h5>
                            </td>
                            <?php
                            foreach ($cursos as $curso) {
                                $queryCurso = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $idalumno AND id_curso = " . $curso["id_curso"]);
                                $dataCurso = mysqli_fetch_assoc($queryCurso);
                                echo '<td><h5>' . $dataCurso["trofeos"] . '</h5></td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>
                                <h5>Destreza</h5>
                            </td>
                            <?php
                            foreach ($cursos as $curso) {
                                $queryCurso = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $idalumno AND id_curso = " . $curso["id_curso"]);
                                $dataCurso = mysqli_fetch_assoc($queryCurso);
                                echo '<td><h5>' . $dataCurso["puntos"] . '</h5></td>';
                            }
                            ?>
                        </tr>
                        <!-- <tr>
                            <td>
                                <h5>Conexiones</h5>
                            </td>
                            <?php
                            foreach ($cursos as $curso) {
                                echo '<td><h5>' . $data3["conexiones"] . '</h5></td>';
                            }
                            ?>
                        </tr> -->
                    </tbody>
                </table>
                <a href="../grupos.php" class="btn btn-danger">Atrás</a>
            </div>
        </div>
    </section>

    <?php include '../footer.php'; ?>
</body>