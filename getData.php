<?php
// Establece la conexión con la base de datos (debes configurar tus propios datos de conexión)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aerobotp_beta";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener el conteo de alumnos por mes desde múltiples tablas
$sqlAlumnos = "
    SELECT 
        DATE_FORMAT(FROM_UNIXTIME(a.fecha_registro), '%Y-%m') AS mes,
        COUNT(*) AS total_alumnos
    FROM
        (
            SELECT id_alumno, fecha_registro FROM alumnos_primaria
            UNION ALL
            SELECT id_alumno, fecha_registro FROM alumnos_secundaria
            UNION ALL
            SELECT id_alumno, fecha_registro FROM alumnos_preparatoria
            UNION ALL
            SELECT id_alumno, fecha_registro FROM alumnos_universidad
        ) a
    WHERE
        a.fecha_registro BETWEEN '2023-01-01' AND '2023-12-31'
    GROUP BY
        mes
    ORDER BY
        mes
";

// Consulta SQL para obtener el conteo de docentes por mes desde múltiples tablas
$sqlDocentes = "
    SELECT 
        DATE_FORMAT(FROM_UNIXTIME(d.fecha_registro), '%Y-%m') AS mes,
        COUNT(*) AS total_docentes
    FROM
        (
            SELECT id_docente, fecha_registro FROM docentes_primaria
            UNION ALL
            SELECT id_docente, fecha_registro FROM docentes_secundaria
            UNION ALL
            SELECT id_docente, fecha_registro FROM docentes_preparatoria
            UNION ALL
            SELECT id_docente, fecha_registro FROM docentes_universidad
        ) d
    WHERE
        d.fecha_registro BETWEEN '2023-01-01' AND '2023-12-31'
    GROUP BY
        mes
    ORDER BY
        mes
";

// Consulta SQL para obtener el conteo de visitas por mes desde múltiples tablas
$sqlVisitas = "
    SELECT 
        DATE_FORMAT(FROM_UNIXTIME(v.fecha_registro), '%Y-%m') AS mes,
        COUNT(*) AS total_visitas
    FROM
        (
            SELECT id_visita, fecha_registro FROM visitas
            UNION ALL
        ) v
    WHERE
        v.fecha_registro BETWEEN '2023-01-01' AND '2023-12-31'
    GROUP BY
        mes
    ORDER BY
        mes
";

// Consulta SQL para obtener el conteo de cursos por mes desde múltiples tablas
$sqlCursos = "
    SELECT 
        DATE_FORMAT(FROM_UNIXTIME(c.fecha_registro), '%Y-%m') AS mes,
        COUNT(*) AS total_cursos
    FROM
        (
            SELECT id_curso, fecha_registro FROM conexiones_cursos
            UNION ALL
        ) c
    WHERE
        c.fecha_registro BETWEEN '2023-01-01' AND '2023-12-31'
    GROUP BY
        mes
    ORDER BY
        mes
";

// Ejecuta las consultas SQL
$resultAlumnos = $conn->query($sqlAlumnos);
$resultDocentes = $conn->query($sqlDocentes);
$resultVisitas = $conn->query($sqlVisitas);
$resultCursos = $conn->query($sqlCursos);

// Verifica si se obtuvieron resultados para Alumnos, Docentes, Visitas y Cursos
if ($resultAlumnos === false || $resultDocentes === false || $resultVisitas === false || $resultCursos === false) {
    die("Error en una de las consultas: " . $conn->error);
}

// Cierra la conexión a la base de datos
$conn->close();

// Formatea los datos para la respuesta JSON
$data = [
    "Alumnos" => [],
    "Docentes" => [],
    "Visitas" => [],
    "Cursos" => []
];

// Procesa los resultados de Alumnos
while ($row = $resultAlumnos->fetch_assoc()) {
    $data["Alumnos"][] = [
        "mes" => $row["mes"],
        "cantidad" => (int)$row["total_alumnos"]
    ];
}

// Procesa los resultados de Docentes
while ($row = $resultDocentes->fetch_assoc()) {
    $data["Docentes"][] = [
        "mes" => $row["mes"],
        "cantidad" => (int)$row["total_docentes"]
    ];
}

// Procesa los resultados de Visitas
while ($row = $resultVisitas->fetch_assoc()) {
    $data["Visitas"][] = [
        "mes" => $row["mes"],
        "cantidad" => (int)$row["total_visitas"]
    ];
}

// Procesa los resultados de Cursos
while ($row = $resultCursos->fetch_assoc()) {
    $data["Cursos"][] = [
        "mes" => $row["mes"],
        "cantidad" => (int)$row["total_cursos"]
    ];
}

// Devuelve los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data);
