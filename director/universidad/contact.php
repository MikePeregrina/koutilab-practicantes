<?php
session_start();
$id_user = $_SESSION['id_director_universidad'];
if (empty($_SESSION['active']) || empty($_SESSION['id_director_universidad'])) {
  header('location: ../../acciones/cerrarsesion.php');
}

include('../../acciones/conexion.php');

//Información solo de director
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM directores_universidad a JOIN escuelas e ON a.id_escuela = e.id_escuela WHERE id_director = $id_user"));

//Información para director - escuela
$user_escuela = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT e.* FROM directores_universidad a
JOIN escuelas e 
ON a.id_escuela = e.id_escuela
WHERE a.id_director = $id_user"));

?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/contact.css">
<link rel="stylesheet" href="css/nav-barra.css">
<link rel="stylesheet" href="css/footer.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>KOUTILAB</title>
</head>

<body>

  <!-- Header nav -->
  <?php include 'header-nav.php'; ?>

  <div class="containers">
    <h1>CONTACTO</h1>
  </div>
  <form enctype="multipart/form-data" action="" method="post">

    <section>

      <div class="titlec">
        <h2>Comentarios y sugerencias</h2>
      </div>

      <div class="asunto">
        <input type="text" placeholder="Asunto" name="asunto" required>
      </div>

      <div class="mensaje">
        <textarea placeholder="Mensaje" name="mensaje" required></textarea>
      </div>

      <div class="button">
        <!--<input type="submit" value="Enviar">-->
        <button class="btn-submit" type="submit" name="enviarsugerencia">
          <h3>Enviar</h3>
        </button>
      </div>

    </section>
  </form>

  <?php include 'footer.php'; ?>
  
  <?php
  if (isset($_POST['enviarsugerencia'])) {
    $data2 = mysqli_query($conexion, "SELECT * FROM directores_universidad d INNER JOIN escuelas e WHERE d.id_escuela = e.id_escuela AND id_director = '$id_user'");
    while ($consulta = mysqli_fetch_array($data2)) {
      $nombre_escuela = $consulta['nombre_escuela'];
    }
    $nombre_usuario = $_SESSION['nombre'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    $sql = "INSERT INTO sugerencias (nombre_escuela,nombre_usuario,asunto,mensaje,estado) VALUES (?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conexion, $sql)) {
      mysqli_stmt_bind_param($stmt, "sssss", $param_escuela, $param_usuario, $param_asunto, $param_mensaje, $param_estado);

      $param_escuela = $nombre_escuela;
      $param_usuario = $nombre_usuario;
      $param_asunto = $asunto;
      $param_mensaje = $mensaje;
      $param_estado = 1;

      if (mysqli_stmt_execute($stmt)) {
        echo
        "
                      <script>
                      Swal.fire({
                          title: '¡Excelente!',
                          text: 'La sugerencia se ha enviado correctamente.',
                          icon: 'success',
                          confirmButtonColor: '#3085d6',
                          confirmButtonText: 'Aceptar',
                        }).then((result) => {
                          if (result.isConfirmed) {
                              window.location.href = 'contact.php';
                          }
                        });
                      </script>
                        ";
      } else {
        "
                      <script>
                      Swal.fire({
                          title: '¡Error inesperado!',
                          text: 'Inténtelo de nuevo más tarde.',
                          icon: 'info',
                          confirmButtonColor: '#3085d6',
                          confirmButtonText: 'Reintentar',
                        }).then((result) => {
                          if (result.isConfirmed) {
                              window.location.href = 'contact.php';
                          }
                        });
                      </script>
                        ";
      }
    }
  }
  ?>

</body>

</html>