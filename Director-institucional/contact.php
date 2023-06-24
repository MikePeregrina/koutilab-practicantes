<!DOCTYPE html>
<html lang="en">
<>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/contact.css">
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
    <h1>CONTACTO</h1>  
  </div>

  <section>
    <div class="titlec">
      <h2>Comentarios y sugerencias</h2>
    </div>
    
    <div class="asunto">
      <input type="text" placeholder="Asunto">
    </div>
  
    <div class="mensaje">
        <textarea placeholder="Mensaje"></textarea>
    </div>
  
    <div class="button">
    <button class="btn-submit" type="submit"><h3>Enviar</h3></button>
    </div>
  </section>
  
  <?php include 'footer.php'; ?>

</body>
</html>
