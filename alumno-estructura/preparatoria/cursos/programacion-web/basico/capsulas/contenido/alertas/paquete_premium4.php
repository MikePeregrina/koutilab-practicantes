<?php
session_start();
$id_user = $_SESSION['id_alumno_preparatoria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_preparatoria'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../../../../../../img/lgk.png">
    <link rel="shortcut icon" href="../../../../../../img/lgk.png">
    <link rel="stylesheet" href="../../css/capsula-teoria.css">
    <link rel="stylesheet" href="../../css/carrusel.css" />
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="body">
        <div class="container">
            <a href="#" onclick="history.back(); return false;"><button style="float: left;" class="btn-b" id="btn-cerrar-modalV"><i class="fas fa-reply"></i></button></a>
            <div class="new-g" style="text-align: center;">Cápsula de pago</div><br>
            <section id="container-slider">

                <ul class="listslider">
                    <!-- Agregar linea de código <li><a itlist="itList_X" href="#"></a></li> cada que se agrega una imagen más-->
                    <li>
                        <a itlist="itList_7" href="#" class="item-select-slid"></a>
                    </li>

                </ul>
                <ul id="slider">
                    <li style="background-image: url('../../img/Alertas.gif'); z-index:0; opacity: 1;">
                        <form id="pregunta" method="POST" enctype="multipart/form-data" action="../pasarela/orderPasarela.php">
                            <input type="hidden" name="id_capsula" value="4">
                            <input type="hidden" name="id_curso" value="1">
                            <button type="submit" class="btn-grd1" style="margin-left: 61.5%;">¡Comprar!</button>
                        </form>
                    </li>
                </ul>
            </section>
        </div>
    </div>
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
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script defer src="../../js/functions.js"></script>
</body>