<?php
session_start();
$id_user = $_SESSION['id_alumno_preparatoria']; $rol = $_SESSION['rol'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_preparatoria'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_preparatoria']; $rol = $_SESSION['rol'];
$permiso = "capsulapago6";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_preparatoria c INNER JOIN detalle_capsulas_pago_preparatoria d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 2;");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../../../../intermedio/capsulas/contenido/alertas/paquete_premium6.php");
}
//Verificar si ya se tiene permiso y no dar puntos de más
//Verificar si permiso_intento es correcto
$permiso_intento = 28;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_preparatoria WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 2");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

// //Contar total de intentos
// $consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_preparatoria WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 2");
// $resultadoIntentos = mysqli_fetch_assoc($consultaIntentos);
// if (isset($resultadoIntentos['intentos'])) {
//     $totalIntentos = $resultadoIntentos['intentos'];
//     if ($totalIntentos == 2 && $result_sql_permisos == 0) {
//         $puntosGanados = 8;
//     } else if ($totalIntentos == 3 && $result_sql_permisos == 0) {
//         $puntosGanados = 6;
//     } else if ($totalIntentos > 3 && $result_sql_permisos == 0) {
//         $puntosGanados = 0;
//     } else {
//         $puntosGanados = 0;
//     }
// } else {
//     $puntosGanados = 10;
// }
?>

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
            <a href="../../../../../../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct7js.php"><button style="float: right; width: 100px; height: 40px;" class="btn-b"><b>Volver a teoría</b></button></a>
            <div class="new-g" style="text-align: center;">Cápsula práctica 7 JavaScript</div><br>
            <div class="board">
                <table width="100%">
                    <thead>
                        <tr>
                            <td>Instrucciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="nombre">
                                <p> Aquí te dejo una práctica sencilla para
                                    que puedas practicar cómo utilizar cuadros de
                                    diálogo en JavaScript:
                                    1.Pide al usuario que introduzca su edad utilizando el cuadro de diálogo prompt().
                                    2.Si el usuario introduce un número válido, muestra un mensaje que indique si es mayor de edad o no.
                                    <br><br>
                                </p>
                            </td>
                            <td class="ne">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="editor-container">
                <h3 style="margin-bottom: 20px;">EDITOR DE CÓDIGO</h3>
                <!--
                <textarea onkeyup="actualizar()" class="cd" id="cd" placeholder="Escribe el código aquí"></textarea>
                <iframe class="editor" id="editor" srcdoc=" "></iframe> -->
                <!-- <button type="button" class="btn-grd" onclick="copyToClipBoard()" style="width: 5%; padding: 5px; margin: -30px 60px -20px 1050px; scale: 80%;"><i class="fas fa-paste fa-2x"></i></button> -->

                <div class="editor1">
                    <div class="titulo-edit1">
                        <h6>HTML</h6>
                    </div>
                    <div class="titulo-edit2">
                        <h6>CSS</h6>
                    </div>
                    <div class="titulo-edit3">
                        <h6>JAVASCRIPT</h6>
                    </div>
                    <div class="titulo-edit4">
                        <h6>SALIDA</h6>
                    </div>
                    <textarea onkeyup="actualizar()" id="html-code" class="cd" placeholder="Escribe el código HTML aquí"></textarea>
                    <textarea onkeyup="actualizar()" id="css-code" class="cd1" placeholder="Escribe el código CSS aquí"></textarea>
                    <textarea onkeyup="actualizar()" id="js-code" class="cd2" placeholder="Escribe el código JavaScript aquí"></textarea> <br>
                    <iframe id="output" class="editor" style="margin-top: 20px;"></iframe>
                </div>

            </div>
            <a style="text-decoration: none;"><button onclick="miFunc()" type="submit" class="btn-grd" id="update" disabled>Evaluar</button></a>
        </div>
    </div>

    <button class="boton-fijo" id="show-keyboard" ><i class="fa-regular fa-keyboard fa-2xl"></i></button>

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
const textInputs = document.querySelectorAll(".cd, .cd1, .cd2"); 
const virtualKeyboard = document.getElementById("virtual-keyboard");
const specialChars = document.querySelectorAll(".key");
const closeKeyboardButton = document.querySelector(".close-keyboard");

let activeTextInput = null; // Variable para realizar un seguimiento del textarea activo

// Función para mostrar el teclado al hacer clic en el botón
showKeyboardButton.addEventListener("click", () => {
    virtualKeyboard.style.display = "block";
    activeTextInput = null; // Restablece el textarea activo al mostrar el teclado
});

// Función para insertar caracteres en el textarea
specialChars.forEach(charButton => {
    charButton.addEventListener("click", () => {
        if (activeTextInput) {
            const char = charButton.textContent;
            activeTextInput.value += char;
        }
    });
});

// Función para cerrar el teclado
closeKeyboardButton.addEventListener("click", () => {
    virtualKeyboard.style.display = "none";
    activeTextInput = null; // Restablece el textarea activo
});

// Función para borrar un carácter en el textarea
const deleteButton = document.querySelector(".delete");
deleteButton.addEventListener("click", () => {
    if (activeTextInput) {
        const text = activeTextInput.value;
        activeTextInput.value = text.slice(0, -1);
    }
});

// Función para añadir un espacio en el textarea
const spaceButton = document.querySelector(".space");
spaceButton.addEventListener("click", () => {
    if (activeTextInput) {
        activeTextInput.value += " ";
    }
});

// Función para detectar la entrada activa
textInputs.forEach(input => {
    input.addEventListener("focus", () => {
        activeTextInput = input;
    });
});

    </script>
    <script src="../../js/editor.js"></script>
    <script type="text/javascript">
        function run() {
            let htmlCode = document.querySelector(".editor1 #html-code").value;
            let cssCode = "<style>" + document.querySelector(".editor1 #css-code").value + "</style>";
            let jsCode = document.querySelector(".editor1 #js-code").value;
            let output = document.querySelector(".editor1 #output");

            output.contentDocument.body.innerHTML = htmlCode + cssCode;
            output.contentWindow.eval(jsCode);
        }
        document.querySelector(".editor1 #html-code").addEventListener("keyup", run);
        document.querySelector(".editor1 #css-code").addEventListener("keyup", run);
        document.querySelector(".editor1 #js-code").addEventListener("keyup", run);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.5.3/ace.js"></script>
    <script>
        //se esta llamando los sonidos de la carpeta "sonidos"
        var Correcto = document.createElement("audio");
        Correcto.src = "../../../../../../../acciones/sonidos/correcto.mp3";
        var Incorrecto = document.createElement("audio");
        Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

        function miFunc() {


            let htmlcode = document.getElementById("html-code").value;
            let csscode = document.getElementById("css-code").value;
            let jscode = document.getElementById("js-code").value;
            let condicional = contOcurrencias(jscode, 'if');
            let alertas = contOcurrencias(jscode, 'alert');

            //Validando atributos, operadores y cuadros de diálogo
            if (jscode.toLowerCase().indexOf('edad') !== -1) {
                console.log("Si aparece edad");
            } else {
                console.log("No hay edad");
            }

            if (jscode.indexOf('>') !== -1) {
                console.log("Si aparece >");
            } else {
                console.log("No hay >");
            }

            if (jscode.indexOf('prompt') !== -1) {
                console.log("Si aparece prompt");
            } else {
                console.log("No hay prompt");
            }

            console.log("if: " + condicional);
            console.log("alert: " + alertas);

            if (jscode.toLowerCase().indexOf('edad') !== -1 && jscode.indexOf('>') !== -1 && jscode.indexOf('prompt') !== -1 && condicional >= 1 && alertas >= 1) {
                //se llama a "sonido" y reproducimos el sonido de que esta correcto
                Correcto.play();


                Swal.fire({
                    title: '¡Excelente sigue asi! ' + 'Obtuviste ' + 10 + ' puntos prácticos',
                    text: '¡Puntuación guardada con éxito!',
                    imageUrl: "../../../../../../img/Thumbs-Up.gif",
                    imageHeight: 350,
                    backdrop: `
                    rgba(0,143,255,0.6)
                    url("../../../../../../img/fondo.gif")
                    `,
                    confirmButtonColor: '#a14cd9',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../../acciones/insertar_cp13.php?validar=' + 'correcto' + '&permiso=' + 22 + '&id_curso=' + 7 + '&practico=' + 10;
                    }
                });

            } else {
                // fallo, quitar vidas
                fail();
            }

        }

        function fail() {
            //se llama a "sonido" y reproducimos el sonido de que esta correcto
            Incorrecto.play();

            Swal.fire({
                title: 'Oops...',
                text: '¡Verifica tu respuesta!',
                imageUrl: "../../../../../../img/signo.gif",
                imageHeight: 350,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../../acciones/insertar_cp13.php?validar=' + 'incorrecto' + '&permiso=' + 22 + '&id_curso=' + 7 + '&practico=' + 10;
                }
            });
        }
    </script>
    <script>
        function copyToClipBoard() {
            var content = document.getElementById('editor');
            content.select();
            document.execCommand('copy');
        }
    </script>
    <script>
        //Función para contar las veces que aparece una cadena dentro de otra
        function contOcurrencias(cadena, subcadena) {
            let apariciones = 0;
            let i = 0;

            while ((i = cadena.indexOf(subcadena, i)) !== -1) {
                apariciones++;

                i += subcadena.length;
            }
            return apariciones;
        }

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