<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/principalIndex.css">
    <link rel="shortcut icon" href="img/lgk.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.3/plyr.css" />
    <link rel="stylesheet" href="Comfortaa/Comfortaa-VariableFont_wght.ttf">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <title>KOUTILAB</title>
</head>

<body>
    <!-- Navbar -->
    <header>
        <nav class="nav" id="navi">
            <ul class="space-right">
                <li class="logo-img-res"><a href="#inicio"><img src="img/koutilab.png" class="logo-img" alt=""></a></li>
                <li class="logo-img-res1"><a href="#inicio"><img src="img/benvenida.png" class="logo-img" alt=""></a></li>
                <li class="menu" id="abrir" onclick="abrirMenu();"><i class="fas fa-bars"></i></li>
                <li class="menu" id="cerrar" onclick="cerrarMenu();"><i class="fas fa-times"></i></li>
            </ul>
            <ul class="ul" id="ul-res">
                <li class="li-rr"><a  onclick="cerrarMenu();" href="#nosotros">Nosotros</a></li>
                <li class="li-rr"><a  onclick="cerrarMenu();" href="#rutas">Rutas de aprendizaje</a></li>
                <li class="li-rr"><a  onclick="cerrarMenu();" href="#usuarios">Tipos de usuario</a></li>
                <li class="hov li-r">
                    <div class="singin"><a href="index.php" style="color: #ffffff">Iniciar sesión</a></div>
                </li>
                <li class="hov li-r">
                    <div class="singin"><a href="./tipo-usuario-registro.php" style="color: #ffffff">Registrarse</a></div>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Prueba gratuita -->
    <!-- <div class="demo">
        <div class="demo-text">
            <p>Prueba gratuita aquí</p>
        </div>
        <a href="alumno/prueba/rutas/ruta-prueba.php" style="color: #ffffff"><i class="hand fas fa-hand-paper fa-flip-horizontal"></i></a>
    </div> -->

    <!-- Inicio -->
    <section id="inicio">
        <div class="banner"></div>
    </section>

    <!-- Nosotros -->
    <section class="content-1" id="nosotros">

        <div class="hallowen-img">
        </div>

        <div class="hallowen-img2">
        </div>

        <div class="tittle-1">
            <h1>Descubre nuestras&nbsp;</h1>
            <h1 class="white-1">RUTAS DE APRENDIZAJE&nbsp;&nbsp;</h1>
            <h1>y juegos interactivos</h1>
        </div>
        <div class="tittle-2">
            <div class="line-1"></div>
            <h1 class="line-2">Nosotros</h1>
            <div class="line-3"></div>
        </div>
        <div class="tittle-3">
            <h3>
                KoutiLab, la plataforma líder en la educación revoluciona la experiencia del
                aprendizaje a través de cápsulas y rutas que se adaptan a las necesidades de
                cada usuario.
                <br><br>
                Nuestro compromiso, impulsar el crecimiento y desarrollo de nuestros
                usuarios a través de herramientas innovadores y accesibles.
            </h3>
        </div>
    </section>

    <!-- Rutas de aprendizaje -->
    <section id="rutas">
        <div class="content-2">
            <div class="card">
                <img src="img/mundo.png" class="c2-img1" alt="">
                <h1 class="white-2">3 +</h1>
                <h2 class="white-2 t2">Paises</h2>
            </div>
            <div class="card">
                <img src="img/institucion.png" class="c2-img2" alt="">
                <h1 class="white-2">5 +</h1>
                <h2 class="white-2 t2">Instituciones</h2>
            </div>
            <div class="card">
                <img src="img/escuela.png" class="c2-img3" alt="">
                <h1 class="white-2">100 +</h1>
                <h2 class="white-2 t2">Escuelas</h2>
            </div>
            <div class="responsive">
                <div class="card">
                    <img src="img/maestro.png" class="c2-img4" alt="">
                    <h1 class="white-2">500 +</h1>
                    <h2 class="white-2 t2">Docentes</h2>
                </div>
                <div class="card">
                    <img src="img/estudiante.png" class="c2-img5" alt="">
                    <h1 class="white-2">5,000 +</h1>
                    <h2 class="white-2 t2">Alumnos</h2>
                </div>
            </div>
        </div>

        <div class="spider-image"></div>

        <div class="spider-image2"></div>

        <div class="content-2-1">
            <div class="tittle-4">
                <h1 class="t4-t1">RUTAS DE APRENDIZAJE</h1>
            </div>
            <div class="tittle-5">
                <div class="line-4"></div>
            </div>
            <div class="tittle-6">
                <h3>Nuestras rutas se adaptan al estilo de aprendizaje de cada usurario (kinestésico, visual, auditivo
                    y verbal) De esta forma aseguramos una experiencia educativa completa y enriquecedora.
                    <br><br>
                    La ruta de aprendizaje consiste en:
                </h3>
            </div>
        </div>
        <div class="capsule">
            <div class="col1">
                <div class="card2">
                    <img src="img/BTNINTRO1.png" class="cp-img" alt="">
                    <div class="cp-bar">
                        <h4 class="cp-t1">
                            Cápsulas introductorias <br>
                            y teoricas
                        </h4>
                    </div>
                </div>
                <div class="card2">
                    <img src="img/BTNEV1.png" class="cp-img" alt="">
                    <div class="cp-bar">
                        <h4 class="cp-t1">
                            Cápsulas evaluativas
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col2">
                <div class="card2">
                    <img src="img/BTNPRA1.png" class="cp-img" alt="">
                    <div class="cp-bar">
                        <h4 class="cp-t1">
                            Cápsulas con ejercicios <br>
                            prácticos
                        </h4>
                    </div>
                </div>
                <div class="card2">
                    <img src="img/BTNJU.png" class="cp-img" alt="">
                    <div class="cp-bar">
                        <h4 class="cp-t1">
                            Cápsulas de juego
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tipos de usuarios -->
    <section id="usuarios">
        <div class="users">
            <div class="tittle-7">
                <h1>
                    Tipos de usuario
                </h1>
            </div>
            <div class="col3">
                <div class="card3">
                    <div class="circle">
                        <img src="img/escuela.png" class="us-img" alt="">
                    </div>
                    <h1>Escolar</h1>
                    <div class="us-bar"></div>
                    <h4 class="us-tx">
                        Está enfocado en los
                        niveles educativos de
                        primaria, secundaria, prepa
                        y universidad.
                    </h4>
                    <div class="btn-sub" onclick="escolar()">
                        <h5 class="us-tx1">Registrar</h5>
                    </div>
                </div>
                <div class="card3">
                    <div class="circle">
                        <img src="img/institucion.png" style="margin-top: 15px; width: 130px;" class="us-img" alt="">
                    </div>
                    <h1>Institucional</h1>
                    <div class="us-bar"></div>
                    <h4 class="us-tx">
                        Para centros no escolares de
                        enseñanza de programación.
                    </h4>
                    <div class="btn-sub" onclick="institucional()">
                        <h5 class="us-tx1">Registrar</h5>
                    </div>
                </div>
                <div class="card3">
                    <div class="circle">
                        <img src="img/estudiante.png" style="margin-top: 20px;" class="us-img" alt="">
                    </div>
                    <h1>Personal</h1>
                    <div class="us-bar"></div>
                    <h4 class="us-tx">
                        Para la adquisición
                        individual y el también
                        aprendizaje personalizados.
                    </h4>
                    <div class="btn-sub" onclick="login()">
                        <h5 class="us-tx1">Registrar</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer">
            <div class="f-card1">
                <img src="img/koutilab.png" class="logo-f-img" alt="">
                <h5 class="f-tx">
                    Somos una plataforma educativa
                    enfocada en brindar una
                    experiencia de aprendizaje
                    enriquecedora.
                </h5>
            </div>
            <div class="f-card">
                <div class="f-space">
                    <h1>Contacto</h1>
                    <h5><i class="fas fa-phone-volume"></i>&nbsp;&nbsp;2228279092</h5>
                    <h5 class="f-tx1"><i class="fas fa-envelope"></i>&nbsp;info@koutilab.com</h5>
                </div>
            </div>
            <div class="f-card">
                <div class="f-space">
                    <h1>Otros servicios</h1>
                    <h5><a href="https://grupoaerobot.com/" class="a-f">Aerobot</a></h5>
                    <h5 class="f-tx1"><a href="./acciones/pdf/Aviso de privacidad_KoutiLab.pdf" class="a-f">Aviso de privacidad</a></h5>
                    <h5 class="f-tx1"><a href="./acciones/pdf/Términos y condiciones_KoutiLab.pdf" class="a-f">Términos y condiciones</a></h5>
                </div>
            </div>
            <div class="f-card">
                <div class="f-space">
                    <h1>Síguenos</h1>
                    <h5><a href="https://www.facebook.com/KoutiLab" class="a-f"><i class="fab fa-facebook-square" style="color: #38b6ff;"></i>&nbsp;&nbsp;Facebook</a></h5>
                    <h5 class="f-tx1"><a href="https://instagram.com/koutilab?igshid=MzRlODBiNWFlZA==" class="a-f"><i class="fab fa-instagram-square" style="color: #38b6ff;"></i>&nbsp;&nbsp;Instagram</a></h5>
                    <h5 class="f-tx1"><a href="https://api.whatsapp.com/send?phone=522228279092" class="a-f"><i class="fab fa-whatsapp-square" style="color: #38b6ff;"></i>&nbsp;&nbsp;WhatsApp</a></h5>
                </div>
            </div>
        </div>
        <div class="bottom">
            <p>© 2023 <b>Aerobot</b> Todos los derechos reservados</p>
        </div>
    </footer>

    <script>
        // const nav = document.querySelector('.nav');
        // window.addEventListener('scroll', function() {
        //     nav.classList.toggle('down', window.scrollY > 0);
        // })

        // var abrir = document.getElementById("abrir");
        // const cerrar = document.querySelector("#cerrar");
        // var ul = document.getElementById("ul");

        // abrir.addEventListener("click", () => {
        //     ul.style.cssText("left: 0;");
        // })

        // cerrar.addEventListener("click", () => {
        //     abrir.classList.add("visible");
        //     abrir.classList.remove("invisible");
        // })
    
        var ul = document.getElementById('ul-res');
        var cerrar = document.getElementById('cerrar');
        var abrir = document.getElementById('abrir');

        function abrirMenu() {
            ul.style.cssText = "left: 0;"
            cerrar.style.cssText = "display: block;"
            abrir.style.cssText = "display: none;"
        }

        function cerrarMenu() {
            ul.style.cssText = "left: -110%;"
            cerrar.style.cssText = "display: none;"
            abrir.style.cssText = "display: block;"
        }

        function login() {
            window.location.href = "./index.php";
        }

        function escolar() {
            window.location.href = "./registro/index.php";
        }

        function institucional() {
            window.location.href = "./registro-institucional/index.php";
        }
    </script>

    <script>
        function activarHalloween() {
            document.body.classList.add('halloween');

            // Espera 5 segundos (5000 milisegundos) para cambiar los colores después del efecto de Halloween
            setTimeout(function() {
                document.body.classList.remove('halloween');

                // Cambiar los colores de los botones
                const buttons = document.querySelectorAll('.singin, .tittle-1, .white-1, .line-3, .line-1, .content-2, .line-4, .cp-bar, .users, .bottom, .card3, .btn-sub, .us-tx1, .us-bar, .circle, .us-tx, .footer, .hallowen-img, .hallowen-img2, .spider-image, .spider-image2, .li-rr, .col3, .tittle-7, i, h5,.a-f, b, a');
                buttons.forEach(function(button) {
                    button.classList.add('hallowen');
                });
            }, 2000); // Cambia el valor a la cantidad de tiempo que desees que dure el efecto de Halloween (en milisegundos)
        }

        // Espera 3 segundos (3000 milisegundos) antes de iniciar la transición. Activar en halloween
        //setTimeout(function() {
        //    activarHalloween();
        //}, 1500); // Cambia el valor a la cantidad de tiempo que desees esperar antes de iniciar el efecto de Halloween (en milisegundos)
    </script>
</body>

</html>