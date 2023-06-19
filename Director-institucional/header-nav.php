<nav>
  <ul>
    <li>
      <a href="" class="logo">
        <img src="R.jpg" alt="">
        <span class="nav-item">KOUTILAB</span>
      </a>
    </li>
    <li<?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? ' class="active"' : ''; ?>>
      <a href="dashboard.php">
        <i class="fas fa-user" ></i>
        <span class="nav-item">Dashboard</span>
      </a>
    </li>
    <li<?php echo (basename($_SERVER['PHP_SELF']) == 'usuarios.php') ? ' class="active"' : ''; ?>>
      <a href="usuarios.php">
        <i class="fas fa-users"></i>
        <span class="nav-item">Usuarios</span>
      </a>
    </li>
    <li<?php echo (basename($_SERVER['PHP_SELF']) == 'add-Packages.php') ? ' class="active"' : ''; ?>>
      <a href="add-Packages.php">
        <i class="fas fa-layer-group"></i>
        <span class="nav-item">Paquetes</span>
      </a>
    </li>
    <li<?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? ' class="active"' : ''; ?>>
      <a href="contact.php">
        <i class="fas fa-address-book"></i>
        <span class="nav-item">Contacto</span>
      </a>
    </li>
    <li<?php echo (basename($_SERVER['PHP_SELF']) == 'help.php') ? ' class="active"' : ''; ?>>
      <a href="help.php">
        <i class="fas fa-question-circle"></i>
        <span class="nav-item">Help</span>
      </a>
    </li>
    <li<?php echo (basename($_SERVER['PHP_SELF']) == 'logout.php') ? ' class="active"' : ''; ?>>
      <a href="logout.php" class="logout">
        <i class="fas fa-sign-out-alt"></i>
        <span class="nav-item">Salir</span>
      </a>
    </li>
  </ul>
</nav>
