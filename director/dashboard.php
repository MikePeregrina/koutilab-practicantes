<?php
// session_start();
// $id_user = $_SESSION['id_director_primaria'];
// if (empty($_SESSION['active']) || empty($_SESSION['id_director_primaria'])) {
//   header('location: ../acciones/cerrarsesion.php');
// }
?>
<!DOCTYPE html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KOUTILAB <?php echo $_SESSION['user']; ?></title>
  <link rel="shortcut icon" href="img/lgk.png">
  <link rel="stylesheet" href="css/dashboard.css" />
  <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
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

    <div id="profile">
      <div id="photo"><img src="img/img2.jpg" alt="" /></div>
      <?php
      // $direct = $_SESSION['user'];
      // $data2 = mysqli_query($conexion, "SELECT * FROM Directores WHERE UsuarioD = '$direct'");
      // while ($consulta = mysqli_fetch_array($data2)) {
      //   echo " <div id='name'><span>" . $consulta['NombreD'] . "</span></div>";
      // }
      ?>
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
        <a href="nueva-escuela.php" class="">
          <div class="icon">
            <i class="fa fa-institution"></i>
          </div>
          <div class="title">
            <span>Mi Escuela</span>
          </div>
        </a>
      </div>
      <div class="item separator"></div>
      <div class="item">
        <a href="contacto.php" class="">
          <div class="icon">
            <i class="fas fa-envelope"></i>
          </div>
          <div class="title">
            <span>Contacto</span>
          </div>
        </a>
      </div>
      <div class="item separator"></div>
      <div class="item">
        <a href="perfil.php" class="">
          <div class="icon">
            <i class="fas fa-user-edit"></i>
          </div>
          <div class="title">
            <span>Perfil</span>
          </div>
        </a>
      </div>
      <div class="item separator"></div>
    </div>
  </div>
  <div id="interface">
    <div class="navigation">
      <div class="n1">
        <div class="search">
          <i class="fas fa-search"></i>
          <input type="text" placeholder="Buscar" />
        </div>
      </div>
      <div class="perfil">
        <img src="img/koutilab0.png">
        <i class="fas fa-bell"></i>
        <a href="../acciones/cerrarsesion.php"><i class="fa fa-sign-out"></i></a>
      </div>
    </div>
  </div>
  <div class="values">
    <h3 class="i-name">Dashboard</h3>
  </div>
  <div class="values">
    <div class="val-box">
      <i class="fas fa-users"></i>
      <div>
        <h3>3050<span> Alumnos</span></h3>
      </div>
    </div>
    <div class="val-box">
      <i class="fas fa-users"></i>
      <div>
        <h3>150<span> Profesores</span></h3>
      </div>
    </div>
  </div>

  <div class="values">
    <div class="val-box">
      <canvas id="myChart1"></canvas>
    </div>
    <div class="val-box">
      <canvas id="myChart2"></canvas>
    </div>
  </div><br><br>

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
    const ctx1 = document.getElementById('myChart1');

    new Chart(ctx1, {
      type: 'line',
      data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
        datasets: [{
          label: '# de alumnos',
          data: [520, 850, 1500, 2400, 2900, 3050],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
  <script>
    const ctx2 = document.getElementById('myChart2');

    new Chart(ctx2, {
      type: 'line',
      data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
        datasets: [{
          label: '# de profesores',
          data: [22, 39, 45, 65, 100, 150],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
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
</body>