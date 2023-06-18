<?php
$conexion = mysqli_connect("localhost", "root", "", "aerobotp_beta");


// Validación de la conexión de la base de datos
if (mysqli_connect_errno()) {
    echo "Error al conectar a la base de datos: " . mysqli_connect_error();
    exit();
}


// Paso 2: Obtener las direcciones de correo electrónico de múltiples tablas
$query = "SELECT email FROM alumnos_primaria 
          UNION
          SELECT email FROM alumnos_secundaria 
          UNION
          SELECT email FROM alumnos_preparatoria
          UNION
          SELECT email FROM alumnos_universidad
          UNION
          SELECT email FROM docentes_primaria
          UNION
          SELECT email FROM docentes_secundaria
          UNION
          SELECT email FROM docentes_preparatoria
          UNION
          SELECT email FROM docentes_universidad
          UNION
          SELECT email FROM directores_primaria
          UNION
          SELECT email FROM directores_secundaria
          UNION
          SELECT email FROM directores_preparatoria
          UNION
          SELECT email FROM directores_universidad";
$resultado = mysqli_query($conexion, $query);

// Paso 3: Iterar sobre las direcciones de correo electrónico
$destinatarios = array();
while ($fila = mysqli_fetch_assoc($resultado)){
    $destinatarios[] = $fila['email'];
}



// Paso 4: Enviar correos electrónicos
$asunto =$_POST['asunto'];
$mensaje =$_POST['mensaje'];

foreach  ( $destinatarios as $destinatario){
mail($destinatario, $asunto, $mensaje);
}

// Cerrar conexión a la base de datos
mysqli_close($conexion);
?>