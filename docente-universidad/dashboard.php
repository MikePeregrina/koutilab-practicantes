<?php
session_start();
$id_user = $_SESSION['id_docente_universidad'];
if (empty($_SESSION['active']) || empty($_SESSION['id_docente_universidad'])) {
  header('location: ../acciones/cerrarsesion.php');
}

include('../acciones/conexion.php');
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM docentes_universidad d
JOIN escuelas e 
ON d.id_escuela = e.id_escuela
WHERE d.id_docente = $id_user"));
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/nav-barra.css">
<link rel="stylesheet" href="css/dashboard.css">
<link rel="stylesheet" href="css/footer.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<title>KOUTILAB</title>
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
      </div><br>

      <form class="form" id="form" action="" enctype="multipart/form-data" method="post">
        <div class="perfil-usuario-avatar">

          <div class="avatar-img">
            <img src="acciones/img/<?php echo $image; ?>" title="<?php echo $image; ?>">
          </div>

          <div class="camera-icon">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="file" style="cursor: pointer;" name="image" id="image" class="" accept=".jpg, .jpeg, .png">
            <i class="fa fa-camera" style="color: white; font-size:30px;"></i>
          </div>
      </form>
    </div>

    <hr style="background-color: lightgray; width:60%; height:2px; margin-left:20%; margin-top:4%">

    <div class="container-info">
      <h3>Nombre: <span><?php echo $name ?></span></h3>
      <br>
      <h3>Usuario: <span><?php echo $username ?></span></h3>
      <br>
      <h3>Escuela: <span><?php echo $user["nombre_escuela"] ?></span></h3>
      <br>
      <h3>CCT: <span><?php echo $user["cct"] ?></span></h3>
      <br>
      <h3>Nivel educativo: <span><?php echo $user["nivel_educativo"] ?></span></h3>
    </div>

    <hr class="hr2" style="background-color: lightgray; width:60%; height:2px; margin-left:20%; margin-top:-48%;">

    <div class="change-password">
      <h3>Cambiar nombre:</h3>
      <form enctype="multipart/form-data" action="" method="post">
        <div class="user-details1">
          <div class="input-box1">
            <input type="text" name="nombredocente" value="" placeholder="Nuevo nombre">
            <input type="submit" name="enviarnombre" value="Actualizar" class="btn-grd">
          </div>
        </div>
      </form>

      <h3>Contraseña:</h3>
      <form enctype="multipart/form-data" action="" method="post">
        <div class="user-details1">
          <div class="input-box1">
            <input type="text" name="contrasena" value="" placeholder="Nueva contraseña">
            <input type="submit" name="enviarcontrasena" value="Actualizar" class="btn-grd">
          </div>
        </div>
      </form>
    </div>
    </div>

    <div class="right-content">
      <div class="titlec">
        <h2>Cursos</h2>
      </div>

      <div class="card" style="margin-bottom: 0px; width: 40%; height: 40%; padding: 7%;">
        <a href="../acciones/pdf/temario-pwb.pdf" target="_blank">
          <div><i class="fab fa-html5 fa-6x"></i></div>
          <h2>Programación web básico</h2>
        </a>
      </div>

      <div class="card" style="margin-bottom: 0px; width: 40%; height: 40%; padding: 7%;">
        <a href="../acciones/pdf/temario-pwi.pdf" target="_blank">
          <div><i class="fab fa-html5 fa-6x"></i></div>
          <h2>Programación web intermedio</h2>
        </a>
      </div>

    </div>

  </section>


  <?php include 'footer.php'; ?>


  <!-- Biblioteca Swal para pantalla emergente que jale -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Cambiar foto de perfil -->
  <script type="text/javascript">
    document.getElementById("image").onchange = function() {
      document.getElementById("form").submit();
    };
  </script>
  <?php
  if (isset($_FILES["image"]["name"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];

    $imageName = $_FILES["image"]["name"];
    $imageSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    // Image validation
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $imageName);
    $imageExtension = strtolower(end($imageExtension));
    if (!in_array($imageExtension, $validImageExtension)) {
      echo
      "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: 'Extensión de imágen invalida',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'dashboard.php';
          }
        });
      </script>
        ";
    } elseif ($imageSize > 1200000) {
      echo
      "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: 'Tamaño de imágen demasiado larga',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'dashboard.php';
            window.location.reload();
          }
        });
        
      </script>
        ";
    } else {
      $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
      $newImageName .= '.' . $imageExtension;
      $query = "UPDATE docentes_universidad SET image = '$newImageName' WHERE id_docente = $id";
      mysqli_query($conexion, $query);
      move_uploaded_file($tmpName, 'acciones/img/' . $newImageName);
      echo
      "
      <script>
      Swal.fire({
          title: 'Excelente!',
          text: 'Cambio de imágen exitoso',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'dashboard.php';
          }
        });
      </script>
        ";
    }
  }
  ?>

  <?php
  if (isset($_POST['enviarnombre'])) {
    $iddocente = $_SESSION['id_docente_universidad'];
    $nombre = $_POST['nombredocente'];

    $sql_update = mysqli_query($conexion, "UPDATE docentes_universidad SET nombre = '$nombre' WHERE id_docente = '$iddocente'");

    if ($sql_update) {
      echo
      "
      <script>
      Swal.fire({
          title: 'Excelente!',
          text: 'Cambio de nombre exitoso',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'dashboard.php';
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
          text: 'Cambio de nombre no exitoso',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'dashboard.php';
          }
        });
      </script>
        ";
    }
  }
  ?>

  <?php
  if (isset($_POST['enviarcontrasena'])) {
    $iddocente = $_SESSION['id_docente_universidad'];
    $contrasena = md5($_POST['contrasena']);

    $sql_update = mysqli_query($conexion, "UPDATE docentes_universidad SET contrasena = '$contrasena' WHERE id_docente = '$iddocente'");

    if ($sql_update) {
      echo
      "
      <script>
      Swal.fire({
          title: 'Excelente!',
          text: 'Cambio de contraseña exitosa',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'dashboard.php';
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
          text: 'Cambio de contraseña no exitosa',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'dashboard.php';
          }
        });
      </script>
        ";
    }
  }
  ?>

</body>

</html>