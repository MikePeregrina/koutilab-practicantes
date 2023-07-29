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
        $sql_update = mysqli_query($conexion, "UPDATE grupos_universidad SET materia = '$materia', nombre_grupo = '$nombregrupo' , grado = '$grado' WHERE id_grupo = $idgrupo");
        $alert = '<div class="alert alert-success" role="alert">Grupo actualizado</div>';
    }
}

// Mostrar Datos

if (empty($_REQUEST['id'])) {
    header("Location: ../../docente-universidad/grupos.php");
}
$idgrupo = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM grupos_universidad WHERE id_grupo = '$idgrupo'");
$result_sql = mysqli_num_rows($sql);

//Seleccionar grado
$query = "SELECT grado FROM grupos_universidad WHERE id_docente = $idgrupo";
$result = $conexion->query($query);
if ($result->num_rows > 0) {
    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

if ($result_sql == 0) {
    header("Location: ../../docente-universidad/grupos.php");
} else {
    if ($data = mysqli_fetch_array($sql)) {
        $idgrupo = $data['id_grupo'];
        $materia = $data['materia'];
        $nombregrupo = $data['nombre_grupo'];
        $grado = $data['grado'];
    }
}
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png">
    <link rel="stylesheet" href="css/editar.css">
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
    <div class="containers">
        <h1>Editar grupos</h1>
    </div>


    <section>
        <div class="contenedor-emergente">
            <form class="" action="" method="post" style="box-shadow: none;">
                <div class="user-details">

                    <?php echo isset($alert) ? $alert : ''; ?> <input type="hidden" name="id" value="<?php echo $idgrupo; ?>">

                    <div class="input-box">
                        <span class="details">Matería</span>
                        <input type="text" name="materia" id="materia" value="<?php echo $materia; ?>" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Nombre grupo</span>
                        <input type="text" name="nombre_grupo" id="nombre_grupo" value="<?php echo $nombregrupo; ?>" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Grado escolar: </span>
                        <select style="height: 44px;" name="grado" type="select" required>
                            <option value="<?php echo $grado; ?>"><?php echo $grado; ?></option>
                            <option value="1°">1°</option>
                            <option value="2°">2°</option>
                            <option value="3°">3°</option>
                        </select>
                    </div>

                </div>

                <br>
                <div style="display: flex; text-align: center; justify-content: center; gap: 20px;">
                    <button type="submit" class="btn btn-success" style="width: 15%; height:40px; margin-top:0%"><i class="fas fa-check"></i></button>
                    <a href="../grupos.php" class="btn btn-danger" style="width: 15%; height:40px; padding:1%">Atrás</a>
                </div>
            </form>
        </div>

    </section>

    <?php include '../footer.php'; ?>
</body>