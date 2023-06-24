<?php
session_start();
$id_user = $_SESSION['id_director_preparatoria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_director_preparatoria'])) {
  header('location: ../../acciones/cerrarsesion.php');
}

include('../../acciones/conexion.php');

//Información solo de director
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM directores_preparatoria a JOIN escuelas e ON a.id_escuela = e.id_escuela WHERE id_director = $id_user"));

//Información para director - escuela
$user_escuela = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT e.* FROM directores_preparatoria a
JOIN escuelas e 
ON a.id_escuela = e.id_escuela
WHERE a.id_director = $id_user"));

?>

<!DOCTYPE html>
<html lang="en">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/nav-barra.css">
  <link rel="stylesheet" href="css/docentes.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <title>Document</title>
</head>
<body>

    <!-- Header nav -->
    <?php include 'header-nav.php'; ?>

  <div class="containers">
    <h1>DOCENTES</h1>  
  </div>

  <div class="studens-add-bar">
    <div class="left-student">
        <i class="fas fa-users"></i><h2>Docentes(s)</h2>
    </div>

    <div class="right-student">
        <i class="fas fa-user-plus"></i><h2>Añadir docente</h2>
    </div>
  </div>

 <section>

    
    
  </section>

</body>
</html>