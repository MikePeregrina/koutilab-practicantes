<?php
session_start();
$id_user = $_SESSION['id_director_licencia'];
if (empty($_SESSION['active']) || empty($_SESSION['id_director_licencia'])) {
    header('location: ../acciones/cerrarsesion.php');
}
include('../acciones/conexion.php');
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM directores d
JOIN escuelas e 
ON d.id_escuela = e.id_escuela
WHERE d.id_director = $id_user"));

$id_escuela = $user['id_escuela'];
$clave = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM escuelas WHERE id_escuela = $id_escuela"));
$clave_alumno = $clave['clave_alumno'];
$clave_docente = $clave['clave_docente'];
$clave_director = $clave['clave_director'];

// Consulta SQL
$query_fecha = "SELECT fecha_expiracion FROM tabla_claves WHERE clave = '$clave_alumno'";

// Ejecutar la consulta
$resultado = $conexion->query($query_fecha);

if ($resultado) {
    // Verificar si hay resultados
    if ($resultado->num_rows > 0) {
        // Obtener los datos de la fila
        $fila = $resultado->fetch_assoc();
        // Verificar si la fecha actual es mayor que la fecha de expiración
        $fecha_actual = strtotime(date("Y-m-d")); // Fecha actual en formato timestamp
        $fecha_expiracion = strtotime($fila['fecha_expiracion']); // Fecha de expiración de la base de datos en formato timestamp

        $boton_deshabilitado = '';
        if ($fecha_actual < $fecha_expiracion) {
            $boton_deshabilitado = 'disabled'; // Si la fecha actual es menor que la de expiración, deshabilitar el botón
        }
    } else {
        echo "No se encontraron resultados para la clave especificada.";
    }
} else {
    echo "Error al ejecutar la consulta: " . $conexion->error;
}

?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/paquetes.css">
<link rel="stylesheet" href="css/nav-barra.css">
<link rel="stylesheet" href="css/footer.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<title>KOUTILAB</title>
</head>

<!-- Header nav -->
<?php include 'header-nav.php'; ?>

<div class="containers">
    <h1>PAQUETES</h1>
</div>

<section>
    <div class="titlec">
        <h2>Adquirir o renovar un paquete</h2>
    </div>
    <div class="linea-azul"></div>
    <div class="container-card">
        <div class="box-card">
            <!-- Tarjeta -->
            <div class="paq-card">
                <div class="icon-card"><i class="fas fa-check"></i></div>
                <div class="tittle-card1">
                    <p>CODING</p>
                </div>
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
                    <form action="pasarela/orderPasarela.php" method="post">
                        <input type="hidden" name="precio" value="1625">
                        <input type="hidden" name="usuarios" value="500">
                        <input type="hidden" name="modelo" value="CODING">
                        <input type="hidden" name="clave_alumno" value="<?php echo $clave_alumno; ?>">
                        <input type="hidden" name="clave_docente" value="<?php echo $clave_docente; ?>">
                        <input type="hidden" name="clave_director" value="<?php echo $clave_director; ?>">
                        <button type="submit" <?php echo $boton_deshabilitado; ?>>ADQUIRIR</button>
                    </form>
                </div>
            </div>

            <div class="paq-card">
                <div class="icon-card"><i class="fas fa-paper-plane"></i></div>
                <div class="tittle-card1">
                    <p>INNOVA</p>
                </div>
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
                    <form action="pasarela/orderPasarela.php" method="post">
                        <input type="hidden" name="precio" value="3250">
                        <input type="hidden" name="usuarios" value="1000">
                        <input type="hidden" name="modelo" value="INNOVA">
                        <input type="hidden" name="clave_alumno" value="<?php echo $clave_alumno; ?>">
                        <input type="hidden" name="clave_docente" value="<?php echo $clave_docente; ?>">
                        <input type="hidden" name="clave_director" value="<?php echo $clave_director; ?>">
                        <button type="submit" <?php echo $boton_deshabilitado; ?>>ADQUIRIR</button>
                    </form>
                </div>
            </div>

            <div class="paq-card">
                <div class="icon-card"><i class="fas fa-brain"></i></div>
                <div class="tittle-card1">
                    <p>CODER</p>
                </div>
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
                    <form action="pasarela/orderPasarela.php" method="post">
                        <input type="hidden" name="precio" value="7800">
                        <input type="hidden" name="usuarios" value="3000">
                        <input type="hidden" name="modelo" value="CODER">
                        <input type="hidden" name="clave_alumno" value="<?php echo $clave_alumno; ?>">
                        <input type="hidden" name="clave_docente" value="<?php echo $clave_docente; ?>">
                        <input type="hidden" name="clave_director" value="<?php echo $clave_director; ?>">
                        <button type="submit" <?php echo $boton_deshabilitado; ?>>ADQUIRIR</button>
                    </form>
                </div>
            </div>

            <div class="paq-card">
                <div class="icon-card"><i class="fas fa-gem"></i></div>
                <div class="tittle-card1">
                    <p>PROGRAMMER</p>
                </div>
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
                    <form action="pasarela/orderPasarela.php" method="post">
                        <input type="hidden" name="precio" value="9750">
                        <input type="hidden" name="usuarios" value="5000">
                        <input type="hidden" name="modelo" value="PROGRAMMER">
                        <input type="hidden" name="clave_alumno" value="<?php echo $clave_alumno; ?>">
                        <input type="hidden" name="clave_docente" value="<?php echo $clave_docente; ?>">
                        <input type="hidden" name="clave_director" value="<?php echo $clave_director; ?>">
                        <button type="submit" <?php echo $boton_deshabilitado; ?>>ADQUIRIR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>