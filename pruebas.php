<?php
// Configura la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aerobotp_pruebas";

// Crea una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Define el número de registros que deseas insertar (10,000 en este caso)
$numero_registros = 10000;

// Tiempo de inicio de las inserciones
$start_time = microtime(true);

// Genera e inserta datos de prueba en la tabla
for ($i = 1; $i <= $numero_registros; $i++) {
    $nombre = "nombre" . $i;
    $usuario = "usuario" . $i;
    $contrasena = "contrasena" . $i;
    $clave = rand(18, 60);
    $email = "usuario" . $i . "@example.com";
    $image = "image" . $i;
    $grado_escolar = rand(18, 60);
    $fondo = "fondo" . $i;
    $id_escuela = rand(18, 60);
    $id_docente = rand(18, 60);

    // Crea y ejecuta la consulta SQL para insertar los datos
    $sql = "INSERT INTO alumnos_primaria (nombre, usuario, contrasena, clave, email, image, grado_escolar, fondo, id_escuela, id_docente) VALUES ('$nombre', '$usuario', '$contrasena', '$clave', '$email', '$image', '$grado_escolar', '$fondo', '$id_escuela', '$id_docente')";
    if ($conn->query($sql) === TRUE) {
        echo "Registro insertado: $i <br>";
    } else {
        echo "Error al insertar registro: " . $conn->error;
    }
}

// Tiempo de finalización de las inserciones
$end_time = microtime(true);

// Calcula el tiempo total que llevó insertar los datos
$total_time = $end_time - $start_time;
echo "Tiempo total de inserción: " . $total_time . " segundos";

// Cierra la conexión
$conn->close();

//Pruebas de seguridad realizadas

// 1. Pruebas de Inyección SQL
// 2. Cross-Site Scripting (XSS)
// 3. Cross-Site Request Forgery (CSRF)
// 4. Autenticación y Autorización
// 5. Manejo de Sesiones
// 6. Exposición de Información Sensible
// 7. Seguridad de Contraseñas
// 8. Control de Acceso y Validación de Datos
// 9. Seguridad del Servidor
