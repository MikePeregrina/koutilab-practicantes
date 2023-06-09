<?php
session_start();
$id_user = $_SESSION['id_admin'];
if (empty($_SESSION['active']) || empty($_SESSION['id_admin'])) {
    header('location: ../acciones/cerrarsesion.php');
}
include('../acciones/conexion.php');
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM admin WHERE id_admin = $id_user"));

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="img/lgk.png">
    <link rel="stylesheet" href="css/escuelas.css">
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
        $id = $user["id_admin"];
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
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="title">
                        <span>Dashboard</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
            <div class="item">
                <a href="estadisticas.php" class="">
                    <div class="icon" style="height: 40px; margin: 5px 0px 5px 0px;">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <div class="title">
                        <span>Estadísticas</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
            <div class="item">
                <a href="ingresos.php" class="">
                    <div class="icon" style="height: 40px; margin: 5px 0px 5px 0px;">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <div class="title">
                        <span>Ingresos</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
            <div class="item">
                <a href="administradores.php" class="">
                    <div class="icon" style="height: 40px; margin: 5px 0px 5px 0px;">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="title">
                        <span>Agregar administrador</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
            <div class="item">
                <a href="escuelas.php" class="">
                    <div class="icon" style="height: 40px; margin: 5px 0px 5px 0px;">
                        <i class='fa-solid fa-school'></i>
                    </div>
                    <div class="title">
                        <span>Escuelas</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
            <div class="item" style="background-color: rgba(61,172,244, .4);">
                <a href="preregistros.php" class="">
                    <div class="icon" style="height: 40px; margin: 5px 0px 5px 0px;">
                        <i class='fa-solid fa-clipboard'></i>
                    </div>
                    <div class="title">
                        <span>Pre-registros</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
            <div class="item">
                <a href="bandeja.php" class="">
                    <div class="icon" style="height: 40px; margin: 5px 0px 5px 0px;">
                        <i class='fas fa-envelope'></i>
                    </div>
                    <div class="title">
                        <span>Bandeja</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
        </div>
    </div>
    <div id="interface">
        <div class="navigation">
            <div class="n1" style="margin-left: 460px;">
                <img src="img/koutilab0.png">
            </div>
            <div class="perfil">
                <a href="../acciones/cerrarsesion.php"><i class="fa fa-sign-out"></i></a>
            </div>
        </div>
    </div>
    <div class="values ms-5 mt-4 pe-1">
        <h3 class="i-name"> Pre-Registros</h3>
    </div>

    <div class="board p-2" style="width: 92%; margin-left: 75px;">
        <table id="preregistros" width="100%" class="table border-top">
            <thead>
                <tr>
                    <td><b>Nombre</b></td>
                    <td><b>Cargo</b></td>
                    <td><b>WhatsApp</b></td>
                    <td><b>Correo</b></td>
                    <td><b>Escuela</b></td>
                    <td><b>País</b></td>
                    <td><b>Estado</b></td>
                    <td><b>Grado</b></td>
                    <td><b>Total alumnos</b></td>
                    <td><b>Otro</b></td>
                    <td><b>Acción</b></td>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../acciones/conexion.php";

                $query_formulario = mysqli_query($conexion, "SELECT * FROM formulario");
                $result = mysqli_num_rows($query_formulario);
                if ($result > 0) {
                    while ($data = mysqli_fetch_assoc($query_formulario)) {

                ?>
                        <tr>
                            <td><?php echo $data['nombre_r']; ?></td>
                            <td><?php echo $data['cargo']; ?></td>
                            <td><?php echo $data['contacto']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td><?php echo $data['nombre_e']; ?></td>
                            <td><?php echo $data['pais']; ?></td>
                            <td><?php echo $data['estado']; ?></td>
                            <td><?php echo $data['grado']; ?></td>
                            <td><?php echo $data['numero_a']; ?></td>
                            <td><?php echo $data['otro_c']; ?></td>
                            <td>
                                <a href="acciones/preregistrar.php?id=<?php echo $data['id']; ?>" class="btn btn-success" style="margin-right: 5px;"><i class='fas fa-check'></i></a>
                                <form style="padding: 0px 0px;" action="acciones/eliminar_preregistro.php?id=<?php echo $data['id']; ?>" method="post" class="confirmar d-inline">
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
        <div class="container">
            <button style="float: right;" class="btn-b" id="btn-cerrar-modalA"><i class="fas fa-close"></i></button>
            <div class="new-g">Registrar alumno</div><br>
            <form>
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
                            <option value="">Eliga un grupo</option>
                            <option value="">Grupo 2</option>
                            <option value="">Grupo 3</option>
                            <option value="">Grupo 4</option>
                            <option value="">Grupo 5</option>
                            <option value="">Grupo 6</option>
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
                <button class="btn-grd">Registrar</button>

            </form>

        </div>
    </dialog>

    <dialog close id="modalV" style="background-image: url(img/bg1.png); border-radius: 20px; border: 2px solid #f1f2f3;">
        <div>
            <button style="float: right; background: white; width: 8%; scale: 70%;" class="btn-b" id="btn-cerrar-modalV"><i class="fas fa-close"></i></button>
            <br>
            <video width="520" height="250" controls>
                <source src="" type="video/mp4">
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
        <div class="container">
            <button style="float: right;" class="btn-b" id="btn-cerrar-modalG"><i class="fas fa-close"></i></button>
            <form action="../acciones/guardar-escuelas.php" method="post">
                <h2>Registrar escuela</h2>
                <div class="user-details">

                    <input type="hidden" placeholder="Quien autoriza" name="nombre_autoriza" required>

                    <div class="input-box">
                        <span class="details">Escuela:</span>
                        <input type="text" placeholder="Nombre de la escuela" name="nombre_escuela" required>
                    </div>
                    <div class="input-box">
                        <span class="details">CCT:</span>
                        <input type="text" placeholder="AP123456" name="CCT" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Director:</span>
                        <input type="text" placeholder="Ejemplo: Juan Ejemplo Ejemplo" name="nombre_director" required>
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
                        <span class="details">Colonia:</span>
                        <input type="text" placeholder="Colonia" name="colonia" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Estado:</span>
                        <select required name="estado">
                            <option value="">Elige una opción</option>
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
                        <span class="details">País:</span>
                        <select name="pais">
                            <option value="">Elige una opción</option>
                            <option value="US">Estados Unidos</option>
                            <option value="MX">México</option>
                            <option value="PE">Perú</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Código Postal:</span>
                        <input type="text" placeholder="Codigo" name="codigo" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Nivel Educativo:</span>
                        <select required name="nivel">
                            <option value="">Elige una opción</option>
                            <option value="Primaria">Primaria</option>
                            <option value="Secundaria">Secundaria</option>
                            <option value="Preparatoria">Preparatoria</option>
                            <option value="PrimaSecu">Primaria - Secundaria</option>
                            <option value="SecuPrepa">Secundaria - Preparatoria</option>
                            <option value="Todos">Los tres niveles</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Clave director:</span>
                        <input type="text" placeholder="AP123456" name="clave_director" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Clave profesor:</span>
                        <input type="text" placeholder="AP123456" name="clave_profesor" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Clave alumnos:</span>
                        <input type="text" placeholder="AP123456" name="clave_alumnos" required>
                    </div>
                    <div class="input-box">
                        <button class="btn-grd">Generar claves</button>
                        </div<br>
                    </div>
                    <button class="btn-grd" type="submit">Registrar</button>
            </form>
        </div>
    </dialog>

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
            $('#escuelas').DataTable({
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