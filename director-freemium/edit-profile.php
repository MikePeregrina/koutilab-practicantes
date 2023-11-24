<?php
session_start();
$id_user = $_SESSION['id_director_freemium'];
if (empty($_SESSION['active']) || empty($_SESSION['id_director_freemium'])) {
    header('location: ../acciones/cerrarsesion.php');
}

include('../acciones/conexion.php');
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM directores d
JOIN escuelas e 
ON d.id_escuela = e.id_escuela
WHERE d.id_director = $id_user"));

$id_escuela = $user['id_escuela'];
$clave = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM escuelas WHERE id_escuela = $id_escuela"));
$clave_alumno = $clave['clave_alumno'];
$clave_docente = $clave['clave_docente'];

$id = $user["id_director"];
$name = $user["nombre"];
$apellidop = $user["apellidop"];
$apellidom = $user["apellidom"];
$image = $user["image"];
$username = $user["usuario"];
$email = $user['email'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/edit-profile.css">
    <link rel="stylesheet" href="css/nav-barra.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>KOUTILAB</title>
</head>

<body>
    <div class="containers">
        <h1>EDITAR PERFIL</h1>
    </div>
    <section>
        <div class="titlec">
            <h2>Información de usuario</h2>
        </div>
        <div class="cont-profile">
            <div class="return">
                <a href="./dashboard.php">
                    <i class="fas fa-reply"></i>
                </a>
            </div>
            <div class="foto-perfil">
                <p>Foto de perfil</p>
                <form id="form" action="" enctype="multipart/form-data" method="post">
                    <div class="perfil-usuario-avatar">

                        <div class="avatar-img">
                            <img src="acciones/img/<?php echo $image; ?>" title="<?php echo $image; ?>">
                            <div class="camera-icon">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="name" value="<?php echo $name; ?>">
                                <input type="file" style="cursor: pointer;" name="image" id="image" accept=".jpg, .jpeg, .png">
                                <i class="fa fa-camera" style="color: white; font-size:30px;"></i>
                            </div>
                        </div>
                </form>
            </div>
        </div>
        <div class="info-perfil">
            <p>
                <i class="fas fa-user"></i>
                <b><?php echo $name, ' ', $apellidop, ' ', $apellidom ?></b>
            </p>
            <p>
                <i class="fas fa-school"></i>
                <b>Escuela:</b> <?php echo $user["nombre_escuela"] ?>
            </p>
            <p>
                <i class="fas fa-gem"></i>
                <b>Modo de uso del sistema:</b> <?php echo $user["tipo"] ?>
            </p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <p>Correo electrónico:</p>
                <input type="email" name="correo" value="<?php echo $email; ?>">
                <p>Contraseña:</p>
                <input type="password" name="contrasena" placeholder="contraseña">
                <input type="submit" name="actualizar" value="Guardar cambios" id="btn-sub">
            </form>
        </div>
    </section>

    <?php include 'footer.php'; ?>

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
                window.location.href = 'edit-profile.php';
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
                    window.location.href = 'edit-profile.php';
                    window.location.reload();
                }
                });
                
            </script>
    ";
        } else {
            $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
            $newImageName .= '.' . $imageExtension;
            $query = "UPDATE directores SET image = '$newImageName' WHERE id_director = $id";
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
                    window.location.href = 'edit-profile.php';
                }
                });
            </script>
        ";
        }
    }
    ?>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
        $iddirector = $_SESSION['id_director_freemium'];
        $actualizacionExitosa = false; // Variable para verificar si se realizó alguna actualización con éxito

        if (isset($_POST['correo']) && !empty($_POST['correo'])) {
            $correo = $_POST['correo'];
            // Aquí deberías validar y sanitizar el correo antes de usarlo en la consulta SQL
            $sql_update_correo = mysqli_query($conexion, "UPDATE directores SET email = '$correo' WHERE id_director = '$iddirector'");
            if ($sql_update_correo) {
                $actualizacionExitosa = true;
            }
        }

        if (isset($_POST['contrasena']) && !empty($_POST['contrasena'])) {
            $contrasena = md5($_POST['contrasena']);
            $sql_update_contrasena = mysqli_query($conexion, "UPDATE directores SET contrasena = '$contrasena' WHERE id_director = '$iddirector'");
            if ($sql_update_contrasena) {
                $actualizacionExitosa = true;
            }
        }

        if ($actualizacionExitosa) {
            echo "
            <script>
            Swal.fire({
                title: 'Excelente!',
                text: 'Actualización exitosa',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'edit-profile.php';
                }
                });
            </script>
        ";
        } else {
            echo "
            <script>
            Swal.fire({
                title: '¡Advertencia!',
                text: 'No se realizaron cambios o hubo un error en la actualización',
                icon: 'info',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Reintentar'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'edit-profile.php';
                }
                });
            </script>
        ";
        }
    }
    ?>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>