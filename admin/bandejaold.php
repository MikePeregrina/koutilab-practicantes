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
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="img/lgk.png">
<link rel="stylesheet" href="css/nav-barra.css">
<link rel="stylesheet" href="css/administradores.css">
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
        <h1>BANDEJA DE ENTRADA </h1>
    </div>


    <section>
        <div class="board p-2">
            <table id="bandeja" width="100%" class="table border-top">
                <thead>
                    <tr>
                        <td><b>Nombre</b></td>
                        <td><b>Escuela</b></td>
                        <td><b>Asunto</b></td>
                        <td><b>Sugerencia</b></td>
                        <td><b>Estado</b></td>
                        <td><b>Acción</b></td>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include "../acciones/conexion.php";

                    $query_sugerencias = mysqli_query($conexion, "SELECT * FROM sugerencias ORDER BY estado DESC");
                    $result = mysqli_num_rows($query_sugerencias);
                    if ($result > 0) {
                        while ($data = mysqli_fetch_assoc($query_sugerencias)) {
                            if ($data['estado'] == 1) {
                                $estado = 'Pendiente';
                            } else {
                                $estado = 'Completado';
                            }
                    ?>
                            <tr>
                                <td><?php echo $data['nombre_usuario']; ?></td>
                                <td><?php echo $data['nombre_escuela']; ?></td>
                                <td><?php echo $data['asunto']; ?></td>
                                <td><?php echo $data['mensaje']; ?></td>
                                <td><?php echo $estado; ?></td>

                                <td>
                                    <?php if ($data['estado'] == 1) { ?>
                                        <form style="padding: 0px 0px;" action="acciones/eliminar_sugerencia.php?id=<?php echo $data['id_sugerencia']; ?>" method="post" id="f-c" class="confirmar d-inline">
                                            <button class="btn btn-danger" id="btn-trs" type="submit"><i id="i-trs" class='fas fa-check'></i> </button>
                                        </form>
                                    <?php } ?>
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
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#bandeja').DataTable({
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
        document.querySelector('.campo span').addEventListener('click', e => {
            const passwordInput = document.querySelector('#password');
            if (e.target.classList.contains('show')) {
                e.target.classList.remove('show');
                e.target.textContent = 'Ocultar';
                passwordInput.type = 'text';
            } else {
                e.target.classList.add('show');
                e.target.textContent = 'Mostrar';
                passwordInput.type = 'password';
            }
        });
    </script>
    <script src="js/bar.js"></script>
    <script src="js/funciones.js"></script>

</body>

</html>