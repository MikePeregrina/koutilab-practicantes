<?php
session_start();
$id_user = $_SESSION['id_admin'];
if (empty($_SESSION['active']) || empty($_SESSION['id_admin'])) {
    header('location: ../acciones/cerrarsesion.php');
}
include('../../acciones/conexion.php');

$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM admin WHERE id_admin = $id_user"));

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png">
    <link rel="stylesheet" href="../css/escuelas.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bulma.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-image: url(../img/bg1.png); padding-top: 10px; padding-bottom: 30px;">
    <?php
    require "../../acciones/conexion.php";

    if (!empty($_POST)) {
        $alert = "";
        if (empty($_POST['nombre_escuela']) || empty($_POST['cct']) || empty($_POST['nombre_director'])) {
            $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
        } else {
            $idescuela = $_GET['id'];
            $nombre_escuela = $_POST['nombre_escuela'];
            $cct = $_POST['cct'];
            $nombre_director = $_POST['nombre_director'];
            $calle = $_POST['calle'];
            $num_exterior = $_POST['num_exterior'];
            $estado = $_POST['estado'];
            $pais = $_POST['pais'];
            $codigo_postal = $_POST['codigo_postal'];
            $nivel_educativo = $_POST['nivel_educativo'];
            $autorizacion = $_POST['autorizacion'];
            $clave_director = $_POST['clave_director'];
            $clave_docente = $_POST['clave_docente'];
            $clave_alumno = $_POST['clave_alumno'];
            $id_user = $_SESSION['id_admin'];
            $sql_update = mysqli_query($conexion, "UPDATE escuelas SET nombre_escuela = '$nombre_escuela', cct = '$cct', nombre_director = '$nombre_director', calle = '$calle', num_exterior = '$num_exterior', estado = '$estado', codigo_postal = '$codigo_postal', nivel_educativo = '$nivel_educativo', pais = '$pais', autorizacion = '$autorizacion', id_admin = '$id_user' WHERE id_escuela = $idescuela");
            $alert = '<div class="alert alert-success" role="alert">Escuela actualizada</div>';
        }
    }

    // Mostrar Datos

    if (empty($_REQUEST['id'])) {
        header("Location: ../../admin/escuelas.php");
    }
    $idescuela = $_REQUEST['id'];
    $sql = mysqli_query($conexion, "SELECT * FROM escuelas WHERE id_escuela = '$idescuela'");
    $result_sql = mysqli_num_rows($sql);

    if ($result_sql == 0) {
        header("Location: ../../admin/escuelas.php");
    } else {
        if ($data = mysqli_fetch_array($sql)) {
            $idescuela = $data['id_escuela'];
            $nombre_escuela = $data['nombre_escuela'];
            $cct = $data['cct'];
            $nombre_director = $data['nombre_director'];
            $calle = $data['calle'];
            $num_exterior = $data['num_exterior'];
            $estado = $data['estado'];
            $pais = $data['pais'];
            $codigo_postal = $data['codigo_postal'];
            $nivel_educativo = $data['nivel_educativo'];
            $autorizacion = $data['autorizacion'];
            $id_user = $data['id_admin'];
            $clave_director = $data['clave_director'];
            $clave_docente = $data['clave_docente'];
            $clave_alumno = $data['clave_alumno'];
        }
    }
    ?>
    <div class="row">
        <div class="col-md-9 mx-auto">
            <div class="container" style="margin-top: -40px;">
                <div class="board" style="padding: 10px; margin-left: 7px; text-align:center; width: 98%;">
                    <h3 class="i-name">Datos de escuela</h3>
                </div>
                <form class="" action="" method="post">
                    <div class="user-details">
                        <?php echo isset($alert) ? $alert : ''; ?> <input type="hidden" name="id" value="<?php echo $idescuela; ?>">
                        <div class="input-box">
                            <span class="details">Escuela</span>
                            <input type="text" name="nombre_escuela" id="nombre_escuela" value="<?php echo $nombre_escuela; ?>" readonly>
                        </div>
                        <div class="input-box">
                            <span class="details">CCT</span>
                            <input type="text" name="cct" id="cct" value="<?php echo $cct; ?>" readonly>
                        </div>
                        <div class="input-box">
                            <span class="details">Director</span>
                            <input type="text" name="nombre_director" id="nombre_director" value="<?php echo $nombre_director; ?>" readonly>
                        </div>
                        <div class="input-box">
                            <span class="details">Quien autoriza</span>
                            <input type="text" name="estado" id="estado" value="<?php echo $autorizacion; ?>" readonly>
                        </div>
                        <div class="input-box">
                            <span class="details">Nivel educativo</span>
                            <input type="text" name="pais" id="pais" value="<?php echo $nivel_educativo; ?>" readonly>
                        </div>
                        <div class="input-box">
                            <span class="details">Clave director</span>
                            <input type="text" name="pais" id="pais" value="<?php echo $clave_director; ?>" readonly>
                        </div>
                        <div class="input-box">
                            <span class="details">Clave docente</span>
                            <input type="text" name="pais" id="pais" value="<?php echo $clave_docente; ?>" readonly>
                        </div>
                        <div class="input-box">
                            <span class="details">Clave alumno</span>
                            <input type="text" name="pais" id="pais" value="<?php echo $clave_alumno; ?>" readonly>
                        </div>
                        <div class="input-box">
                            <span class="details">País</span>
                            <input type="text" name="pais" id="pais" value="<?php echo $pais; ?>" readonly>
                        </div>
                        <div class="input-box">
                            <span class="details">Estado</span>
                            <input type="text" name="estado" id="estado" value="<?php echo $estado; ?>" readonly>
                        </div>
                        <div class="input-box">
                            <span class="details">Calle</span>
                            <input type="text" name="calle" id="calle" value="<?php echo $calle; ?>" readonly>
                        </div>
                        <div class="input-box">
                            <span class="details">Número exterior</span>
                            <input type="text" name="num_exterior" id="num_exterior" value="<?php echo $num_exterior; ?>" readonly>
                        </div>
                        <div class="input-box">
                            <span class="details">Código Postal</span>
                            <input type="text" name="codigo_postal" id="codigo_postal" value="<?php echo $codigo_postal; ?>" readonly>
                        </div>
                        <input type="hidden" name="autorizacion" placeholder="Nombre" value="<?php echo $user['nombre'] ?>">

                    </div>
                    <br>
                    <a href="../escuelas.php" class="btn btn-danger">Atrás</a>
                </form>
            </div>
        </div>
    </div>
</body>