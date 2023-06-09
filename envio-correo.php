<?php

$destinatario = $email_registrar;
$asunto       = "Registro exitoso";
$cuerpo = '
                    <!DOCTYPE html>
                    <html lang="es">
                    <head>
                    <title>Registro exitoso</title>';
$cuerpo .= ' 
                <style>
                    * {
                        margin: 0;
                        padding: 0;
                        box-sizing: border-box;
                    }
                    body {
                        font-family: "Roboto", sans-serif;
                        font-size: 16px;
                        font-weight: 300;
                        color: #888;
                        line-height: 30px;
                        text-align: center;
                    }
                    .contenedor{
                        width: 80%;
                        min-height:auto;
                        text-align: center;
                        margin: 0 auto;
                        background: rgba(129, 178, 243, 0.2);
                        border: 3px solid #84c42c;
                    }
                    .misection{
                        color: #34495e;
                        margin: 4% 10% 2%;
                        text-align: justify;
                        font-family: sans-serif;
                    }
                </style>
                ';

$cuerpo .= '
                </head>
                <body>
                    <div class="contenedor">
                    <table style="max-width: 600px; padding: 10px; margin: 0 auto; border-collapse: collapse;">
                    <tr>
                        <td style="background-color: #ffffff;">
                            <div class="misection">
                                <img src="https://koutilab.com/img/koutilab.png" alt="koutilab" style="position: absolute; width: 100px; margin: -10px 0 0 420px;">
                                <br>
                                <h2 style="color: #84c42c; margin: 0 0 7px; text-align: center;">¡Hola ' . $nombre_registrar . '!</h2>
                                <p style="margin: 2px; font-size: 20px">El equipo de desarrollo de Koutilab te da la bienvenida a la plataforma. Tu 
                                    nombre de usuario es <strong>' . $usuario_registrar . '</strong> y tu contraseña es <strong> ' . $contrasena_correo . '</strong>. Inicia sesión en la plataforma para empezar a 
                                    disfrutar de los servicios. <br><br> <strong> https://koutilab.com/login.php </strong>
                                </p>
                                <p>&nbsp;</p>
                            </div>
                        </td>
                    </tr>
                    </table>';

$cuerpo .= '
                    </div>
                </body>
                </html>';

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: Koutilab\r\n";
$headers .= "Reply-To: ";
$headers .= "Return-path:";
$headers .= "Cc:";
$headers .= "Bcc:";
(mail($destinatario, $asunto, $cuerpo, $headers));
