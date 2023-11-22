<?php
// session_start();
// $id_user = $_SESSION['id_docente_primaria'];
// if (empty($_SESSION['active']) || empty($_SESSION['id_docente_primaria'])) {
//   header('location: ../acciones/cerrarsesion.php');
// }
// include('../acciones/conexion.php');
// $user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM docentes_primaria d
// JOIN escuelas e 
// ON d.id_escuela = e.id_escuela
// WHERE d.id_docente = $id_user"));
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
            <p>Cápsulas compradas</p>
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="tabla">
            <table id="ingresos" width="100%" class="table border-top" style="z-index: 1;">
                <thead>
                    <tr>
                        <td><b>Cápsulas compradas</b></td>
                        <td><b>Curso</b></td>
                        <td><b>Precio</b></td>
                        <td><b>Ingreso</b></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Paquete 1</td>
                        <td>Programación web básico</td>
                        <td>$30.00</td>
                        <td>$3.00</td>
                    </tr>
                    <tr>
                        <td>Paquete 3</td>
                        <td>Programación web básico</td>
                        <td>$30.00</td>
                        <td>$3.00</td>
                    </tr>
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

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            datasets: [{
                label: 'Cápsulas compradas',
                data: [12, 19, 3, 5, 2, 3],
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