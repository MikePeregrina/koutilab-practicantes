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

<body style="background-image: url(../img/bg1.png); padding-top: 0px; padding-bottom: 160px;">
    <?php
    require "../../acciones/conexion.php";

    if (!empty($_POST)) {
        $alert = "";
        if (empty($_POST['materia']) || empty($_POST['nombre_grupo']) || empty($_POST['grado'])) {
            $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
        } else {
            $idgrupo = $_GET['id'];
            $materia = $_POST['materia'];
            $nombregrupo = $_POST['nombre_grupo'];
            $grado = $_POST['grado'];
            $sql_update = mysqli_query($conexion, "UPDATE grupos_primaria SET materia = '$materia', nombre_grupo = '$nombregrupo' , grado = '$grado' WHERE id_grupo = $idgrupo");
            $alert = '<div class="alert alert-success" role="alert">Grupo actualizado</div>';
        }
    }

    // Mostrar Datos

    if (empty($_REQUEST['id'])) {
        header("Location: ../../docente/grupos.php");
    }
    $idgrupo = $_REQUEST['id'];
    $sql = mysqli_query($conexion, "SELECT * FROM grupos_primaria WHERE id_grupo = '$idgrupo'");
    $result_sql = mysqli_num_rows($sql);

    //Seleccionar grado
    $query = "SELECT grado FROM grupos_primaria WHERE id_docente = $idgrupo";
    $result = $conexion->query($query);
    if ($result->num_rows > 0) {
        $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    if ($result_sql == 0) {
        header("Location: ../../docente/grupos.php");
    } else {
        if ($data = mysqli_fetch_array($sql)) {
            $idgrupo = $data['id_grupo'];
            $materia = $data['materia'];
            $nombregrupo = $data['nombre_grupo'];
            $grado = $data['grado'];
        }
    }
    ?>

    <div class="row">
        <div class="col-md-7 mx-auto">
            <div class="container1" style="margin-top: 30px;">
                <div class="board" style="padding: 10px; margin-left: 7px; text-align:center; width: 98%;">
                    <h3 class="i-name">Editar grupo</h3>
                </div>
                <form class="" action="" method="post">
                    <div class="user-details1">

                        <?php echo isset($alert) ? $alert : ''; ?> <input type="hidden" name="id" value="<?php echo $idgrupo; ?>">

                        <div class="input-box1">
                            <span class="details">Matería</span>
                            <input type="text" name="materia" id="materia" value="<?php echo $materia; ?>" required>
                        </div>

                        <div class="input-box1">
                            <span class="details">Nombre grupo</span>
                            <input type="text" name="nombre_grupo" id="nombre_grupo" value="<?php echo $nombregrupo; ?>" required>
                        </div>

                        <div class="input-box1">
                            <span class="details">Grado escolar: </span>
                            <select style="height: 44px;" name="grado" type="select" required>
                                <option><?php echo $grado; ?></option>
                                <option value="1°">1°</option>
                                <option value="2°">2°</option>
                                <option value="3°">3°</option>
                                <option value="4°">4°</option>
                                <option value="5°">5°</option>
                                <option value="6°">6°</option>
                            </select>
                        </div>

                    </div>

                    <br>
                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                    <a href="../grupos.php" class="btn btn-danger">Atrás</a>
                </form>

            </div>

        </div>
    </div>

</body>