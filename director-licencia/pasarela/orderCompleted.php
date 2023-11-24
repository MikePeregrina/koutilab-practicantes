<?php ob_start();
$clave_alumno = $_GET['clave_alumno'];
$clave_docente = $_GET['clave_docente'];
$clave_director = $_GET['clave_director'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Koutilab</title>
    <link rel="shortcut icon" href="img/lgk.png">
    <link rel="stylesheet" href="order.css" />
</head>

<body>

    <div class="container">
        <div class="context">
            <h1>¡Éxito! Su pedido se procesó correctamente.</h1>
            <h1>Claves escolares</h1>
            <h1>Clave alumno: <?php echo $clave_alumno; ?></h1>
            <h1>Clave docente: <?php echo $clave_docente; ?></h1>
            <h1>Clave director: <?php echo $clave_director; ?></h1>
        </div>
        <div class="image-container">
            <img src="img/Thumbs-Up.gif" alt="" />
        </div>
        
    </div>
    <div class="button-container">
            <button>
                <a href="../paquetes.php" type="button">Regresar a paquetes</a>
            </button>
        </div>
</body>

<script>
    function generateConfetti() {
        const colors = ['#f1c40f', '#e74c3c', '#3498db', '#2ecc71']; // Colores del confeti
        const confettiElements = 200; // Cantidad de elementos de confeti

        const container = document.createElement('div');
        container.classList.add('confetti-container');

        for (let i = 0; i < confettiElements; i++) {
            const confetti = document.createElement('div');
            confetti.classList.add('confetti');
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.left = `${Math.random() * 100}vw`;
            confetti.style.animationDelay = `${Math.random() * 1}s`; // Ajustando el delay
            confetti.style.animationDuration = `${Math.random() * 3 + 2}s`; // Ajustando la duración
            container.appendChild(confetti);
        }

        document.body.appendChild(container);
    }

    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(generateConfetti, 500); // Llama a la función después de un retraso al cargar la página
    });
</script>


</html>

<?php ob_end_flush(); ?>