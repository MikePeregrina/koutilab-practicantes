<?php
session_start();
$id_user = $_SESSION['id_director_secundaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_director_secundaria'])) {
  header('location: ../../acciones/cerrarsesion.php');
}

include('../../acciones/conexion.php');

//Información solo de director
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM directores_secundaria a JOIN escuelas e ON a.id_escuela = e.id_escuela WHERE id_director = $id_user"));

//Información para director - escuela
$user_escuela = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT e.* FROM directores_secundaria a
JOIN escuelas e 
ON a.id_escuela = e.id_escuela
WHERE a.id_director = $id_user"));

?>

<!DOCTYPE html>
<html lang="en">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/cursos.css">
  <link rel="stylesheet" href="css/nav-barra.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <title>Document</title>
</head>
<body>

    <!-- Header nav -->
    <?php include 'header-nav.php'; ?>

  <div class="containers">
    <h1>CURSOS</h1>  
  </div>

  <div class="studens-add-bar">
    <div class="left-student">
        <i class="fas fa-book"></i><h2>Curso(s)</h2>
    </div>

    <div class="right-student" id="addCourseButton">
        <i class="fas fa-book-medical"></i><h2>Añadir curso</h2>
    </div>
</div>

<!-- Contenido de la pantalla emergente -->
<div class="popup-container" id="popupContainer">
    <div class="popup-content">
        <div class="titlec">
            <h2>Adquirir curso</h2>
        </div>
        <br>
        <div class="search">
            <div class="category"><h4>Todos</h4></div>
            <div class="category"><h4>Programaciòn</h4></div>
            <div class="category"><h4>Arduino</h4></div>
            <div class="category"><h4>Bàsico</h4></div>
            <div class="category"><h4>Intermedio</h4></div>
            <div class="category"><h4>Avanzado</h4></div>

            <div class="box">
                <input type="text" placeholder="Search">
                <i class="fa-solid fa-magnifying-glass fa-lg"></i>
            </div>
        </div>

        <div class="content-popup">
            <div class="container1">
                <h2>Programacion Web Basico</h2>
                <img src="R.jpg" alt="">
                <button><h3>Adquirir</h3></button>
            </div>

            <div class="container2">
                <h2>Programacion Web Intermedio</h2>
                <img src="R.jpg" alt="">
                <button><h3>Adquirir</h3></button>
            </div>

            <div class="container3">
                <h2>Programacion Web Avanzado</h2>
                <img src="R.jpg" alt="">
                <button><h3>Adquirir</h3></button>
            </div>
        </div>

        <button id="closeButton"><i class="fas fa-times"></i></button>
       
    </div>
</div>

<section>

    
    
</section>
<script></script>
<script>
    const addCourseButton = document.getElementById('addCourseButton');
    const popupContainer = document.getElementById('popupContainer');
    const closeButton = document.getElementById('closeButton');

    addCourseButton.addEventListener('click', function() {
        popupContainer.style.display = 'block';
    });

    closeButton.addEventListener('click', function() {
        popupContainer.style.display = 'none';
    });

    popupContainer.addEventListener('click', function(event) {
        if (event.target === popupContainer) {
            popupContainer.style.display = 'none';
        }
    });
</script>

</body>
</html>
