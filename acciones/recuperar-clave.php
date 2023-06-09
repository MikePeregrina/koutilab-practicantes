<?php
include('conexion.php');

//Generando clave aleatoria
$logitudPass = 4;
$miPassword  = substr(md5(microtime()), 1, $logitudPass);
$clave1 = $miPassword;
$clave       = md5($miPassword);

$correo             = trim($_REQUEST['email']);

//Verificar a que tipo de rol pertenece el corrreo

$consulta1           = ("SELECT * FROM alumnos_primaria WHERE email ='" . $correo . "'");
$queryconsulta1      = mysqli_query($conexion, $consulta1);
$cantidadConsulta1   = mysqli_num_rows($queryconsulta1);
$dataConsulta1       = mysqli_fetch_array($queryconsulta1);

$consulta2          = ("SELECT * FROM docentes_primaria WHERE email ='" . $correo . "'");
$queryconsulta2      = mysqli_query($conexion, $consulta2);
$cantidadConsulta2   = mysqli_num_rows($queryconsulta2);
$dataConsulta2       = mysqli_fetch_array($queryconsulta2);

$consulta3          = ("SELECT * FROM directores_primaria WHERE email ='" . $correo . "'");
$queryconsulta3      = mysqli_query($conexion, $consulta3);
$cantidadConsulta3   = mysqli_num_rows($queryconsulta3);
$dataConsulta3       = mysqli_fetch_array($queryconsulta3);

$consulta4           = ("SELECT * FROM alumnos_secundaria WHERE email ='" . $correo . "'");
$queryconsulta4      = mysqli_query($conexion, $consulta4);
$cantidadConsulta4   = mysqli_num_rows($queryconsulta4);
$dataConsulta4       = mysqli_fetch_array($queryconsulta4);

$consulta5          = ("SELECT * FROM docentes_secundaria WHERE email ='" . $correo . "'");
$queryconsulta5      = mysqli_query($conexion, $consulta5);
$cantidadConsulta5   = mysqli_num_rows($queryconsulta5);
$dataConsulta5       = mysqli_fetch_array($queryconsulta5);

$consulta6          = ("SELECT * FROM directores_secundaria WHERE email ='" . $correo . "'");
$queryconsulta6      = mysqli_query($conexion, $consulta6);
$cantidadConsulta6   = mysqli_num_rows($queryconsulta6);
$dataConsulta6       = mysqli_fetch_array($queryconsulta6);

$consulta7           = ("SELECT * FROM alumnos_preparatoria WHERE email ='" . $correo . "'");
$queryconsulta7      = mysqli_query($conexion, $consulta7);
$cantidadConsulta7   = mysqli_num_rows($queryconsulta7);
$dataConsulta7       = mysqli_fetch_array($queryconsulta7);

$consulta8          = ("SELECT * FROM docentes_preparatoria WHERE email ='" . $correo . "'");
$queryconsulta8      = mysqli_query($conexion, $consulta8);
$cantidadConsulta8   = mysqli_num_rows($queryconsulta8);
$dataConsulta8       = mysqli_fetch_array($queryconsulta8);

$consulta9          = ("SELECT * FROM directores_preparatoria WHERE email ='" . $correo . "'");
$queryconsulta9      = mysqli_query($conexion, $consulta9);
$cantidadConsulta9   = mysqli_num_rows($queryconsulta9);
$dataConsulta9       = mysqli_fetch_array($queryconsulta9);

$consulta10           = ("SELECT * FROM alumnos_universidad WHERE email ='" . $correo . "'");
$queryconsulta10      = mysqli_query($conexion, $consulta10);
$cantidadConsulta10   = mysqli_num_rows($queryconsulta10);
$dataConsulta10       = mysqli_fetch_array($queryconsulta10);

$consulta11          = ("SELECT * FROM docentes_universidad WHERE email ='" . $correo . "'");
$queryconsulta11      = mysqli_query($conexion, $consulta11);
$cantidadConsulta11   = mysqli_num_rows($queryconsulta11);
$dataConsulta11       = mysqli_fetch_array($queryconsulta11);

$consulta12          = ("SELECT * FROM directores_universidad WHERE email ='" . $correo . "'");
$queryconsulta12      = mysqli_query($conexion, $consulta12);
$cantidadConsulta12   = mysqli_num_rows($queryconsulta12);
$dataConsulta2       = mysqli_fetch_array($queryconsulta12);

$consulta13          = ("SELECT * FROM alumnos_personal WHERE email ='" . $correo . "'");
$queryconsulta13      = mysqli_query($conexion, $consulta13);
$cantidadConsulta13   = mysqli_num_rows($queryconsulta13);
$dataConsulta13       = mysqli_fetch_array($queryconsulta13);

if ($cantidadConsulta1) {
    if ($cantidadConsulta1 == 0) {
        header("Location:../login.php");
        exit();
    } else {
        $updateClave1    = ("UPDATE alumnos_primaria SET contrasena='$clave' WHERE email='" . $correo . "' ");
        $queryResult    = mysqli_query($conexion, $updateClave1);

        $destinatario = $correo;
        $asunto       = "Recuperación de clave";
        $cuerpo = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <title>Recuperar clave de usuario</title>';
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
                    <h2 style="color: #84c42c; margin: 0 0 7px; text-align: center;">¡Hola ' . $dataConsulta1['nombre'] . '!</h2>
                    <p style="margin: 2px; font-size: 20px">El equipo de desarrollo de Koutilab te ha creado una nueva clave 
						temporal para que puedas iniciar sesión, la clave temporal es: <strong>' . $clave1 . '</strong> y tu usuario 
						es: <strong> ' . $dataConsulta1['usuario'] . '</strong> No olvides cambiar tu contraseña nuevamente una 
						vez que inicies sesión. <br><br> Por si lo llegas a ocupar, tu clave de acceso 
						es: <strong> ' . $dataConsulta1['clave'] . '</strong>
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

        header("Location: ../login.php");
        exit();
    }
} elseif ($cantidadConsulta2) {
    if ($cantidadConsulta2 == 0) {
        header("Location: ../login.php");
        exit();
    } else {
        $updateClave2    = ("UPDATE docentes_primaria SET contrasena='$clave' WHERE email='" . $correo . "' ");
        $queryResult    = mysqli_query($conexion, $updateClave2);

        $destinatario = $correo;
        $asunto       = "Recuperación de clave";
        $cuerpo = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <title>Recuperar clave de usuario</title>';
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
                    <h2 style="color: #84c42c; margin: 0 0 7px; text-align: center;">¡Hola ' . $dataConsulta2['nombre'] . '!</h2>
                    <p style="margin: 2px; font-size: 20px">El equipo de desarrollo de Koutilab te ha creado una nueva clave 
						temporal para que puedas iniciar sesión, la clave temporal es: <strong>' . $clave1 . '</strong> y tu usuario 
						es: <strong> ' . $dataConsulta2['usuario'] . '</strong> No olvides cambiar tu contraseña nuevamente una 
						vez que inicies sesión. <br><br> Por si lo llegas a ocupar, tu clave de acceso 
						es: <strong> ' . $dataConsulta2['clave'] . '</strong>
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

        header("Location:../login.php");
        exit();
    }
} elseif ($cantidadConsulta3) {
    if ($cantidadConsulta3 == 0) {
        header("Location: ../login.php");
        exit();
    } else {
        $updateClave3    = ("UPDATE directores_primaria SET contrasena='$clave' WHERE email='" . $correo . "' ");
        $queryResult    = mysqli_query($conexion, $updateClave3);

        $destinatario = $correo;
        $asunto       = "Recuperación de clave";
        $cuerpo = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <title>Recuperar clave de usuario</title>';
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
                    <h2 style="color: #84c42c; margin: 0 0 7px; text-align: center;">¡Hola ' . $dataConsulta3['nombre'] . '!</h2>
                    <p style="margin: 2px; font-size: 20px">El equipo de desarrollo de Koutilab te ha creado una nueva clave 
						temporal para que puedas iniciar sesión, la clave temporal es: <strong>' . $clave1 . '</strong> y tu usuario 
						es: <strong> ' . $dataConsulta3['usuario'] . '</strong> No olvides cambiar tu contraseña nuevamente una 
						vez que inicies sesión. <br><br> Por si lo llegas a ocupar, tu clave de acceso 
						es: <strong> ' . $dataConsulta3['clave'] . '</strong>
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

        header("Location:../login.php");
        exit();
    }
} elseif ($cantidadConsulta4) {
    if ($cantidadConsulta4 == 0) {
        header("Location:../login.php");
        exit();
    } else {
        $updateClave4    = ("UPDATE alumnos_secundaria SET contrasena='$clave' WHERE email='" . $correo . "' ");
        $queryResult    = mysqli_query($conexion, $updateClave4);

        $destinatario = $correo;
        $asunto       = "Recuperación de clave";
        $cuerpo = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <title>Recuperar clave de usuario</title>';
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
                    <h2 style="color: #84c42c; margin: 0 0 7px; text-align: center;">¡Hola ' . $dataConsulta4['nombre'] . '!</h2>
                    <p style="margin: 2px; font-size: 20px">El equipo de desarrollo de Koutilab te ha creado una nueva clave 
						temporal para que puedas iniciar sesión, la clave temporal es: <strong>' . $clave1 . '</strong> y tu usuario 
						es: <strong> ' . $dataConsulta4['usuario'] . '</strong> No olvides cambiar tu contraseña nuevamente una 
						vez que inicies sesión. <br><br> Por si lo llegas a ocupar, tu clave de acceso 
						es: <strong> ' . $dataConsulta4['clave'] . '</strong>
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

        header("Location: ../login.php");
        exit();
    }
} elseif ($cantidadConsulta5) {
    if ($cantidadConsulta5 == 0) {
        header("Location: ../login.php");
        exit();
    } else {
        $updateClave5    = ("UPDATE docentes_secundaria SET contrasena='$clave' WHERE email='" . $correo . "' ");
        $queryResult    = mysqli_query($conexion, $updateClave5);

        $destinatario = $correo;
        $asunto       = "Recuperación de clave";
        $cuerpo = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <title>Recuperar clave de usuario</title>';
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
                    <h2 style="color: #84c42c; margin: 0 0 7px; text-align: center;">¡Hola ' . $dataConsulta5['nombre'] . '!</h2>
                    <p style="margin: 2px; font-size: 20px">El equipo de desarrollo de Koutilab te ha creado una nueva clave 
						temporal para que puedas iniciar sesión, la clave temporal es: <strong>' . $clave1 . '</strong> y tu usuario 
						es: <strong> ' . $dataConsulta5['usuario'] . '</strong> No olvides cambiar tu contraseña nuevamente una 
						vez que inicies sesión. <br><br> Por si lo llegas a ocupar, tu clave de acceso 
						es: <strong> ' . $dataConsulta5['clave'] . '</strong>
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

        header("Location:../login.php");
        exit();
    }
} elseif ($cantidadConsulta6) {
    if ($cantidadConsulta6 == 0) {
        header("Location: ../login.php");
        exit();
    } else {
        $updateClave6    = ("UPDATE directores_secundaria SET contrasena='$clave' WHERE email='" . $correo . "' ");
        $queryResult    = mysqli_query($conexion, $updateClave6);

        $destinatario = $correo;
        $asunto       = "Recuperación de clave";
        $cuerpo = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <title>Recuperar clave de usuario</title>';
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
                    <h2 style="color: #84c42c; margin: 0 0 7px; text-align: center;">¡Hola ' . $dataConsulta6['nombre'] . '!</h2>
                    <p style="margin: 2px; font-size: 20px">El equipo de desarrollo de Koutilab te ha creado una nueva clave 
						temporal para que puedas iniciar sesión, la clave temporal es: <strong>' . $clave1 . '</strong> y tu usuario 
						es: <strong> ' . $dataConsulta6['usuario'] . '</strong> No olvides cambiar tu contraseña nuevamente una 
						vez que inicies sesión. <br><br> Por si lo llegas a ocupar, tu clave de acceso 
						es: <strong> ' . $dataConsulta6['clave'] . '</strong>
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

        header("Location:../login.php");
        exit();
    }
} elseif ($cantidadConsulta7) {
    if ($cantidadConsulta7 == 0) {
        header("Location:../login.php");
        exit();
    } else {
        $updateClave7    = ("UPDATE alumnos_preparatoria SET contrasena='$clave' WHERE email='" . $correo . "' ");
        $queryResult    = mysqli_query($conexion, $updateClave7);

        $destinatario = $correo;
        $asunto       = "Recuperación de clave";
        $cuerpo = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <title>Recuperar clave de usuario</title>';
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
                    <h2 style="color: #84c42c; margin: 0 0 7px; text-align: center;">¡Hola ' . $dataConsulta7['nombre'] . '!</h2>
                    <p style="margin: 2px; font-size: 20px">El equipo de desarrollo de Koutilab te ha creado una nueva clave 
						temporal para que puedas iniciar sesión, la clave temporal es: <strong>' . $clave1 . '</strong> y tu usuario 
						es: <strong> ' . $dataConsulta7['usuario'] . '</strong> No olvides cambiar tu contraseña nuevamente una 
						vez que inicies sesión. <br><br> Por si lo llegas a ocupar, tu clave de acceso 
						es: <strong> ' . $dataConsulta7['clave'] . '</strong>
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

        header("Location: ../login.php");
        exit();
    }
} elseif ($cantidadConsulta8) {
    if ($cantidadConsulta8 == 0) {
        header("Location: ../login.php");
        exit();
    } else {
        $updateClave8    = ("UPDATE docentes_preparatoria SET contrasena='$clave' WHERE email='" . $correo . "' ");
        $queryResult    = mysqli_query($conexion, $updateClave8);

        $destinatario = $correo;
        $asunto       = "Recuperación de clave";
        $cuerpo = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <title>Recuperar clave de usuario</title>';
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
                    <h2 style="color: #84c42c; margin: 0 0 7px; text-align: center;">¡Hola ' . $dataConsulta8['nombre'] . '!</h2>
                    <p style="margin: 2px; font-size: 20px">El equipo de desarrollo de Koutilab te ha creado una nueva clave 
						temporal para que puedas iniciar sesión, la clave temporal es: <strong>' . $clave1 . '</strong> y tu usuario 
						es: <strong> ' . $dataConsulta8['usuario'] . '</strong> No olvides cambiar tu contraseña nuevamente una 
						vez que inicies sesión. <br><br> Por si lo llegas a ocupar, tu clave de acceso 
						es: <strong> ' . $dataConsulta8['clave'] . '</strong>
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

        header("Location:../login.php");
        exit();
    }
} elseif ($cantidadConsulta9) {
    if ($cantidadConsulta9 == 0) {
        header("Location: ../login.php");
        exit();
    } else {
        $updateClave9    = ("UPDATE directores_preparatoria SET contrasena='$clave' WHERE email='" . $correo . "' ");
        $queryResult    = mysqli_query($conexion, $updateClave9);

        $destinatario = $correo;
        $asunto       = "Recuperación de clave";
        $cuerpo = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <title>Recuperar clave de usuario</title>';
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
                    <h2 style="color: #84c42c; margin: 0 0 7px; text-align: center;">¡Hola ' . $dataConsulta9['nombre'] . '!</h2>
                    <p style="margin: 2px; font-size: 20px">El equipo de desarrollo de Koutilab te ha creado una nueva clave 
						temporal para que puedas iniciar sesión, la clave temporal es: <strong>' . $clave1 . '</strong> y tu usuario 
						es: <strong> ' . $dataConsulta9['usuario'] . '</strong> No olvides cambiar tu contraseña nuevamente una 
						vez que inicies sesión. <br><br> Por si lo llegas a ocupar, tu clave de acceso 
						es: <strong> ' . $dataConsulta9['clave'] . '</strong>
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

        header("Location:../login.php");
        exit();
    }
} elseif ($cantidadConsulta10) {
    if ($cantidadConsulta10 == 0) {
        header("Location:../login.php");
        exit();
    } else {
        $updateClave10    = ("UPDATE alumnos_universidad SET contrasena='$clave' WHERE email='" . $correo . "' ");
        $queryResult    = mysqli_query($conexion, $updateClave10);

        $destinatario = $correo;
        $asunto       = "Recuperación de clave";
        $cuerpo = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <title>Recuperar clave de usuario</title>';
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
                    <h2 style="color: #84c42c; margin: 0 0 7px; text-align: center;">¡Hola ' . $dataConsulta10['nombre'] . '!</h2>
                    <p style="margin: 2px; font-size: 20px">El equipo de desarrollo de Koutilab te ha creado una nueva clave 
						temporal para que puedas iniciar sesión, la clave temporal es: <strong>' . $clave1 . '</strong> y tu usuario 
						es: <strong> ' . $dataConsulta10['usuario'] . '</strong> No olvides cambiar tu contraseña nuevamente una 
						vez que inicies sesión. <br><br> Por si lo llegas a ocupar, tu clave de acceso 
						es: <strong> ' . $dataConsulta10['clave'] . '</strong>
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

        header("Location: ../login.php");
        exit();
    }
} elseif ($cantidadConsulta11) {
    if ($cantidadConsulta11 == 0) {
        header("Location: ../login.php");
        exit();
    } else {
        $updateClave11    = ("UPDATE docentes_universidad SET contrasena='$clave' WHERE email='" . $correo . "' ");
        $queryResult    = mysqli_query($conexion, $updateClave11);

        $destinatario = $correo;
        $asunto       = "Recuperación de clave";
        $cuerpo = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <title>Recuperar clave de usuario</title>';
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
                    <h2 style="color: #84c42c; margin: 0 0 7px; text-align: center;">¡Hola ' . $dataConsulta11['nombre'] . '!</h2>
                    <p style="margin: 2px; font-size: 20px">El equipo de desarrollo de Koutilab te ha creado una nueva clave 
						temporal para que puedas iniciar sesión, la clave temporal es: <strong>' . $clave1 . '</strong> y tu usuario 
						es: <strong> ' . $dataConsulta11['usuario'] . '</strong> No olvides cambiar tu contraseña nuevamente una 
						vez que inicies sesión. <br><br> Por si lo llegas a ocupar, tu clave de acceso 
						es: <strong> ' . $dataConsulta11['clave'] . '</strong>
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

        header("Location:../login.php");
        exit();
    }
} elseif ($cantidadConsulta12) {
    if ($cantidadConsulta12 == 0) {
        header("Location: ../login.php");
        exit();
    } else {
        $updateClave12    = ("UPDATE directores_universidad SET contrasena='$clave' WHERE email='" . $correo . "' ");
        $queryResult    = mysqli_query($conexion, $updateClave12);

        $destinatario = $correo;
        $asunto       = "Recuperación de clave";
        $cuerpo = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <title>Recuperar clave de usuario</title>';
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
                    <h2 style="color: #84c42c; margin: 0 0 7px; text-align: center;">¡Hola ' . $dataConsulta12['nombre'] . '!</h2>
                    <p style="margin: 2px; font-size: 20px">El equipo de desarrollo de Koutilab te ha creado una nueva clave 
						temporal para que puedas iniciar sesión, la clave temporal es: <strong>' . $clave1 . '</strong> y tu usuario 
						es: <strong> ' . $dataConsulta12['usuario'] . '</strong> No olvides cambiar tu contraseña nuevamente una 
						vez que inicies sesión. <br><br> Por si lo llegas a ocupar, tu clave de acceso 
						es: <strong> ' . $dataConsulta12['clave'] . '</strong>
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

        header("Location:../login.php");
        exit();
    }
} elseif ($cantidadConsulta13) {
    if ($cantidadConsulta13 == 0) {
        header("Location: ../login.php");
        exit();
    } else {
        $updateClave13    = ("UPDATE alumnos_personal SET contrasena='$clave' WHERE email='" . $correo . "' ");
        $queryResult    = mysqli_query($conexion, $updateClave13);

        $destinatario = $correo;
        $asunto       = "Recuperación de clave";
        $cuerpo = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <title>Recuperar clave de usuario</title>';
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
                    <h2 style="color: #84c42c; margin: 0 0 7px; text-align: center;">¡Hola ' . $dataConsulta13['nombre'] . '!</h2>
                    <p style="margin: 2px; font-size: 20px">El equipo de desarrollo de Koutilab te ha creado una nueva clave 
						temporal para que puedas iniciar sesión, la clave temporal es: <strong>' . $clave1 . '</strong> y tu usuario 
						es: <strong> ' . $dataConsulta13['usuario'] . '</strong> No olvides cambiar tu contraseña nuevamente una 
						vez que inicies sesión.
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

        header("Location:../login.php");
        exit();
    }
}
