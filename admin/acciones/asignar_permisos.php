<?php
session_start();
$id_user = $_SESSION['id_admin'];
if (empty($_SESSION['active']) || empty($_SESSION['id_admin'])) {
    header('location: ../acciones/cerrarsesion.php');
}
include('../../acciones/conexion.php');

$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM admin WHERE id_admin = $id_user"));

?>
<?php
require "../../acciones/conexion.php";

if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['id_permiso'])) {
        $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
    } else {
        $idadmin = $_GET['id'];
        $id_permiso = $_POST['id_permiso'];
        $sql_update = mysqli_query($conexion, "INSERT INTO detalle_permisos_admin(id_permiso, id_admin) VALUES ('$id_permiso', '$idadmin')");
    }
}

// Mostrar Datos

if (empty($_REQUEST['id'])) {
    header("Location: ../../admin/administradores.php");
}
$idadmin = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM admin_secundario WHERE id_admin_secundario = '$idadmin'");
$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
    header("Location: ../../admin/administradores.php");
} else {
    if ($data = mysqli_fetch_array($sql)) {
        $idadmin = $data['id_admin_secundario'];
        $usuario = $data['usuario'];
        $nombre = $data['nombre'];
        $contrasena = $data['contrasena'];
        $pais = $data['pais'];
    }
}
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png">
    <link rel="stylesheet" href="css/asignar.css">
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
        <h1>Asignar permisos</h1>
    </div>


    <section>
        <div class="contenedor-emergente">
            <form class="" action="" method="post" style="box-shadow: none;">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Usuario</span>
                        <input type="text" name="usuario" id="usuario" value="<?php echo $usuario; ?>" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Nombre</span>
                        <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required>
                    </div>


                    <div class="board p-2">
                        <table id="admins" width="50px" class="table border-top" style="z-index: 3;">
                            <thead>
                                <tr>
                                    <td><b>Permisos asignados</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "../../acciones/conexion.php";
                                // Consulta SQL para obtener los permisos del administrador
                                $sql_asignados = "SELECT DISTINCT p.id_permisos, p.permiso
        FROM permisos_admin p
        INNER JOIN detalle_permisos_admin dp ON p.id_permisos = dp.id_permiso
        WHERE dp.id_admin = $idadmin";

                                // Ejecutar la consulta
                                $resultado_asignados = $conexion->query($sql_asignados);
                                // Verificar si hay resultados
                                if ($resultado_asignados->num_rows > 0) {
                                    // Iterar sobre los resultados y mostrar los permisos en la tabla
                                    while ($fila = $resultado_asignados->fetch_assoc()) {
                                        $permiso = $fila['permiso'];
                                ?>
                                        <tr>
                                            <td><?php echo $permiso; ?></td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="2">No se encontraron permisos para este administrador</td></tr>';
                                }

                                ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="input-box">
                        <span class="details">Permisos</span>
                        <select name="id_permiso" type="select" style="height: 44px;" required>
                            <?php
                            include "../../acciones/conexion.php";
                            // Consulta SQL para obtener los permisos
                            $sql_permisos = "SELECT id_permisos, permiso FROM permisos_admin";

                            // Ejecutar la consulta
                            $resultado_permisos = $conexion->query($sql_permisos);
                            // Verificar si hay resultados
                            if ($resultado_permisos->num_rows > 0) {
                                // Iterar sobre los resultados y mostrar opciones en el select
                                while ($fila = $resultado_permisos->fetch_assoc()) {
                                    $id_permisos = $fila['id_permisos'];
                                    $permiso = $fila['permiso'];
                            ?>
                                    <option value="<?php echo $id_permisos; ?>"><?php echo $permiso; ?></option>
                            <?php
                                }
                            } else {
                                echo '<option value="">No hay permisos disponibles</option>';
                            }


                            ?>
                        </select>
                    </div>


                </div>
                <br>
                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                <a href="../administradores.php" class="btn btn-danger">Atrás</a>
            </form>
        </div>

    </section>
    <?php include '../footer.php'; ?>

</body>