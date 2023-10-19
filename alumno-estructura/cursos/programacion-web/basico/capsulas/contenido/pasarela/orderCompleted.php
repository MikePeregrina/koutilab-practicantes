<?php ob_start(); ?>
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
        </div>
        <img src="img/Thumbs-Up.gif" alt="" />
        <div>
            <button>
                <a href="../../../../../../rutas/ruta-pw-b.php" type="button">Regresar a la ruta</a>
            </button>
        </div>
    </div>
</body>

</html>

<?php ob_end_flush(); ?>