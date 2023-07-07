<?php
session_start();
$id_user = $_SESSION['id_admin'];
if (empty($_SESSION['active']) || empty($_SESSION['id_admin'])) {
  header('location: ../acciones/cerrarsesion.php');
}
include('../acciones/conexion.php');

$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM admin WHERE id_admin = $id_user"));

$sql = "SELECT COUNT(*) id_admin FROM admin";
$result = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KOUTILAB</title>
  <link rel="shortcut icon" href="img/lgk.png">
  <link rel="stylesheet" href="css/nav-barra.css">
  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <div class="subtitle-perfil">
      <h3></h3>
    </div>


    <form class="form" id="form" action="" enctype="multipart/form-data" method="post">
      <div class="perfil-usuario-avatar">

        <div class="avatar-img">
          <img src="acciones/img/<?php echo $image; ?>" title="<?php echo $image; ?>">
        </div>

        <div class="camera-icon">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="hidden" name="name" value="<?php echo $name; ?>">
          <input type="file" style="cursor: pointer;" name="image" id="image" class="" accept=".jpg, .jpeg, .png">
          <i class="fa fa-camera" style="color: rgba(0,201,255,2556); font-size:25px;"></i>
        </div>
    </form>
  </div>

  <hr style="background-color: lightgray; width:60%; height:2px; margin-left:20%; margin-top:4%">

  <div class="container-info">
    <h3>Nombre:<span><?php echo $name; ?></span></h3>
    <br>
    <h3>Usuario:<span><?php echo $username ?></span></h3>
    <br>
    <h3>Pais:<span><?php echo $pais ?></span></h3>
  </div>

  <hr class="hr2" style="background-color: lightgray; width:60%; height:2px; margin-left:20%; margin-top:-48%;">

  <div class="change-password">
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

    <div class="latd" style="scale:100%;justify-content: center; align-items: center;">

      <canvas id="myChart" width="30px !important" height="30px !important"></canvas>
    </div>
  
</section>


<?php include 'footer.php'; ?>


<script>
    const btnAbrirModalA = document.querySelector("#btn-abrir-modalA");
    const btnCerrarModalA = document.querySelector("#btn-cerrar-modalA");
    const modalA = document.querySelector("#modalA");
    btnAbrirModalA.addEventListener("click", () => {
      modalA.showModal();
    })

    btnCerrarModalA.addEventListener("click", () => {
      modalA.close();
    })
  </script>

  <dialog close id="modalC">
    <div class="container1">
      <button style="float: right;" class="btn-b" id="btn-cerrar-modalC"><i class="fas fa-close"></i></button>
      <?php
      if (isset($_POST['enviar'])) {
        $id = $_POST['id_admin'];
        $name = $_POST['nombre'];
        $contrasena = $_POST['contrasena'];

        $sql = "UPDATE admin SET contrasena='" . $contrasena . "'";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
          echo "<script languaje='JavaScript'>
                    alert('Se actulizaron los datos');
                    location.assing('docente/perfil.php');
                  </script>";
        } else {
          echo "<script languaje='JavaScript'>
                  </script>";
        }
      } else {
        $id = $user["id_admin"];
        $name = $user["nombre"];
        $contrasena = $user["contrasena"];


      ?>
        <form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
          <h2>Cambiar contraseña</h2>
          <div class="user-details1">

            <input type="hidden" name="id_admin" value="<?php echo $id ?>">
            <input type="hidden" name="name" value="<?php echo $name ?>">
            <div class="input-box1" style="width: 100%;">
              <input type="text" name="contrasena" value="" placeholder="Nueva contraseña">
            </div>
            <input type="submit" name="enviar" value="ACTUALIZAR" class="btn-grd">
        </form>
      <?php
      }
      ?>
    </div>
  </dialog>

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
    const btn = document.querySelector("#menu-btn");
    const menu = document.querySelector("#sidemenu");
    btn.addEventListener("click", (e) => {
      menu.classList.toggle("menu-expanded");
      menu.classList.toggle("menu-collapsed");


      document.querySelector("body").classList.toggle("body-expanded");
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Primaria', 'Secundaria', 'Preparatoria', 'Bachillerato'],
        datasets: [{
          label: '# de estudiantes',
          data: [12, 19, 3, 5],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
  </script>
  <script>
    function disableIE() {
      if (document.all) {
        return false;
      }
    }

    function disableNS(e) {
      if (document.layers || (document.getElementById && !document.all)) {
        if (e.which == 2 || e.which == 3) {
          return false;
        }
      }
    }
    if (document.layers) {
      document.captureEvents(Event.MOUSEDOWN);
      document.onmousedown = disableNS;
    } else {
      document.onmouseup = disableNS;
      document.oncontextmenu = disableIE;
    }
    document.oncontextmenu = new Function("return false");
  </script>
  <script>
    onkeydown = e => {
      let tecla = e.which || e.keyCode;

      // Evaluar si se ha presionado la tecla Ctrl:
      if (e.ctrlKey) {
        // Evitar el comportamiento por defecto del nevagador:
        e.preventDefault();
        e.stopPropagation();

        // Mostrar el resultado de la combinación de las teclas:
        if (tecla === 85)
          console.log("Ha presionado las teclas Ctrl + U");

        if (tecla === 83)
          console.log("Ha presionado las teclas Ctrl + S");
      }
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
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
      $query = "UPDATE admin SET image = '$newImageName' WHERE id_admin = $id";
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
  if (isset($_POST['enviarcontrasena'])) {
    $idadmin = $_SESSION['id_admin_secundario'];
    $contrasena = md5($_POST['contrasena']);

    $sql_update = mysqli_query($conexion, "UPDATE admin SET contrasena = '$contrasena' WHERE id_admin = '$idadmin'");

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