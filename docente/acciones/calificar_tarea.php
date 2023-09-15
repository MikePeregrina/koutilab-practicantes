<?php
require "../../acciones/conexion.php";

if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['calificacion'])) {
        $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
    } else {
        $id_archivo = $_GET['id_archivo'];
        $id_alumno = $_GET['id_alumno'];
        $id_curso = $_GET['id_curso'];
        $id_capsula = $_GET['id_capsula'];
        $calificacion = $_POST['calificacion'];
        $comentario = $_POST['comentario'];

        //$sql_update = mysqli_query($conexion, "UPDATE grupos_primaria SET materia = '$materia', nombre_grupo = '$nombregrupo' , grado = '$grado' WHERE id_grupo = $idgrupo");
        //$alert = '<div class="alert alert-success" role="alert">Grupo actualizado</div>';
        //$fecha_calificado = date("d-m-Y");

        //ACTUALIZA CALIFICACIÓN Y COMENTARIO EN ARCHIVOS
        $sql_update = mysqli_query($conexion, "UPDATE archivos_primaria SET calificacion = '$calificacion', fecha_calificado = current_timestamp(), comentario = '$comentario' WHERE id_archivo = $id_archivo");
        $alert = '<div class="alert alert-success" role="alert">¡Calificación asignada!</div>';

        //INSERTA EN DETALLE_ESTADISTICAS_PRIMARIA
        $query = "INSERT INTO detalle_estadisticas_primaria (progreso, practico, id_alumno, id_curso, id_capsula) VALUES ('2', $calificacion, '$id_alumno', $id_curso, $id_capsula)";
        $query_run = mysqli_query($conexion, $query);

        //Sumar trofeos
        $consultaEstadistica = mysqli_query($conexion, "SELECT trofeos, SUM(trofeos) AS total_trofeos, progreso, SUM(progreso) AS total_progreso, puntos, SUM(puntos) AS total_puntos, practico, SUM(practico) AS total_practico, teorico, SUM(teorico) AS total_teorico FROM detalle_estadisticas_primaria WHERE id_alumno = '$id_alumno' AND id_curso = '$id_curso'");
        $resultadoEstadistica = mysqli_fetch_assoc($consultaEstadistica);
        $totalTrofeos = $resultadoEstadistica['total_trofeos'];
        $totalProgreso = $resultadoEstadistica['total_progreso'];
        $totalPuntos = $resultadoEstadistica['total_puntos'];
        $totalPractico = $resultadoEstadistica['total_practico'];
        $totalTeorico = $resultadoEstadistica['total_teorico'];
        $insertarEstadisticas = mysqli_query($conexion, "UPDATE estadisticas_primaria SET trofeos = '$totalTrofeos', progreso = '$totalProgreso', puntos = '$totalPuntos', practico = '$totalPractico', teorico = '$totalTeorico' WHERE id_alumno = $id_alumno AND id_curso = '$id_curso'");

        if ($insertarEstadisticas) {
            header('location: ../archivos.php');
            exit();
        }
    }
}

// Mostrar Datos

if (empty($_REQUEST['id_alumno'])) {
    header("Location: ../../docente/archivos.php");
}
$id_archivo = $_REQUEST['id_archivo'];
$id_alumno = $_REQUEST['id_alumno'];
$id_curso = $_REQUEST['id_curso'];
$id_capsula = $_REQUEST['id_capsula'];

$sql = mysqli_query($conexion, "SELECT ar.id_archivo, ar.id_alumno, ap.nombre, ap.grado_escolar, ar.id_capsula, cp.curso, ar.id_curso, ar.calificacion, ar.comentario, DATE_FORMAT(ar.created_at,'%r %d-%m-%Y') as fecha FROM archivos_primaria ar 
                    JOIN alumnos_primaria ap
                    ON ar.id_alumno = ap.id_alumno
                    JOIN docentes_primaria dp
                    ON ap.id_docente = dp.id_docente
                    JOIN cursos_primaria cp
                    ON ar.id_curso = cp.id_curso
                    WHERE ar.id_archivo = $id_archivo");
$result_sql = mysqli_num_rows($sql);



if ($result_sql == 0) {
    //header("Location: ../../docente/grupos.php");
    $calificacion = -1;
    $comentario = '';
} else {
    if ($data = mysqli_fetch_array($sql)) {
        $calificacion = $data['calificacion'];
        $nombre = $data['nombre'];
        $curso = $data['curso'];
        $id_capsula = $data['id_capsula'];
        $comentario = $data['comentario'];
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
        <h1>CALIFICAR TAREA</h1>
    </div>


    <section>
        <div class="contenedor-emergente">
            <form class="" action="" method="post" style="box-shadow: none;">
                <div style="text-align: center; font-size: 18px; padding-bottom: 20px;" class="input-box">
                    <span style="padding: 0px 0px 0px 20px;" class="details"><b>Alumno: </b></span>
                    <span style="padding: 0px 20px 0px 0px;" class="details"><?php echo $nombre; ?></span>

                    <span style="padding: 0px 0px 0px 20px;" class="details"><b>Curso: </b></span>
                    <span style="padding: 0px 20px 0px 0px;" class="details"><?php echo $curso; ?></span>

                    <span style="padding: 0px 0px 0px 20px;" class="details"><b>Capsula: </b></span>
                    <span style="padding: 0px 20px 0px 0px;" class="details"><?php echo $id_capsula; ?></span>
                </div>
                <div class="user-details">

                    <?php echo isset($alert) ? $alert : ''; ?>
                    <input type="hidden" name="id_archivo" value="<?php echo $id_archivo; ?>">

                    <input type="hidden" name="id_alumno" value="<?php echo $id_alumno; ?>">

                    <input type="hidden" name="id_curso" value="<?php echo $id_curso; ?>">

                    <input type="hidden" name="id_capsula" value="<?php echo $id_capsula; ?>">



                    <div class="input-box">
                        <span class="details">Calificación: </span>
                        <?php
                        if ($calificacion >= 0) {
                        ?>
                            <input type="number" name="calificacion" placeholder="Ejemplo: 9" required min="0" max="10" value="<?php echo $calificacion; ?>">
                        <?php
                        } else { ?>
                            <input type="number" name="calificacion" placeholder="Ejemplo: 9" required min="0" max="10">
                        <?php
                        }
                        ?>
                        <!--<input type="number" name="calificacion" placeholder="Ejemplo: 9" required min="0" max="10">-->
                    </div>

                    <div class="input-box">
                        <span class="details">Comentario (opcional): </span>
                        <?php
                        if (!empty($comentario)) {
                        ?>

                            <input type="text" name="comentario" id="comentario" placeholder="Ejemplo: Tarea incompleta" value="<?php echo $comentario; ?>">
                        <?php
                        } else { ?>
                            <input type="number" name="calificacion" placeholder="Ejemplo: 9" required min="0" max="10">
                        <?php
                        }
                        ?>
                        <!--<input type="text" name="comentario" id="comentario" placeholder="Ejemplo: Tarea incompleta">-->
                    </div>

                </div>

                <br>
                <div style="display: flex; text-align: center; justify-content: center; gap: 20px;">
                    <button type="submit" class="btn btn-success" style="width: 15%; height:40px; margin-top:0%">Calificar</button>
                    <a href="../archivos.php" class="btn btn-danger" style="width: 15%; height:40px;">Atrás</a>
                </div>
            </form>
        </div>

    </section>

    <?php include '../footer.php'; ?>
</body>