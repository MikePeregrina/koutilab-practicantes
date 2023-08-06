<?php
$id = $user["id_admin"];
$name = $user["nombre"];
$image = $user["image"];
$username = $user["usuario"];
$pais = $user["pais"];
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
      <li<?php echo (basename($_SERVER['PHP_SELF']) == 'escuela.php') ? ' class="active"' : ''; ?>>
        <a href="escuelas.php">
          <i class="fas fa-school"></i>
          <span class="nav-item">Escuelas</span>
        </a>
        </li>
        <li<?php echo (basename($_SERVER['PHP_SELF']) == 'bandeja.php') ? ' class="active"' : ''; ?>>
          <a href="bandeja.php">
            <i class="fas fa-envelope"></i>
            <span class="nav-item">Bandeja entrada</span>
          </a>
          </li>
          <li<?php echo (basename($_SERVER['PHP_SELF']) == 'pre-registros.php') ? ' class="active"' : ''; ?>>
            <a href="pre-registros.php">
              <i class="fas fa-clipboard-list"></i>
              <span class="nav-item">Pre-Registros</span>
            </a>
            </li>
            <li<?php echo (basename($_SERVER['PHP_SELF']) == 'pre-registros-inst.php') ? ' class="active"' : ''; ?>>
              <a href="pre-registros-inst.php">
                <i class="fas fa-clipboard-list"></i>
                <span class="nav-item">Pre-Registros Inst</span>
              </a>
              </li>
              <li<?php echo (basename($_SERVER['PHP_SELF']) == 'help.php') ? ' class="active"' : ''; ?>>
                <a id="btn-abrir-modalV">
                  <i class="fas fa-question-circle"></i>
                  <span class="nav-item">Help</span>
                </a>
                </li>
                <li class="li-ultimo" <?php echo (basename($_SERVER['PHP_SELF']) == 'logout.php') ? ' class="active"' : ''; ?>>
                  <a href="../acciones/cerrarsesion.php" class="logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-item2">Salir</span>
                  </a>
                </li>
  </ul>
</nav>


<dialog close id="modalV" style="border-radius: 20px; border: 2px solid #f1f2f3; width: 50%; height:64%; margin-left:25%; margin-top:7%">
  <div>
    <button style="float: right; background: white; padding-left: 10px; padding-right: 9px; scale: 100%; border-radius: 50%; outline: none; border: 0px; margin-bottom: 5px;" class="" id="btn-cerrar-modalV"><i class="fas fa-close"></i></button>
    <br>
    <video width="100%" height="100%" controls>
      <source src="vid/Video explicativo_2.mp4" type="video/mp4">
    </video>
  </div>
</dialog>