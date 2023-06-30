<?php
//ProPayPal es vital para declarar si es demo o prueba las transacciones

//define('ProPayPal', 0); // El cero simboliza entorno de Prueba
//define('ProPayPal', 1); // El 1 simboliza entorno de producción

session_start();
$id_user = $_SESSION['id_alumno_personal'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_personal'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../acciones/conexion.php";
//../../../../../../../../acciones/conexion.php
define('ProPayPal', 0);
if (ProPayPal) {
    define("PayPalClientId", "*********************");
    define("PayPalSecret", "*********************");
    define("PayPalBaseUrl", "https://koutilab.com/alumno/personal/");
    define("PayPalENV", "production");
} else {
    define("PayPalClientId", "Ae1Oau6-P8S9_nG7DK0q7u74hRYNkPSZnKSWDgBLuTIbk-mblCFjgCOxJVKW5Uf6uiYOran_5vnLu28a");
    define("PayPalSecret", "EAOYI052iYSGGT2592LeeXNvDbCq9tArRGqgWRVCAxQwf55u-wHx3VVxePzGD2j-9F29mEcbXL12mPFR");
    define("PayPalBaseUrl", "http://localhost/koutilab-practicantes/alumno/personal/");
    define("PayPalENV", "sandbox");
}
$currency = "USD";
$productPrice = 2;
$id_curso = 1;
$id_capsula = 1;
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="pagos-cursos.css">
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
                            <p>Pago curso programacion web básico</p>
                        </button>
                    </div>
                    <div class="logop">
                        <img src="img/koutilab.png" alt="KOUTILAB">
                    </div>
                    <div class="s">
                        <p>Total a pagar</p><br>
                        <p>2 USD</p><br>
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
                                            window.location = "<?php echo PayPalBaseUrl; ?>orderDetails.php?id_alumno=<?php echo $id_user; ?>" + "&id_curso=<?php echo $id_curso; ?>";
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
                    <a href="perfil.php" return false;" type="button">Regresar a perfil</a>
                </button>
            </div>
        </div>
    </div>
</body>

</html>