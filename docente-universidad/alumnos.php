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

//Conteo de alumnos
$sql = "SELECT COUNT(*) id_alumno FROM alumnos_universidad a 
JOIN docentes_universidad d
ON a.id_docente = d.id_docente
WHERE d.id_docente = $id_user";
$result = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($result);

//Estadisticas
$query1 = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $id_user");
$data1 = mysqli_fetch_assoc($query1);
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


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bulma.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<title>KOUTILAB</title>
</head>

<body>

    <!-- Header nav -->
    <?php include 'header-nav.php'; ?>

    <div class="containers">
        <h1>ALUMNOS</h1>
    </div>

    <div class="studens-add-bar">
        <div class="left-student">
            <i class="fas fa-users"></i>
            <h2><?php echo $fila['id_alumno']; ?> <span>Alumno(s)</span< /h2>
        </div>

    </div>

    <section>
        <div class="board p-2">
            <table id="alumnos" width="100%" class="table border-top" style="z-index: 1;">
                <thead>
                    <tr>
                        <td><b>Nombre</b></td>
                        <td><b>Apellido Paterno</b></td>
                        <td><b>Apellido Materno</b></td>
                        <td><b>Usuario</b></td>
                        <td><b>Conexiones</b></td>
                        <td><b>Clave secreta</b></td>
                        <!-- <td><b>Acción</b></td> -->
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include "../acciones/conexion.php";

                    $query_alumnos = mysqli_query($conexion, "SELECT a.nombre, a.apellidop, a.apellidom, a.usuario, a.conexiones, a.clave_secreta FROM alumnos_universidad a
                JOIN docentes_universidad d
                ON a.id_docente = d.id_docente
                WHERE d.id_docente = '$id_user' AND a.estado = 1");
                    $result = mysqli_num_rows($query_alumnos);
                    if ($result > 0) {
                        while ($data = mysqli_fetch_assoc($query_alumnos)) {

                    ?>
                            <tr>
                                <td><?php echo $data['nombre']; ?></td>
                                <td><?php echo $data['apellidop']; ?></td>
                                <td><?php echo $data['apellidom']; ?></td>
                                <td><?php echo $data['usuario']; ?></td>
                                <td><?php echo $data['conexiones']; ?></td>
                                <td><?php echo $data['clave_secreta']; ?></td>
                                <!-- <td> -->
                                    <!-- <a href="acciones/mostrar_alumno.php?id=<?php echo $data['id_alumno']; ?>" id="btn-group" class="btn btn-info"><i class='fas fa-chart-line' id="i-group" style="color: white"></i></a> -->
                                    <!--<a href="acciones/editar_alumno.php?id=<?php //echo $data['id_alumno']; 
                                                                                ?>" id="btn-group" class="btn btn-success"><i class='fas fa-edit' id="i-group"></i></a>-->
                                    <!-- <form action="acciones/eliminar_alumno.php?id=<?php echo $data['id_alumno']; ?>" method="post" id="f-c" class="confirmar d-inline"> -->
                                        <!-- <button class="btn btn-danger" id="btn-trs" type="submit"><i class='fas fa-trash-alt' id="i-group"></i> </button> -->
                                    <!-- </form> -->
                                <!-- </td> -->
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

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bulma.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bulma.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#alumnos').DataTable({
                responsive: true,
                autoWidth: false,
                lengthChange: false,
                searching: true,
                paging: true,
                ordering: false,
                info: false,
                buttons: [{
                    extend: 'pdf',
                    split: ['excel', 'print'],
                }],
                "language": {
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });


            table.buttons().container().appendTo($('div.column.is-half', table.table().container()).eq(0));
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