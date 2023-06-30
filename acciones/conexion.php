<?php
$servername = "localhost";
$database = "aerobotp_beta";
$username = "root";
$password = "tiburon2014";
// Create connection
$conexion = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conexion) {
  echo ("La conexion fallo: " . mysqli_connect_error());
}
