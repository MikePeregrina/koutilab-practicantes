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
            <div class="foto-perfil">
                <p>Foto de perfil</p>
                <form id="form" action="" enctype="multipart/form-data" method="post">
                    <div class="perfil-usuario-avatar">

                        <div class="avatar-img">
                            <img src="../docente-primaria/acciones/img/docente - 2023.02.12 - 04.48.11am.jpg" alt="">
                            <div class="camera-icon">
                                <input type="hidden" name="id" value="<?php // echo $id; 
                                                                        ?>">
                                <input type="hidden" name="name" value="<?php // echo $name; 
                                                                        ?>">
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
                <b>Nombre(s) Apellido Apellido</b>
            </p>
            <p>
                <i class="fas fa-school"></i>
                <b>Escuela:</b> Escuela ejemplo
            </p>
            <p>
                <i class="fas fa-gem"></i>
                <b>Modo de uso del sistema:</b> Licencia
            </p>
            <form action="">
                <p>
                    Correo electrónico:
                </p>
                <input type="email" value="correo">
                <p>Contraseña:</p>
                <input type="password" placeholder="contraseña">
                <input type="button" value="Guardar cambios" id="btn-sub">
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
            $query = "UPDATE docentes_primaria SET image = '$newImageName' WHERE id_docente = $id";
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