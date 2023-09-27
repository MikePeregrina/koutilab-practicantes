<?php
require "../../acciones/conexion.php";

if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['curso'])) {
        $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
    } else {
        $idgrupo = $_GET['id'];
        $curso = $_POST['curso'];
        // Realiza una consulta SELECT para obtener los datos que deseas insertar
        $sql = "SELECT dg.id_alumno FROM alumnos_secundaria a
            JOIN detalle_grupos_secundaria dg
            ON dg.id_alumno = a.id_alumno
            WHERE dg.id_grupo = $idgrupo;";
        $resultado = $conexion->query($sql);

        $insertar_detalle_grupo = mysqli_query($conexion, "INSERT INTO detalle_grupo_cursos_secundaria(id_grupo, id_curso) VALUES ('$idgrupo', '$curso')");

        // Verifica si la consulta SELECT tiene resultados
        if ($resultado->num_rows > 0) {
            // Itera sobre los resultados de la consulta SELECT y ejecuta una consulta INSERT para insertar cada registro en la tabla de destino
            while ($fila = $resultado->fetch_assoc()) {
                $idalumno = $fila["id_alumno"];
                $sql_insert = "INSERT INTO acceso_cursos_secundaria(id_curso, id_alumno) VALUES ('$curso', $idalumno)";
                $conexion->query($sql_insert);
            }
            header("Location: ../../docente-secundaria/grupos.php");
        } else {
            header("Location: ../../docente-secundaria/grupos.php");
        }
    }
}

// Mostrar Datos

if (empty($_REQUEST['id'])) {
    header("Location: ../../docente-secundaria/grupos.php");
}
$idgrupo = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM grupos_secundaria WHERE id_grupo = '$idgrupo'");
$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
    header("Location: ../../docente-secundaria/grupos.php");
} else {
    if ($data = mysqli_fetch_array($sql)) {
        $materia = $data['materia'];
        $nombregrupo = $data['nombre_grupo'];
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
        <h1>Agregar cursos al grupo</h1>
    </div>


    <section>
        <div class="contenedor-emergente">
            <form class="" action="" method="post" style="box-shadow: none;">
                <div class="user-details">

                    <?php echo isset($alert) ? $alert : ''; ?>

                    <div class="input-box">
                        <span class="details">Matería</span>
                        <input type="text" name="materia" id="materia" value="<?php echo $materia; ?>" required readonly>
                    </div>

                    <div class="input-box">
                        <span class="details">Nombre grupo</span>
                        <input type="text" name="nombre_grupo" id="nombre_grupo" value="<?php echo $nombregrupo; ?>" required readonly>
                    </div>

                    <div class="input-box">
                        <span class="details">Cursos del grupo</span>
                        <table width="100%" class="table border-top">
                            <tbody>
                                <?php
                                include "../../acciones/conexion.php";
                                $query_alumnos = mysqli_query($conexion, "SELECT DISTINCT c.curso FROM grupos_secundaria g JOIN detalle_grupo_cursos_secundaria dg ON g.id_grupo = dg.id_grupo JOIN cursos_secundaria c ON dg.id_curso = c.id_curso WHERE g.id_grupo = $idgrupo");
                                $result = mysqli_num_rows($query_alumnos);
                                if ($result > 0) {
                                    while ($data = mysqli_fetch_assoc($query_alumnos)) {

                                ?>
                                        <tr>
                                            <td><?php echo $data['curso']; ?></td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="input-box">
                        <span class="details">Cursos</span>
                        <select style="height: 44px;" name="curso" type="select" required>
                            <option value="1">Programación web básico</option>
                            <option value="2">Programación web intermedio</option>
                            <option value="3">Programación web avanzado</option>
                            <option value="4">Python básico</option>
                            <option value="5">Python intermedio</option>
                            <option value="6">Python avanzado</option>
                            <option value="7">Informática básico</option>
                            <option value="8">Informática intermedio</option>
                            <option value="9">Informática avanzado</option>
                            <option value="10">Unity básico</option>
                            <option value="11">Unity intermedio</option>
                            <option value="12">Unity avanzado</option>
                            <option value="13">Apps móviles básico</option>
                            <option value="14">Apps móviles intermedio</option>
                            <option value="15">Apps móviles avanzado</option>
                        </select>
                    </div>

                </div>

                <br>
                <div style="display: flex; text-align: center; justify-content: center; gap: 20px;">
                    <button type="submit" class="btn btn-success" style="width: 15%; height:50px; margin-top:0%">Guardar</button>
                    <a href="../grupos.php" class="btn btn-danger" style="width: 15%; height:50px; padding:1.7%">Atrás</a>
                </div>

            </form>
        </div>

    </section>
    <?php include '../footer.php'; ?>
    <!--<footer>
        <div class="imagen-footer">
            <img src="img/Bienvenida.png">
        </div>
    </footer>-->

</body>