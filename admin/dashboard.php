<?php
session_start();
$id_user = $_SESSION['id_admin'];
if (empty($_SESSION['active']) || empty($_SESSION['id_admin'])) {
  header('location: ../acciones/cerrarsesion.php');
}
include('../acciones/conexion.php');
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM admin WHERE id_admin = $id_user"));

?>
<!-- Escuelas a agregar -->
<!-- Koutilab piloto -->
<!-- Koutilab -->
<!-- Grupo Aerobot -->
<!-- INNER JOIN ALUMNO Y DOCENTE -->
<!--  -->

<!DOCTYPE html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KOUTILAB</title>
  <link rel="shortcut icon" href="img/lgk.png">
  <link rel="stylesheet" href="css/dashboard.css" />
  <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div id="sidemenu" class="menu-collapsed">
    <div id="header">
      <div id="title"><img src="img/koutilab3.png" alt="" /></div>
      <div id="menu-btn">
        <div class="btn-hamburger"></div>
        <div class="btn-hamburger"></div>
        <div class="btn-hamburger"></div>
      </div>
    </div>
    <div class="item separator"></div>
    <?php
    $id = $user["id_admin"];
    $name = $user["nombre"];
    $image = $user["image"];
    $username = $user["usuario"];
    ?>
    <div id="profile">
      <div id="photo"><img src="acciones/img/<?php echo $image; ?>" title="<?php echo $image; ?>"></div>
      <div id="name"><span><?php echo $name; ?></span></div>
    </div>

    <div id="menu-items">
      <div class="item separator"></div>
      <div class="item" style="background-color: rgba(61,172,244, .4);">
        <a href="dashboard.php" class="">
          <div class="icon">
            <i class="fas fa-chart-line"></i>
          </div>
          <div class="title">
            <span>Dashboard</span>
          </div>
        </a>
      </div>
      <div class="item separator"></div>
      <div class="item">
        <a href="estadisticas.php" class="">
          <div class="icon">
            <i class="fas fa-chart-pie"></i>
          </div>
          <div class="title">
            <span>Estadísticas</span>
          </div>
        </a>
      </div>
      <div class="item separator"></div>
      <div class="item">
        <a href="ingresos.php" class="">
          <div class="icon">
            <i class="fas fa-money-check-alt"></i>
          </div>
          <div class="title">
            <span>Ingresos</span>
          </div>
        </a>
      </div>
      <div class="item separator"></div>
      <div class="item">
        <a href="administradores.php" class="">
          <div class="icon">
            <i class="fas fa-user-shield"></i>
          </div>
          <div class="title">
            <span>Agregar administrador</span>
          </div>
        </a>
      </div>
      <div class="item separator"></div>
      <div class="item">
        <a href="escuelas.php" class="">
          <div class="icon">
            <i class='fa-solid fa-school'></i>
          </div>
          <div class="title">
            <span>Escuelas</span>
          </div>
        </a>
      </div>
      <div class="item separator"></div>
      <div class="item">
        <a href="preregistros.php" class="">
          <div class="icon">
            <i class='fa-solid fa-clipboard'></i>
          </div>
          <div class="title">
            <span>Pre-registros</span>
          </div>
        </a>
      </div>
      <div class="item separator"></div>
      <div class="item">
        <a href="bandeja.php" class="">
          <div class="icon">
            <i class='fas fa-envelope'></i>
          </div>
          <div class="title">
            <span>Bandeja</span>
          </div>
        </a>
      </div>
      <div class="item separator"></div>
    </div>
  </div>
  <div id="interface">
    <div class="navigation">
      <div class="n1" style="margin-left: 460px;">
        <img src="img/koutilab0.png">
      </div>
      <div class="perfil">
        <a href="../acciones/cerrarsesion.php"><i class="fa fa-sign-out"></i></a>
      </div>
    </div>
  </div>
  <div class="values ms-5 mt-3 pe-1">
    <h3 class="i-name">Dashboard</h3>
  </div>

  <div class="body">
    <div class="latd" style="width: 33%; margin-left: 77px; margin-right: 40px">
      <div class="dos1">
        <div class="titlec" style="margin-left: 60px;">
          <h4 class="i-name">Datos de usuario</h4>
        </div>
        <ul class="lista-datos">
          <li><b>Foto de perfil:</b> </li>
          <li>
            <form class="form" id="form" action="" enctype="multipart/form-data" method="post">
              <div class="upload">
                <?php
                $id = $user["id_admin"];
                $name = $user["nombre"];
                $image = $user["image"];
                $pais = $user["pais"];
                ?>
                <div id="photo"><img style="width: 180px; height: 180px; border-radius: 50%; margin-top:10px; margin-left:30%;  object-fit: cover;" src="acciones/img/<?php echo $image; ?>" title="<?php echo $image; ?>"></div>
                <div class="round" style="margin-right: 150px; margin-bottom: 395px; scale: 90%;">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <input type="hidden" name="name" value="<?php echo $name; ?>">
                  <input type="file" name="image" id="image" class="" accept=".jpg, .jpeg, .png">
                  <i class="fa fa-camera" style="color: rgba(61, 172, 244);"></i>
                </div>
              </div>
            </form>
          </li>
          <hr style="width: auto">
          <li><b>Nombre:</b> <?php echo $name; ?></li><br>
          <li><b>Usuario:</b> <?php echo $username ?></li><br>
          <li><b>País:</b> <?php echo $pais ?></li><br>
          <hr style="width: auto">
          <li><b>Contraseña:</b> </li><br>
          <li>
            <form enctype="multipart/form-data" action="" method="post">
              <div class="user-details1">
                <div class="input-box1" style="width: auto; scale: 80%; margin-top:-20px; margin-left: -25px;">
                  <input type="text" name="contrasena" value="" placeholder="Nueva contraseña">
                  <input type="submit" name="enviarcontrasena" value="Actualizar" class="btn-grd" style="scale: 80%; width: 60%;">
                </div>
              </div>
            </form>

          </li>


        </ul>
      </div>
    </div>
    <div class="latd">
      <div class="titlec">
        <h4 class="i-name">Escuelas</h4>

      </div>
      <div class="card" style="scale: 80%; margin-bottom: 0px">
        <a href="#">
          <div><i class="fas fa-money-check-alt fa-6x"></i></div>
          <h2>Acceso 1</h2>
        </a>
      </div>
      <div class="card" style="scale: 80%; margin-bottom: 0px">
        <a href="#">
          <div><i class="fas fa-chalkboard fa-6x"></i></div>
          <h2>Acceso 2</h2>
        </a>
      </div>
      <div class="card" style="scale: 80%; margin-bottom: 0px">
        <a href="#">
          <div><i class="fas fa-chart-pie fa-6x"></i></div>
          <h2>Acceso 3</h2>
        </a>
      </div>
      <div class="card" style="scale: 80%; margin-bottom: 0px">
        <a href="#">
          <div><i class="fas fa-project-diagram fa-6x"></i></div>
          <h2>Acceso 4</h2>
        </a>
      </div>
    </div>
  </div>

  <dialog close id="modalA" style="background-image: url(img/bg1.png); border-radius: 20px; border: 2px solid #f1f2f3;">
    <div>
      <button style="float: right; background: white; width: 8%; scale: 70%;" class="btn-b" id="btn-cerrar-modalA"><i class="fas fa-close"></i></button>
      <br>
      <video width="520" height="250" controls>
        <source src="" type="video/mp4">
      </video>
    </div>
  </dialog>

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
    $idadmin = $_SESSION['id_admin'];
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