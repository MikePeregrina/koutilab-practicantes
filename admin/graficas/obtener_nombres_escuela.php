<?php

include('../../acciones/conexion.php');

$inputValue = $_POST["input"]; // Valor ingresado por el usuario

// Realiza una consulta para buscar nombres de escuelas que coincidan con el valor ingresado
$query = "SELECT nombre_escuela FROM escuelas WHERE nombre_escuela LIKE ?";
$stmt = $conexion->prepare($query);
$inputValue = '%' . $inputValue . '%';
$stmt->bind_param("s", $inputValue);
$stmt->execute();
$result = $stmt->get_result();

$nombresEscuela = array();
while ($row = $result->fetch_assoc()) {
    $nombresEscuela[] = $row["nombre_escuela"];
}

// Devuelve los nombres de las escuelas como JSON
echo json_encode($nombresEscuela);

// Cierra la conexión a la base de datos
$stmt->close();
$conexion->close();
