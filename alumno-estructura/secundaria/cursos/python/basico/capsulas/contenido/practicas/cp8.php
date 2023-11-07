<?php
session_start();
$id_user = $_SESSION['id_alumno_secundaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_secundaria'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_secundaria'];
$permiso = "capsula17";
if (isset($_GET['pythoncode'])) {
    $pythoncode = $_GET['pythoncode'];
} else {
    $pythoncode = "";
}

$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_secundaria c INNER JOIN detalle_capsulas_secundaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 4");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: ../../../../basico/capsulas/acciones/capsulas.php");
}
//Verificar si ya se tiene permiso y no dar puntos de más
//Verificar si permiso_intento es correcto
$permiso_intento = 18;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_secundaria WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 4");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_secundaria WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 4");
$resultadoIntentos = mysqli_fetch_assoc($consultaIntentos);
if (isset($resultadoIntentos['intentos'])) {
    $totalIntentos = $resultadoIntentos['intentos'];
    if ($totalIntentos == 2 && $result_sql_permisos == 0) {
        $puntosGanados = 8;
    } else if ($totalIntentos == 3 && $result_sql_permisos == 0) {
        $puntosGanados = 6;
    } else if ($totalIntentos > 3 && $result_sql_permisos == 0) {
        $puntosGanados = 0;
    } else {
        $puntosGanados = 0;
    }
} else {
    $puntosGanados = 10;
}
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
            <div class="new-g" style="text-align: center;">Cápsula práctica 8</div><br>
            <div class="board">
                <table width="100%">
                    <thead>
                        <tr>
                            <td>Instrucciones</td>
                            <td>Imagen Muestra</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="nombre">
                                <p> Realiza la suma de las dos variables utilizando el operador "+". Luego, imprime el resultado.
                                </p>
                            </td>
                            <td class="ne">
                                <img src="../../img/code8.png">
                                </img>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="">
                <h3>EDITOR DE CÓDIGO</h3>
                <!--
                <textarea onkeyup=" actualizar()" class="cd" id="cd" placeholder="Escribe el código aquí"></textarea>
                                <iframe class="editor" id="editor" srcdoc=" "></iframe> -->
                <button type="button" class="btn-grd" onclick="copyToClipBoard()" style="width: 15%; padding: 5px; margin: -30px 60px -20px 70%; scale: 80%;"><i class="fas fa-paste fa-2x"></i></button>

                <div class="editor-container">
                    <div class="cd" id="editor"></div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.5.3/ace.js"></script>
    <script src="../../js/codePy.js"></script>
    <script src="../../js/fund.js"></script>
    <script>
        var editorP = ace.edit('editor');
        editorP.setValue(`<?php echo urldecode($pythoncode); ?>`);
    </script>

    <script>
        //se esta llamando los sonidos de la carpeta "sonidos"
        var Correcto = document.createElement("audio");
        Correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
        var Incorrecto = document.createElement("audio");
        Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

        function miFunc() {

            // let ta = document.getElementById('editor').innerText
            // evaluacion del string
            // el split ayuda a dividir las cadenas de ahi tomo el nombre y lo meto a la condicion
            // asi logra aceptar cualquier nombre
            // let val = ta.split(' ');
            // para revisar que palabra manda y que posicion
            // alert(val[2]+" + "+val[4]);
            // let esCorrecto = ta == '1\n2\nsuma = numero1 + numero2\nprint("La suma es:", suma)';

            function compararCodigo(usuario, esperado) {
                const quitarEspaciosSaltosLinea = (codigo) => codigo.replace(/[\s\n]/g, '');
                const codigoUsuarioLimpio = quitarEspaciosSaltosLinea(usuario);
                const codigoEsperadoLimpio = quitarEspaciosSaltosLinea(esperado);

                console.log("Código del usuario sin espacios ni saltos de línea:");
                console.log(codigoUsuarioLimpio);
                console.log("Código esperado sin espacios ni saltos de línea:");
                console.log(codigoEsperadoLimpio);

                //Convertir en minusculas
                const codigoUsuarioMin = codigoUsuarioLimpio.toLowerCase();
                const codigoEsperadoMin = codigoEsperadoLimpio.toLowerCase();

                console.log("Código del usuario en minusculas:");
                console.log(codigoUsuarioMin);
                console.log("Código esperado en minusculas:");
                console.log(codigoEsperadoMin);

                return codigoUsuarioMin === codigoEsperadoMin;
            }

            let ta = document.getElementById('editor').innerText.trim();
            console.log("Respuesta desde el editor: ", ta);
            let esperado = '1\n2\nsuma = numero1 + numero2\nprint("La suma es:", suma)';

            let esCorrecto = compararCodigo(ta, esperado);

            console.log("¿El código del usuario es igual al código esperado?", esCorrecto);


            if (!esCorrecto) {
                //se llama a "sonido" y reproducimos el sonido de que esta incorrecto
                Incorrecto.play();
                var editorP = ace.edit("editor");

                var myCode = editorP.getSession().getValue();
                var encodeV = encodeURI(myCode);
                Swal.fire({
                    title: 'Oops...',
                    text: '¡Verifica tu respuesta!',
                    imageUrl: "../../../../../../img/signo.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../../acciones/insertar_practica.php?validar=' + 'incorrecto' + '&permiso=' + <?php echo $permiso_intento; ?> + '&id_curso=' + 4 + '&practico=' + 10 + '&pythoncode=' + encodeV + '&redireccion=' + '../contenido/practicas/cp8.php';
                    }
                });
            } else {
                //se llama a "sonido" y reproducimos el sonido de que esta correcto
                Correcto.play();
                let puntos = '<?php echo $puntosGanados; ?>';

                //UNA SERIE DE CONDICIONALES ANIDADAS LAS CUALES VALIDAN NUESTROS 4 POSIBLES RESULTADOS Y MANDA LA ALERTA CORRESPONDIENTE
                if (puntos == 0) {
                    //resultado();
                    Swal.fire({
                        title: 'Bien hecho al fin lo lograste. ¡Debes mejorar!',
                        text: '¡Más de 3 intentos, no es posible sumar puntos!',
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
                            window.location.href = '../../acciones/insertar_practica.php?validar=' + 'correcto' + '&permiso=' + <?php echo $permiso_intento; ?> + '&id_curso=' + 4 + '&practico=' + 10;
                        }
                    });
                } else if (puntos == 6) {
                    Swal.fire({
                        title: '¡Bien hecho! ' + 'Obtuviste ' + puntos + ' puntos prácticos',
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
                            window.location.href = '../../acciones/insertar_practica.php?validar=' + 'correcto' + '&permiso=' + <?php echo $permiso_intento; ?> + '&id_curso=' + 4 + '&practico=' + 10;
                        }
                    });
                } else if (puntos == 8) {
                    Swal.fire({
                        title: '¡Bien hecho! ' + 'Obtuviste ' + puntos + ' puntos prácticos',
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
                            window.location.href = '../../acciones/insertar_practica.php?validar=' + 'correcto' + '&permiso=' + <?php echo $permiso_intento; ?> + '&id_curso=' + 4 + '&practico=' + 10;
                        }
                    });
                } else if (puntos == 10) {
                    Swal.fire({
                        title: '¡Excelente sigue así! ' + 'Obtuviste ' + puntos + ' puntos prácticos',
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
                            window.location.href = '../../acciones/insertar_practica.php?validar=' + 'correcto' + '&permiso=' + <?php echo $permiso_intento; ?> + '&id_curso=' + 4 + '&practico=' + 10;
                        }
                    });
                }
            }
        }
    </script>

    <script>
        function copyToClipBoard() {
            // Crea un input para poder copiar el texto dentro       
            let copyText = document.getElementById('editor').innerText
            const textArea = document.createElement('textarea');
            textArea.textContent = copyText;
            document.body.append(textArea);
            textArea.select();
            document.execCommand("copy");
            // Delete created Element       
            textArea.remove()
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