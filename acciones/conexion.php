<?php
$servername = "localhost";
$database = "aerobotbeta";
$username = "root";
$password = "Computadoras3";
// Create connection
$conexion = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conexion) {
  echo ("La conexion fallo: " . mysqli_connect_error());
}
