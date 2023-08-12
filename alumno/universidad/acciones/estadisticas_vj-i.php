<?php
session_start();
$id_user = $_SESSION['id_alumno_universidad'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_universidad'])) {
    header('location: ../../../acciones/cerrarsesion.php');
}

include('../../../acciones/conexion.php');

// Función para actualizar las estrellas
/*function actualizarEstrellas($id_user, $conexion)
{
    // Consulta para obtener el número de conexiones del alumno
    $sql = "SELECT conexiones FROM alumnos_universidad WHERE id_alumno = $id_user";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_conexiones = $row['conexiones'];
        //Verificar estrellas en total_estrellas_universidad
        $sql = mysqli_query($conexion, "SELECT * FROM total_estrellas_universidad WHERE id_alumno = '$id_user'");
        $result_sql = mysqli_num_rows($sql);

        if ($result_sql == 0) {
            $sql =  mysqli_query($conexion, "INSERT INTO total_estrellas_universidad (id_alumno, estrellas) VALUES ($id_user, 1)");
        }

        // Si es múltiplo de 20 o es la primera conexión, insertar una estrella en la tabla total_estrellas_universidad
        if ($total_conexiones % 20 == 0) {
            // Si no es múltiplo de 20, actualizar el campo estrellas en la tabla total_estrellas_universidad
            $sql =  mysqli_query($conexion, "UPDATE total_estrellas_universidad SET estrellas = estrellas + 1 WHERE id_alumno = $id_user");
        } else {
            // Si no es múltiplo de 20, actualizar el campo estrellas en la tabla total_estrellas_universidad
            $sql =  mysqli_query($conexion, "UPDATE total_estrellas_universidad SET estrellas = estrellas + 0 WHERE id_alumno = $id_user");
        }
    }
}


// Verifica si la variable de sesión "actualizacion_realizada" no está definida
if (!isset($_SESSION['actualizacion_realizada'])) {
    // Llama a la función para actualizar las estrellas
    actualizarEstrellas($id_user, $conexion);

    // Establece la variable de sesión "actualizacion_realizada" para indicar que la actualización ya se hizo
    $_SESSION['actualizacion_realizada'] = true;
}
*/
//Verificar si ya se tiene permiso en ruta 1
$permiso_ruta_r1 = "1";
$sql_verificar_r1 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_universidad a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r1'");
$existe_verificar_r1 = mysqli_num_rows($sql_verificar_r1);

//Verificar si ya se tiene permiso en ruta 2
$permiso_ruta_r2 = "2";
$sql_verificar_r2 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_universidad a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r2'");
$existe_verificar_r2 = mysqli_num_rows($sql_verificar_r2);

//Verificar si ya se tiene permiso en ruta 3
$permiso_ruta_r3 = "3";
$sql_verificar_r3 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_universidad a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r3'");
$existe_verificar_r3 = mysqli_num_rows($sql_verificar_r3);

//Verificar si ya se tiene permiso en ruta 4
$permiso_ruta_r4 = "4";
$sql_verificar_r4 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_universidad a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r4'");
$existe_verificar_r4 = mysqli_num_rows($sql_verificar_r4);

//Verificar si ya se tiene permiso en ruta 5
$permiso_ruta_r5 = "5";
$sql_verificar_r5 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_universidad a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r5'");
$existe_verificar_r5 = mysqli_num_rows($sql_verificar_r5);

//Verificar si ya se tiene permiso en ruta 6
$permiso_ruta_r6 = "6";
$sql_verificar_r6 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_universidad a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r6'");
$existe_verificar_r6 = mysqli_num_rows($sql_verificar_r6);

//Verificar si ya se tiene permiso en ruta 7
$permiso_ruta_r7 = "7";
$sql_verificar_r7 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_universidad a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r7'");
$existe_verificar_r7 = mysqli_num_rows($sql_verificar_r7);

//Verificar si ya se tiene permiso en ruta 8
$permiso_ruta_r8 = "8";
$sql_verificar_r8 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_universidad a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r8'");
$existe_verificar_r8 = mysqli_num_rows($sql_verificar_r8);

//Verificar si ya se tiene permiso en ruta 9
$permiso_ruta_r9 = "9";
$sql_verificar_r9 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_universidad a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r9'");
$existe_verificar_r9 = mysqli_num_rows($sql_verificar_r9);

//Verificar si ya se tiene permiso en ruta 10
$permiso_ruta_r10 = "10";
$sql_verificar_r10 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_universidad a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r10'");
$existe_verificar_r10 = mysqli_num_rows($sql_verificar_r10);

//Verificar si ya se tiene permiso en ruta 11
$permiso_ruta_r11 = "11";
$sql_verificar_r11 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_universidad a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r11'");
$existe_verificar_r11 = mysqli_num_rows($sql_verificar_r11);

//Verificar si ya se tiene permiso en ruta 12
$permiso_ruta_r12 = "12";
$sql_verificar_r12 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_universidad a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r12'");
$existe_verificar_r12 = mysqli_num_rows($sql_verificar_r12);

//Estadisticas de todos los cursos del alumno
$consultaEstadistica = mysqli_query($conexion, "SELECT trofeos, SUM(trofeos) AS total_trofeos, progreso, SUM(progreso) AS total_progreso, puntos, SUM(puntos) AS total_puntos, practico, SUM(practico) AS total_practico, teorico, SUM(teorico) AS total_teorico FROM estadisticas_universidad WHERE id_alumno = $id_user AND id_curso = 11"); // Modificando consulta por cada curso
$resultadoEstadistica = mysqli_fetch_assoc($consultaEstadistica);

//Estadisticas programacion web basica
$query_programacion_web_basica = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $id_user AND id_curso = 1");
$data_programacion_web_basica = mysqli_fetch_assoc($query_programacion_web_basica);

//Estadisticas programacion web intermedio
$query_programacion_web_intermedio = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $id_user AND id_curso = 2");
$data_programacion_web_intermedio = mysqli_fetch_assoc($query_programacion_web_intermedio);

//Estadisticas programacion web avanzado
$query_programacion_web_avanzado = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $id_user AND id_curso = 3");
$data_programacion_web_avanzado = mysqli_fetch_assoc($query_programacion_web_avanzado);

//Estadisticas python basico
$query_python_basico = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $id_user AND id_curso = 4");
$data_python_basico = mysqli_fetch_assoc($query_python_basico);

//Estadisticas python intermedio
$query_python_intermedio = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $id_user AND id_curso = 5");
$data_python_intermedio = mysqli_fetch_assoc($query_python_intermedio);

//Estadisticas python avanzado
$query_python_avanzado = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $id_user AND id_curso = 6");
$data_python_avanzado = mysqli_fetch_assoc($query_python_avanzado);

//Estadisticas informatica basico
$query_informatica_basico = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $id_user AND id_curso = 7");
$data_informatica_basico = mysqli_fetch_assoc($query_informatica_basico);

//Estadisticas informatica intermedio
$query_informatica_intermedio = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $id_user AND id_curso = 8");
$data_informatica_intermedio = mysqli_fetch_assoc($query_informatica_intermedio);

//Estadisticas informatica avanzado
$query_informatica_avanzado = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $id_user AND id_curso = 9");
$data_informatica_avanzado = mysqli_fetch_assoc($query_informatica_avanzado);

//Estadisticas videojuegosunity basico
$query_videojuegosunity_basico = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $id_user AND id_curso = 10");
$data_videojuegosunity_basico = mysqli_fetch_assoc($query_videojuegosunity_basico);

//Estadisticas videojuegosunity intermedio
$query_videojuegosunity_intermedio = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $id_user AND id_curso = 11");
$data_videojuegosunity_intermedio = mysqli_fetch_assoc($query_videojuegosunity_intermedio);

//Estadisticas videojuegosunity avanzado
$query_videojuegosunity_avanzado = mysqli_query($conexion, "SELECT * FROM estadisticas_universidad WHERE id_alumno = $id_user AND id_curso = 12");
$data_videojuegosunity_avanzado = mysqli_fetch_assoc($query_videojuegosunity_avanzado);

//Información solo de alumno
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM alumnos_universidad a JOIN escuelas e ON a.id_escuela = e.id_escuela WHERE id_alumno = $id_user"));

//Información para alumno - escuela
$user_escuela = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT e.* FROM alumnos_universidad a
JOIN escuelas e 
ON a.id_escuela = e.id_escuela
WHERE a.id_alumno = $id_user"));

//Información para alumno - docente
$user_docente = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT d.* FROM alumnos_universidad a
JOIN docentes_universidad d 
ON a.id_docente = d.id_docente
WHERE a.id_alumno = $id_user"));

//Conteo de cursos
$sql = "SELECT COUNT(*) id_alumno FROM acceso_cursos_universidad
WHERE id_alumno = $id_user";
$result = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($result);

$sql_verificar_rutas = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_universidad a WHERE a.id_alumno = $id_user");
$existe_verificar_rutas = mysqli_num_rows($sql_verificar_rutas);

//Estadísticas por capsula
//area: teoría, práctica, juego, evaluativa
//tipo de puntos: conocimiento, coding, logros, destreza
//puntos 8 de 10

$datos_por_capsula = array(
    "1" => array(
        "area" => "Teórica",
        "tema" => "Introducción",
        "tipoPuntos" => "Conocimientos"
    ),
    "2" => array(
        "area" => "Teórica",
        "tema" => "Menú de selección de personaje",
        "tipoPuntos" => "Conocimientos"
    ),
    "3" => array(
        "area" => "Práctica",
        "tema" => "Menú de selección de personaje",
        "tipoPuntos" => "Coding"
    ),
    "4" => array(
        "area" => "Juego",
        "tema" => "Menú de selección de personaje",
        "tipoPuntos" => "Logros"
    ),
    "5" => array(
        "area" => "Teórica",
        "tema" => "Menú de opciones",
        "tipoPuntos" => "Conocimientos"
    ),
    "6" => array(
        "area" => "Práctica",
        "tema" => "Menú de opciones",
        "tipoPuntos" => "Coding"
    ),
    "7" => array(
        "area" => "Juego",
        "tema" => "Menú de opciones",
        "tipoPuntos" => "Logros"
    ),
    "8" => array(
        "area" => "Teórica",
        "tema" => "Menú de game over",
        "tipoPuntos" => "Conocimientos"
    ),
    "9" => array(
        "area" => "Práctica",
        "tema" => "Menú de game over",
        "tipoPuntos" => "Coding"
    ),
    "10" => array(
        "area" => "Juego",
        "tema" => "Menú de game over",
        "tipoPuntos" => "Logros"
    ),
    "11" => array(
        "area" => "Teórica",
        "tema" => "Menú de niveles",
        "tipoPuntos" => "Conocimientos"
    ),
    "12" => array(
        "area" => "Práctica",
        "tema" => "Menú de niveles",
        "tipoPuntos" => "Coding"
    ),
    "13" => array(
        "area" => "Juego",
        "tema" => "Menú de niveles",
        "tipoPuntos" => "Logros"
    ),
    "14" => array(
        "area" => "Teórica",
        "tema" => "Puntaje",
        "tipoPuntos" => "Conocimientos"
    ),
    "15" => array(
        "area" => "Práctica",
        "tema" => "Puntaje",
        "tipoPuntos" => "Coding"
    ),
    "16" => array(
        "area" => "Juego",
        "tema" => "Puntaje",
        "tipoPuntos" => "Logros"
    ),
    "17" => array(
        "area" => "Teórica",
        "tema" => "Barra de vida",
        "tipoPuntos" => "Conocimientos"
    ),
    "18" => array(
        "area" => "Práctica",
        "tema" => "Barra de vida",
        "tipoPuntos" => "Coding"
    ),
    "19" => array(
        "area" => "Juego",
        "tema" => "Barra de vida",
        "tipoPuntos" => "Logros"
    ),
    "20" => array(
        "area" => "Teórica",
        "tema" => "Disparos y botones",
        "tipoPuntos" => "Conocimientos"
    ),
    "21" => array(
        "area" => "Práctica",
        "tema" => "Disparos y botones",
        "tipoPuntos" => "Coding"
    ),
    "22" => array(
        "area" => "Juego",
        "tema" => "Disparos y botones",
        "tipoPuntos" => "Logros"
    ),
    "23" => array(
        "area" => "Teórica",
        "tema" => "Vista elevada",
        "tipoPuntos" => "Conocimientos"
    ),
    "24" => array(
        "area" => "Práctica",
        "tema" => "Vista elevada",
        "tipoPuntos" => "Coding"
    ),
    "25" => array(
        "area" => "Juego",
        "tema" => "Vista elevada",
        "tipoPuntos" => "Logros"
    ),
    "26" => array(
        "area" => "Evaluativa",
        "tema" => "Opciones Unity",
        "tipoPuntos" => "Destreza"
    ),
    "27" => array(
        "area" => "Teórica",
        "tema" => "Crear nivels(Tilemaps)",
        "tipoPuntos" => "Conocimientos"
    ),
    "28" => array(
        "area" => "Práctica",
        "tema" => "Crear nivels(Tilemaps)",
        "tipoPuntos" => "Coding"
    ),
    "29" => array(
        "area" => "Juego",
        "tema" => "Crear nivels(Tilemaps)",
        "tipoPuntos" => "Logros"
    ),
    "30" => array(
        "area" => "Teórica",
        "tema" => "Juego infinito",
        "tipoPuntos" => "Conocimientos"
    ),
    "31" => array(
        "area" => "Práctica",
        "tema" => "Juego infinito",
        "tipoPuntos" => "Coding"
    ),
    "32" => array(
        "area" => "Juego",
        "tema" => "Juego infinito",
        "tipoPuntos" => "Logros"
    ),
    "33" => array(
        "area" => "Teórica",
        "tema" => "Siguiente nivel",
        "tipoPuntos" => "Conocimientos"
    ),
    "34" => array(
        "area" => "Práctica",
        "tema" => "Siguiente nivel",
        "tipoPuntos" => "Coding"
    ),
    "35" => array(
        "area" => "Juego",
        "tema" => "Siguiente nivel",
        "tipoPuntos" => "Logros"
    ),
    "36" => array(
        "area" => "Teórica",
        "tema" => "Crear enemigos",
        "tipoPuntos" => "Conocimientos"
    ),
    "37" => array(
        "area" => "Práctica",
        "tema" => "Crear enemigos",
        "tipoPuntos" => "Coding"
    ),
    "38" => array(
        "area" => "Juego",
        "tema" => "Crear enemigos",
        "tipoPuntos" => "Logros"
    ),
    "39" => array(
        "area" => "Teórica",
        "tema" => "Temporizador",
        "tipoPuntos" => "Conocimientos"
    ),
    "40" => array(
        "area" => "Práctica",
        "tema" => "Temporizador",
        "tipoPuntos" => "Coding"
    ),
    "41" => array(
        "area" => "Juego",
        "tema" => "Temporizador",
        "tipoPuntos" => "Logros"
    ),
    "42" => array(
        "area" => "Teórica",
        "tema" => "Luces",
        "tipoPuntos" => "Conocimientos"
    ),
    "43" => array(
        "area" => "Práctica",
        "tema" => "Luces",
        "tipoPuntos" => "Coding"
    ),
    "44" => array(
        "area" => "Juego",
        "tema" => "Luces",
        "tipoPuntos" => "Logros"
    ),
    "45" => array(
        "area" => "Teórica",
        "tema" => "Retroceso",
        "tipoPuntos" => "Conocimientos"
    ),
    "46" => array(
        "area" => "Práctica",
        "tema" => "Retroceso",
        "tipoPuntos" => "Coding"
    ),
    "47" => array(
        "area" => "Juego",
        "tema" => "Retroceso",
        "tipoPuntos" => "Logros"
    ),
    "48" => array(
        "area" => "Teórica",
        "tema" => "Parallax(Fondo con animación)",
        "tipoPuntos" => "Conocimientos"
    ),
    "49" => array(
        "area" => "Práctica",
        "tema" => "Parallax(Fondo con animación)",
        "tipoPuntos" => "Coding"
    ),
    "50" => array(
        "area" => "Juego",
        "tema" => "Parallax(Fondo con animación)",
        "tipoPuntos" => "Logros"
    ),
    "51" => array(
        "area" => "Evaluativa",
        "tema" => "Niveles Unity",
        "tipoPuntos" => "Destreza"
    ),
);



// Array que contiene los puntos correspondientes a cada ruta desbloqueada.
$puntos_por_ruta = array(
    /*"1" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "2" => array(
        "trofeos" => 210,
        "teoricos" => 210,
        "practicos" => 210,
        "evaluativos" => 30
    ),
    "3" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "4" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "5" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "6" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "7" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "8" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "9" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "10" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),*/
    "11" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    )/*,
    "12" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    )*/

);

// Conjunto para llevar un registro de las rutas desbloqueadas ya procesadas.
$rutas_procesadas = array();

// Variables para almacenar los puntos totales de cada tipo.
$total_trofeos = 0;
$total_puntos_teoricos = 0;
$total_puntos_practicos = 0;
$total_puntos_evaluativos = 0;

if ($existe_verificar_rutas > 0) {
    // Si el usuario tiene desbloqueada al menos una ruta, sumar los puntos de todas las rutas desbloqueadas.
    while ($ruta = mysqli_fetch_assoc($sql_verificar_rutas)) {
        $ruta_desbloqueada = $ruta['id_curso'];
        if (isset($puntos_por_ruta[$ruta_desbloqueada]) && !isset($rutas_procesadas[$ruta_desbloqueada])) {
            $total_trofeos += $puntos_por_ruta[$ruta_desbloqueada]["trofeos"];
            $total_puntos_teoricos += $puntos_por_ruta[$ruta_desbloqueada]["teoricos"];
            $total_puntos_practicos += $puntos_por_ruta[$ruta_desbloqueada]["practicos"];
            $total_puntos_evaluativos += $puntos_por_ruta[$ruta_desbloqueada]["evaluativos"];
            $rutas_procesadas[$ruta_desbloqueada] = true;
        }
    }
}

// Ahora, las variables $total_trofeos, $total_puntos_teoricos, $total_puntos_practicos y $total_puntos_evaluativos contienen los totales de puntos máximos que el usuario puede obtener sin repetir rutas desbloqueadas y por cada tipo de punto.
$totalTrofeos = $total_trofeos;
$totalPuntaje = $total_puntos_evaluativos;
$totalPractico = $total_puntos_practicos;
$totalTeorico = $total_puntos_teoricos;



// Consulta para obtener la cantidad de estrellas para el alumno específico
$sql_estrellas = "SELECT estrellas FROM total_estrellas_universidad WHERE id_alumno = $id_user";
$result_estrellas = $conexion->query($sql_estrellas);

if ($result_estrellas->num_rows > 0) {
    $row = $result_estrellas->fetch_assoc();
    $cantidad_estrellas = $row['estrellas'];
}

?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png">
    <link rel="stylesheet" href="../css/estadisticas_ruta.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">

</head>

<body>


    <div class="containers">
        <a href="../perfil.php"><button class="btn-b"><i class="fas fa-reply fa-lg"></i></button></a>
        <h1>CURSO DE VIDEOJUEGOS UNITY INTERMEDIO DE KOUTILAB</h1>
    </div>

    <section>
        <div class="left-content">
            <div class="estadisticas">
                <div class="titlec">
                    <h2>Estadisticas</h2>
                </div>

                <div class="canva">
                    <canvas id="myChart1"></canvas>
                </div>
            </div>

            <div class="details">
                <ul class="lista-datos">
                    <li><i class="fas fa-award"></i> &nbsp;<b>Conocimientos:</b> <?php echo $resultadoEstadistica["teorico"] ?> de <?php echo $totalTeorico ?> </li><br>
                    <li><i class='fas fa-chart-line'></i></i> &nbsp;<b>Coding:</b> <?php echo $resultadoEstadistica["practico"] ?> de <?php echo $totalPractico ?> </li><br>
                    <li><i class='fab fa-joomla'></i></i>&nbsp; <b>Logros:</b> <?php echo $resultadoEstadistica["trofeos"] ?> de <?php echo $totalTrofeos ?> </li><br>
                    <li><i class='fas fa-file-alt'></i></i> &nbsp;<b>Destreza:</b> <?php echo $resultadoEstadistica["puntos"] ?> de <?php echo $totalPuntaje ?> </li> <br>
                    <li><i class='fas fa-star'></i></i> &nbsp;<b>Estrellas:</b> <?php echo $cantidad_estrellas ?> </li>

                    <!--<li><i class="fas fa-award"></i> &nbsp;<b>Conocimientos:</b> de </li><br>
                    <li><i class='fas fa-chart-line'></i></i> &nbsp;<b>Coding:</b> de </li><br>
                    <li><i class='fab fa-joomla'></i></i>&nbsp; <b>Logros:</b> de </li><br>
                    <li><i class='fas fa-file-alt'></i></i> &nbsp;<b>Destreza:</b> de </li> <br>
                    <li><i class='fas fa-star'></i></i> &nbsp;<b>Estrellas:</b> </li>-->
                </ul>
            </div>
        </div>

        <div class="right-content">
            <div class="board p-2">
                <table id="alumnos" width="100%" class="table border-top" style="z-index: 1;">
                    <thead>
                        <tr>
                            <td><b>Capsula</b></td>
                            <td><b>Área</b></td>
                            <td><b>Tema</b></td>
                            <td><b>Tipo de puntos</b></td>
                            <td><b>Puntos obtenidos</b></td>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        //include "../acciones/conexion.php";

                        $query_alumnos = mysqli_query($conexion, "SELECT *FROM detalle_estadisticas_universidad
                    WHERE id_curso = 11");
                        $result = mysqli_num_rows($query_alumnos);
                        if ($result > 0) {
                            while ($data = mysqli_fetch_assoc($query_alumnos)) {
                                //Asociar con el arreglo de temario
                                $id_capsula = $data['id_capsula'];
                                $capsula_data = $datos_por_capsula[$id_capsula];
                                $area = $capsula_data["area"];
                                $tema = $capsula_data["tema"];
                                $tipoPuntos = $capsula_data["tipoPuntos"];
                                $puntos = 0;

                                if($area == "Teórica"){
                                    $puntos = $data['teorico'];
                                }else if($area == "Práctica"){
                                    $puntos = $data['practico'];
                                }else if($area == "Juego"){
                                    $puntos = $data['trofeos'];
                                }else if($area == "Evaluativa"){
                                    $puntos = $data['puntos'];
                                }
                        ?>
                                <tr>
                                    <td><?php echo $data['id_capsula']; ?></td>
                                    <td><?php echo $area; ?></td>
                                    <td><?php echo $tema; ?></td>
                                    <td><?php echo $tipoPuntos; ?></td>
                                    <td><?php echo $puntos; ?> de 10</td>
                                </tr>
                        <?php }
                        } ?>

                    </tbody>
                </table>
            </div>
        </div>

    </section>

    <footer class="footerimga">
        <div class="imagen-footer">
            <img src="../img/benvenida.png" alt="No-image">
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx1 = document.getElementById('myChart1');
        new Chart(ctx1, {
            type: 'radar',
            data: {
                labels: ['Conocimientos', 'Coding', 'Logros', 'Destreza'],
                datasets: [{
                    label: 'Estadísticas',
                    data: [<?php echo $resultadoEstadistica["teorico"] ?>, <?php echo $resultadoEstadistica["practico"] ?>, <?php echo $resultadoEstadistica["trofeos"] ?>, <?php echo $resultadoEstadistica["puntos"] ?>],
                    fill: true,
                    borderWidth: 1
                }]
            },
        });
    </script>


    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bulma.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bulma.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            $('#alumnos').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/es-MX.json'
                }
            });
        });
    </script>
    </script>

</body>