<!DOCTYPE html>
<html lang="en">
<>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/packages.css">
  <link rel="stylesheet" href="css/nav-barra.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <title>Document</title>
</head>
<body>

<!-- Header nav -->
  <?php include 'header-nav.php'; ?>

  <div class="containers">
    <h1>PAQUETES ADQUIRIDOS</h1>  
  </div>

  <div class="studens-add-bar">
    <div class="left-student">
        <i class="fas fa-book"></i><h2>Paquete(s)</h2>
    </div>

    <div class="right-student" id="addCourseButton">
        <i class="fas fa-book-medical"></i><h2>Añadir paquete</h2>
    </div>
</div>

<!-- Contenido de la pantalla emergente -->
<div class="popup-container" id="popupContainer">
    <div class="popup-content">
        <div class="titlec">
            <h2>Adquirir paquete</h2>
        </div>

        <br>
        <div class="search">
            <div class="box">
                <input type="text" placeholder="Buscar paquete">
                <i class="fa-solid fa-magnifying-glass fa-lg"></i>
            </div>
        </div>

        <div class="content-popup">
            <div class="container1">
                <h2>Paquete 1</h2>
                <img src="R.jpg" alt="">
                <button><h3>Adquirir</h3></button>
            </div>

            <div class="container2">
                <h2>Paquete 2</h2>
                <img src="R.jpg" alt="">
                <button><h3>Adquirir</h3></button>
            </div>

            <div class="container3">
                <h2>Paquete 3</h2>
                <img src="R.jpg" alt="">
                <button><h3>Adquirir</h3></button>
            </div>
        </div>

        <button id="closeButton"><i class="fas fa-times"></i></button>

    </div>
</div>

<section>

    
    
</section>

<?php include 'footer.php'; ?>

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
