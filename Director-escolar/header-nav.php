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
        <i class="fas fa-user"></i>
        <span class="nav-item">Dashboard</span>
      </a>
    </li>
    <li<?php echo (basename($_SERVER['PHP_SELF']) == 'alumnos.php') ? ' class="active"' : ''; ?>>
      <a href="alumnos.php">
        <i class="fas fa-users" ></i>
        <span class="nav-item">Alumnos</span>
      </a>
    </li>
    <li<?php echo (basename($_SERVER['PHP_SELF']) == 'docentes.php') ? ' class="active"' : ''; ?>>
      <a href="docentes.php">
        <i class="fas fa-person-chalkboard"></i>
        <span class="nav-item">Docentes</span>
      </a>
    </li>
    <li<?php echo (basename($_SERVER['PHP_SELF']) == 'cursos.php') ? ' class="active"' : ''; ?>>
      <a href="cursos.php">
        <i class="fas fa-layer-group"></i>
        <span class="nav-item">Cursos</span>
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
