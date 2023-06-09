<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="acciones/img/lgk.png">
    <link rel="stylesheet" href="acciones/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/23412c6a8d.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body onload="recuperarDatos()">
    <div class="container" style="margin-top: -25px; margin-left: -50px;">
        <div class="panel">
            <div class="row">
                <div class="col liquid">
                    <!-- Owl-Carousel -->

                    <img src="acciones/img/kouti-02.png" alt="" class="login_img">

                    <!-- /Owl-Carousel -->
                </div>
                <div class="form-box"><br><br>
                    <div class="button-box" style="margin: 10px 0 0 55px;">
                        <div id="elegir"  style="width: 240px;"></div>
                        <button type="button" class="toggle-btn" style="margin: 0 0 0 35px;">Recuperar contraseña</button>
                    </div>
                    <div class="logop" style="margin: 30px 0 0 -70px;">
                        <img src="acciones/img/koutilab.png" alt="KOUTILAB">
                    </div>
                    <form action="acciones/recuperar-clave.php" class="input-group" method="POST" style="margin: 50px 0 0 0;">
                        <div class="form-group">
                            <br>
                            <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                            </div>
                            <input type="email" name="email" class="input-field" placeholder="Correo electrónico" value="" required>
                        </div>

                        <button type="submit" class="submit-btn" style="margin-top: 20px;" value="RECUPERAR CLAVE">Enviar correo</button>
                        <a href="login.php" class="submit-btn" style="margin-top: 20px; width: 50px; text-align: center; color: black; text-decoration: none;">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Guarda los datos del formulario en una cookie
        function guardarDatos() {
            var usuario_inicio = document.getElementById("usuario_inicio").value;
            var contrasena_inicio = document.getElementById("contrasena_inicio").value;
            var clave_inicio = document.getElementById("clave_inicio").value;
            document.cookie = "usuario_inicio=" + usuario_inicio + "; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
            document.cookie = "contrasena_inicio=" + contrasena_inicio + "; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
            document.cookie = "clave_inicio=" + clave_inicio + "; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
        }

        function off() {
            console.log("Reinicio")
            var usuario_inicio = '';
            var contrasena_inicio = '';
            var clave_inicio = '';
            document.cookie = "usuario_inicio=" + usuario_inicio + "; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
            document.cookie = "contrasena_inicio=" + contrasena_inicio + "; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
            document.cookie = "clave_inicio=" + clave_inicio + "; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
        }

        var checkbox = document.getElementById('checkbox');

        checkbox.addEventListener("change", comprueba, false);

        // Función para establecer el valor de una cookie
        function setCookie(name, value) {
            document.cookie = `${name}=${value}; path=/;`;
        }

        function comprueba() {
            if (checkbox.checked) {
                guardarDatos();
                setCookie('checkbox', true);
            } else {
                off();
            }
        }
    </script>

    <script>
        // Recupera los datos del formulario de la cookie
        function recuperarDatos() {
            var cookieData = document.cookie;
            if (cookieData) {
                var cookies = cookieData.split("; ");
                for (var i = 0; i < cookies.length; i++) {
                    var parts = cookies[i].split("=");
                    var name = parts[0];
                    var value = decodeURIComponent(parts[1]);
                    if (name == "usuario_inicio") {
                        document.getElementById("usuario_inicio").value = value;
                    } else if (name == "contrasena_inicio") {
                        document.getElementById("contrasena_inicio").value = value;
                    } else if (name == "clave_inicio") {
                        document.getElementById("clave_inicio").value = value;
                    }
                }
            }
        }
    </script>

    <script>
        // Función para obtener el valor de una cookie
        function getCookie(name) {
            const cookieArray = document.cookie.split("; ");
            for (let i = 0; i < cookieArray.length; i++) {
                const cookie = cookieArray[i].split("=");
                if (cookie[0] === name) {
                    return cookie[1];
                }
            }
            return "";
        }
    </script>

    <script>
        // EVITAR REENVIO DE DATOS.
        if (window.history.replaceState) { // verificamos disponibilidad
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

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

    <script>
        var x = document.getElementById("Ingresar");
        var y = document.getElementById("Registrarse");
        var z = document.getElementById("elegir");

        function Registrarse() {
            x.style.left = "-450px"
            y.style.left = "50px"
            z.style.left = "120px"
        }

        function Ingresar() {
            x.style.left = "50px"
            y.style.left = "450px"
            z.style.left = "0px"
        }
    </script>

</body>

</html>