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


$query = "SELECT curso FROM cursos_universidad";
$result = $conexion->query($query);
if ($result->num_rows > 0) {
    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
$sql = "SELECT COUNT(*) id_grupo FROM grupos_universidad WHERE id_docente = '$id_user'";
$result = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="img/lgk.png">
    <link rel="stylesheet" href="css/grupos.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.bulma.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="acciones/Exportacion/datatables.min.css">
</head>

<body>
    <div id="sidemenu" class="menu-collapsed">
        <div id="header">
            <div id="title"><img src="img/koutilab3.png" alt=""></div>
            <div id="menu-btn">
                <div class="btn-hamburger"></div>
                <div class="btn-hamburger"></div>
                <div class="btn-hamburger"></div>
            </div>
        </div>
        <div class="item separator"></div>
        <?php
        $id = $user["id_docente"];
        $name = $user["nombre"];
        $image = $user["image"];
        $username = $user["usuario"];
        ?>
        <div id="profile">
            <div id="photo"><img src="acciones/img/<?php echo $image; ?>" title="<?php echo $image; ?>"></div>
            <div id="name"><span><?php echo $name; ?></span></div>
        </div>
        <div id="menu-items">
            <div class="item separator"></div>
            <div class="item">
                <a href="dashboard.php" class="">
                    <div class="icon" style="height: 40px; margin: 5px 0px 5px 0px;">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="title">
                        <span>Dashboard</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
            <div class="item" style="background-color: rgba(61,172,244, .4);">
                <a href="grupos.php" class="">
                    <div class="icon" style="height: 40px; margin: 5px 0px 5px 0px;">
                        <i class='fas fa-users'></i>
                    </div>
                    <div class="title">
                        <span>Grupos</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
            <div class="item">
                <a href="contacto.php" class="">
                    <div class="icon" style="height: 40px; margin: 5px 0px 5px 0px;">
                        <i class="fa fa-address-book"></i>
                    </div>
                    <div class="title">
                        <span>Contacto</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
            <div class="item">
                <a id="btn-abrir-modalV" class="">
                    <div class="icon" style="height: 40px; margin: 5px 0px 5px 0px;">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                    </div>
                    <div class="title">
                        <span>Ayuda</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
        </div>
    </div>
    <div id="interface">
        <div class="navigation">
            <div class="n1" style="margin-left: 505px;">
                <img src="img/koutilab0.png">
            </div>
            <div class="perfil">
                <h6 class style="margin-right: 20px; margin-top: 5px;"><?php echo $user["nombre_escuela"] ?></h6>
                <a href="../acciones/cerrarsesion.php"><i class="fa fa-sign-out"></i></a>
            </div>
        </div>
    </div>
    <div class="values ms-5 mt-4 pe-1">
        <h3 class="i-name"> Grupos</h3>
    </div>
    <div class="values ms-5">
        <div class="val-box pe-2">
            <i class="fas fa-users"></i>
            <div>
                <h3><?php echo $fila['id_grupo']; ?><span> Grupos</span></h3>
            </div>
        </div>
        <div class="val-box ps-2">
            <i class="fas fa-users"></i>
            <div>
                <button id="btn-abrir-modalG" class="submit-btn">Crear Grupo</button>
            </div>
        </div>
    </div>
    <div class="board p-2" style="width: 92%; margin-left: 75px;">
        <table id="grupos" width="100%" class="table border-top">
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

                $query_grupos = mysqli_query($conexion, "SELECT * FROM grupos_universidad WHERE id_docente = $id_user AND estado = 1");
                $result = mysqli_num_rows($query_grupos);
                if ($result > 0) {
                    while ($data = mysqli_fetch_assoc($query_grupos)) {

                ?>
                        <tr>
                            <td><?php echo $data['materia']; ?></td>
                            <td><?php echo $data['nombre_grupo']; ?></td>
                            <td><?php echo $data['grado']; ?></td>
                            <td><?php echo $data['clave']; ?></td>

                            <td>
                                <a href="acciones/mostrar_grupo.php?id=<?php echo $data['id_grupo']; ?>" class="btn btn-info" style="margin-right: 5px;"><i class='fas fa-clipboard-list' style="color: white;"></i></a>
                                <a href="acciones/mostrar_estadisticas_grupo.php?id=<?php echo $data['id_grupo']; ?>" class="btn btn-info" style="margin-right: 5px;"><i class='fas fa-clipboard-list' style="color: red;"></i></a>
                                <a href="acciones/editar_grupo.php?id=<?php echo $data['id_grupo']; ?>" class="btn btn-success" style="margin-right: 5px;"><i class='fas fa-edit'></i></a>
                                <a href="acciones/agregar_curso.php?id=<?php echo $data['id_grupo']; ?>" class="btn btn-success" style="margin-right: 5px;"><i class='fas fa-plus'></i></a>
                                <form style="padding: 0px 0px;" action="acciones/eliminar_grupo.php?id=<?php echo $data['id_grupo']; ?>" method="post" class="confirmar d-inline">
                                    <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
                                </form>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
    <dialog close id="modalV" style="background-image: url(img/bg1.png); border-radius: 20px; border: 2px solid #f1f2f3; width: 50%;">
        <div>
            <button style="float: right; background: white; width: 7%; scale: 70%; margin-top: -10px;" class="btn-b" id="btn-cerrar-modalV"><i class="fas fa-close"></i></button>
            <br>
            <video width="100%" height="100%" controls>
                <source src="vid/Video explicativo_2.mp4" type="video/mp4">
            </video>
        </div>
    </dialog>
    <script>
        const btnAbrirModalV = document.querySelector("#btn-abrir-modalV");
        const btnCerrarModalV = document.querySelector("#btn-cerrar-modalV");
        const modalV = document.querySelector("#modalV");
        btnAbrirModalV.addEventListener("click", () => {
            modalV.showModal();
        })

        btnCerrarModalV.addEventListener("click", () => {
            modalV.close();
        })
    </script>
    <dialog close id="modalG">
        <div class="container1" style="margin-top: -50px;">
            <button style="float: right; margin-bottom: -15px; z-index: 5; margin-right: -10px;" class="btn-b" id="btn-cerrar-modalG"><i class="fas fa-close"></i></button>
            <div class="board1" style="margin-left: 7px;text-align:center; width: 98%;">
                <h3 class="i-name">Nuevo grupo</h3>
            </div>
            <form id="grupos" method="POST" enctype="multipart/form-data" action="acciones/insertar_grupo.php" autocomplete="off">
                <div class="user-details1">
                    <div class="input-box1">
                        <span class="details">Materia: </span>
                        <input type="text" name="materia" placeholder="Nombre de la materia" required>
                    </div>
                    <div class="input-box1">
                        <span class="details">Nombre del grupo: </span>
                        <input type="text" name="nombre_grupo" id="nombre_grupo" onkeydown="generarGrupo()" placeholder="Ejemplo: A Matutino" required>
                    </div>
                    <div class="input-box1">
                        <span class="details">Grado: </span>
                        <select style="height: 44px;" name="grado" type="select" required>
                            <option value="">Eliga un grado</option>
                            <option value="1°">1°</option>
                            <option value="2°">2°</option>
                            <option value="3°">3°</option>
                        </select>
                    </div>
                    <div class="input-box1">
                        <span class="details">Curso: </span>
                        <select style="height: 44px;" name="curso" required>
                            <option>Seleccionar curso</option>
                            <option value="1">Programación web básico</option>
                            <option value="2">Programación web intermedio</option>
                            <option value="3">Programación web avanzado</option>
                            <option value="4">Python básico</option>
                            <option value="5">Python intermedio</option>
                            <option value="6">Python avanzado</option>
                        </select>
                    </div>
                    <div class="input-box1">
                        <span class="details">Clave: </span>
                        <input type="text" name="clave" id="clave" required readonly>
                    </div>
                    <div class="input-box1">
                        <span class="details"></span><br>
                        <button type="button" class="btn-grd" onclick="copyToClipBoard()">Copiar clave</button>
                    </div>
                </div>
                <button type="submit" class="btn-grd">Guardar</button>
            </form>
        </div>
    </dialog>
    <dialog close id="modalList">
        <div class="container2">
            <div>
                <button style="float: right; margin-bottom: -14px; margin-right: -10px;" class="btn-b" id="btn-cerrar-modalList"><i class="fas fa-close"></i></button>
            </div>
            <div class="new-g">Lista de alumnos</div>
            <div class="board1">
                <table id="grupos" width="30%" class="table">
                    <thead>
                        <tr>
                            <td><b>Nombre</b></td>
                            <td><b>Nivel educativo</b></td>
                            <td><b>Grado escolar</b></td>
                            <td><b>Grupo</b></td>
                            <td><b>Trofeos</b></td>
                            <td><b>Puntaje</b></td>
                            <td><b>Práctico</b></td>
                            <td><b>Teorico</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../acciones/conexion.php";
                        $query_alumnos = mysqli_query($conexion, "SELECT * FROM alumnos_universidad a JOIN estadisticas_universidad e ON a.id_alumno = e.id_alumno WHERE a.id_docente = '$id_user'");
                        $result = mysqli_num_rows($query_alumnos);
                        if ($result > 0) {
                            while ($data = mysqli_fetch_assoc($query_alumnos)) {
                        ?>
                                <tr>
                                    <td><?php echo $data['nombre']; ?></td>
                                    <td><?php echo $data['nivel_educativo']; ?></td>
                                    <td><?php echo $data['grado_escolar']; ?></td>
                                    <td><?php echo $data['nombre_grupo']; ?></td>
                                    <td><?php echo $data['trofeos']; ?></td>
                                    <td><?php echo $data['puntos']; ?></td>
                                    <td><?php echo $data['practico']; ?></td>
                                    <td><?php echo $data['teorico']; ?></td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </dialog>
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
            resultado = prefijo.toUpperCase() + "-" + generarClaveGrupo().toUpperCase();
            document.getElementById("clave").value = resultado.split(" ").join("");
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
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.bulma.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#grupos').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/es-MX.json'
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#alumnos').DataTable({
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