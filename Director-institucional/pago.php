<?php
//ProPayPal es vital para declarar si es demo o prueba las transacciones

//define('ProPayPal', 0); // El cero simboliza entorno de Prueba
//define('ProPayPal', 1); // El 1 simboliza entorno de producción

session_start();
$id_user = $_SESSION['id_director'];
if (empty($_SESSION['active']) || empty($_SESSION['id_director'])) {
    header('location: ../acciones/cerrarsesion.php');
}
include "../acciones/conexion.php";

define('ProPayPal', 0);
if (ProPayPal) {
    define("PayPalClientId", "*********************");
    define("PayPalSecret", "*********************");
    define("PayPalBaseUrl", "https://koutilab.com/Director-institucional/pasarela/");
    define("PayPalENV", "production");
} else {
    define("PayPalClientId", "Ae1Oau6-P8S9_nG7DK0q7u74hRYNkPSZnKSWDgBLuTIbk-mblCFjgCOxJVKW5Uf6uiYOran_5vnLu28a");
    define("PayPalSecret", "EAOYI052iYSGGT2592LeeXNvDbCq9tArRGqgWRVCAxQwf55u-wHx3VVxePzGD2j-9F29mEcbXL12mPFR");
    define("PayPalBaseUrl", "http://localhost/koutilab-practicantes/Director-institucional/pasarela/");
    define("PayPalENV", "sandbox");
}
$productName = "Paquete de prueba";
$currency = "USD";
$productPrice = 2;
$productId = 1;
$orderNumber = 1;
$id_curso = 1;
$id_capsula = 1;

$id = trim($_POST['id']);
$cupo = trim($_POST['cupo']);
$clave = trim($_POST['acceso']);
$nombrePaquete = $_POST['nombrePaquete'];
$image = trim($_POST['image']);


?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/pago.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- jQuery -->
    <title>Koutilab</title>
    <link rel="shortcut icon" href="img/lgk.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body>
    <div class="container" style="margin-top: 70px; margin-left: -50px;">
        <div class="panel">
            <div class="row">

                <div class="liquid">
                    <div class="back-button">
                        <i class="fas fa-rotate-left"></i>
                    </div>

                    <img src="img/foco.gif" alt="" srcset="">

                </div>


                <!-- side -->
                <div class="form-box">
                    <div class="titlec">
                        <h1>¡Adquiere este paquete para tener acceso a su contenido!</h1>
                    </div>


                    <div class="s">
                        <h2>Total a pagar</h2><br>
                        <h2>2 USD</h2><br>
                        <div id="paypal-button-container" class=""></div>
                        <div id="paypal-button"></div>
                        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                        <script>
                            paypal.Button.render({
                                env: '<?php echo PayPalENV; ?>',
                                client: {
                                    <?php if (ProPayPal) { ?>
                                        production: '<?php echo PayPalClientId; ?>'
                                    <?php } else { ?>
                                        sandbox: '<?php echo PayPalClientId; ?>'
                                    <?php } ?>
                                },
                                payment: function(data, actions) {
                                    return actions.payment.create({
                                        transactions: [{
                                            amount: {
                                                total: '<?php echo $productPrice; ?>',
                                                currency: '<?php echo $currency; ?>'
                                            }
                                        }]
                                    });
                                },
                                onAuthorize: function(data, actions) {
                                    return actions.payment.execute()
                                        .then(function() {
                                            window.location = "<?php echo PayPalBaseUrl; ?>orderDetails.php?payment_id=" + data.paymentID + "&item_number=<?php echo $productId; ?>" + "&item_name=<?php echo $productName; ?>" + "&payment_amount=<?php echo $productPrice; ?>" + "&payment_currency=<?php echo $currency; ?>" + "&id_director=<?php echo $id; ?> " + "&cupo=<?php echo $cupo; ?> " + "&image=<?php echo $image; ?>" + "&nombrePaquete=<?php echo $nombrePaquete; ?>" + "&clave=<?php echo $clave; ?>";
                                        });
                                },
                                style: {
                                    color: 'blue',
                                    label: 'paypal',
                                    layout: 'vertical',
                                },
                            }, '#paypal-button');
                        </script>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <footer>
        <div class="image">
            <img src="img/Bienvenida.png" alt="" width="300px">
        </div>
    </footer>
</body>

</html>