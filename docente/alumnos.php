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
//Seleccionar nombre del grupo
$query = "SELECT a.nombre FROM alumnos_primaria a 
JOIN docentes_primaria d
ON a.id_alumno = d.id_docente
WHERE $id_user = d.id_docente";


$query_grupo = "SELECT nombre_grupo FROM grupos_primaria WHERE id_docente = $id_user";
$result = $conexion->query($query_grupo);
if ($result->num_rows > 0) {
    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
}


//Seleccinar y dar permiso a grupos
$grupo = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM grupos_primaria WHERE id_docente = $id_user"));


//Conteo de alumnos
$sql = "SELECT COUNT(*) id_alumno FROM alumnos_primaria a 
JOIN docentes_primaria d
ON a.id_docente = d.id_docente
WHERE d.id_docente = $id_user AND a.estado = 1";
$result = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($result);

//Estadisticas
$query1 = mysqli_query($conexion, "SELECT * FROM estadisticas_primaria WHERE id_alumno = $id_user");
$data1 = mysqli_fetch_assoc($query1);
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="img/lgk.png">
    <link rel="stylesheet" href="css/alumnos.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bulma.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <div class="item">
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
            <div class="item" style="background-color: rgba(61,172,244, .4);">
                <a href="alumnos.php" class="">
                    <div class="icon" style="height: 40px; margin: 5px 0px 5px 0px;">
                        <i class='fas fa-user-alt'></i>
                    </div>
                    <div class="title">
                        <span>Alumnos</span>
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
            <div class="item">
                <div class="item separator"></div>
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
                <ul class="nav">
                </ul>
                <a href="../acciones/cerrarsesion.php"><i class="fa fa-sign-out"></i></a>
            </div>
        </div>
    </div>
    <div class="values ms-5 mt-4 pe-1">
        <h3 class="i-name"> Alumnos</h3>
    </div>
    <div class="values ms-5">
        <div class="val-box1 pe-2">
            <i class="fas fa-users"></i>
            <div>
                <h3><?php echo $fila['id_alumno']; ?><span> Alumnos</span></h3>
            </div>
        </div>
        <div class="val-box1 ps-2">
            <i class="fas fa-users"></i>
            <div>
                <button id="btn-abrir-modalA" class="submit-btn">Añadir alumno</button>
            </div>
        </div>
    </div>

    <div class="board p-2" style="width: 92%; margin-left: 75px;">
        <table id="alumnos" width="100%" class="table border-top">
            <thead>
                <tr>
                    <td><b>Nombre</b></td>
                    <td><b>Grado escolar</b></td>
                    <td><b>Correo</b></td>
                    <td><b>Acción</b></td>
                </tr>
            </thead>
            <tbody>

                <?php
                include "../acciones/conexion.php";

                $query_alumnos = mysqli_query($conexion, "SELECT a.id_alumno, a.nombre, a.grado_escolar, a.email FROM alumnos_primaria a
                JOIN docentes_primaria d
                ON a.id_docente = d.id_docente
                WHERE d.id_docente = '$id_user' AND a.estado = 1");
                $result = mysqli_num_rows($query_alumnos);
                if ($result > 0) {
                    while ($data = mysqli_fetch_assoc($query_alumnos)) {

                ?>
                        <tr>
                            <td><?php echo $data['nombre']; ?></td>
                            <td><?php echo $data['grado_escolar']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td>
                                <a href="acciones/mostrar_alumno.php?id=<?php echo $data['id_alumno']; ?>" class="btn btn-info" style="margin-right: 5px;"><i class='fas fa-chart-line' style="color: white;"></i></a>
                                <a href="acciones/editar_alumno.php?id=<?php echo $data['id_alumno']; ?>" class="btn btn-success" style="margin-right: 5px;"><i class='fas fa-edit'></i></a>
                                <form style="padding: 0px 0px;" action="acciones/eliminar_alumno.php?id=<?php echo $data['id_alumno']; ?>" method="post" class="confirmar d-inline">
                                    <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
                                </form>
                            </td>
                        </tr>
                <?php }
                } ?>

            </tbody>
        </table>
    </div>
    <dialog close id="modalA">
        <div class="container1" style="margin-top: -40px;">
            <button style="float: right; margin-right: -5px;" class="btn-b" id="btn-cerrar-modalA"><i class="fas fa-close"></i></button>
            <div class="board" style="padding: 10px; margin-left: 7px; text-align:center; width: 98%; margin-bottom: -5px;">
                <h3 class="i-name">Añadir alumno</h3>
            </div>
            <form id="contacto" method="POST" enctype="multipart/form-data" action="acciones/insertar_alumnos.php">
                <div class="user-details1">
                    <input type="hidden" name="id_escuela" id="id_escuela" value="<?php echo $user['id_escuela'] ?>">
                    <input type="hidden" name="id_docente" id="id_docente" value="<?php echo $user['id_docente'] ?>">

                    <div class="input-box1">
                        <span class="details">Nivel educativo: </span>
                        <input type="text" value="Primaria" name="nivel_educativo" placeholder="Nivel educativo" required readonly>
                    </div>
                    <div class="input-box1">
                        <span class="details">Grado escolar: </span>
                        <select style="height: 44px;" name="grado_escolar" type="select" required>
                            <option value="">Eliga un grado</option>
                            <option value="1°">1°</option>
                            <option value="2°">2°</option>
                            <option value="3°">3°</option>
                            <option value="4°">4°</option>
                            <option value="5°">5°</option>
                            <option value="6°">6°</option>
                        </select>
                    </div>
                    <div class="input-box1">
                        <span class="details">Nombre completo: </span>
                        <input type="text" onkeydown="generarUsuario()" name="nombre" id="nombrealumno" placeholder="Nombre del Alumno" required>
                    </div>
                    <div class="input-box1">
                        <span class="details">Nombre del grupo: </span>
                        <select style="height: 44px;" type="select" name="nombre_grupo" required>
                            <option>Seleccionar grupo</option>
                            <?php
                            foreach ($options as $option) {
                            ?>
                                <option><?php echo $option['nombre_grupo']; ?> </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-box1">
                        <span class="details">Usuario: </span>
                        <!-- Generar usuario random -->
                        <input type="text" name="usuario" id="usuarioalumno" placeholder="Usuario del alumno" required readonly>
                    </div>
                    <div class="campo">
                        <label for="password">Contraseña:</label>
                        <input type="password" name="contrasena" id="password" value="ABC123">
                        <span class="fa fa-fw fa-eye password-icon show-password1" style="margin-right: -155px; margin-top: -40px; background: #ffffff00;"></span>
                    </div>
                    <!-- <input type="hidden" name="clave" value="alumno" required> -->
                    <div class="input-box1">
                        <span class="details">Clave: </span>
                        <input type="text" name="clave" id="clave" value="<?php echo $user['clave_alumno'] ?>" readonly>

                    </div>
                    <div class="input-box1">
                        <span class="details"></span><br>
                        <button type="button" class="btn-grd" onclick="copyToClipBoard()">Copiar clave</button>
                    </div>
                    <div class="input-box1">
                        <span class="details">Correo:</span>
                        <input type="email" name="email" id="email" placeholder="ejemplo@gmail.com" required>
                    </div>
                </div>
                <button type="submit" class="btn-grd">Registrar</button>

            </form>

        </div>
    </dialog>
    <dialog close id="modalE">
        <div class="container1">
            <button style="float: right;" class="btn-b" id="btn-cerrar-modalE"><i class="fas fa-close"></i></button>
            <form>
                <h2>Editar alumno</h2>
                <div class="user-details1">
                    <div class="input-box1">
                        <span class="details">Escuela: </span>
                        <input type="text" placeholder="Nombre de la escuela" required>
                    </div>
                    <div class="input-box1">
                        <span class="details">Profesor: </span>
                        <input type="text" placeholder="Nombre del profesor" required>
                    </div>
                    <div class="input-box1">
                        <span class="details">Nivel educativo: </span>
                        <input type="text" placeholder="Nivel educativo" required>
                    </div>
                    <div class="input-box1">
                        <span class="details">Grado escolar: </span>
                        <input type="text" placeholder="Grado escolar" required>
                    </div>
                    <div class="input-box1">
                        <span class="details">Nombre: </span>
                        <input type="text" placeholder="Nombre del Alumno" required>
                    </div>
                    <div class="input-box1">
                        <span class="details">Nombre del grupo: </span>
                        <select type="select" required>
                            <option>Seleccionar grupo</option>
                            <?php
                            foreach ($options as $option) {
                            ?>
                                <option><?php echo $option['nombre_grupo']; ?> </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-box1">
                        <span class="details">Usuario: </span>
                        <input type="text" placeholder="Usuario del alumno" required>
                    </div>
                    <div class="input-box1">
                        <span class="details">Contraseña: </span>
                        <input type="password" placeholder="Contraseña del alumno" required>
                    </div>
                </div>
                <button class="btn-grd">Guardar</button>

            </form>

        </div>
    </dialog>

    <dialog close id="modalEst" style="width: 50%;">
        <button style="float: right;" class="btn-b" id="btn-cerrar-modalEst"><i class="fas fa-close"></i></button><br>
        <div class="board" style="width: 90%">
            <table class="table">
                <thead>
                    <tr>
                        <td><b></b></td>
                        <td><b>HTML</b></td>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <h5>Trofeos</h5>
                        </td>
                        <td>
                            <h5><?php echo $data1["trofeos"] ?></h5>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <h5>Puntaje</h5>
                        </td>
                        <td>
                            <h5><?php echo $data1["puntos"] ?></h5>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <h5>Práctico</h5>
                        </td>
                        <td>
                            <h5><?php echo $data1["practico"] ?></h5>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <h5>Teorico</h5>
                        </td>
                        <td>
                            <h5><?php echo $data1["teorico"] ?></h5>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </dialog>

    <dialog close id="modalC">
        <div class="container1">
            <button style="float: right;" class="btn-b" id="btn-cerrar-modalC"><i class="fas fa-close"></i></button>
            <?php
            if (isset($_POST['enviar'])) {
                $contrasena = $_POST['contrasena'];

                $sql = "UPDATE docentes SET contrasena='" . $contrasena . "'";
                $resultado = mysqli_query($conexion, $sql);

                if ($resultado) {
                    echo "<script languaje='JavaScript'>
                    alert('Se actulizaron los datos');
                    location.assing('docente/perfil.php');
                  </script>";
                } else {
                    echo "<script languaje='JavaScript'>
                  </script>";
                }
            } else {
                $contrasena = $user["contrasena"];

                mysqli_close($conexion);
            ?>

                <form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                    <h2>Cambiar contraseña</h2>
                    <div class="user-details1">
                        <div class="input-box1" style="width: 100%;">
                            <input type="text" name="contrasena" value="" placeholder="Nueva contraseña">
                        </div>
                        <input type="submit" name="enviar" value="ACTUALIZAR" class="btn-grd">
                </form>
            <?php
            }
            ?>
        </div>
    </dialog>

    <dialog close id="modalV" style="background-image: url(img/bg1.png); border-radius: 20px; border: 2px solid #f1f2f3; width: 50%;">
        <div>
            <button style="float: right; background: white; width: 7%; scale: 70%; margin-bottom: 10px; margin-top: -10px;" class="btn-b" id="btn-cerrar-modalV"><i class="fas fa-close"></i></button>
            <br>
            <video width="100%" height="100%" controls>
                <source src="vid/Video explicativo_2.mp4" type="video/mp4">
            </video>
        </div>
    </dialog>

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

    <script>
        const btnAbrirModalC = document.querySelector("#btn-abrir-modalC");
        const btnCerrarModalC = document.querySelector("#btn-cerrar-modalC");
        const modalC = document.querySelector("#modalC");
        btnAbrirModalC.addEventListener("click", () => {
            modalC.showModal();
        })

        btnCerrarModalC.addEventListener("click", () => {
            modalC.close();
        })
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
        const btnAbrirModalEst = document.querySelector("#btn-abrir-modalEst");
        const btnCerrarModalEst = document.querySelector("#btn-cerrar-modalEst");
        const modalEst = document.querySelector("#modalEst");
        btnAbrirModalEst.addEventListener("click", () => {
            modalEst.showModal();
        })

        btnCerrarModalEst.addEventListener("click", () => {
            modalEst.close();
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
    <script>
        $(document).ready(function() {
            $('#alumnos').DataTable({
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