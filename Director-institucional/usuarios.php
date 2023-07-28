<?php
session_start();
$id_user = $_SESSION['id_director'];
if (empty($_SESSION['active']) || empty($_SESSION['id_director'])) {
  header('location: ../acciones/cerrarsesion.php');
}

include('../acciones/conexion.php');
//obtener los datos del director
$query = "SELECT ta.id, ta.conexiones, ta.nombre, ta.username, ta.clave, ta.fechaRegistro FROM `userdirector` as ud INNER JOIN temp_account as ta on ud.id = ta.id INNER JOIN director_institucional as di on ud.id_director = di.id_director WHERE di.id_director = $id_user";
$alumnos = mysqli_query($conexion, $query);
$result = mysqli_num_rows($alumnos);


?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/usuarios.css">
<link rel="stylesheet" href="css/nav-barra.css">
<link rel="stylesheet" href="css/footer.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bulma.min.css">

<title>KOUTILAB</title>
</head>

<body>

  <!-- Header nav -->
  <?php include 'header-nav.php'; ?>


  <div class="containers">
    <h1 class="titulos">USUARIOS</h1>
  </div>

  <div class="studens-add-bar">
    <div class="left-student">
      <i class="fas fa-users"></i>
      <h2 class="subtitulos">Usuarios(s)</h2>
    </div>
  </div>
  <!-- <div class="right-student">
      <i class="fas fa-user-plus"></i>
      <h2 class="subtitulos">Añadir usuario</h2>
    </div>
  </div> -->
  <section>

    <div class="board p-2" style="width: 92%;">
      <table id="usuarios" width="100%" class="table border-top">
        <thead>
          <tr>
            <td><b>#</b></td>
            <td><b>Nombre</b></td>
            <td><b>username</b></td>
            <td><b>clave</b></td>
            <td><b>Dias restantes</b></td>
            <td><b>N° conexiones</b></td>
          </tr>
        </thead>
        <tbody>

          <?php

          if ($result > 0) {
            while ($data = mysqli_fetch_assoc($alumnos)) {
              //Cambiamos a nuestra zona horaria
              date_default_timezone_set('America/Monterrey');
              //formateamos la fecha
              $today = date('Y-m-d', time());
              //Creamos las fechas dando formato de tipo fecha
              $fechaHoy = new DateTime($today);
              $fechaRegistro = new DateTime($data['fechaRegistro']);
              //calculamos la diferencia de dias que han pasado desde el registro
              $resultado = $fechaHoy->diff($fechaRegistro);
              //Al tiempo de vida se le restan los dias que han pasado
              $resta = 30 - intval($resultado->format('%a'));
          ?>
              <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['nombre']; ?></td>
                <td><?php echo $data['username']; ?></td>
                <td><?php echo $data['clave']; ?></td>
                <td><?php echo $resta; ?></td>
                <td><?php echo $data['conexiones']; ?></td>
              </tr>
          <?php }
          } ?>

        </tbody>
      </table>
    </div>
  </section>
  <?php include 'footer.php'; ?>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bulma.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    $(document).ready(function() {
      $('#usuarios').DataTable({
        responsive: true,
        autoWidth: false,
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/es-MX.json'
        }
      });
    });
  </script>

</body>

</html>