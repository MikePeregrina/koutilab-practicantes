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
            <div class="pasos">
                <div class="line"></div>
                <div class="circle">
                    <p>1</p>
                </div>
                <div class="circle">
                    <p>2</p>
                </div>
                <div class="circle">
                    <div class="circle-white">
                        <p style="color: #000000;">3</p>
                    </div>
                </div>
            </div>
            <p class="preg">Lo sentimos</p>
            <p class="parrafo">No pudimos encontrar tu correo electrónico</p>
            <div class="opt-user">
                <a href="./login.php">
                    <p style="width: 100px; margin: 50px 0 0 0;">Regresar</p>
                </a>
            </div>
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

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

</body>

</html>