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
                <!-- <li><a onclick="cerrarMenu();" href="#paquete3">Paquete personal</a></li> -->
                <!-- <li><a onclick="cerrarMenu();" href="#paquete2">Paquete freemium</a></li> -->
                <li><a onclick="cerrarMenu();" href="#licencia">Paquete licencia</a></li>
                <li><a onclick="cerrarMenu();" href="#freemium">Paquete freemium</a></li>
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

    <!-- División para el buen fin -->
    <div class="buen-fin">
        <div class="tittle-bf">
            <p>PAQUETES ESCOLARES</p>
        </div>
        <div class="line-bf">
            <div class="sup-bf">
                <div class="img-bf"><img src="../img/Buen_Fin-Logo_2023.png" alt=""></div>
                <div class="txt-bf">
                    <p>HASTA</p>
                    <b>50%</b>
                    <p>OFF</p>
                </div>
            </div>
            <div class="inf-bf">
                <p>
                    VALIDO DEL 17 DE AL 30 DE NOVIEMBRE DEL 2023 SOLO EN PAQUETES LICENCIA EN KOUTILAB
                </p>
            </div>
        </div>
    </div>

    <!-- Paquete con imagen a la izquierda -->
    <!-- <section id="paquete1" class="paquete">
        <div class="img-promo" id="img-izq">
            <div class="precio" id="txt-izq">
                <p>DESCUENTO POR<br>APOYO A ESCUELAS<br><b>30%</b></p>
            </div>
            <img src="../img/img-p.png" alt="">
        </div>
        <div class="sup">
            <div class="tiitle-paq" id="txt-derecha">
                <b>PAQUETE LICENCIA</b>
            </div>
        </div>
        <div class="centro">
            <div class="descr1" id="txt-derecha">
                <div class="paq-card"></div>
            </div>
        </div>
    </section> -->

    <!-- Paquete con tarjetas -->
    <section class="paquete" id="licencia">
        <div class="linea-azul"></div>
        <div class="container-card">
            <div class="tittle-card">
                <p>PAQUETES LICENCIA</p>
            </div>
            <div class="box-card">
                <!-- Tarjeta -->
                <div class="paq-card">
                    <div class="icon-card"><i class="fas fa-check"></i></div>
                    <div class="tittle-card1"><p>CODING</p></div>
                    <div class="tittle-card2">
                        <p class="p1">de $3,250.00 mxn</p>
                        <p class="p2">a sólo $1,625.00 mxn</p>
                    </div>
                    <div class="tittle-card3">
                        <ul>
                            <li>500 USUARIOS</li>
                            <li>RUTAS DE APRENDIZAJE ILIMITADAS</li>
                            <li>ACCESO PARA DOCENTES Y DIRECTORES</li>
                            <li>PANELES FÁCILES DE USAR</li>
                            <li>PAGO SEMESTRAL</li>
                        </ul>
                    </div>
                    <div class="tittle-card4">
                        <p>ADQUIRIR</p>
                    </div>
                </div>

                <div class="paq-card">
                    <div class="icon-card"><i class="fas fa-paper-plane"></i></div>
                    <div class="tittle-card1"><p>INNOVA</p></div>
                    <div class="tittle-card2">
                        <p class="p1">de $6,500.00 mxn</p>
                        <p class="p2">a sólo $3,250.00 mxn</p>
                    </div>
                    <div class="tittle-card3">
                        <ul>
                            <li>1,000 USUARIOS</li>
                            <li>RUTAS DE APRENDIZAJE ILIMITADAS</li>
                            <li>ACCESO PARA DOCENTES Y DIRECTORES</li>
                            <li>PANELES FÁCILES DE USAR</li>
                            <li>PAGO SEMESTRAL</li>
                        </ul>
                    </div>
                    <div class="tittle-card4">
                        <p>ADQUIRIR</p>
                    </div>
                </div>

                <div class="paq-card">
                    <div class="icon-card"><i class="fas fa-brain"></i></div>
                    <div class="tittle-card1"><p>CODER</p></div>
                    <div class="tittle-card2">
                        <p class="p1">de $15,600.00 mxn</p>
                        <p class="p2">a sólo $7,800.00 mxn</p>
                    </div>
                    <div class="tittle-card3">
                        <ul>
                            <li>3000 USUARIOS</li>
                            <li>RUTAS DE APRENDIZAJE ILIMITADAS</li>
                            <li>ACCESO PARA DOCENTES Y DIRECTORES</li>
                            <li>PANELES FÁCILES DE USAR</li>
                            <li>PAGO SEMESTRAL</li>
                        </ul>
                    </div>
                    <div class="tittle-card4">
                        <p>ADQUIRIR</p>
                    </div>
                </div>

                <div class="paq-card">
                    <div class="icon-card"><i class="fas fa-gem"></i></div>
                    <div class="tittle-card1"><p>PROGRAMMER</p></div>
                    <div class="tittle-card2">
                        <p class="p1">de $19,500.00 mxn</p>
                        <p class="p2">a sólo $9,750.00 mxn</p>
                    </div>
                    <div class="tittle-card3">
                        <ul>
                            <li>5,000 USUARIOS</li>
                            <li>RUTAS DE APRENDIZAJE ILIMITADAS</li>
                            <li>ACCESO PARA DOCENTES Y DIRECTORES</li>
                            <li>PANELES FÁCILES DE USAR</li>
                            <li>PAGO SEMESTRAL</li>
                        </ul>
                    </div>
                    <div class="tittle-card4">
                        <p>ADQUIRIR</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Paquete con imagen a la izquierda -->
    <!-- <section id="paquete1" class="paquete">
        <div class="img-promo" id="img-izq">
            <div class="precio" id="txt-izq">Paquetes<br>desde<br>$1,500.00<br>Semestrales</div>
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
                <p>Costos por semestre:</p>
                <h1 class="cost-p"> 
                    500 usuarios: $2,500.00&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                    1,000 usuarios: $5,000.00&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                    3,000 usuarios: $12,000.00&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                    5,000 usuarios: $15,000.00
                </h1>
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
    </section> -->

    <!-- División con color azul -->
    <div class="division"></div>

    <!-- Paquete con imagen a la derecha -->
    <section id="freemium" class="paquete">
        <div class="sup">
            <div class="tiitle-paq" id="txt-izquierda">
                <b>PAQUETE FREEMIUM</b>
            </div>
        </div>
        <div class="centro">
            <div class="descr" id="txt-izquierda">
                <div class="centro-tittle">
                    <p>Rutas desbloqueadas para todos los alumnos de tu escuela y rutas alternativas para seguir aprendiendo por un costo extra</p>
                </div>
                <div class="centro-info">
                    <div class="izq-c">
                        <p>COSTO POR RUTA PREMIUM</p>
                    </div>
                    <div class="der-c">
                        <ul>
                            <li>RUTA DE 3 CÁPSULAS POR $30 MXN</li>
                            <li>RUTA DE 6 CÁPSULAS POR $50 MXN</li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="centro-btn">
                    <p>ADQUIRIR</p>
                </div> -->
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
                <a href="form-freemium.php">Adquirir paquete</a>
            </div>
        </div>
    </section>

    <!-- <div class="division"></div> -->

    <!-- <section id="paquete3" class="paquete">
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
    </section> -->

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