<?php
session_start();
$id_user = $_SESSION['id_admin'];
if (empty($_SESSION['active']) || empty($_SESSION['id_admin'])) {
    header('location: ../acciones/cerrarsesion.php');
}
include('../acciones/conexion.php');

$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM admin WHERE id_admin = $id_user"));


$sql = "SELECT 
nivel_educativo,
COUNT(DISTINCT CASE 
    WHEN nivel_educativo = 'Institucional' THEN nivel_educativo
    ELSE cct
END) AS conteo
FROM escuelas
WHERE estatus = 1
GROUP BY nivel_educativo";
$result = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="img/lgk.png">
<link rel="stylesheet" href="css/nav-barra.css">
<link rel="stylesheet" href="css/escuelas.css">
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
        <h1>ESCUELAS</h1>
    </div>

    <div class="studens-add-bar">
        <?php if ($result->num_rows > 0) {
            // Mostrar los resultados
            while ($row = $result->fetch_assoc()) {
                echo '<div class="left-student"> <i class="fas fa-school"></i> <h2>' . $row["nivel_educativo"] . " - Total: " . $row["conteo"] . " Escuela(s)</h2> </div>";
            }
        } else {
            echo "No se encontraron escuelas.";
        } ?>
    </div>
    <div class="right-student" id="addCourseButton">
        <i class="fas fa-plus-circle"></i>
        <h2>Añadir escuela</h2>
    </div>

    <!-- Contenido de la pantalla emergente -->
    <div class="popup-container" id="popupContainer">
        <div class="popup-content">
            <div class="titlec">
                <h2>Nueva Escuela</h2>
            </div>

            <div class="contenedor-emergente">
                <form id="grupos" method="POST" enctype="multipart/form-data" action="acciones/insertar_escuela.php">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Escuela:</span>
                            <input type="text" placeholder="Nombre de la escuela" name="nombre_escuela" required>
                        </div>
                        <div class="input-box">
                            <span class="details">CCT:</span>
                            <input type="text" onkeydown="generarClaves()" placeholder="AP123456" name="cct" id="cct" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Director:</span>
                            <input type="text" placeholder="Ejemplo: Juan Ejemplo Ejemplo" name="nombre_director" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Nivel Educativo:</span>
                            <select required style="height: 44px;" name="nivel_educativo" id="nivel_educativo">
                                <option value="">Elige una opción</option>
                                <option value="Primaria">Primaria</option>
                                <option value="Secundaria">Secundaria</option>
                                <option value="Preparatoria">Preparatoria</option>
                                <option value="Universidad">Universidad</option>
                                <option value="Institucion">Institución</option>
                            </select>
                        </div>
                        <!-- <input type="hidden" name="rol_alumno" id="rol_alumno" required>
                    <input type="hidden" name="rol_docente" id="rol_docente" required>
                    <input type="hidden" name="rol_director" id="rol_director" required> -->
                        <div class="input-box">
                            <span class="details">País:</span>
                            <input type="text" placeholder="País" name="pais" value="<?php echo $user['pais']; ?>" required readonly>
                        </div>
                        <div class="input-box">
                            <span class="details">Estado</span>
                            <select style="height: 44px;" name="estado" type="select" required>
                                <option>Elige una opción</option>
                                <option value="Aguascalientes">Aguascalientes</option>
                                <option value="Baja California">Baja California</option>
                                <option value="Baja California Sur">Baja California Sur</option>
                                <option value="Campeche">Campeche</option>
                                <option value="Ciudad de Mexico">Ciudad de Mexico</option>
                                <option value="Coahuila">Coahuila</option>
                                <option value="Colima">Colima</option>
                                <option value="Chiapas">Chiapas</option>
                                <option value="Chihuahua">Chihuahua</option>
                                <option value="Durango">Durango</option>
                                <option value="Guanajuato">Guanajuato</option>
                                <option value="Guerrero">Guerrero</option>
                                <option value="Hidalgo">Hidalgo</option>
                                <option value="Jalisco">Jalisco</option>
                                <option value="Mexico">México</option>
                                <option value="Michuacan">Michoacán</option>
                                <option value="Morelos">Morelos</option>
                                <option value="Nayarit">Nayarit</option>
                                <option value="Nuevo Leon">Nuevo León</option>
                                <option value="Oaxaca">Oaxaca</option>
                                <option value="Puebla">Puebla</option>
                                <option value="Queretaro">Querétaro</option>
                                <option value="Quintana Roo">Quintana Roo</option>
                                <option value="San Luis Potosi">San Luis Potosí</option>
                                <option value="Sinaloa">Sinaloa</option>
                                <option value="Sonora">Sonora</option>
                                <option value="Tabasco">Tabasco</option>
                                <option value="Tamaulipas">Tamaulipas</option>
                                <option value="Tlaxcala">Tlaxcala</option>
                                <option value="Veracruz">Veracruz</option>
                                <option value="Yucatan">Yucatán</option>
                                <option value="Zacatecas">Zacatecas</option>
                            </select>
                        </div>
                        <div class="input-box">
                            <span class="details">Colonia:</span>
                            <input type="text" placeholder="Colonia" name="colonia" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Calle:</span>
                            <input type="text" placeholder="Calle" name="calle" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Número Exterior:</span>
                            <input type="text" placeholder="Numero Exterior" name="num_exterior" required>
                        </div>

                        <div class="input-box">
                            <span class="details">Código Postal:</span>
                            <input type="text" placeholder="Codigo" name="codigo_postal" required>
                        </div>

                        <input type="hidden" name="autorizacion" placeholder="Nombre" value="<?php echo $user['nombre'] ?>">

                        <div class="input-box">
                            <span class="details">Clave director:</span>
                            <input type="text" id="clave_director" name="clave_director" required readlink>
                        </div>
                        <div class="input-box">
                            <span class="details"></span> <br>
                            <button type="button" class="btn-grd1" onclick="copyToClipBoard1()">Copiar clave director</button>
                        </div>
                        <div class="input-box">
                            <span class="details">Clave docente:</span>
                            <input type="text" id="clave_docente" name="clave_docente" required readonly>
                        </div>
                        <div class="input-box">
                            <span class="details"></span> <br>
                            <button type="button" class="btn-grd1" onclick="copyToClipBoard2()">Copiar clave docente</button>
                        </div>
                        <div class="input-box">
                            <span class="details">Clave alumnos:</span>
                            <input type="text" id="clave_alumno" name="clave_alumno" required readonly>
                        </div>
                        <div class="input-box">
                            <span class="details"></span> <br>
                            <button type="button" class="btn-grd1" onclick="copyToClipBoard3()">Copiar clave alumno</button>
                        </div>

                        <button class="btn-grd" style="margin-left: 180px; margin-top:5%" type="submit">Registrar</button>

                    </div>
            </div>

            </form>
        </div>

        <button id="closeButton"><i class="fas fa-times"></i></button>

    </div>
    </div> <!-- Cierre de la pantalla emergente -->
    <section>
        <div class="board p-2">
            <table id="escuelas" width="100%" class="table border-top">
                <thead>
                    <tr>
                        <td><b>Escuela</b></td>
                        <td><b>CCT</b></td>
                        <td><b>País</b></td>
                        <td><b>Nivel educativo</b></td>
                        <td><b>Claves</b></td>
                        <td><b>Quien autoriza</b></td>
                        <td><b>Acción</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../acciones/conexion.php";

                    $query_escuelas = mysqli_query($conexion, "SELECT * FROM escuelas WHERE estatus = 1 AND id_admin = $id_user");
                    $result = mysqli_num_rows($query_escuelas);
                    if ($result > 0) {
                        while ($data = mysqli_fetch_assoc($query_escuelas)) {

                    ?>
                            <tr>
                                <td><?php echo $data['nombre_escuela']; ?></td>
                                <td><?php echo $data['cct']; ?></td>
                                <td><?php echo $data['pais']; ?></td>
                                <td><?php echo $data['nivel_educativo']; ?></td>
                                <td>
                                    Clave director: <?php echo $data['clave_director'] ?><br>
                                    <?php if ($data['nivel_educativo'] !== 'Institucional') : ?>
                                        Clave docente: <?php echo $data['clave_docente'] ?><br>
                                    <?php endif; ?>
                                    Clave alumno: <?php echo $data['clave_alumno'] ?>
                                </td>

                                <td><?php echo $data['autorizacion']; ?></td>

                                <td id="td-btn">
                                    <a href="acciones/editar_escuela.php?id=<?php echo $data['id_escuela']; ?>" class="btn btn-success" id="btn-edit"><i id="i-edit" class='fas fa-edit'></i></a>
                                    <form action="acciones/eliminar_escuela.php?id=<?php echo $data['id_escuela']; ?>" method="post" id="f-c" class="confirmar d-inline">
                                        <button class="btn btn-danger" id="btn-trs" type="submit"><i id="i-trs" class='fas fa-trash-alt'></i> </button>
                                    </form>
                                    <a href="acciones/mostrar_info.php?id=<?php echo $data['id_escuela']; ?>" id="btn-inf" class="btn btn-info"><i id="i-inf" class="fas fa-info-circle"></i></i></a>
                                    <a style="background-color: purple; border:none" href="acciones/asignar_porcentaje.php?id=<?php echo $data['id_escuela']; ?>" id="btn-inf" class="btn btn-info"><i id="i-inf" class="fas fa-percent"></i></i></a>
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
        function copyToClipBoard1() {
            var content = document.getElementById('clave_director');
            content.select();
            document.execCommand('copy');
        }
    </script>

    <script>
        function copyToClipBoard2() {
            var content = document.getElementById('clave_docente');
            content.select();
            document.execCommand('copy');
        }
    </script>

    <script>
        function copyToClipBoard3() {
            var content = document.getElementById('clave_alumno');
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
        /* Función para generar clave para docente*/
        function generarClaveDocente() {
            var pass = "";
            var str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            for (let i = 1; i <= 8; i++) {
                var char = Math.floor(Math.random() * str.length + 1);
                pass += str.charAt(char);
            }
            return pass;
        }
        /* Función para generar clave para  director*/
        function generarClaveDirector() {
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
            document.getElementById("clave_alumno").value = prefijo.toUpperCase() + "-" + generarClaveAlumno();
            document.getElementById("clave_docente").value = prefijo.toUpperCase() + "-" + generarClaveDocente();
            document.getElementById("clave_director").value = prefijo.toUpperCase() + "-" + generarClaveDirector();
        }
    </script>

    <script>
        const btnAbrirModalA = document.querySelector("#btn-abrir-modalA");
        const btnCerrarModalA = document.querySelector("#btn-cerrar-modalA");
        const modalA = document.querySelector("#modalA");
        btnAbrirModalA.addEventListener("click", () => {
            modalA.showModal();
        })

        btnCerrarModalA.addEventListener("click", () => {
            modalA.close();
        })
    </script>
    <script>
        const btnAbrirModalG = document.querySelector("#btn-abrir-modalG");
        const btnCerrarModalG = document.querySelector("#btn-cerrar-modalG");
        const modalG = document.querySelector("#modalG");
        btnAbrirModalG.addEventListener("click", () => {
            modalG.showModal();
        })

        btnCerrarModalG.addEventListener("click", () => {
            modalG.close();
        })
    </script>
    <script>
        const btnAbrirModalE = document.querySelector("#btn-abrir-modalE");
        const btnCerrarModalE = document.querySelector("#btn-cerrar-modalE");
        const modalE = document.querySelector("#modalE");
        btnAbrirModalE.addEventListener("click", () => {
            modalE.showModal();
        })

        btnCerrarModalE.addEventListener("click", () => {
            modalE.close();
        })
    </script>
    <script>
        const btnAbrirModalL = document.querySelector("#btn-abrir-modalL");
        const btnCerrarModalL = document.querySelector("#btn-cerrar-modalL");
        const modalL = document.querySelector("#modalL");
        btnAbrirModalL.addEventListener("click", () => {
            modalE.showModal();
        })

        btnCerrarModalL.addEventListener("click", () => {
            modalL.close();
        })
    </script>
    <script>
        const btnAbrirModalList = document.querySelector("#btn-abrir-modalList");
        const btnCerrarModalList = document.querySelector("#btn-cerrar-modalList");
        const modalList = document.querySelector("#modalList");
        btnAbrirModalList.addEventListener("click", () => {
            modalList.showModal();
        })

        btnCerrarModalList.addEventListener("click", () => {
            modalList.close();
        })
    </script>
    <script>
        const btn = document.querySelector('#menu-btn');
        const menu = document.querySelector('#sidemenu');
        btn.addEventListener('click', e => {
            menu.classList.toggle("menu-expanded");
            menu.classList.toggle("menu-collapsed");

            document.querySelector('body').classList.toggle('body-expanded');
        });
    </script>
    <script>
        function disableIE() {
            if (document.all) {
                return false;
            }
        }

        function disableNS(e) {
            if (document.layers || (document.getElementById && !document.all)) {
                if (e.which == 2 || e.which == 3) {
                    return false;
                }
            }
        }
        if (document.layers) {
            document.captureEvents(Event.MOUSEDOWN);
            document.onmousedown = disableNS;
        } else {
            document.onmouseup = disableNS;
            document.oncontextmenu = disableIE;
        }
        document.oncontextmenu = new Function("return false");
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
            $('#escuelas').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/es-MX.json'
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#alumnos').DataTable({
                responsive: true,
                autoWidth: false,
                lengthChange: false,
                searching: false,
                paging: false,
                ordering: false,
                info: false,
                buttons: [{
                    extend: 'pdf',
                    split: ['excel', 'print'],
                }],
            });


            table.buttons().container().appendTo($('div.column.is-half', table.table().container()).eq(0));
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="js/funciones.js"></script>
</body>

</html>