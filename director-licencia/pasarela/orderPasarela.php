<?php
//ProPayPal es vital para declarar si es demo o prueba las transacciones

//define('ProPayPal', 1); // El cero simboliza entorno de Prueba
//define('ProPayPal', 1); // El 1 simboliza entorno de producción

include "../../acciones/conexion.php";

define('ProPayPal', 0);
if (ProPayPal) {
    define("PayPalClientId", "AWuU3SUmjGF7B2S3LJgWW9tAb_u_-YA1PUx2nX1fSIQll5V1N6zonfDZ-40NIcmOKEPh5FewTaQPp6n3");
    define("PayPalSecret", "EMerBic12d3e1gHvFwUC6qSMisA00APvqKJcKb2tENmig-EN3jqmr7IzzDQjrEx_88CaleyOgb3qQqK8");
    define("PayPalBaseUrl", "https://koutilab.com/director-licencia/pasarela/");
    define("PayPalENV", "production");
} else {
    define("PayPalClientId", "Ae1Oau6-P8S9_nG7DK0q7u74hRYNkPSZnKSWDgBLuTIbk-mblCFjgCOxJVKW5Uf6uiYOran_5vnLu28a");
    define("PayPalSecret", "EAOYI052iYSGGT2592LeeXNvDbCq9tArRGqgWRVCAxQwf55u-wHx3VVxePzGD2j-9F29mEcbXL12mPFR");
    define("PayPalBaseUrl", "http://localhost/koutilab-practicantes/director-licencia/pasarela/");
    define("PayPalENV", "sandbox");
}

$productName = $_POST['modelo'];
$currency = "MXN";
$productPrice = $_POST['precio'];
$productId = 1;
$orderNumber = 1;
// Recibir los datos del formulario
$clave_alumno = $_POST['clave_alumno'];
$clave_docente = $_POST['clave_docente'];
$clave_director = $_POST['clave_director'];
$usuarios = $_POST['usuarios'];

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- jQuery -->
    <title>Koutilab</title>
    <link rel="shortcut icon" href="img/lgk.png">

<body>
    <div class="container" style="margin-top: -25px; margin-left: -50px;">
        <div class="panel">
            <div class="row">
                <div class="liquid">
                    <img src="img/foco.gif" alt="" srcset="">
                </div>
                <!-- side -->
                <div class="form-box">
                    <div class="button-box">
                        <button type="button" class="toggle-btn">
                            <p>Pago paquete <?php echo $productName; ?></p>
                        </button>
                    </div>
                    <div class="logop">
                        <img src="img/koutilab.png" alt="KOUTILAB">
                    </div>
                    <div class="s">
                        <p>Total a pagar</p><br>
                        <p><?php echo $productPrice; ?> MXN</p><br>
                        <div id="paypal-button-container"></div>
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
                                            window.location = "<?php echo PayPalBaseUrl; ?>orderDetails.php?payment_id=" + data.paymentID + "&item_number=<?php echo $productId; ?>" + "&item_name=<?php echo $productName; ?>" + "&payment_amount=<?php echo $productPrice; ?>" + "&payment_currency=<?php echo $currency; ?>" + "&usuarios=<?php echo $usuarios; ?>" + "&clave_alumno=<?php echo $clave_alumno; ?>" + "&clave_docente=<?php echo $clave_docente; ?>" + "&clave_director=<?php echo $clave_director; ?>"; 
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
            <div class="button-box">
                <button type="button" class="toggle-btn">
                    <a href="../paquetes.php" type="button">Regresar a paquetes</a>
                </button>
            </div>
        </div>
    </div>
</body>

</html>