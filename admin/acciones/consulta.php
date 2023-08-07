<?php
session_start();
$id_user = $_SESSION['id_admin'];
if (empty($_SESSION['active']) || empty($_SESSION['id_admin'])) {
    header('location: ../../acciones/cerrarsesion.php');
}
include('../../acciones/conexion.php');

$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM admin WHERE id_admin = $id_user"));
// Obtenemos el país del resultado de la consulta
$pais_admin = $user['pais'];

// Validación de la conexión de la base de datos
if (mysqli_connect_errno()) {
    echo "Error al conectar a la base de datos: " . mysqli_connect_error();
    exit();
}

// Paso 2: Obtener las direcciones de correo electrónico de múltiples tablas y sus respectivos países
$query = "SELECT email, e.pais AS pais FROM (
          SELECT email, id_escuela FROM alumnos_primaria 
          UNION
          SELECT email, id_escuela FROM alumnos_secundaria 
          UNION
          SELECT email, id_escuela FROM alumnos_preparatoria
          UNION
          SELECT email, id_escuela FROM alumnos_universidad
          UNION
          SELECT email, id_escuela FROM docentes_primaria
          UNION
          SELECT email, id_escuela FROM docentes_secundaria
          UNION
          SELECT email, id_escuela FROM docentes_preparatoria
          UNION
          SELECT email, id_escuela FROM docentes_universidad
          UNION
          SELECT email, id_escuela FROM directores_primaria
          UNION
          SELECT email, id_escuela FROM directores_secundaria
          UNION
          SELECT email, id_escuela FROM directores_preparatoria
          UNION
          SELECT email, id_escuela FROM directores_universidad
          ) as destinatarios_escuelas
          LEFT JOIN escuelas e ON destinatarios_escuelas.id_escuela = e.id_escuela
          WHERE e.pais = '$pais_admin' OR e.pais IS NULL";

$resultado = mysqli_query($conexion, $query);

// Paso 3: Iterar sobre las direcciones de correo electrónico
$destinatarios = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
    $destinatarios[] = $fila['email'];
}

// Paso 4: Enviar correos electrónicos con diseño HTML
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];

foreach ($destinatarios as $destinatario) {
    // Ruta de la imagen del logotipo
    $logo_path = 'https://koutilab.com/img/koutilab.png'; // Reemplaza con la ruta de la imagen de tu logotipo

    // Contenido HTML con el logotipo
    $contenido = '<html>
                    <head>
                        <title>' . $asunto . '</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                background-color: #f9f9f9;
                                color: #333;
                            }
                            .container {
                                padding: 20px;
                                background-color: #fff;
                                border-radius: 5px;
                                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                            }
                            .logo {
                                text-align: center;
                                margin-bottom: 20px;
                            }
                            .logo img {
                                max-width: 200px; /* Ajusta el tamaño de la imagen del logotipo */
                            }
                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <div class="logo">
                                <img src="' . $logo_path . '" alt="Logo"> <!-- Muestra el logotipo -->
                            </div>
                            <h1>' . $asunto . '</h1>
                            <p>' . $mensaje . '</p>
                            <p>Somos una plataforma educativa enfocada en brindar una experiencia de aprendizaje enriquecedora.
                            </p>
                        </div>
                    </body>
                </html>';

    // Encabezados para enviar correos electrónicos en formato HTML
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: koutilab@gmail.com" . "\r\n"; // Reemplaza con la dirección de correo del remitente

    // Enviar el correo electrónico
    mail($destinatario, $asunto, $contenido, $headers);
}

// Cerrar conexión a la base de datos
mysqli_close($conexion);
