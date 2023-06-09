<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png">
    <link rel="stylesheet" href="../css/alumnos.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bulma.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-image: url(../img/bg1.png); padding-top: 10px; padding-bottom: 300px;">
    <?php
    require "../../acciones/conexion.php";
    session_start();
    $id_user = $_SESSION['id_docente_universidad'];
    // Validar datos
    if (empty($_REQUEST['id'])) {
        header("Location: ../../docente/alumnos.php");
    }
    //Estadisticas
    $idalumno = $_REQUEST['id'];
    $query1 = mysqli_query($conexion, "SELECT * FROM estadisticas WHERE id_alumno = $idalumno");
    $data1 = mysqli_fetch_assoc($query1);
    $result_sql = mysqli_num_rows($query1);
    if ($result_sql == 0) {
        header("Location: ../../docente/alumnos.php");
    }

    ?>

    <div class="d-flex justify-content-center" style="margin-bottom: 35px;">
        <div class="values" style="width: 98%; margin-left: 52px;">
            <h3 class="i-name">Puntaje del alumno</h3>
        </div>
    </div>

    <div class="d-flex justify-content-center" style="margin-top: -50px;">
        <div class="board p-4" style="width: 90%;">
            <table id="alumnos" width="100%" class="table border-top">
                <thead>
                    <tr>
                        <td><b></b></td>
                        <td><b>Programación web básica</b></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <h5>Trofeos</h5>
                        </td>
                        <td>
                            <h5><?php echo $data1["trofeos"] ?></h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>Puntaje</h5>
                        </td>
                        <td>
                            <h5><?php echo $data1["puntos"] ?></h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>Práctico</h5>
                        </td>
                        <td>
                            <h5><?php echo $data1["practico"] ?></h5>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <h5>Teorico</h5>
                        </td>
                        <td>
                            <h5><?php echo $data1["teorico"] ?></h5>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a href="../alumnos.php" class="btn btn-danger">Atrás</a>
        </div>
    </div>
</body>