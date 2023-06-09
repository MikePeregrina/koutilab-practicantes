<?php
session_start();
$id_user = $_SESSION['id_docente_preparatoria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_docente_preparatoria'])) {
    header('location: ../acciones/cerrarsesion.php');
}

include('../acciones/conexion.php');
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM docentes_preparatoria d
JOIN escuelas e 
ON d.id_escuela = e.id_escuela
WHERE d.id_docente = $id_user"));
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="img/lgk.png">
    <link rel="stylesheet" href="css/dashboard.css" />
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div id="sidemenu" class="menu-collapsed">
        <div id="header">
            <div id="title"><img src="img/koutilab3.png" alt="" /></div>
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
            <div class="item" style="background-color: rgba(61,172,244, .4);">
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
                <a id="btn-abrir-modalA" class="">
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
        <h3 class="i-name">Dashboard</h3>
    </div>

    <div class="body">
        <div class="latd" style="width: 33%; margin-left: 77px; margin-right: 40px">
            <div class="dos1">
                <div class="titlec" style="margin-left: 60px;">
                    <h4 class="i-name">Datos de usuario</h4>
                </div>
                <ul class="lista-datos">
                    <li><b>Foto de perfil:</b> </li>
                    <li>
                        <form class="form" id="form" action="" enctype="multipart/form-data" method="post">
                            <div class="upload">
                                <?php
                                $id = $user["id_docente"];
                                $name = $user["nombre"];
                                $image = $user["image"];
                                ?>
                                <div id="photo"><img style="width: 160px; height: 160px; border-radius: 50%; margin-top:10px; margin-left:30%;  object-fit: cover;" src="acciones/img/<?php echo $image; ?>" title="<?php echo $image; ?>"></div>
                                <div class="round" style="margin-right: 165px; margin-bottom: 435px; scale: 90%;">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                                    <input type="file" name="image" id="image" class="" accept=".jpg, .jpeg, .png">
                                    <i class="fa fa-camera" style="color: rgba(61, 172, 244);"></i>
                                </div>
                            </div>
                        </form>
                    </li>
                    <hr style="width: auto">
                    <li><b>Nombre:</b> <?php echo $name; ?></li><br>
                    <li><b>Usuario:</b> <?php echo $username ?></li><br>
                    <li><b>Escuela:</b> <?php echo $user["nombre_escuela"] ?></li><br>
                    <li><b>CCT:</b> <?php echo $user["cct"] ?></li><br>
                    <hr style="width: auto">
                    <li><b>Contraseña:</b> </li><br>
                    <li>
                        <form enctype="multipart/form-data" action="" method="post">
                            <div class="user-details1">
                                <div class="input-box1" style="width: auto; scale: 80%; margin-top:-20px; margin-left: -25px;">
                                    <input type="text" name="contrasena" value="" placeholder="Nueva contraseña">
                                    <input type="submit" name="enviarcontrasena" value="Actualizar" class="btn-grd" style="scale: 80%; width: 60%;">
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="latd">
            <div class="titlec">
                <h4 class="i-name">Cursos</h4>
            </div>
            <div class="card" style="scale: 80%;">
                <a href="img/temario-pw-b.pdf" target="_blank">
                    <div><i class="fab fa-html5 fa-6x"></i></div>
                    <h2>Programación web básico</h2>
                </a>
            </div>
            <div class="card" style="scale: 80%;">
                <a href="img/temario-pw-i.pdf" target="_blank">
                    <div><i class="fab fa-html5 fa-6x"></i></div>
                    <h2>Programación web intermedio</h2>
                </a>
            </div>
            <!-- <div class="card" style="scale: 80%;">
                <a href="img/temario-pw-a.pdf" target="_blank">
                    <div><i class="fab fa-html5 fa-6x"></i></div>
                    <h2>Programación web avanzado</h2>
                </a>
            </div> -->
            <!-- <div class="card" style="scale: 80%;">
                <a href="img/temario-py-b.pdf" target="_blank">
                    <div><i class="fab fa-python fa-6x"></i></div>
                    <h2>Python básico</h2>
                </a>
            </div> -->
            <!-- <div class="card" style="scale: 80%;">
                <a href="img/temario-py-i.pdf" target="_blank">
                    <div><i class="fab fa-python fa-6x"></i></div>
                    <h2>Python intermedio</h2>
                </a>
            </div> -->
            <!-- <div class="card" style="scale: 80%;">
                <a href="img/temario-py-a.pdf" target="_blank">
                    <div><i class="fab fa-python fa-6x"></i></div>
                    <h2>Python avanzado</h2>
                </a>
            </div> -->
            <!-- <div class="card" style="scale: 80%;">
                <a href="img/PWB.pdf" target="_blank">
                    <div><i class="fab fa-html5 fa-6x"></i></div>
                    <h2>Arduino básico</h2>
                </a>
            </div> -->
            <!-- <div class="card" style="scale: 80%;">
                <a href="img/PWB.pdf" target="_blank">
                    <div><i class="fab fa-html5 fa-6x"></i></div>
                    <h2>Arduino intermedio</h2>
                </a>
            </div> -->
            <!-- <div class="card" style="scale: 80%;">
                <a href="img/PWB.pdf" target="_blank">
                    <div><i class="fab fa-html5 fa-6x"></i></div>
                    <h2>Arduino avanzado</h2>
                </a>
            </div> -->
        </div>
    </div>

    <dialog close id="modalA" style="background-image: url(img/bg1.png); border-radius: 20px; border: 2px solid #f1f2f3; width: 50%;">
        <div>
            <button style="float: right; background: white; width: 7%; scale: 70%;" class="btn-b" id="btn-cerrar-modalA"><i class="fas fa-close"></i></button>
            <br>
            <video width="100%" height="100%" controls>
                <source src="vid/Video explicativo_2.mp4" type="video/mp4">
            </video>
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

    <dialog close id="modalC">
        <div class="container1">
            <button style="float: right;" class="btn-b" id="btn-cerrar-modalC"><i class="fas fa-close"></i></button>
            <?php
            if (isset($_POST['enviar'])) {
                $id = $_POST['id_docente'];
                $name = $_POST['nombre'];
                $contrasena = $_POST['contrasena'];

                $sql = "UPDATE docentes_preparatoria SET contrasena='" . $contrasena . "'";
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
                $id = $user["id_docente"];
                $name = $user["nombre"];
                $contrasena = $user["contrasena"];
            ?>
                <form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                    <h2>Cambiar contraseña</h2>
                    <div class="user-details1">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="hidden" name="name" value="<?php echo $name ?>">
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
        const btn = document.querySelector("#menu-btn");
        const menu = document.querySelector("#sidemenu");
        btn.addEventListener("click", (e) => {
            menu.classList.toggle("menu-expanded");
            menu.classList.toggle("menu-collapsed");

            document.querySelector("body").classList.toggle("body-expanded");
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx1 = document.getElementById('myChart1');

        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['HTML', 'CSS', 'PHP', 'PYTHON'],
                datasets: [{
                    label: 'Progreso de grupo 1',
                    data: [10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        const ctx2 = document.getElementById('myChart2');

        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: ['HTML', 'CSS', 'PHP', 'PYTHON'],
                datasets: [{
                    label: 'Progreso de grupo 2',
                    data: [10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
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

    <!-- Cambiar foto de perfil -->

    <script type="text/javascript">
        document.getElementById("image").onchange = function() {
            document.getElementById("form").submit();
        };
    </script>
    <?php
    if (isset($_FILES["image"]["name"])) {
        $id = $_POST["id"];
        $name = $_POST["name"];

        $imageName = $_FILES["image"]["name"];
        $imageSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        // Image validation
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $imageName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            echo
            "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: 'Extensión de imágen invalida',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'dashboard.php';
          }
        });
      </script>
        ";
        } elseif ($imageSize > 1200000) {
            echo
            "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: 'Tamaño de imágen demasiado larga',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'dashboard.php';
            window.location.reload();
          }
        });
        
      </script>
        ";
        } else {
            $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
            $newImageName .= '.' . $imageExtension;
            $query = "UPDATE docentes_preparatoria SET image = '$newImageName' WHERE id_docente = $id";
            mysqli_query($conexion, $query);
            move_uploaded_file($tmpName, 'acciones/img/' . $newImageName);
            echo
            "
      <script>
      Swal.fire({
          title: 'Excelente!',
          text: 'Cambio de imágen exitoso',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'dashboard.php';
          }
        });
      </script>
        ";
        }
    }
    ?>

    <?php
    if (isset($_POST['enviarcontrasena'])) {
        $iddocente = $_SESSION['id_docente_preparatoria'];
        $contrasena = md5($_POST['contrasena']);

        $sql_update = mysqli_query($conexion, "UPDATE docentes_preparatoria SET contrasena = '$contrasena' WHERE id_docente = '$iddocente'");

        if ($sql_update) {
            echo
            "
      <script>
      Swal.fire({
          title: 'Excelente!',
          text: 'Cambio de contraseña exitosa',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'dashboard.php';
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
          text: 'Cambio de contraseña no exitosa',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'dashboard.php';
          }
        });
      </script>
        ";
        }
    }
    ?>

</body>