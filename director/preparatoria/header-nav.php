<?php
$id_user = $_SESSION['id_director_preparatoria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_director_preparatoria'])) {
  header('location: ../../acciones/cerrarsesion.php');
}

include('../../acciones/conexion.php');

//Información solo de director
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM directores_preparatoria a JOIN escuelas e ON a.id_escuela = e.id_escuela WHERE id_director = $id_user"));

//Información para director - escuela
$user_escuela = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT e.* FROM directores_preparatoria a
JOIN escuelas e 
ON a.id_escuela = e.id_escuela
WHERE a.id_director = $id_user"));

  $id = $user["id_director"];
  $name = $user["nombre"];
  $image = $user["image"];

?>
<nav>
  <ul>
    <li>
      <a href="" class="logo">
      <img src="acciones/img/<?php echo $image; ?>" id="imgchange1">
        <span class="nav-item">KOUTILAB</span>
      </a>
    </li>
    <li <?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? ' class="active"' : ''; ?>>
      <a href="dashboard.php">
        <i class="fas fa-user"></i>
        <span class="nav-item">Dashboard</span>
      </a>
    </li>
    <li <?php echo (basename($_SERVER['PHP_SELF']) == 'alumnos.php') ? ' class="active"' : ''; ?>>
      <a href="alumnos.php">
        <i class="fas fa-users" ></i>
        <span class="nav-item">Alumnos</span>
      </a>
    </li>
    <li <?php echo (basename($_SERVER['PHP_SELF']) == 'docentes.php') ? ' class="active"' : ''; ?>>
      <a href="docentes.php">
        <i class="fas fa-person-chalkboard"></i>
        <span class="nav-item">Docentes</span>
      </a>
    </li>
    <li <?php echo (basename($_SERVER['PHP_SELF']) == 'cursos.php') ? ' class="active"' : ''; ?>>
      <a href="cursos.php">
        <i class="fas fa-layer-group"></i>
        <span class="nav-item">Cursos</span>
      </a>
    </li>
    <li <?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? ' class="active"' : ''; ?>>
      <a href="contact.php">
        <i class="fas fa-address-book"></i>
        <span class="nav-item">Contacto</span>
      </a>
    </li>
    <li <?php echo (basename($_SERVER['PHP_SELF']) == 'help.php') ? ' class="active"' : ''; ?>>
      <a href="help.php">
        <i class="fas fa-question-circle"></i>
        <span class="nav-item">Help</span>
      </a>
    </li>
    <li <?php echo (basename($_SERVER['PHP_SELF']) == 'logout.php') ? ' class="active"' : ''; ?>>
      <a href="../../acciones/cerrarsesion.php" class="logout">
        <i class="fas fa-sign-out-alt"></i>
        <span class="nav-item">Salir</span>
      </a>
    </li>
  </ul>
</nav>
