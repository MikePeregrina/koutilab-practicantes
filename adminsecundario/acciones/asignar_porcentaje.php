<?php
session_start();
$id_user = $_SESSION['id_admin_secundario'];
if (empty($_SESSION['active']) || empty($_SESSION['id_admin_secundario'])) {
    header('location: ../acciones/cerrarsesion.php');
}
include('../../acciones/conexion.php');

$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM admin_secundario WHERE id_admin_secundario = $id_user"));


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
    <?php
    require "../../acciones/conexion.php";

    if (!empty($_POST)) {
        $alert = "";
        if (empty($_POST['nombre_escuela']) || empty($_POST['cct']) || empty($_POST['nombre_director'])) {
            $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
        } else {
            $idescuela = $_GET['id'];
            $porcentaje = $_POST['porcentaje'];
            $sql_update = mysqli_query($conexion, "UPDATE escuelas SET porcentaje_ganancias = '$porcentaje' WHERE id_escuela = $idescuela");
            $alert = '<div class="alert alert-success" role="alert">Escuela actualizada</div>';
        }
    }

    // Mostrar Datos

    if (empty($_REQUEST['id'])) {
        header("Location: ../../adminsecundario/escuelas.php");
    }
    $idescuela = $_REQUEST['id'];
    $sql = mysqli_query($conexion, "SELECT * FROM escuelas WHERE id_escuela = '$idescuela'");
    $result_sql = mysqli_num_rows($sql);

    if ($result_sql == 0) {
        header("Location: ../../adminsecundario/escuelas.php");
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
            $id_user = $data['id_admin_secundario'];
            $clave_director = $data['clave_director'];
            $clave_docente = $data['clave_docente'];
            $clave_alumno = $data['clave_alumno'];
            $porcentaje_asignado = $data['porcentaje_ganancias'];
        }
    }
    ?>


    <div class="containers">
        <h1>Asignar porcentaje escuela</h1>
    </div>


    <section>
        <div class="contenedor-emergente">
            <form class="" action="" method="post" style="box-shadow: none;">
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
                        <span class="details">Nivel educativo</span>
                        <input type="text" name="pais" id="pais" value="<?php echo $nivel_educativo; ?>" readonly>
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
                        <span class="details">Porcentaje de ganancias</span>
                        <input type="text" name="porcentaje_asignado" id="porcentaje_asignado" value="<?php echo $porcentaje_asignado . ' %'; ?>" readonly>
                    </div>
                    <div class="input-box">
                        <span class="details">Asignar porcentaje</span>
                        <input type="range" id="porcentajeRange" name="porcentaje" min="0" max="100" step="1" value="50">
                        <span id="porcentajeValor">50%</span>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                    <a href="../escuelas.php" class="btn btn-danger">Atrás</a>
            </form>
        </div>

    </section>
    <?php include '../footer.php'; ?>

    <!--Script para manejar el porcentaje-->
    <script>
        const porcentajeRange = document.getElementById('porcentajeRange');
        const porcentajeValor = document.getElementById('porcentajeValor');

        porcentajeRange.addEventListener('input', () => {
            const porcentaje = porcentajeRange.value;
            porcentajeValor.innerText = porcentaje + '%';
        });
    </script>
</body>