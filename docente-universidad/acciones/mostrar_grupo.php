<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png">
    <link rel="stylesheet" href="../css/alumnos.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.bulma.min.css">
</head>

<body style="background-image: url(../img/bg1.png); padding-top: 10px; padding-bottom: 300px;">
    <?php
    require "../../acciones/conexion.php";
    session_start();
    $id_user = $_SESSION['id_docente_universidad'];
    // Validar datos
    if (empty($_REQUEST['id'])) {
        header("Location: ../../docente-universidad/grupos.php");
    }
    //Estadisticas
    $idgrupo = $_REQUEST['id'];
    $query1 = mysqli_query($conexion, "SELECT * FROM grupos_universidad WHERE id_grupo = $idgrupo");
    $data1 = mysqli_fetch_assoc($query1);
    $result_sql = mysqli_num_rows($query1);
    if ($result_sql == 0) {
        header("Location: ../../docente-universidad/grupos.php");
    }

    ?>
    <div class="d-flex justify-content-center" style="margin-bottom: 35px;">
        <div class="values" style="width: 98%; margin-left: 52px;">
            <h3 class="i-name">Lista de alumnos y puntajes</h3>
        </div>
    </div>
    <div class="d-flex justify-content-center" style="margin-top: -50px;">
        <div class="board p-2" style="width: 90%;">
            <table id="alumnos" width="100%" class="table border-top">
                <thead>
                    <tr>
                        <td><b>Nombre</b></td>
                        <td><b>Grado escolar</b></td>
                        <td><b>Trofeos</b></td>
                        <td><b>Puntaje</b></td>
                        <td><b>Práctico</b></td>
                        <td><b>Teorico</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../../acciones/conexion.php";
                    $query_grupo = mysqli_query($conexion, "SELECT a.nombre, a.grado_escolar, e.trofeos, e.puntos, e.practico, e.teorico FROM estadisticas_universidad e
                JOIN alumnos_universidad a
                ON e.id_alumno = a.id_alumno
                JOIN detalle_grupos_universidad dg
                ON dg.id_alumno = a.id_alumno
                WHERE dg.id_grupo = '$idgrupo';");
                    $result = mysqli_num_rows($query_grupo);
                    if ($result > 0) {
                        while ($data = mysqli_fetch_assoc($query_grupo)) {
                    ?>
                            <tr>
                                <td><?php echo $data['nombre']; ?></td>
                                <td><?php echo $data['grado_escolar']; ?></td>
                                <td><?php echo $data['trofeos']; ?></td>
                                <td><?php echo $data['puntos']; ?></td>
                                <td><?php echo $data['practico']; ?></td>
                                <td><?php echo $data['teorico']; ?></td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
            <a href="../grupos.php" class="btn btn-danger">Atrás</a>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#alumnos').DataTable({
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
</body>