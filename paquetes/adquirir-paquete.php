<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../acciones/img/lgk.png">
    <link rel="stylesheet" href="./css/paquetes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/23412c6a8d.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.3/plyr.css" />
    <link rel="stylesheet" href="Comfortaa/Comfortaa-VariableFont_wght.ttf">
</head>

<body>
    <!-- Nav -->
    <nav>
        <div class="logo-nav">
            <img src="../img/koutilab.png" alt="koutilab">
        </div>
        <i id="abrir" onclick="abrirMenu();" class="fas fa-bars"></i>
        <div class="opt-nav" id="nav">
            <i id="cerrar" onclick="cerrarMenu();" class="fas fa-times"></i>
            <ul>
                <li><a onclick="cerrarMenu();" href="../index.php" id="back">Regresar</a></li>
                <li><a onclick="cerrarMenu();" href="#paquete3">Paquete personal</a></li>
                <li><a onclick="cerrarMenu();" href="#paquete2">Paquete freemium</a></li>
                <li><a onclick="cerrarMenu();" href="#paquete1">Paquete licencia</a></li>
            </ul>
        </div>
    </nav>

    <!-- Pasos para adquirir -->
    <section id="steps">
        <div class="cont-div">
            <div class="cuadro">
                <img src="../img/Thumbs-Up.gif" alt="">
            </div>
        </div>
        <div class="cont-info">
            <div class="tittle-steps">
                <p>Adquiere tu paquete ¡En tan solo 4 pasos!</p>
            </div>
            <div class="cont-steps">
                <div class="card">
                    <div class="num"><i class="far fa-hand-pointer"></i></div>
                    <div class="num-txt">
                        <p>PASO 1:</p>
                    </div>
                    <div class="num-info">
                        <P>Elige el paquete que mejor te convenga</P>
                    </div>
                </div>
                <div class="card">
                    <div class="num"><i class="fas fa-align-justify"></i></div>
                    <div class="num-txt">
                        <p>PASO 2:</p>
                    </div>
                    <div class="num-info">
                        <P>Llena el formulario con la información requerida</P>
                    </div>
                </div>
                <div class="card">
                    <div class="num"><i class="fas fa-money-check-alt"></i></div>
                    <div class="num-txt">
                        <p>PASO 3:</p>
                    </div>
                    <div class="num-info">
                        <P>Paga el paquete que elegiste</P>
                    </div>
                </div>
                <div class="card">
                    <div class="num"><i class="fas fa-check-circle"></i></div>
                    <div class="num-txt">
                        <p>PASO 4:</p>
                    </div>
                    <div class="num-info">
                        <P>¡Listo! Ahora puedes disfrutar de tu paquete</P>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="paquete1" class="paquete">
        <div class="img-promo" id="img-izq">
            <div class="precio" id="txt-izq">$1,000.00 <br>Al mes</div>
            <img src="../img/img-p.png" alt="">
        </div>
        <div class="sup">
            <div class="tiitle-paq" id="txt-derecha">
                <b>PAQUETE LICENCIA</b>
                <p>El mejor para todas las escuelas</p>
            </div>
        </div>
        <div class="centro">
            <div class="descr" id="txt-derecha">
                <p>Rutas desbloqueadas para todos los alumnos de tu escuela con claves <br> incluidas, lo mejor para todos los alumnos</p>
            </div>
        </div>
        <div class="inf">
            <div class="icons">
                <div class="beneficio">
                    <div class="icon-b"><i class="fas fa-check"></i></div>
                    <div class="text-b">
                        <p>Acceso a las rutas de aprendizaje</p>
                    </div>
                </div>
                <div class="beneficio">
                    <div class="icon-b"><i class="fas fa-smile-beam"></i></div>
                    <div class="text-b">
                        <p>Capsulas prácticas, teóricas, juegos y evaluativas</p>
                    </div>
                </div>
                <div class="beneficio">
                    <div class="icon-b"><i class="fas fa-user-check"></i></div>
                    <div class="text-b">
                        <p>Acceso para docentes y directores</p>
                    </div>
                </div>
                <div class="beneficio">
                    <div class="icon-b"><i class="fas fa-sitemap"></i></div>
                    <div class="text-b">
                        <p>Paneles completos y fáciles de usar para todos</p>
                    </div>
                </div>
            </div>
            <div class="comprar">
                <a href="#">Adquirir paquete</a>
            </div>
        </div>
    </section>

    <div class="division"></div>

    <section id="paquete2" class="paquete">
        <div class="img-promo" id="img-der">
            <div class="precio" id="prec-der">$2,000.00 <br>Al mes</div>
            <img src="../img/img-p1.png" alt="">
        </div>
        <div class="sup">
            <div class="tiitle-paq" id="txt-izquierda">
                <b>PAQUETE FREEMIUM</b>
                <p>El paquete ideal para aquellos que quieren seguir aprendiendo</p>
            </div>
        </div>
        <div class="centro">
            <div class="descr" id="txt-izquierda">
                <p>Rutas desbloqueadas para todos los alumnos de tu escuela con claves <br> incluidas y rutas alternativas para seguir aprendiendo por un costo extra</p>
            </div>
        </div>
        <div class="inf">
            <div class="icons">
                <div class="beneficio">
                    <div class="icon-b"><i class="fas fa-check"></i></div>
                    <div class="text-b">
                        <p>Acceso a las rutas de aprendizaje y contenido extra</p>
                    </div>
                </div>
                <div class="beneficio">
                    <div class="icon-b"><i class="fas fa-smile-beam"></i></div>
                    <div class="text-b">
                        <p>Capsulas prácticas, teóricas, juegos y evaluativas</p>
                    </div>
                </div>
                <div class="beneficio">
                    <div class="icon-b"><i class="fas fa-user-check"></i></div>
                    <div class="text-b">
                        <p>Acceso para docentes y directores</p>
                    </div>
                </div>
                <div class="beneficio">
                    <div class="icon-b"><i class="fas fa-sitemap"></i></div>
                    <div class="text-b">
                        <p>Paneles completos y fáciles de usar para todos</p>
                    </div>
                </div>
            </div>
            <div class="comprar">
                <a href="#">Adquirir paquete</a>
            </div>
        </div>
    </section>

    <div class="division"></div>

    <section id="paquete3" class="paquete">
        <div class="img-promo" id="img-izq">
            <div class="precio" id="txt-izq">$500.00 <br>Al mes</div>
            <img src="../img/img-p2.png" alt="">
        </div>
        <div class="sup">
            <div class="tiitle-paq" id="txt-derecha">
                <b>PAQUETE PERSONAL</b>
                <p>Ideal para aquellos que quieren aprender por su cuenta</p>
            </div>
        </div>
        <div class="centro">
            <div class="descr" id="txt-derecha">
                <p>Rutas desbloqueadas y a tu propio ritmo.<br>Sin presiones</p>
            </div>
        </div>
        <div class="inf">
            <div class="icons">
                <div class="beneficio">
                    <div class="icon-b"><i class="fas fa-check"></i></div>
                    <div class="text-b">
                        <p>Acceso a las rutas de aprendizaje</p>
                    </div>
                </div>
                <div class="beneficio">
                    <div class="icon-b"><i class="fas fa-smile-beam"></i></div>
                    <div class="text-b">
                        <p>Capsulas prácticas, teóricas, juegos y evaluativas</p>
                    </div>
                </div>
                <div class="beneficio">
                    <div class="icon-b"><i class="fas fa-sitemap"></i></div>
                    <div class="text-b">
                        <p>Paneles completos y fáciles de usar</p>
                    </div>
                </div>
            </div>
            <div class="comprar">
                <a href="#">Adquirir paquete</a>
            </div>
        </div>
    </section>

    <footer>
        <p>© 2023 <b>Aerobot</b> Todos los derechos reservados</p>
    </footer>
</body>

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
</script>

</html>