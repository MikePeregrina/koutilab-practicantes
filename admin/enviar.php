<?php
session_start();
$id_user = $_SESSION['id_admin'];
if (empty($_SESSION['active']) || empty($_SESSION['id_admin'])) {
  header('location: ../acciones/cerrarsesion.php');
}
include('../acciones/conexion.php');
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM admin WHERE id_admin = $id_user"));

?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="img/lgk.png">
<link rel="stylesheet" href="css/contact.css">
<link rel="stylesheet" href="css/nav-barra.css">
<link rel="stylesheet" href="css/footer.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<title>KOUTILAB</title>
</head>

<!-- Header nav -->
<?php include 'header-nav.php'; ?>

<div class="containers">
  <h1>BANDEJA DE SALIDA </h1>
</div>

<section>

  <div class="titlec">
    <h2>Comentarios y sugerencias</h2>
  </div>
  <form id="contacto" method="POST" enctype="multipart/form-data" action="acciones/consulta.php">
    <div class="asunto">
      <input type="text" name="asunto" placeholder="Asunto">
    </div>

    <div class="mensaje">
      <textarea name="mensaje" id="contacto" placeholder="Escriba aqu&iacute; su mensaje" rows="5" cols="40"></textarea>
    </div>

    <div class="button">
      <button type="submit" class="btn-submit">
        <h3>Enviar</h3>
      </button>
    </div>
  </form>
</section>

<?php include 'footer.php'; ?>

<script>
  const btnAbrirModalV = document.querySelector("#btn-abrir-modalV");
  const btnCerrarModalV = document.querySelector("#btn-cerrar-modalV");
  const modalV = document.querySelector("#modalV");
  btnAbrirModalV.addEventListener("click", () => {
    modalV.showModal();
  })

  btnCerrarModalV.addEventListener("click", () => {
    modalV.close();
  })
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>