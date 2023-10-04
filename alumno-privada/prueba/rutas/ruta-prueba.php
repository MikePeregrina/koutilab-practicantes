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
        }

        #teoria {
            background-image: url(../img/BTNTEO2.png);
        }

        #prac {
            background-image: url(../img/BTNPRA2.png);
        }

        #game {
            background-image: url(../img/BTNJU2.png);
        }

        #eva {
            background-image: url(../img/BTNEV2.png);
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
        <a href="../../../index.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn-b"><i class="fas fa-reply"></i></button></a>
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
                <a href="../cursos/prueba/basico/capsulas/contenido/teoricas/prueba.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn2" id="teoria"></button></a><!--Capsula teorica 1-->
                <a href="../cursos/prueba/basico/capsulas/contenido/practicas/prueba.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn3" id="prac"></button></a><!--Capsula practica 1-->
                <a href="../cursos/prueba/basico/capsulas/contenido/juegos/prueba.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn4" id="game"></button></a><!--Capsula juego 1-->

                <!-- EVALUATIVA HTML-->
                <a href="../cursos/prueba/basico/capsulas/contenido/evaluativas/prueba.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn5" id="eva"></button></a><!--Capsula evaluativas HTML-->
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

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