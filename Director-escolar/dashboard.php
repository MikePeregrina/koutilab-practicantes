

<!DOCTYPE html>
<html lang="en">
<>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/nav-barra.css">
  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <title>Document</title>
</head>
<body>

    <!-- Header nav -->
    <?php include 'header-nav.php'; ?>

  <div class="containers">
    <h1>DASHBOARD</h1>  
  </div>

 <section>
    <div class="left-content">
        <div class="titlec">
          <h2>Usuario</h2>
        </div>
        <br>

        <div class="subtitle-perfil">
          <h3>Foto de Perfil</h3>
        </div>
      
        <div class="perfil-usuario-avatar">
            <div class="avatar-img">
              <img src="R.jpg" alt="Imagen de perfil">
            </div>

            <div class="camera-icon">
              <i class="fa fa-camera" style="color: rgba(0,201,255,2556); font-size:25px;"></i>
            </div>
        </div>

        <hr style="background-color: lightgray; width:60%; height:2px; margin-left:20%; margin-top:4%">

        <div class="container-info">
          <h3 class="info-heading">Nombre: <span>Nombre ejemplo</span></h3>
          <br>
          <h3 class="info-heading">Usuario: <span>Nombre ejemplo</span></h3>
          <br>
          <h3 class="info-heading">Escuela: <span>Nombre ejemplo</span></h3>
          <br>
          <h3 class="info-heading">CCT: <span>ABVS23</span></h3>
        </div>
      
    </div>

    <div class="right-content">
      <div class="titlec">
        <h2>Datos de compras</h2>
      </div>
    </div>
  </section>


  <?php include 'footer.php'; ?>
  
</body>
</html>