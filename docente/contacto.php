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
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="img/lgk.png">
    <link rel="stylesheet" href="css/contacto.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
                    <div class="icon">
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
                    <div class="icon">
                        <i class='fas fa-users'></i>
                    </div>
                    <div class="title">
                        <span>Grupos</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
            <div class="item">
                <a href="alumnos.php" class="">
                    <div class="icon">
                        <i class='fas fa-user-alt'></i>
                    </div>
                    <div class="title">
                        <span>Alumnos</span>
                    </div>
                </a>
            </div>
            <div class="item separator"></div>
            <div class="item" style="background-color: rgba(61,172,244, .4);">
                <a href="contacto.php" class="">
                    <div class="icon">
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
                    <div class="icon">
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
    <div class="values ms-5 mt-3 pe-1">
        <h3 class="i-name"> Contacto</h3>
    </div>
    <div class="board" style="width: 95.7%; margin-left: 52px;">
        <form id="contacto" method="POST" enctype="multipart/form-data" action="">
            <h2>Comentarios y sugerencias</h2>
            <input type="hidden" name="nombre_escuela" placeholder="Nombre de la escuela" value="<?php echo $user['nombre_escuela'] ?>">
            <input type="hidden" name="nombre_usuario" placeholder="Nombre" value="<?php echo $user['nombre'] ?>">
            <input type="text" name="asunto" placeholder="Asunto">
            <textarea name="mensaje" id="contacto" placeholder="Escriba aqu&iacute; su mensaje" rows="5" cols="40"></textarea>
            <button type="submit" name="enviarcontacto" class="btn-grd">Enviar</button>
        </form>
    </div>

    <dialog close id="modalV" style="background-image: url(img/bg1.png); border-radius: 20px; border: 2px solid #f1f2f3; width: 50%;">
        <div>
            <button style="float: right; background: white; padding-left: 10px; padding-right: 9px; scale: 100%; border-radius: 50%; outline: none; border: 0px; margin-bottom: 5px;" class="" id="btn-cerrar-modalV"><i class="fas fa-close"></i></button>
            <br>
            <video width="100%" height="100%" controls>
                <source src="vid/Video explicativo_2.mp4" type="video/mp4">
            </video>
        </div>
    </dialog>

    <?php
    if (isset($_POST['enviarcontacto'])) {
        //Datos contacto
        $nombre_escuela = $_POST['nombre_escuela'];
        $nombre_usuario = $_POST['nombre_usuario'];
        $asunto = $_POST['asunto'];
        $mensaje = $_POST['mensaje'];
        $insertar_contacto = mysqli_query($conexion, "INSERT INTO sugerencias(nombre_escuela, nombre_usuario, asunto, mensaje, estado) VALUES ('$nombre_escuela', '$nombre_usuario', '$asunto', '$mensaje', 1)");

        if ($insertar_contacto) {
            echo
            "
      <script>
      Swal.fire({
          title: 'Excelente!',
          text: 'Sugerencia enviada',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'contacto.php';
          }
        });
      </script>
        ";
        } else {
            echo
            "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: 'Tu sugerencia no fue enviada',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'contacto.php';
          }
        });
      </script>
        ";
        }
    }
    ?>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>