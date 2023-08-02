<?php
$servername = "localhost";
$database = "aerobotp_pruebas";
$username = "root";
$password = "";
// Create connection
$conexion = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conexion) {
  echo ("La conexion fallo: " . mysqli_connect_error());
}
