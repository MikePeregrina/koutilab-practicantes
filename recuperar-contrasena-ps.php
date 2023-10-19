<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="acciones/img/lgk.png">
    <link rel="stylesheet" href="acciones/css/indexL.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/23412c6a8d.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<!-- Recuperar contraseña para primaria y secundaria -->

<body onload="recuperarDatos();">
    <div class="img-bot">
        <img src="./img/Thumbs-Up.gif" alt="koubot">
        <div class="bubble" id="bubble">
            <p id="txt-name">Aquí debes poner SOLO tu nombre o nombres</p>
            <p id="txt-ap">Aquí debes poner tu clave escolar que usaste al registrarte, también te la puede proporcionar tu docente</p>
            <p id="txt-am">Aquí pide ayuda a tu docente, ya que solo el sabe tu clave secreta que está en su lista de alumnos</p>
            <p id="txt-reg">Al confirmar tus datos aparecerá una alerta con tu usuario y contraseña nueva, ¡Debes estar atento!</p>
            <div class="bubble-tail"></div>
        </div>
    </div>
    <div class="container">
        <div class="info-box">
            <div class="titl-info">
                <p>Bienvenido a</p>
            </div>
            <div class="logop">
                <img src="acciones/img/benvenida.png" alt="KOUTILAB">
            </div>
            <div class="separacion">
                <div class="linea"></div>
            </div>
            <div class="separacion">
                <div class="txt-info">
                    <p>La <b>PLATAFORMA EDUCATIVA</b> especializada en <b>CODING</b> para instituciones, escuelas y usuarios</p>
                </div>
            </div>
        </div>
        <div class="form-box">
            <div class="reg">
                <p>Olvidé mi contraseña</p>
            </div>
            <p></p>
            <div class="pasos">
                <div class="line" style="width: 40%;"></div>
                <div class="circle">
                    <p>1</p>
                </div>
                <div class="circle">
                    <div class="circle-white">
                        <p style="color: #000000;">2</p>
                    </div>
                </div>
            </div>
            <p class="preg">Ingresa los datos requeridos</p>
            <form action="" class="input-group" method="POST" style="margin: 0 0 0 0;">
                <div class="form-group">
                    <div class="input-icon">
                        <i class="ico fas fa-user"></i>
                    </div>
                    <input type="text" name="nombre_recuperar" class="input-field" placeholder="Nombre(s)" onmouseenter="aparecer1(); bubbleIn();" onmouseleave="desaparecer1(); bubbleOut();" required>
                </div>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="ico fas fa-school"></i>
                    </div>
                    <input type="password" name="clave_recuperar" class="input-field password1" placeholder="Clave escolar" onmouseenter="aparecer2(); bubbleIn();" onmouseleave="desaparecer2(); bubbleOut();" required>
                    <span class="fa fa-fw fa-eye password-icon show-password1" style="margin: -35px 20px 0 0;"></span>
                </div>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="ico fas fa-chalkboard-teacher"></i>
                    </div>
                    <input type="password" name="pass_recuperar" class="input-field password2" placeholder="Clave secreta de docente" onmouseenter="aparecer3(); bubbleIn();" onmouseleave="desaparecer3(); bubbleOut();" required>
                    <span class="fa fa-fw fa-eye password-icon show-password2" style="margin: -35px 20px 0 0;"></span>
                </div>
                <div class="sub-btn" style="margin: 30px 0 0 0">
                    <button type="submit" class="submit-btn" name="recuperar" onmouseenter="aparecer4(); bubbleIn();" onmouseleave="desaparecer4(); bubbleOut();">Confirmar</button>
                </div>

                <div class="sub-btn" style="margin: 20px 0 0 0; scale: 90%;">
                    <a href="#" onclick="history.back();" class="submit-btn">Regresar</a>
                </div>
            </form>
        </div>
    </div>

    <?php
    function eliminar_tildes($cadena)
    {
        //Ahora reemplazamos las letras
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );

        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena
        );

        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena
        );

        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena
        );

        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena
        );

        $cadena = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $cadena
        );

        return $cadena;
    }

    include('acciones/conexion.php');

    if (isset($_POST['recuperar'])) {
        //Generando clave aleatoria
        $logitudPass = 4;
        $miPassword  = substr(md5(microtime()), 1, $logitudPass);
        $clave1      = $miPassword;
        $clave       = md5($miPassword);

        //Recuperar datos del formulario
        $nombre_recuperar = $_POST['nombre_recuperar'];
        $clave_recuperar = $_POST['clave_recuperar'];
        $pass_recuperar = $_POST['pass_recuperar'];

        //Hacer mayusculas y quitar tildes o caracteres especiales
        $nombre_recuperar = strtoupper(eliminar_tildes($nombre_recuperar));
        $clave_recuperar = strtoupper(eliminar_tildes($clave_recuperar));
        $pass_recuperar = strtoupper(eliminar_tildes($pass_recuperar));

        //Verificar a que tipo de rol pertenece el corrreo
        $consulta1           = ("SELECT * FROM alumnos_primaria WHERE nombre = '$nombre_recuperar' AND clave = '$clave_recuperar' AND clave_secreta = '$pass_recuperar' ");
        $queryconsulta1      = mysqli_query($conexion, $consulta1);
        $cantidadConsulta1   = mysqli_num_rows($queryconsulta1);
        $dataConsulta1       = mysqli_fetch_array($queryconsulta1);

        $consulta2           = ("SELECT * FROM alumnos_secundaria WHERE nombre = '" . $nombre_recuperar . "' AND clave = '" . $clave_recuperar . "' AND clave_secreta = '" . $pass_recuperar . "' ");
        $queryconsulta2      = mysqli_query($conexion, $consulta2);
        $cantidadConsulta2   = mysqli_num_rows($queryconsulta2);
        $dataConsulta2       = mysqli_fetch_array($queryconsulta2);

        //Actualiza a la nueva contraseña
        if ($cantidadConsulta1) {
            if ($cantidadConsulta1 == 0) {
                header("Location: login.php");
                exit();
            } else {
                $updateClave1    = ("UPDATE alumnos_primaria SET contrasena = '$clave' WHERE nombre = '$nombre_recuperar' AND clave = '$clave_recuperar' AND clave_secreta = '$pass_recuperar' ");
                $queryResult     = mysqli_query($conexion, $updateClave1);

                $data2 = mysqli_query($conexion, "SELECT * FROM alumnos_primaria WHERE nombre = '$nombre_recuperar' AND clave = '$clave_recuperar' AND clave_secreta = '$pass_recuperar' ");
                while ($consulta = mysqli_fetch_array($data2)) {
                    $user = $consulta['usuario'];
                }

                echo "
                <script>
                Swal.fire({
                    title: '¡Hola de nuevo " . $nombre_recuperar . "! Tu nueva contraseña está activa',
                    html: 'Esta es tu nueva contraseña <b>" . $clave1 . "</b> y este es tu usuario <b>" . $user . "</b> para acceder nuevamente a tu cuenta. Asegúrate de cambiar de nuevo tu contraseña al ingresar.',
                    imageUrl: 'img/Thumbs-Up.gif',
                    imageHeight: 300,
                    confirmButtonColor: '#a14cd9',
                    confirmButtonText: 'Listo',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = './login.php';
                    }
                });
                </script>
                ";
            }
        } else if ($cantidadConsulta2) {
            if ($cantidadConsulta2 == 0) {
                header("Location: login.php");
                exit();
            } else {
                $updateClave1    = ("UPDATE alumnos_secundaria SET contrasena = '$clave' WHERE nombre = '$nombre_recuperar' AND clave = '$clave_recuperar' AND clave_secreta = '$pass_recuperar' ");
                $queryResult     = mysqli_query($conexion, $updateClave1);

                $data2 = mysqli_query($conexion, "SELECT * FROM alumnos_secundaria WHERE nombre = '$nombre_recuperar' AND clave = '$clave_recuperar' AND clave_secreta = '$pass_recuperar' ");
                while ($consulta = mysqli_fetch_array($data2)) {
                    $user = $consulta['usuario'];
                }

                echo "
                <script>
                Swal.fire({
                    title: '¡Hola de nuevo " . $nombre_recuperar . "! Tu nueva contraseña está activa',
                    html: 'Esta es tu nueva contraseña <b>" . $clave1 . "</b> y este es tu usuario <b>" . $user . "</b> para acceder nuevamente a tu cuenta. Asegúrate de cambiar de nuevo tu contraseña al ingresar.',
                    imageUrl: 'img/Thumbs-Up.gif',
                    imageHeight: 300,
                    confirmButtonColor: '#a14cd9',
                    confirmButtonText: 'Listo',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = './login.php';
                    }
                });
                </script>
                ";
            }
        } else {
            echo "
                <script>
                Swal.fire({
                    title: 'No pudimos encontrar tu usuario',
                    html: 'Verifica que los datos sean correctos e inténtalo nuevamente',
                    imageUrl: 'img/loop.gif',
                    imageHeight: 300,
                    confirmButtonColor: '#a14cd9',
                    confirmButtonText: 'Listo',
                });
                </script>
                ";
        }
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script>
        //Animacion de la burbuja de Koubot
        function bubbleIn() {
            var div = document.getElementById("bubble");
            div.style.cssText = "animation-name: bubble-in; animation-duration: 0.5s; animation-fill-mode: forwards;";
        }

        function bubbleOut() {
            var div = document.getElementById("bubble");
            div.style.cssText = "animation-name: bubble-out; animation-duration: 0.5s; animation-fill-mode: forwards;";
        }
    </script>

    <script>
        //Animación de los dialogos de koubot
        function aparecer1() {
            var div = document.getElementById("txt-name");
            div.style.cssText = "display: block";
        }

        function desaparecer1() {
            var div = document.getElementById("txt-name");
            div.style.cssText = "display: none;";
        }

        function aparecer2() {
            var div = document.getElementById("txt-ap");
            div.style.cssText = "display: block";
        }

        function desaparecer2() {
            var div = document.getElementById("txt-ap");
            div.style.cssText = "display: none;";
        }

        function aparecer3() {
            var div = document.getElementById("txt-am");
            div.style.cssText = "display: block";
        }

        function desaparecer3() {
            var div = document.getElementById("txt-am");
            div.style.cssText = "display: none;";
        }

        function aparecer4() {
            var div = document.getElementById("txt-reg");
            div.style.cssText = "display: block";
        }

        function desaparecer4() {
            var div = document.getElementById("txt-reg");
            div.style.cssText = "display: none;";
        }
    </script>

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

    <script>
        window.addEventListener("load", function() {

            // icono para mostrar contraseña
            showPassword2 = document.querySelector('.show-password2');
            showPassword2.addEventListener('click', () => {

                // elementos input de tipo clave
                password2 = document.querySelector('.password2');

                if (password2.type === "text") {
                    password2.type = "password"
                    showPassword2.classList.remove('fa-eye-slash');
                } else {
                    password2.type = "text"
                    showPassword2.classList.toggle("fa-eye-slash");
                }

            })

        });
    </script>

    <script>
        window.addEventListener("load", function() {

            // icono para mostrar contraseña
            showPassword3 = document.querySelector('.show-password3');
            showPassword3.addEventListener('click', () => {

                // elementos input de tipo clave
                password3 = document.querySelector('.password3');

                if (password3.type === "text") {
                    password3.type = "password"
                    showPassword3.classList.remove('fa-eye-slash');
                } else {
                    password3.type = "text"
                    showPassword3.classList.toggle("fa-eye-slash");
                }

            })

        });
    </script>

    <script>
        window.addEventListener("load", function() {

            // icono para mostrar contraseña
            showPassword4 = document.querySelector('.show-password4');
            showPassword4.addEventListener('click', () => {

                // elementos input de tipo clave
                password4 = document.querySelector('.password4');

                if (password4.type === "text") {
                    password4.type = "password"
                    showPassword4.classList.remove('fa-eye-slash');
                } else {
                    password4.type = "text"
                    showPassword4.classList.toggle("fa-eye-slash");
                }

            })

        });
    </script>
</body>

</html>