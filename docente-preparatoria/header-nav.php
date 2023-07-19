<?php 
$id = $user["id_docente"];
$name = $user["nombre"];
$image = $user["image"];
$username = $user["usuario"];
?>
<nav class="navbar-header">
  <ul>
    <li>
      <a href="" class="logo">
        <img src="acciones/img/<?php echo $image; ?>" title="<?php echo $image; ?>">
        <span class="nav-item">KOUTILAB</span>
      </a>
    </li>
    <li<?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? ' class="active"' : ''; ?>>
      <a href="dashboard.php">
        <i class="fas fa-user"></i>
        <span class="nav-item">Dashboard</span>
      </a>
    </li>
    <li<?php echo (basename($_SERVER['PHP_SELF']) == 'grupos.php') ? ' class="active"' : ''; ?>>
      <a href="grupos.php">
        <i class="fas fa-users-viewfinder" ></i>
        <span class="nav-item">Grupos</span>
      </a>
    </li>
    <li<?php echo (basename($_SERVER['PHP_SELF']) == 'alumnos.php') ? ' class="active"' : ''; ?>>
      <a href="alumnos.php">
        <i class="fas fa-users"></i>
        <span class="nav-item">Alumnos</span>
      </a>
    </li>
    <li<?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? ' class="active"' : ''; ?>>
      <a href="contact.php">
        <i class="fas fa-address-book"></i>
        <span class="nav-item">Contacto</span>
      </a>
    </li>
    <li<?php echo (basename($_SERVER['PHP_SELF']) == 'help.php') ? ' class="active"' : ''; ?>>
      <a  id="btn-abrir-modalV">
        <i class="fas fa-question-circle"></i>
        <span class="nav-item">Help</span>
      </a>
    </li>
    <li class="li-ultimo" <?php echo (basename($_SERVER['PHP_SELF']) == 'logout.php') ? ' class="active"' : ''; ?>>
      <a href="../acciones/cerrarsesion.php" class="logout">
        <i class="fas fa-sign-out-alt"></i>
        <span class="nav-item2" style="margin-left: 2.5%; margin-top:2%;">Salir</span>
      </a>
    </li>
  </ul>
</nav>


<dialog close id="modalV" style="border-radius: 20px; border: 2px solid #f1f2f3; width: 50%; height:64%; margin-left:25%; margin-top:7%">
        <div >
            <button style="float: right; background: white; padding-left: 10px; padding-right: 9px; scale: 100%; border-radius: 50%; outline: none; border: 0px; margin-bottom: 5px;" class="" id="btn-cerrar-modalV"><i class="fas fa-close"></i></button>
            <br>
            <video width="100%" height="100%" controls>
                <source src="vid/Video explicativo_2.mp4" type="video/mp4">
            </video>
        </div>
    </dialog>