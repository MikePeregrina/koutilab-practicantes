<?php
session_start();
$id_user = $_SESSION['id_director_primaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_director_primaria'])) {
  header('location: ../acciones/cerrarsesion.php');
}
?>
<!DOCTYPE html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KOUTILAB <?php echo $_SESSION['user']; ?></title>
  <link rel="shortcut icon" href="img/lgk.png">
  <link rel="stylesheet" href="css/perfil-director.css" />
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
      <div class="item">
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
      <div class="item" style="background-color: rgba(61,172,244, .4)">
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
      <div class="item">
        <a href="../acciones/cerrarsesion.php" class="">
          <div class="icon">
            <i class="fa fa-sign-out"></i>
          </div>
          <div class="title">
            <span>Cerrar sesión</span>
          </div>
        </a>
      </div>
      <div class="item separator"></div>
    </div>
  </div>
  <section class="seccion-perfil-usuario">
    <div class="perfil-usuario-header">
      <div class="perfil-usuario-portada">
        <div class="perfil-usuario-avatar">
          <img src="img/img2.jpg" alt="img-avatar" />
          <button type="button" class="boton-avatar">
            <i class="far fa-image"></i>
          </button>
        </div>
        <button type="button" class="boton-portada">
          <i class="far fa-image"></i> Cambiar fondo
        </button>
      </div>
    </div>
    <div class="perfil-usuario-body">
      <div class="perfil-usuario-bio">
        <button type="button" class="boton-avatar" id="btn-abrir-modalA">
          <i class="far fa-edit"></i>
        </button>
        <?php
        // $direct = $_SESSION['user'];
        // $data2 = mysqli_query($conexion, "SELECT * FROM Directores WHERE UsuarioD = '$direct'");
        // while ($consulta = mysqli_fetch_array($data2)) {
        //   echo " <h3 class='titulo'>" . $consulta['NombreD'] . "</h3>";
        // }
        ?>
      </div>
      <div class="perfil-usuario-footer">
        <?php
        // $direct = $_SESSION['user'];
        // $data3 = mysqli_query($conexion, "SELECT * FROM Directores WHERE UsuarioD = '$direct'");
        // while ($consulta3 = mysqli_fetch_array($data3)) {
        //   echo "
        //         <ul class='lista-datos'>
        //           <li><i class='icono fas fa-user-tie'></i><b>Usuario:</b> " . $consulta3['UsuarioD'] . "</li>
        //           <li><i class='fa fa-envelope'></i> <b>Correo:</b>  " . $consulta3['CorreoD'] . "</li>
        //           <li><i class='fas fa-user-lock'></i> <b>Contraseña:</b> <input class='form-control' disabled name='password' type='password' value='" . $consulta3['ContrasenaD'] . "' id='password'>

        //                 <button class='btn btn-primary' type='button' onclick='mostrarContrasena()'><i class='fa fa-eye'></i></button>

        //           </li>
        //           <li><i class='fa fa-phone'></i> <b>Telefono:</b> " . $consulta3['NumeroD'] . "</li>
        //         </ul>";
        // }
        ?>
      </div>
    </div><br>

    <div class="perfil-usuario-body">
      <div class="perfil-usuario-bio">
        <h3 class="titulo">Paquete Adquirido</h3>
      </div>
      <div class="perfil-usuario-footer">
        <ul class="lista-datos">
          <li><i class="icono fas fa-school"></i> <b>Paquete:</b> Plus</li>
          <li><i class="icono fas fa-user-tie"></i> <b>Alumnos permitidos:</b> 350</li>
          <li><i class="fas fa-graduation-cap"></i> <b>Profesores permitidos:</b> 20</li>
        </ul>
        <ul class="lista-datos">
          <li><i class="icono fas fa-school"></i><b>Fecha de pago:</b> 10/12/22</li>
          <li><i class="icono fas fa-user-tie"></i> <b>Fecha de adquisición: 05/05/22</b> </li>
          <li><i class="fas fa-graduation-cap"></i> <b>Saldo a favor:</b> 20</li>
        </ul>
      </div>
    </div><br><br>
    <dialog close id="modalA" class="modal-center">
      <div class="container">
        <button style="float: right" class="btn-b" id="btn-cerrar-modalA">
          <i class="fas fa-close"></i>
        </button>
        <div class="new-g">Editar perfil</div>
        <br />
        <form>
          <div class="user-details">
            <div class="input-box">
              <span class="details">Número de alumnos: </span>
              <input type="text" placeholder="Nombre del Alumno" required />
            </div>
            <div class="input-box">
              <span class="details">Número de profesores: </span>
              <input type="text" placeholder="Nombre de la escuela" required />
            </div>
            <div class="input-box">
              <span class="details">Dirección: </span>
              <input type="text" placeholder="Nombre del profesor" required />
            </div>
            <div class="input-box">
              <span class="details">Usuario: </span>
              <input type="text" placeholder="Nombre del Alumno" required />
            </div>
            <div class="input-box">
              <span class="details">Correo: </span>
              <input type="text" placeholder="Usuario del alumno" required />
            </div>
            <div class="input-box">
              <span class="details">Contraseña: </span>
              <input type="password" placeholder="Contraseña del alumno" required />
            </div>
          </div>
          <button class="btn-grd">Guardar</button>
        </form>
      </div>
    </dialog>
  </section>


  <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script>
    function mostrarContrasena() {
      var tipo = document.getElementById("password");
      if (tipo.type == "password") {
        tipo.type = "text";
      } else {
        tipo.type = "password";
      }
    }
  </script>

  <script>
    const btnAbrirModalA = document.querySelector("#btn-abrir-modalA");
    const btnCerrarModalA = document.querySelector("#btn-cerrar-modalA");
    const modalA = document.querySelector("#modalA");
    btnAbrirModalA.addEventListener("click", () => {
      modalA.showModal();
    });

    btnCerrarModalA.addEventListener("click", () => {
      modalA.close();
    });
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