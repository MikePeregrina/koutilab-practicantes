<?php

$conexion = mysqli_connect('localhost', 'root', '', 'aerobotp_KoutiLab');
if (!$conexion){
    die("Connection failed: " . mysqli_connect_error());
}

$query = "INSERT INTO score (score) VALUES ('" . $_POST['score'] . "')";
$query_run = mysqli_query($conexion, $query);
if(!$query_run){
    header('location:index.php');
    exit();
}

?>