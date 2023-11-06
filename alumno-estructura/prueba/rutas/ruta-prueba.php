<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png">
    <link rel="stylesheet" href="../css/ruta.css">

    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        #intro {
            background-image: url(../img/BTNINTRO2.png);
            z-index: -1;
        }

        #teoria {
            background-image: url(../img/BTNTEO2.png);
            z-index: -1;
        }

        #prac {
            background-image: url(../img/BTNPRA2.png);
            z-index: -1;
        }

        #game {
            background-image: url(../img/BTNJU2.png);
            z-index: -1;
        }

        #eva {
            background-image: url(../img/BTNEV2.png);
            z-index: -1;
        }

        .margen {
            width: 100%;
            height: 99.8%;
            overflow: hidden; 
         }

        .margen img {
            width: 100%;
            height: 100%; 
            object-fit: cover; 
        }
       /*Pantalla emergente*/
            .popup-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            }

            .popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 85%;
            height: 85%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border: 3px solid rgba(0, 201, 255, 2556);
            border-radius: 20px;
            overflow-x: hidden !important;
            }

            .content-popup {
            width: 90%;
            height: 65%;
            margin-left: 5%;
            margin-top: 4%;
            display: flex;
            }

            #closeButton {
                position: absolute;
                top: 4%;
                right: 2%;
                background: none;
                border: none;
                cursor: pointer;
            }    

            #closeButton i {
            color: #555555;
            font-size: 35px;
            }

            #closeButton:hover i {
            color: red;
            }

            #miBoton {
                position: absolute;
                bottom: 35%; 
                left: 6%; 
                background-color: #38b6ff;
                color: black;
                border: none;
                padding: 10px 50px;
                font-size: 16px;
                cursor: pointer;
                border-radius: 15px;
            }

            #miBoton:hover {
                color: white;
            }


    </style>
</head>

<body>
    <audio id="popAudio" preload="auto">
        <source src="../../../acciones/sonidos/pop.mp3" type="audio/mpeg">
    </audio>
    <audio id="hoverAudio" preload="auto">
        <source src="../../../acciones/sonidos/pop2.mp3" type="audio/mpeg">
    </audio>

    <div class="containers">
        <a href="../../../index.php"><button  class="btn-b"><i class="fas fa-reply"></i></button></a>
        <h1>CURSO DE PROGRAMACIÓN WEB BÁSICA DE KOUTILAB</h1>
    </div>
    <aside class="sidebar">
        <div class="circle" style="background-image:url(../img/BTNINTRO2.png); background-size:cover;background-position:center ">
            <p>Introducción</p>
        </div>
        <div class="circle" style="background-image:url(../img/BTNPRA2.png); background-size:cover;background-position:center ">
            <p>Práctica</p>
        </div>
        <div class="circle" style="background-image:url(../img/BTNTEO2.png); background-size:cover;background-position:center ">
            <p>Teórica</p>
        </div>
        <div class="circle" style="background-image:url(../img/BTNJU2.png); background-size:cover;background-position:center ">
            <p>Juegos</p>
        </div>
        <div class="circle" style="background-image:url(../img/BTNEV2.png); background-size:cover;background-position:center ">
            <p>Evaluativa</p>
        </div>
    </aside>



    <section>
        <div class="main-content">
            <div class="label">
                <span>HTML</span>
            </div>
            <div class="snake">

                <!-- HTML -->
                <a href="../cursos/prueba/basico/capsulas/contenido/introduccion/prueba.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn1" id="intro"></button></a><!--Capsula introduccion a HTML-->
                <!-- TEMA 1 -->
                <a href="../cursos/prueba/basico/capsulas/contenido/teoricas/prueba.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()"  class="btn2" id="teoria"></button></a><!--Capsula teorica 1-->
                <a href="../cursos/prueba/basico/capsulas/contenido/practicas/prueba.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()"  class="btn3" id="prac"></button></a><!--Capsula practica 1-->
                <a href="../cursos/prueba/basico/capsulas/contenido/juegos/prueba.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()"  class="btn4" id="game"></button></a><!--Capsula juego 1-->
                <!-- EVALUATIVA HTML-->
                <a href="../cursos/prueba/basico/capsulas/contenido/evaluativas/prueba.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()"  class="btn5" id="eva"></button></a><!--Capsula evaluativas HTML-->

                    
                <a href="../cursos/prueba/basico/capsulas/contenido/teoricas/prueba2.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()"  class="btn6" id="teoria"></button></a><!--Capsula teorica 1-->
                <a href="../cursos/prueba/basico/capsulas/contenido/practicas/prueba2.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()"  class="btn7" id="prac"></button></a><!--Capsula practica 1-->
                <a href="../cursos/prueba/basico/capsulas/contenido/juegos/index.html"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()"  class="btn8" id="game"></button></a><!--Capsula juego 1-->
                <!-- EVALUATIVA HTML-->
               
                <!-- Pantalla emergente-->
                <div class="popup-container" id="popupContainer">
                    <div class="popup-content">
                        <div class="margen">
                            <img src="../img/imagen-register.png" alt="">
                        </div>

                        <a href="../../../login.php"><button id="miBoton"><h1>REGISTRARSE</h1></button></a>
                        <button id="closeButton"><i class="fas fa-times"></i></button>
                        
                    </div>
                </div>

                <div class="right-student" id="addCourseButton">
                    <a href="#"><button  class="btn9" id="teoria"></button></a><!--Capsula teorica 1-->
                    <a href="#"><button  class="btn10" id="prac"></button></a><!--Capsula practica 1-->
                    <a href="#"><button  class="btn11" id="game"></button></a><!--Capsula juego 1-->
                    <a href="#"><button  class="btn12" id="teoria"></button></a><!--Capsula teorica 1-->
                    <a href="#"><button  class="btn13" id="prac"></button></a><!--Capsula practica 1-->
                    <a href="#"><button  class="btn14" id="game"></button></a><!--Capsula juego 1-->
                    <a href="#"><button  class="btn15" id="teoria"></button></a><!--Capsula teorica 1-->
                    <a href="#"><button  class="btn16" id="prac"></button></a><!--Capsula practica 1-->
                    <a href="#"><button  class="btn17" id="game"></button></a><!--Capsula juego 1-->
                    <a href="#"><button  class="btn18" id="teoria"></button></a><!--Capsula teorica 1-->
                    <a href="#"><button  class="btn19" id="prac"></button></a><!--Capsula practica 1-->
                    <a href="#"><button  class="btn20" id="game"></button></a><!--Capsula juego 1-->
                    <a href="#"><button  class="btn21" id="teoria"></button></a><!--Capsula teorica 1-->
                    <a href="#"><button  class="btn22" id="prac"></button></a><!--Capsula practica 1-->
                    <a href="#"><button  class="btn23" id="game"></button></a><!--Capsula juego 1-->
                    <a href="#"><button  class="btn24" id="teoria"></button></a><!--Capsula teorica 1-->
                    <a href="#"><button  class="btn25" id="prac"></button></a><!--Capsula practica 1-->
                    <a href="#"><button  class="btn32" id="game"></button></a><!--Capsula juego 1-->


                    <div class="label-css">
                        <span>CSS</span>
                    </div>

                    <!-- CSS-->
                    <a href="../cursos/prueba/basico/capsulas/contenido/introduccion/prueba.php"><button  class="btn33" id="intro"></button></a><!--Capsula introduccion a HTML-->
                    <a href="#"><button  class="btn34" id="teoria"></button></a><!--Capsula teorica 1-->
                    <a href="#"><button  class="btn35" id="prac"></button></a><!--Capsula practica 1-->
                    <a href="#"><button  class="btn36" id="game"></button></a><!--Capsula juego 1-->
                    <a href="#"><button  class="btn37" id="teoria"></button></a><!--Capsula teorica 1-->
                    <a href="#"><button  class="btn38" id="prac"></button></a><!--Capsula practica 1-->
                    <a href="#"><button  class="btn39" id="game"></button></a><!--Capsula juego 1-->
                    <a href="#"><button  class="btn40" id="teoria"></button></a><!--Capsula teorica 1-->
                    <a href="#"><button  class="btn41" id="prac"></button></a><!--Capsula practica 1-->
                    <a href="#"><button  class="btn42" id="game"></button></a><!--Capsula juego 1-->
                    <a href="#"><button  class="btn43" id="teoria"></button></a><!--Capsula teorica 1-->
                    <a href="#"><button  class="btn44" id="prac"></button></a><!--Capsula practica 1-->
                    <a href="#"><button  class="btn45" id="game"></button></a><!--Capsula juego 1-->
                    <a href="#"><button  class="btn46" id="teoria"></button></a><!--Capsula teorica 1-->
                    <a href="#"><button  class="btn47" id="prac"></button></a><!--Capsula practica 1-->
                    <a href="#"><button  class="btn48" id="game"></button></a><!--Capsula juego 1-->
                    <a href="#"><button  class="btn49" id="teoria"></button></a><!--Capsula teorica 1-->
                    <a href="#"><button  class="btn50" id="prac"></button></a><!--Capsula practica 1-->
                    <a href="#"><button  class="btn51" id="game"></button></a><!--Capsula juego 1-->
                    <a href="#"><button  class="btn52" id="teoria"></button></a><!--Capsula teorica 1-->
                    <a href="#"><button  class="btn53" id="prac"></button></a><!--Capsula practica 1-->
                    <a href="#"><button  class="btn54" id="teoria"></button></a><!--Capsula teorica 1-->
                    <a href="#"><button  class="btn58" id="prac"></button></a><!--Capsula practica 1-->
                    <a href="#"><button  class="btn59" id="game"></button></a><!--Capsula juego 1-->
                    <!-- EVALUATIVA HTML-->
                    <a href="../cursos/prueba/basico/capsulas/contenido/evaluativas/prueba.php"><button  class="btn60" id="eva"></button></a><!--Capsula evaluativas HTML-->
                </div>
 
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
            const addCourseButton = document.getElementById('addCourseButton');
            const popupContainer = document.getElementById('popupContainer');
            const closeButton = document.getElementById('closeButton');

            addCourseButton.addEventListener('click', function() {
                popupContainer.style.display = 'block';
            });

            //cerrar la ventana emergente
            closeButton.addEventListener('click', function() {
                popupContainer.style.display = 'none';
            });

            popupContainer.addEventListener('click', function(event) {
                if (event.target === popupContainer) {
                    popupContainer.style.display = 'none';
                }
            });
        </script>

    <script>
        $(".step").click(function() {
            $(this).addClass("active").prevAll().addClass("active");
            $(this).nextAll().removeClass("active");
        });

        $(".step01").click(function() {
            $("#line-progress").css("width", "3%");
            $(".discovery").addClass("active").siblings().removeClass("active");
        });

        $(".step02").click(function() {
            $("#line-progress").css("width", "25%");
            $(".strategy").addClass("active").siblings().removeClass("active");
        });

        $(".step03").click(function() {
            $("#line-progress").css("width", "50%");
            $(".creative").addClass("active").siblings().removeClass("active");
        });

        $(".step04").click(function() {
            $("#line-progress").css("width", "75%");
            $(".production").addClass("active").siblings().removeClass("active");
        });

        $(".step05").click(function() {
            $("#line-progress").css("width", "100%");
            $(".analysis").addClass("active").siblings().removeClass("active");
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
            document.onclick = disableNS;
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
    <script>
        // Funciones para reproducir sonidos
        function playHoverSound() {
            var popAudio = document.getElementById("popAudio");
            popAudio.currentTime = 0; // Reiniciar el sonido si ya se está reproduciendo
            var hoverAudio = document.getElementById("hoverAudio");
            hoverAudio.currentTime = 0; // Reiniciar el sonido si ya se está reproduciendo
            hoverAudio.play();
        }

        function playClickSound() {
            var hoverAudio = document.getElementById("hoverAudio");
            hoverAudio.currentTime = 0; // Reiniciar el sonido si ya se está reproduciendo
            var popAudio = document.getElementById("popAudio");
            popAudio.currentTime = 0; // Reiniciar el sonido si ya se está reproduciendo
            popAudio.play();
        }
    </script>

</body>