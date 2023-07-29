<?php
session_start();
$id_user = $_SESSION['id_director'];
if (empty($_SESSION['active']) || empty($_SESSION['id_director'])) {
  header('location: ../acciones/cerrarsesion.php');
}
include('../acciones/conexion.php');
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM director_institucional d
JOIN escuelas e 
ON d.id_escuela = e.id_escuela
WHERE d.id_director = $id_user"));
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

    <section>
      <div class="titlec">
        <h2>Comentarios y sugerencias</h2>
      </div>

      <form id="contacto" method="POST" enctype="multipart/form-data" action="">
        <div class="asunto">
          <input type="text" placeholder="Asunto" name="asunto" required>
        </div>

        <div class="mensaje">
          <input type="hidden" name="nombre_escuela" placeholder="Nombre de la escuela" value="<?php echo $user['nombre_escuela'] ;?>">
          <input type="hidden" name="nombre_usuario" placeholder="Nombre" value="<?php echo $user['nombre'] ?>">
          <textarea placeholder="Mensaje" name="mensaje" required></textarea>
        </div>
        <div class="button">
        <button class="btn-submit" type="submit" name="enviarcontacto">
          <h3>Enviar</h3>
        </button>
      </div>

      </form>


    </section>
    <?php include 'footer.php'; ?>
  </body>
  <?php
  if (isset($_POST['enviarcontacto'])) {
    //Datos contacto
    $nombre_escuela = $_POST['nombre_escuela'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];
    $insertar_contacto = mysqli_query($conexion, "INSERT INTO sugerencias(nombre_escuela, nombre_usuario, asunto, mensaje, estado) VALUES ('$nombre_escuela', '$nombre_usuario', '$asunto', '$mensaje', 1)");

    if ($insertar_contacto) {
      echo
      "
      <script>
      Swal.fire({
          title: 'Excelente!',
          text: 'Sugerencia enviada',
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
      echo
      "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: 'Tu sugerencia no fue enviada',
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
  ?>

  <script>
    const btnAbrirModalV = document.querySelector("#btn-abrir-modalV");
    const btnCerrarModalV = document.querySelector("#btn-cerrar-modalV");
    const modalV = document.querySelector("#modalV");
    btnAbrirModalV.addEventListener("click", () => {
      modalV.showModal();
    })

    btnCerrarModalV.addEventListener("click", () => {
      modalV.close();
    })
  </script>

  <script>
    const btnAbrirModalC = document.querySelector("#btn-abrir-modalC");
    const btnCerrarModalC = document.querySelector("#btn-cerrar-modalC");
    const modalC = document.querySelector("#modalC");
    btnAbrirModalC.addEventListener("click", () => {
      modalC.showModal();
    })

    btnCerrarModalC.addEventListener("click", () => {
      modalC.close();
    })
  </script>


  <script>
    const btn = document.querySelector('#menu-btn');
    const menu = document.querySelector('#sidemenu');
    btn.addEventListener('click', e => {
      menu.classList.toggle("menu-expanded");
      menu.classList.toggle("menu-collapsed");

      document.querySelector('body').classList.toggle('body-expanded');
    });
  </script>

</html>