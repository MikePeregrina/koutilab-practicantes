<?php
session_start();
$id_user = $_SESSION['id_alumno_preparatoria'];
if (empty($_SESSION['active'])) {
    header('location: ../../../../../../../../index.php');
}
include "../../../../../../../../acciones/conexion.php";

// Consulta para obtener la cantidad de estrellas para el alumno específico
$sql_estrellas = "SELECT estrellas FROM total_estrellas_preparatoria WHERE id_alumno = $id_user";
$result_estrellas = $conexion->query($sql_estrellas);

if ($result_estrellas->num_rows > 0) {
    $row = $result_estrellas->fetch_assoc();
    $cantidad_estrellas = $row['estrellas'];

    // Verificar si el usuario tiene al menos 150 estrellas
    $puede_comprar = ($cantidad_estrellas >= 150);
} else {
    $cantidad_estrellas = 0;
    $puede_comprar = false;
}

$id_capsula = $_GET['id_capsula'];
$id_curso = $_GET['id_curso'];

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
            <h1>Total de <?php echo $cantidad_estrellas; ?> estrella(s).</h1>
        </div>
        <img src="img/Thumbs-Up.gif" alt="" />
        <div>
            <?php if ($puede_comprar) : ?>
                <button>
                    <a href="orderDetailsEstrellas.php?payment_amount=150&id_alumno=<?php echo $id_user; ?>&id_capsula=<?php echo $id_capsula; ?>&id_curso=<?php echo $id_curso; ?>" type="button">Comprar por 150 estrellas ahora mismo</a>
                </button>
            <?php else : ?>
                <h1 style="color: red;">Estrellas insuficientes</h1>
                <button disabled>
                    <a href="../../../../../../rutas/ruta-in-a.php" type="button">¡Ir a recolectar estrellas!</a>
                </button>
            <?php endif; ?>
            <button>
                <a href="../../../../../../rutas/ruta-in-a.php" type="button">Regresar a la ruta</a>
            </button>
        </div>
    </div>
</body>

</html>