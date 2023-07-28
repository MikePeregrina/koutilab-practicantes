<?php
session_start();
$id_user = $_SESSION['id_docente_secundaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_docente_secundaria'])) {
  header('location: ../acciones/cerrarsesion.php');
}
include('../acciones/conexion.php');
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM docentes_secundaria d
JOIN escuelas e 
ON d.id_escuela = e.id_escuela
WHERE d.id_docente = $id_user"));
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <h1>CONTACTO</h1>
</div>

<section>

  <div class="titlec">
    <h2>Comentarios y sugerencias</h2>
  </div>
  <form id="contacto" method="POST" enctype="multipart/form-data">
    <div class="asunto">
      <input type="hidden" name="nombre_escuela" placeholder="Nombre de la escuela" value="<?php echo $user['nombre_escuela'] ?>">
      <input type="hidden" name="nombre_usuario" placeholder="Nombre" value="<?php echo $user['nombre'] ?>">
      <input type="text" name="asunto" placeholder="Asunto">
    </div>

    <div class="mensaje">
      <textarea name="mensaje" id="contacto" placeholder="Escriba aqu&iacute; su mensaje" rows="5" cols="40"></textarea>
    </div>

    <div class="button">
      <button type="submit" name="enviarcontacto" class="btn-submit">
        <h3>Enviar</h3>
      </button>
    </div>
  </form>
</section>

<?php include 'footer.php'; ?>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contacto');
    form.addEventListener('submit', function(event) {
      event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

      const nombreEscuela = form.querySelector('[name="nombre_escuela"]').value;
      const nombreUsuario = form.querySelector('[name="nombre_usuario"]').value;
      const asunto = form.querySelector('[name="asunto"]').value;
      const mensaje = form.querySelector('[name="mensaje"]').value;

      // Realiza una solicitud AJAX para enviar los datos del formulario al servidor
      const xhr = new XMLHttpRequest();
      xhr.open('POST', '', true); // Deja la URL vacía para enviar el formulario al mismo archivo
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (xhr.status === 200) {
          // El formulario se envió correctamente
          Swal.fire({
            title: 'Excelente!',
            text: 'Sugerencia enviada',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = 'contact.php';
            }
          });
        } else {
          // Ocurrió un error al enviar el formulario
          Swal.fire({
            title: '¡Advertencia!',
            text: 'Tu sugerencia no fue enviada',
            icon: 'info',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Reintentar',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = 'contact.php';
            }
          });
        }
      };
      xhr.onerror = function() {
        // Ocurrió un error al enviar el formulario
        Swal.fire({
          title: '¡Advertencia!',
          text: 'Tu sugerencia no fue enviada',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = 'contact.php';
          }
        });
      };
      xhr.send(
        'nombre_escuela=' + encodeURIComponent(nombreEscuela) +
        '&nombre_usuario=' + encodeURIComponent(nombreUsuario) +
        '&asunto=' + encodeURIComponent(asunto) +
        '&mensaje=' + encodeURIComponent(mensaje)
      );
    });
  });
</script>


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