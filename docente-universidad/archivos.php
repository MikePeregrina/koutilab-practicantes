<?php
session_start();
$id_user = $_SESSION['id_docente_universidad'];
if (empty($_SESSION['active']) || empty($_SESSION['id_docente_universidad'])) {
    header('location: ../acciones/cerrarsesion.php');
}
include('../acciones/conexion.php');


$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM docentes_universidad d
JOIN escuelas e 
ON d.id_escuela = e.id_escuela
WHERE d.id_docente = $id_user"));
//Seleccionar nombre del grupo
$query = "SELECT a.nombre FROM alumnos_universidad a 
JOIN docentes_universidad d
ON a.id_alumno = d.id_docente
WHERE $id_user = d.id_docente";


$query_grupo = "SELECT nombre_grupo FROM grupos_universidad WHERE id_docente = $id_user";
$result = $conexion->query($query_grupo);
if ($result->num_rows > 0) {
    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
}


//Seleccinar y dar permiso a grupos
$grupo = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM grupos_universidad WHERE id_docente = $id_user"));


//Conteo de alumnos
$sql = "SELECT COUNT(*) id_archivo FROM archivos_universidad a 
JOIN alumnos_universidad ap
ON a.id_alumno = ap.id_alumno
JOIN docentes_universidad dp
ON ap.id_docente = dp.id_docente
WHERE dp.id_docente = $id_user";
$result = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($result);

//Estadisticas
$query1 = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $id_user");
$data1 = mysqli_fetch_assoc($query1);
?>

<?php

/*
DESCARGA DE ARCHIVOS
*/

if (isset($_GET['id'])) {
    /* Preparamos la consulta buscando por id */
    $consulta = $conexion->prepare('
      SELECT archivo_data, nombre_archivo
      FROM archivos_universidad
       WHERE id_archivo = ?
    ');
    if ($consulta === false) {
        die('Error: ' . $conexion->error);
    }
    /* Asignamos la id proporcionada desde el parámetro a la consulta */
    $consulta->bind_param(
        'i',
        $_GET['id']
    );
    /* Realizamos la consulta */
    $consulta->execute();
    /* Almacenamos los datos */
    $consulta->store_result();
    /* Asignamos la salida a dos variables */
    $consulta->bind_result($datos, $nombre);
    /* Obtenemos el registro y lo asignamos a las variables */
    if ($consulta->fetch() === false) {
        die('Archivo no encontrado');
    }
    /* Generamos las cabeceras para forzar la descarga de un archivo con nombre */
    header('Content-Type: application/octet-stream');
    /* Enviamos el tamaño de archivo */
    header('Content-Length: ' . strlen($datos));
    /* Limpiamos del nombre de archivo caracteres extraños */
    header('Content-Disposition: attachment; filename="' .
        addslashes(preg_replace('/[^[:alnum:].,\-_ ]/', '_', $nombre)) . '"');
    /* Enviamos al navegador el archivo */
    die($datos);
}

//HASTA AQUÍIII DESCARGA DE ARCHIVOS------------------------------------
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/nav-barra.css">
<link rel="stylesheet" href="css/alumnos.css">
<link rel="stylesheet" href="css/footer.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bulma.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">

<title>KOUTILAB</title>
</head>

<body>

    <!-- Header nav -->
    <?php include 'header-nav.php'; ?>

    <div class="containers">
        <h1>ARCHIVOS</h1>
    </div>

    <div class="studens-add-bar">
        <div class="left-student">
            <i class="fas fa-users"></i>
            <h2><?php echo $fila['id_archivo']; ?> <span>Archivo(s)</span></h2>
        </div>

    </div>
    <!-- Contenido de la pantalla emergente -->
    <div class="popup-container" id="popupContainer">
        <div class="popup-content">
            <div class="titlec">
                <h2>Calificar Tarea</h2>
            </div>

            <div class="contenedor-emergente">
                <form id="grupos" method="POST" enctype="multipart/form-data" action="acciones/insertar_grupo.php" autocomplete="off">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Calificación: </span>
                            <input type="number" name="materia" placeholder="Ejemplo: 9" required min="0" max="10">
                        </div>
                        <div class="input-box">
                            <span class="details">Comentario (opcional): </span>
                            <input type="text" name="nombre_grupo" id="nombre_grupo" placeholder="Ejemplo: Tarea incompleta">
                        </div>
                    </div>
                    <button type="submit" class="btn-grd">Calificar</button>
                </form>
            </div>


        </div>
        <button id="closeButton"><i class="fas fa-times"></i></button>

    </div> <!-- Cierre de la pantalla emergente -->
    <section>
        <div class="board p-2">
            <table id="alumnos" width="100%" class="table border-top" style="z-index: 1;">
                <thead>
                    <tr>
                        <td><b>Curso</b></td>
                        <td><b>Capsula</b></td>
                        <td><b>Alumno</b></td>
                        <td><b>Grado Escolar</b></td>
                        <td><b>Fecha</b></td>
                        <td><b>Calificación</b></td>
                        <td><b>Comentario</b></td>
                        <td><b>Acciones</b></td>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include "../acciones/conexion.php";

                    $query_alumnos = mysqli_query($conexion, "SELECT ar.id_archivo, ar.id_alumno, ap.nombre, ap.grado_escolar, ar.id_capsula, cp.curso, ar.id_curso, ar.calificacion, ar.comentario, DATE_FORMAT(ar.created_at,'%r %d-%m-%Y') as fecha FROM archivos_universidad ar 
                    JOIN alumnos_universidad ap
                    ON ar.id_alumno = ap.id_alumno
                    JOIN docentes_universidad dp
                    ON ap.id_docente = dp.id_docente
                    JOIN cursos_universidad cp
                    ON ar.id_curso = cp.id_curso
                    WHERE dp.id_docente = $id_user AND ap.estado = 1");
                    $result = mysqli_num_rows($query_alumnos);
                    if ($result > 0) {
                        while ($data = mysqli_fetch_assoc($query_alumnos)) {

                    ?>
                            <tr>
                                <td><?php echo $data['curso']; ?></td>
                                <td><?php echo $data['id_capsula']; ?></td>
                                <td><?php echo $data['nombre']; ?></td>
                                <td><?php echo $data['grado_escolar']; ?></td>
                                <td><?php echo $data['fecha']; ?></td>
                                <td><?php echo $data['calificacion']; ?></td>
                                <td><?php echo $data['comentario']; ?></td>
                                <td>
                                    <a style="margin-top: 5px;" href="<?= $_SERVER['PHP_SELF'] ?>?id=<?= urlencode($data['id_archivo']) ?>" id="btn-group" class="btn btn-info"><i class='fas fa-download' id="i-group" style="color: white"></i></a>
                                    <a style="margin-top: 5px;" href="acciones/calificar_tarea.php?id_alumno=<?php echo $data['id_alumno']; ?>&id_curso=<?php echo $data['id_curso']; ?>&id_capsula=<?php echo $data['id_capsula']; ?>&id_archivo=<?php echo $data['id_archivo']; ?>" class="btn btn-success" id="" type="submit"><i class='fas fa-clipboard-check' id="i-group"></i> </a>
                                </td>
                            </tr>
                    <?php }
                    } ?>

                </tbody>
            </table>
        </div>
    </section>


    <?php include 'footer.php'; ?>

    <script>
        const addCourseButton = document.getElementById('addCourseButton');
        const popupContainer = document.getElementById('popupContainer');
        const closeButton = document.getElementById('closeButton');

        addCourseButton.addEventListener('click', function() {
            popupContainer.style.display = 'block';
        });

        closeButton.addEventListener('click', function() {
            popupContainer.style.display = 'none';
        });

        popupContainer.addEventListener('click', function(event) {
            if (event.target === popupContainer) {
                popupContainer.style.display = 'none';
            }
        });
    </script>

    <script>
        /* Función para generar clave para alumno */
        function generarUsuarioAlumno() {
            var pass = "";
            var str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            for (let i = 1; i <= 4; i++) {
                var char = Math.floor(Math.random() * str.length + 1);
                pass += str.charAt(char);
            }
            return pass;
        }

        function generarUsuario() {
            var nombre = document.getElementById("nombrealumno").value;
            var prefijo;
            var resultado;
            prefijo = nombre.substr(0, 10);
            resultado = "@" + prefijo.toLowerCase() + "-" + generarUsuarioAlumno().toLowerCase();
            document.getElementById("usuarioalumno").value = resultado.split(" ").join("");
        }
    </script>

    <script>
        function copyToClipBoard() {
            var content = document.getElementById('clave');
            content.select();
            document.execCommand('copy');
        }
    </script>

    <script>
        /* Función para generar clave para alumno */
        function generarClaveAlumno() {
            var pass = "";
            var str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            for (let i = 1; i <= 8; i++) {
                var char = Math.floor(Math.random() * str.length + 1);
                pass += str.charAt(char);
            }
            return pass;
        }

        function generarClaves() {
            var cct = document.getElementById("cct").value;
            var prefijo;
            prefijo = cct.substr(0, 3);
            document.getElementById("clave").value = prefijo.toUpperCase() + "-" + generarClaveAlumno();
        }
    </script>

    <script>
        onkeydown = e => {
            let tecla = e.which || e.keyCode;

            // Evaluar si se ha presionado la tecla Ctrl:
            if (e.ctrlKey) {
                // Evitar el comportamiento por defecto del nevagador:
                e.preventDefault();
                e.stopPropagation();

                // Mostrar el resultado de la combinación de las teclas:
                if (tecla === 85)
                    console.log("Ha presionado las teclas Ctrl + U");

                if (tecla === 83)
                    console.log("Ha presionado las teclas Ctrl + S");
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bulma.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            $('#alumnos').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/es-MX.json'
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx1 = document.getElementById('myChart1');
        new Chart(ctx1, {
            type: 'radar',
            data: {
                labels: ['Trofeos', 'Puntos', 'Audiovisual', 'Practico', 'Teorico'],
                datasets: [{
                    label: 'Estadisticas',
                    data: [],
                    fill: true,
                    borderWidth: 1
                }]
            },
        });
    </script>
    <script>
        document.querySelector('.campo span').addEventListener('click', e => {
            const passwordInput = document.querySelector('#password');
            if (e.target.classList.contains('show')) {
                e.target.classList.remove('show');
                e.target.textContent = '';
                passwordInput.type = 'text';
            } else {
                e.target.classList.add('show');
                e.target.textContent = '';
                passwordInput.type = 'password';
            }
        });
    </script>
    <script src="js/bar.js"></script>
    <script src="js/funciones.js"></script>

    <script>
        window.addEventListener("load", function() {

            // icono para mostrar contraseña
            showPassword1 = document.querySelector('.show-password1');
            showPassword1.addEventListener('click', () => {

                // elementos input de tipo clave
                password1 = document.querySelector('.password1');

                if (password1.type === "text") {
                    password1.type = "password"
                    showPassword1.classList.remove('fa-eye-slash');
                } else {
                    password1.type = "text"
                    showPassword1.classList.toggle("fa-eye-slash");
                }

            })

        });
    </script>

</body>

</html>