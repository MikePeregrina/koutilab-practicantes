<?php
session_start();
$id_user = $_SESSION['id_docente_primaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_docente_primaria'])) {
    header('location: ../acciones/cerrarsesion.php');
}

include('../acciones/conexion.php');

$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM docentes_primaria d
JOIN escuelas e 
ON d.id_escuela = e.id_escuela
WHERE d.id_docente = $id_user"));

// Obtenemos el país del resultado de la consulta
$pais = $user['pais'];

// Definimos un array con las opciones de grados para cada país
$opciones_grados = array(
    'México' => array('1°', '2°', '3°', '4°', '5°', '6°'),
    'Perú' => array('1°', '2°', '3°', '4°', '5°', '6°'),
);

// Obtenemos las opciones de grados dependiendo del país
$grados_disponibles = isset($opciones_grados[$pais]) ? $opciones_grados[$pais] : array();

$query = "SELECT curso FROM cursos_primaria";
$result = $conexion->query($query);
if ($result->num_rows > 0) {
    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
$sql = "SELECT COUNT(*) id_grupo FROM grupos_primaria WHERE id_docente = '$id_user' AND estado = 1";
$result = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/nav-barra.css">
<link rel="stylesheet" href="css/grupos.css">
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
        <h1>GRUPOS</h1>
    </div>

    <div class="studens-add-bar">
        <div class="left-student">
            <i class="fas fa-users"></i>
            <h2><?php echo $fila['id_grupo']; ?> Grupo(s)</h2>
        </div>

        <div class="right-student" id="addCourseButton">
            <i class="fas fa-user-plus"></i>
            <h2>Añadir grupo</h2>
        </div>
    </div>

    <!-- Contenido de la pantalla emergente -->
    <div class="popup-container" id="popupContainer">
        <div class="popup-content">
            <div class="titlec">
                <h2>Nuevo grupo</h2>
            </div>

            <div class="contenedor-emergente">
                <form id="grupos" method="POST" enctype="multipart/form-data" action="acciones/insertar_grupo.php" autocomplete="off">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Materia: </span>
                            <input type="text" name="materia" placeholder="Nombre de la materia" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Nombre del grupo: </span>
                            <input type="text" name="nombre_grupo" id="nombre_grupo" onkeydown="generarGrupo()" placeholder="Ejemplo: A Matutino" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Grado: </span>
                            <select style="height: 44px;" name="grado" type="select" required>
                                <option value="">Elija un grado</option>
                                <?php
                                foreach ($grados_disponibles as $grado) {
                                    echo '<option value="' . $grado . '">' . $grado . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-box">
                            <span class="details">Curso: </span>
                            <select style="height: 44px;" name="curso" required>
                                <option>Seleccionar curso</option>
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
                        <div class="input-box">
                            <span class="details">Clave: </span>
                            <input type="text" name="clave" id="clave" required readonly>
                        </div>
                        <div class="input-box" id="copy-key">
                            <span class="details"></span><br><br>
                            <button type="button" class="btn-grd1" onclick="copyToClipBoard()" id="btn-copy">Copiar clave</button>
                        </div>
                    </div>
                    <button type="submit" class="btn-grd">Guardar</button>
                </form>
            </div>


        </div>
        <button id="closeButton"><i class="fas fa-times"></i></button>

    </div> <!-- Cierre de la pantalla emergente -->
    <section>

        <div class="board p-2">
            <table id="grupos1" width="100%" class="table border-top" style="z-index: 1;">
                <thead>
                    <tr>
                        <td><b>Materia</b></td>
                        <td><b>Nombre del grupo</b></td>
                        <td><b>Grado escolar</b></td>
                        <td><b>Clave</b></td>
                        <td><b>Acción</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../acciones/conexion.php";

                    $query_grupos = mysqli_query($conexion, "SELECT * FROM grupos_primaria WHERE id_docente = $id_user AND estado = 1");
                    $result = mysqli_num_rows($query_grupos);
                    if ($result > 0) {
                        while ($data = mysqli_fetch_assoc($query_grupos)) {

                    ?>
                            <tr>
                                <td><?php echo $data['materia']; ?></td>
                                <td><?php echo $data['nombre_grupo']; ?></td>
                                <td><?php echo $data['grado']; ?></td>
                                <td><?php echo $data['clave']; ?></td>

                                <td id="td-group">
                                    <a href="acciones/mostrar_grupo.php?id=<?php echo $data['id_grupo']; ?>" class="btn btn-info" id="btn-group"><i class='fas fa-clipboard-list' style="color: white;" id="i-group"></i></a>
                                    <a href="acciones/mostrar_estadisticas_grupo.php?id=<?php echo $data['id_grupo']; ?>" class="btn btn-info" id="btn-group"><i class="fas fa-chart-pie" style="color: white;" id="i-group"></i></a>
                                    <a href="acciones/editar_grupo.php?id=<?php echo $data['id_grupo']; ?>" class="btn btn-success" id="btn-group"><i class='fas fa-edit' id="i-group"></i></a>
                                    <a href="acciones/agregar_curso.php?id=<?php echo $data['id_grupo']; ?>" class="btn btn-success" id="btn-group"><i class='fas fa-plus' id="i-group"></i></a>
                                    <form action="acciones/eliminar_grupo.php?id=<?php echo $data['id_grupo']; ?>" method="post" id="f-c" class="d-inline">
                                        <button class="btn btn-danger btn-dlt" style="margin: -13px -15px 0 0;" type="submit" id="btn-trs"><i class='fas fa-trash-alt' style="font-size: 32px; margin: 0 0 0 0;" id="i-trs"></i> </button>
                                    </form>
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
        /* Función para generar clave para grupo */
        function generarClaveGrupo() {
            var pass = "";
            var str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            for (let i = 1; i <= 7; i++) {
                var char = Math.floor(Math.random() * str.length + 1);
                pass += str.charAt(char);
            }
            return pass;
        }

        function generarGrupo() {
            var nombre = document.getElementById("nombre_grupo").value;
            var prefijo;
            var resultado;
            prefijo = nombre.substr(0, 3);
            resultado = prefijo.toUpperCase() + generarClaveGrupo().toUpperCase();
            document.getElementById("clave").value = resultado.split(" ").join("");
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
            $('#grupos1').DataTable({
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