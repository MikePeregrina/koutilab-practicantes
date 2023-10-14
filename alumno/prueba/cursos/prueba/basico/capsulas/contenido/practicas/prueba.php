<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../../../../../../img/lgk.png">
    <link rel="stylesheet" href="../../css/capsula-practica.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="body">
        <div class="container">
            <a href="#" onclick="history.back(); return false;"><button style="float: left;" class="btn-b" id="btn-cerrar-modalV"><i class="fas fa-reply"></i></button></a>
            <a href="../../../../../../cursos/prueba/basico/capsulas/contenido/teoricas/prueba.php"><button style="float: right; width: 100px; height: 40px;" class="btn-b"><b>Volver a teoría</b></button></a>
            <div class="new-g" style="text-align: center;">Cápsula prueba</div><br>
            <div class="board">
            <button class="boton-fijo" id="show-keyboard" ><i class="fa-regular fa-keyboard fa-2xl"></i></button>
                <table width="100%">
                    <thead>
                        <tr>
                            <td>Instrucciones</td>
                            <td>Ejemplo de resultado</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <td class="nombre">
                                <p> Agregar un párrafo con su título dentro de un div (todas las etiquetas se deben de cerrar).
                                    < div>
                                        < h1>
                                            < /h1>
                                                < /div>
                                                    <br> <br>
                                </p>
                            </td>
                            <td class="ne">
                                <img src="../../../../../../img/practica1html.png" style="height: 100px; width: 500px;">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="editor-container">
                <h3>EDITOR DE CÓDIGO</h3>
                <textarea onkeyup="actualizar() " id="cd" class="cd" placeholder="Escribe el código aquí"></textarea>
                <iframe class="editor" id="editor" srcdoc=" "></iframe>
            </div>
            <a style="text-decoration: none;"><button onclick="miFunc()" type="submit" class="btn-grd" id="update" disabled>Evaluar</button></a>
        </div>

    <div id="virtual-keyboard">
    <button class="close-keyboard"><i class="fa-solid fa-xmark fa-2xl"></i></button>
        <div class="keyboard-row">
            <button class="key">1</button>
            <button class="key">2</button>
            <button class="key">3</button>
            <button class="key">4</button>
            <button class="key">5</button>
            <button class="key">6</button>
            <button class="key">7</button>
            <button class="key">8</button>
            <button class="key">9</button>
            <button class="key">0</button>
            <button class="key">/</button>
            <button class="key">*</button>
            <button class="key">+</button>
            <button class="key">-</button>
            <button class="delete">Borrar</button>
        </div>
        <div class="keyboard-row">
            <button class="key">q</button>
            <button class="key">w</button>
            <button class="key">e</button>
            <button class="key">r</button>
            <button class="key">t</button>
            <button class="key">y</button>
            <button class="key">u</button>
            <button class="key">i</button>
            <button class="key">o</button>
            <button class="key">p</button>
            <button class="key">(</button>
            <button class="key">)</button>
            <button class="key">[</button>
            <button class="key">]</button>
            <button class="key">|</button>
           
        </div>

        <div class="keyboard-row">
            <button class="key">a</button>
            <button class="key">s</button>
            <button class="key">d</button>
            <button class="key">f</button>
            <button class="key">g</button>
            <button class="key">h</button>
            <button class="key">j</button>
            <button class="key">k</button>
            <button class="key">l</button>
            <button class="key">%</button>
            <button class="key">&</button>
            <button class="key">"</button>
           
        </div>

        <div class="keyboard-row">
            <button class="key">z</button>
            <button class="key">x</button>
            <button class="key">c</button>
            <button class="key">v</button>
            <button class="key">b</button>
            <button class="key">n</button>
            <button class="key">m</button>
            <button class="key"><</button>
            <button class="key">></button>
            <button class="key">;</button>
        </div>

        <div class="keyboard-row">
            <button class="space">Espacio</button>
        </div>

      


    </div>
    <script>

        // Obtén elementos del DOM
        const showKeyboardButton = document.getElementById("show-keyboard");
        const textInput = document.getElementById("cd");
        const virtualKeyboard = document.getElementById("virtual-keyboard");
        const specialChars = document.querySelectorAll(".key");
        const closeKeyboardButton = document.querySelector(".close-keyboard");

        // Función para mostrar el teclado
        showKeyboardButton.addEventListener("click", () => {
            virtualKeyboard.style.display = "block";
        });

        // Función para insertar caracteres en el textarea
        specialChars.forEach(charButton => {
            charButton.addEventListener("click", () => {
                const char = charButton.textContent;
                textInput.value += char;
            });
        });

        // Función para cerrar el teclado
        closeKeyboardButton.addEventListener("click", () => {
            virtualKeyboard.style.display = "none";
        });

        // Evita que se cierre el teclado al hacer clic en las teclas
        virtualKeyboard.addEventListener("click", (event) => {
            event.stopPropagation();
        });

        // Cierra el teclado si se hace clic fuera de él
        document.addEventListener("click", (event) => {
            if (event.target !== virtualKeyboard && event.target !== showKeyboardButton) {
                virtualKeyboard.style.display = "none";
            }
        });

        // Función para borrar un carácter en el textarea
        const deleteButton = document.querySelector(".delete");
        deleteButton.addEventListener("click", () => {
            const text = textInput.value;
            textInput.value = text.slice(0, -1);
        });

        // Función para añadir un espacio en el textarea
        const spaceButton = document.querySelector(".space");
        spaceButton.addEventListener("click", () => {
            textInput.value += " ";
        });
    </script>


    <script src="../../js/fund.js"></script>
    <script>
        //se esta llamando los sonidos de la carpeta "sonidos"
        var Correcto = document.createElement("audio");
        Correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
        var Incorrecto = document.createElement("audio");
        Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

        function miFunc() {
            var frame = document.getElementById("editor").contentWindow.document;
            let div = frame.querySelectorAll("div").length;
            let titles = frame.querySelectorAll("h1").length;

            if (div > 0 && titles > 0) {
                Correcto.play();
                Swal.fire({
                    title: '¡Excelente sigue así! ',
                    text: '¡Puntuación guardada con éxito!',
                    imageUrl: "../../../../../../img/Thumbs-Up.gif",
                    imageHeight: 350,
                    backdrop: `
                    rgba(0,143,255,0.6)
                    url("../../../../../../img/fondo.gif")
                    `,
                    confirmButtonColor: '#a14cd9',
                    confirmButtonText: '¡Genial!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            } else {
                //se llama a "sonido" y reproducimos el sonido de que esta correcto
                Incorrecto.play();
                Swal.fire({
                    title: 'Oops...',
                    text: '¡Verifica tu respuesta!',
                    imageUrl: "../../../../../../img/signo.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
        }
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
</body>