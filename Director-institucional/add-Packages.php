<?php
//Validamos que exista una sesion 
session_start();
//Recuperamos los datos de la sesion
$id_user = $_SESSION['id_director'];
if (empty($_SESSION['active']) || empty($_SESSION['id_director'])) {
    header('location: ../acciones/cerrarsesion.php');
}
//concetamos con la base de datos
include('../acciones/conexion.php');
//variables para los nombres de paquetes
$namePaquete1 = "Paquete 1";
$namePaquete2 = "Paquete 2";
$namePaquete3 = "Paquete 3";
$resta = 0;
//imagen por defecto
$image = "brandon - 2023.06.23 - 06.22.19am.jpg";
//Generamos clave
function generarParteClave($longitud)
{
    $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $clave = '';

    for ($i = 0; $i < $longitud; $i++) {
        $indice = rand(0, strlen($caracteres) - 1);
        $clave .= $caracteres[$indice];
    }

    return $clave;
}

function generarClave()
{
    $parte1 = generarParteClave(3);
    $parte2 = generarParteClave(5);
    return $parte1 . '-' . $parte2;
}


//genermos la clave
$clave = generarClave();
$adquirido = false;
$adquirido2 = false;
$adquirido3 = false;
// Consulta para conocer los datos para fichas de paquetes comprados
$query = "SELECT * FROM paquete_director WHERE id_director = '$id_user'";
$paquetes = mysqli_query($conexion, $query) or die(mysqli_error($db));
$result = mysqli_num_rows($paquetes);

if ($result > 0) {
    while ($data = mysqli_fetch_array($paquetes)) {
        if ($data['nombre_paquete'] == $namePaquete1 || $data['nombre_paquete'] == $namePaquete2 || $data['nombre_paquete'] == $namePaquete3) {
            $adquirido = true;
        }
        while ($data['clave'] == $clave) {

            $clave = generarClave();
        }
    }
}

// Consulta para conocer los datos para fichas de paquetes comprados
$query = "SELECT * FROM paquete_director WHERE id_director = '$id_user'";
$paquetes = mysqli_fetch_assoc(mysqli_query($conexion, $query));



if (!empty($paquetes['fechaRegistro'])) {
    //Cambiamos a nuestra zona horaria
    date_default_timezone_set('America/Monterrey');
    //formateamos la fecha
    $today = date('Y-m-d', time());
    //Creamos las fechas dando formato de tipo fecha
    $fechaHoy = new DateTime($today);
    $fechaRegistro = new DateTime($paquetes['fechaRegistro']);
    //calculamos la diferencia de dias que han pasado desde el registro
    $resultado = $fechaHoy->diff($fechaRegistro);
    //Al tiempo de vida se le restan los dias que han pasado
    $resta = 30 - intval($resultado->format('%a'));
    if ($resta <= 1) {
        $sql = "DELETE FROM `paquete_director` WHERE id_director = '$id_user'";

        $query = mysqli_query($conexion, $sql);
    }


    // Consulta para conocer los datos para fichas de paquetes comprados
    $query = "SELECT * FROM paquete_director WHERE id_director = '$id_user'";
    $paquetes = mysqli_query($conexion, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/packages.css">
    <link rel="stylesheet" href="css/nav-barra.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Director Institucional</title>
    </head>

    <body>

        <!-- Header nav -->
        <?php include 'header-nav.php'; ?>

        <div class="containers">
            <h1>PAQUETES ADQUIRIDOS</h1>
        </div>

        <div class="studens-add-bar">
            <div class="left-student">
                <i class="fas fa-book"></i>
                <h2>Paquete(s)</h2>
            </div>

            <div class="right-student" id="addCourseButton">
                <i class="fas fa-book-medical"></i>
                <h2>Añadir paquete</h2>
            </div>
        </div>

        <!-- Contenido de la pantalla emergente al adquirir -->
        <div class="popup-container" id="popupContainer">
            <div class="popup-content">
                <div class="titlec">
                    <h2>Adquirir paquete</h2>
                </div>

                <br>
                <div class="search">
                    <div class="box">
                        <input type="text" placeholder="Buscar paquete">
                        <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                    </div>
                </div>

                <div class="content-popup">
                    <div class="container1">
                        <h2>Paquete 1</h2>
                        <h2>25 cupos</h2>
                        <?php
                        if ($resta <= 1) {
                            $adquirido = false;
                        }
                        if ($adquirido) {
                            echo ("
                        <img src='R.jpg' >
                        <button disabled id='btnPaquete1'>
                            <h3>Adquirir</h3>
                        </button>
                        ");
                        } else {

                            echo ("
                            <img src='R.jpg' >
                            <form  method=post action=pago.php>
                        <input type=hidden name=id value= $id_user>
                        <input type=hidden name=nombrePaquete value= $namePaquete1>
                        <input type=hidden name=image value= $image >
                        <input name=acceso  type=hidden value= $clave>
                        <input name = cupo type=hidden  value = 25 >
                       
                        <button >
                        <h3>Adquirir</h3>
                    </button>
                    </form>");
                        } ?>
                    </div>

                    <div class="container2">
                        <h2><?php echo ($namePaquete2); ?></h2>
                        <h2>50 cupos</h2>
                        <?php
                        if ($resta <= 1) {
                            $adquirido = false;
                        }
                        if ($adquirido) {
                            echo ("
                        <img src='R.jpg' >
                        <button disabled id='btnPaquete1'>
                            <h3>Adquirir</h3>
                        </button>
                        ");
                        } else {

                            echo ("
                            <img src='R.jpg' >
                            <form  method=post action=pago.php>
                        <input type=hidden name=id value= $id_user>
                        <input type=hidden name=nombrePaquete value= $namePaquete2>
                        <input type=hidden name=image value= $image >
                        <input name=acceso  type=hidden value= $clave>
                        <input name = cupo type=hidden  value = 50 >
                       
                        <button >
                        <h3>Adquirir</h3>
                    </button>
                    </form>");
                        } ?>
                    </div>

                    <div class="container3">
                        <h2><?php echo ($namePaquete3); ?></h2>
                        <h2>100 cupos</h2>
                        <?php
                        if ($resta <= 1) {
                            $adquirido = false;
                        }
                        if ($adquirido) {
                            echo ("
                        <img src='R.jpg' >
                        <button disabled id='btnPaquete1'>
                            <h3>Adquirir</h3>
                        </button>
                        ");
                        } else {

                            echo ("
                            <img src='R.jpg' >
                            <form  method=post action=pago.php>
                        <input type=hidden name=id value= $id_user>
                        <input type=hidden name=nombrePaquete value= $namePaquete3>
                        <input type=hidden name=image value= $image >
                        <input name=acceso  type=hidden value= $clave>
                        <input name = cupo type=hidden  value = 100 >
                       
                        <button >
                        <h3>Adquirir</h3>
                    </button>
                    </form>");
                        } ?>
                    </div>
                </div>


                <button id="closeButton"><i class="fas fa-times"></i></button>


            </div>
        </div>


        <!-- paquete 2-->



        <style>
            .target {
                width: 233px;
                height: 210px;
                background-color: white;

                border-radius: 12px;
                border: 2px solid blue;

                margin-top: 20px;
                margin-left: 20px;

                text-align: center;
            }
        </style>
        <section>

            <?php
            // Consulta para conocer los datos para fichas de paquetes comprados
            $query = "SELECT * FROM paquete_director WHERE id_director = '$id_user'";
            $paquetes = mysqli_query($conexion, $query) or die(mysqli_error($db));
            $result = mysqli_num_rows($paquetes);
            if ($result > 0) {
                while ($data = mysqli_fetch_array($paquetes)) {

            ?>
                    <div class="target">
                        <br>
                        <span><?php echo $data['nombre_paquete']; ?></span>
                        <img src="R.jpg" height="100px" width="200px"><br>
                        <span>Cupos: <?php echo $data['cupo']; ?></span>
                        <br>
                        <span>Clave de acceso: <?php echo $data['clave']; ?></span>
                    </div>
            <?php
                }
            }
            ?>
        </section>

        <script>
            const addCourseButton = document.getElementById('addCourseButton');
            const popupContainer = document.getElementById('popupContainer');
            const closeButton = document.getElementById('closeButton');
            // //paquete 1
            // const btnPaquete1 = document.getElementById('btnPaquete1');
            // const closeButtonPaquete = document.getElementById('closeButtonPaquete');
            // const popPaquete = document.getElementById('popPaquete');
            // //paquete 2
            // const btnPaquete2 = document.getElementById('btnPaquete2');
            // const closeButtonPaquete2 = document.getElementById('closeButtonPaquete2');
            // const popPaquete2 = document.getElementById('popPaquete2');
            // //paquete 3
            // const btnPaquete3 = document.getElementById('btnPaquete3');
            // const closeButtonPaquete3 = document.getElementById('closeButtonPaquete3');
            // const popPaquete3 = document.getElementById('popPaquete3');

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

    </body>

</html>