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

<!-- Recuperar contraseña para prepa y uni -->

<body onload="recuperarDatos()">
    <i id="abrir" onclick="abrirMenu();" class="fas fa-bars"></i>
    <div class="nav" id="nav">
        <p class="btn-nav" onclick="login();">Conoce Koutilab</p>
        <p class="btn-nav">Adquiere un paquete</p>
        <p class="btn-nav" id="prueba" onclick="prueba();">Prueba gratuita</p>
        <i id="cerrar" onclick="cerrarMenu();" class="fas fa-times"></i>
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
                <div class="line"></div>
                <div class="circle">
                    <p>1</p>
                </div>
                <div class="circle">
                    <div class="circle-white">
                        <p style="color: #000000;">2</p>
                    </div>
                </div>
                <div class="circle">
                    <p>3</p>
                </div>
            </div>
            <p class="preg">Ingresa los datos requeridos</p>
            <form action="acciones/recuperar-clave.php" class="input-group" method="POST">
                <div class="form-group">
                    <div class="input-icon">
                        <i class="ico fas fa-user"></i>
                    </div>
                    <input type="email" name="email" class="input-field" placeholder="Nombre completo" value="" required>
                </div>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="ico fas fa-envelope"></i>
                    </div>
                    <input type="email" name="email" class="input-field" placeholder="Correo electrónico" value="" required>
                </div>
                <div class="sub-btn" style="margin: 30px 0 0 0">
                    <button type="submit" class="submit-btn" value="RECUPERAR CLAVE">Siguiente</button>
                </div>

                <div class="sub-btn" style="margin: 20px 0 0 0; scale: 90%;">
                    <a href="#" onclick="history.back();" class="submit-btn">Regresar</a>
                </div>
            </form>
        </div>
    </div>
    <div class="footer-logo">
        <img src="img/koutilab.png" alt="">
    </div>

    <script>
        var ul = document.getElementById('nav');
        var cerrar = document.getElementById('cerrar');
        var abrir = document.getElementById('abrir');

        function abrirMenu() {
            ul.style.cssText = "left: 0;"
        }

        function cerrarMenu() {
            ul.style.cssText = "left: -100%;"
        }

        function login() {
            window.location.href = "./conoce-koutilab.php";
        }

        function prueba() {
            window.location.href = "./alumno-estructura/prueba/rutas/ruta-prueba.php";
        }
    </script>

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