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
    <link rel="stylesheet" href="../css/administradores.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bulma.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-image: url(../img/bg1.png); padding-top: 30px; padding-bottom: 140px;">
    <?php
    require "../../acciones/conexion.php";

    if (!empty($_POST)) {
        $alert = "";
        if (empty($_POST['usuario']) || empty($_POST['nombre'])) {
            $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
        } else if (($_POST['usuario']) && ($_POST['nombre']) && empty($_POST['contrasena'])) {
            $idadmin = $_GET['id'];
            $usuario = $_POST['usuario'];
            $nombre = $_POST['nombre'];
            $pais = $_POST['pais'];
            $id_user = $_SESSION['id_admin'];
            $sql_update = mysqli_query($conexion, "UPDATE admin SET usuario = '$usuario', nombre = '$nombre', pais = '$pais' WHERE id_admin = $idadmin");
            $alert = '<div class="alert alert-success" role="alert">Administrador actualizado</div>';
        } else if (($_POST['usuario']) && ($_POST['nombre']) && ($_POST['contrasena'])) {
            $idadmin = $_GET['id'];
            $usuario = $_POST['usuario'];
            $nombre = $_POST['nombre'];
            $pais = $_POST['pais'];
            $contrasena = md5($_POST['contrasena']);
            $id_user = $_SESSION['id_admin'];
            $sql_update = mysqli_query($conexion, "UPDATE admin SET usuario = '$usuario', nombre = '$nombre', contrasena = '$contrasena', pais = '$pais' WHERE id_admin = $idadmin");
            $alert = '<div class="alert alert-success" role="alert">Administrador actualizado</div>';
        }
    }

    // Mostrar Datos

    if (empty($_REQUEST['id'])) {
        header("Location: ../../admin/administradores.php");
    }
    $idadmin = $_REQUEST['id'];
    $sql = mysqli_query($conexion, "SELECT * FROM admin WHERE id_admin = '$idadmin'");
    $result_sql = mysqli_num_rows($sql);

    if ($result_sql == 0) {
        header("Location: ../../admin/administradores.php");
    } else {
        if ($data = mysqli_fetch_array($sql)) {
            $idadmin = $data['id_admin'];
            $usuario = $data['usuario'];
            $nombre = $data['nombre'];
            $contrasena = $data['contrasena'];
            $pais = $data['pais'];
        }
    }
    ?>
    <div class="row">
        <div class="col-md-7 mx-auto">
            <div class="container">
                <div class="board" style="padding: 10px; margin-left: 7px; text-align:center; width: 98%;">
                    <h3 class="i-name">Editar administrador</h3>
                </div>
                <form class="" action="" method="post">
                    <div class="user-details">
                        <?php echo isset($alert) ? $alert : ''; ?> <input type="hidden" name="id" value="<?php echo $idadmin; ?>">
                        <div class="input-box">
                            <span class="details">Usuario</span>
                            <input type="text" name="usuario" id="usuario" value="<?php echo $usuario; ?>" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Nombre</span>
                            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Contraseña</span>
                            <input type="text" name="contrasena" id="contrasena" value="">
                        </div>
                        <div class="input-box">
                            <span class="details">País</span>
                            <select name="pais" type="select" style="height: 44px;" required>
                                <option><?php echo $pais; ?></option>
                                <option value="Estados Unidos">Estados Unidos</option>
                                <option value="México">México</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Perú">Perú</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                    <a href="../administradores.php" class="btn btn-danger">Atrás</a>
                </form>
            </div>
        </div>
    </div>
</body>