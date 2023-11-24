<?php
session_start();
$id_user = $_SESSION['id_director_freemium'];
if (empty($_SESSION['active']) || empty($_SESSION['id_director_freemium'])) {
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

$id = $user["id_director"];
$name = $user["nombre"];
$apellidop = $user["apellidop"];
$apellidom = $user["apellidom"];
$image = $user["image"];
$username = $user["usuario"];
$email = $user['email'];
$id_escuela_director = $user['id_escuela'];

$total_capsulas = "SELECT COUNT(*) total FROM payment_primaria p
                        JOIN alumnos_primaria a
                        ON p.id_alumno = a.id_alumno
                        WHERE a.id_escuela = '$id_escuela_director'";
$resultcapsulas = mysqli_query($conexion, $total_capsulas);
$filacapsulas = mysqli_fetch_assoc($resultcapsulas);
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/ingresos.css">
<link rel="stylesheet" href="css/nav-barra.css">
<link rel="stylesheet" href="css/footer.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bulma.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">

<title>KOUTILAB</title>
</head>

<!-- Header nav -->
<?php include 'header-nav.php'; ?>

<div class="containers">
    <h1>INGRESOS</h1>
</div>

<section>
    <div class="titlec">
        <h2>Ingresos por cápsulas premium</h2>
    </div>

    <div class="content-std">
        <div class="grafica">
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="tabla">
            <table id="ingresos" width="100%" class="table border-top" style="z-index: 1;">
                <thead>
                    <tr>
                        <td><b>Cápsulas compradas</b></td>
                        <td><b>Usuario</b></td>
                        <td><b>Precio (MXN)</b></td>
                        <td><b>Ingreso (10%)</b></td>
                        <td><b>Fecha de adquisición (AA/MM/DD)</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../acciones/conexion.php";

                    $query_payment_primaria = mysqli_query($conexion, "SELECT * FROM payment_primaria p
                    JOIN alumnos_primaria a
                    ON p.id_alumno = a.id_alumno
                    WHERE a.id_escuela = '$id_escuela_director'
                    ");

                    $result = mysqli_num_rows($query_payment_primaria);
                    if ($result > 0) {
                        while ($data = mysqli_fetch_assoc($query_payment_primaria)) {
                            $d = new DateTime($data['create_at']); 
                    ?>
                            <tr>
                                <td><?php echo $data['item_name']; ?></td>
                                <td><?php echo $data['usuario']; ?></td>
                                <td>$<?php echo $data['payment_amount']; ?></td>
                                <td>$<?php echo (($data['payment_amount']) / 100) * 10; ?>.00</td>
                                <td><?php echo $d->format('y-m-d'); ?></td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bulma.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#ingresos').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/es-MX.json'
            }
        });
    });
</script>

<script>
    const ctx = document.getElementById('myChart');

    datos = <?php echo $filacapsulas['total'];?>;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total de cápsulas adquiridas dentro de la institución: <?php echo $filacapsulas['total'];?>'],
            datasets: [{
                label: 'Total de cápsulas',
                data: [<?php echo $filacapsulas['total'];?>],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
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