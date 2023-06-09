<?php
	require 'conexion.php';
	session_start();
	
	$id = $_GET['id'];
	
	$sql = "SELECT * FROM Escuelas WHERE id_Escu = '$id'";
	$resultado = $conexion->query($sql);
	$row = $resultado->fetch_array(MYSQLI_ASSOC);
	
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB <?php echo $_SESSION['admin'];?></title>
    <link rel="shortcut icon" href="img/lgk.png">
    <link rel="stylesheet" href="css/modificar.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
	
<body>
    <div id="sidemenu" class="menu-collapsed">

        <div id="header">
            <div id="title"><img src="img/koutilab3.png" alt=""></div>
            <div id="menu-btn">
                <div class="btn-hamburger"></div>
                <div class="btn-hamburger"></div>
                <div class="btn-hamburger"></div>
            </div>
        </div>
        <div class="item separator"></div>


        <div id="profile">
            <div id="photo"><img src="img/img2.jpg" alt=""></div>
            <?php
                    $admin = $_SESSION['admin'];
                    $data2 = mysqli_query($conexion, "SELECT * FROM Administrador WHERE UsuarioA = '$admin'" );
                    while($consulta = mysqli_fetch_array($data2))
                        {
                            echo " <div id='name'><span>". $consulta['NombreA']."</span></div>";
                       }     
                ?>
        </div>

        <div id="menu-items">
            <div class="item separator"></div>
            <div class="item">
              <a href="../admin/dashboard.php" class="">
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
              <a href="../admin/bandeja.php" class="">
                <div class="icon">
                  <i class="fas fa-envelope"></i>
                </div>
                <div class="title">
                  <span>Correos</span>
                </div>
              </a>
            </div>
            <div class="item separator"></div>
            <div class="item">
              <a href="../admin/escuelas.php" class="">
                <div class="icon">
                  <i class="fa fa-institution"></i>
                </div>
                <div class="title">
                  <span>Registrar Escuela</span>
                </div>
              </a>
            </div>
            <div class="item separator"></div>
            <div class="item">
              <a href="../admin/perfil.php" class="">
                <div class="icon">
                  <i class="fas fa-user-edit"></i>
                </div>
                <div class="title">
                  <span>Perfil</span>
                </div>
              </a>
            </div>
            <div class="item separator"></div>
    </div></div>
    <div id="interface">
        <div class="navigation">
            <div class="n1">
                <div class="search">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar">
                </div>
            </div>
            <div class="perfil">
                <img src="img/koutilab0.png">
                <i class="fas fa-bell"></i>
                <a href="cerrarsesion.php"><i class="fa fa-sign-out"></i></a>              
            </div>
        </div>
    </div>
    </div>
    <div class="values"><h3 class="i-name"> Modificar Escuelas</h3></div>
		<div class="container">
			<form  method="POST" action="update.php" autocomplete="off">
			    <div class="user-details">
                    <input type="hidden" id="id" name="id" value="<?php echo $row['id_Escu']; ?>" />
                    <div class="input-box">
                        <span class="details">Escuela: </span>
                        <input type="text" placeholder="Nombre de la escuela" name="NombreEsc" value="<?php echo $row['NombreEsc']; ?>" required>
                    </div>
                    <div class="input-box" >
                        <span class="details">CCT: </span>
                        <input type="text" placeholder="AP123456" name="CCT" value="<?php echo $row['CCT']; ?>"  required>
                    </div>
                    <div class="input-box" >
                        <span class="details">Director: </span>
                        <input type="text" placeholder="Ejemplo: Juan Ejemplo Ejemplo" name="Direc" value="<?php echo $row['Director']; ?>" required>
                    </div>
                    <div class="input-box" >
                        <span class="details">Calle: </span>
                        <input type="text" placeholder="Calle" name="calle" value="<?php echo $row['Calle']; ?>" required>
                    </div>
                    <div class="input-box" >
                        <span class="details">Numero Exterior: </span>
                        <input type="text" placeholder="Numero Exterior" name="numero" value="<?php echo $row['N_Exterior']; ?>" required>
                    </div>
                    <div class="input-box" >
                        <span class="details">Colonia: </span>
                        <input type="text" placeholder="Colonia" name="colonia" value="<?php echo $row['Colonia']; ?>" required>
                    </div>
                    <div class="input-box" >
                        <span class="details">Estado: </span>
                        <input type="text" placeholder="Estado" name="estado" value="<?php echo $row['Estado']; ?>" required>
                    </div>
                    <div class="input-box" >
                        <span class="details">Codigo Postal: </span>
                        <input type="text" placeholder="Codigo" name="codigo" value="<?php echo $row['CP']; ?>" required>
                    </div>
                    <div class="input-box" >
                        <span class="details">Total Docentes: </span>
                        <input type="text" placeholder="Ejemplo: 100" name="TD" value="<?php echo $row['NumeroProfes']; ?>" required>
                    </div>
                    <div class="input-box" >
                        <span class="details">Total Alumnos: </span>
                        <input type="text" placeholder="Ejemplo: 100" name="TA" value="<?php echo $row['NumeroAlum']; ?>" required>
                    </div>
                    <div class="input-box" >
                        <span class="details">Nivel Educativo: </span>
                        <input type="text" placeholder="Ejemplo: Primaria" name="nivel" value="<?php echo $row['Nivel_Educativo']; ?>" required>
                    </div>
                    <div class="input-box" >
                      <span class="details">Clave director: </span>
                      <input type="text" placeholder="AP123456" name="Clave1" value="<?php echo $row['ClaveDirector']; ?>" required>
                  </div>
                  <div class="input-box" >
                      <span class="details">Clave profesor: </span>
                      <input type="text" placeholder="AP123456" name="Clave2" value="<?php echo $row['ClaveProfesor']; ?>" required>
                  </div>
                  <div class="input-box" >
                      <span class="details">Clave alumnos: </span>
                      <input type="text" placeholder="AP123456" name="Clave3" value="<?php echo $row['ClaveAlumno']; ?>" required>
                  </div><br>
                </div>
					
					<center><button type="submit" class="btn-grd">Actualizar</button>
					<a href="../admin/escuelas.php"><button class="btn-grid">Cancelar</button></a></center>
			</form>
		</div>
<script>
    const btnAbrirModalA=document.querySelector("#btn-abrir-modalA");
    const btnCerrarModalA=document.querySelector("#btn-cerrar-modalA");
    const modalA=document.querySelector("#modalA");
    btnAbrirModalA.addEventListener("click",()=>{
        modalA.showModal();
    })

    btnCerrarModalA.addEventListener("click",()=>{
        modalA.close();
    })
</script>
<script>
    const btnAbrirModalE=document.querySelector("#btn-abrir-modalE");
    const btnCerrarModalE=document.querySelector("#btn-cerrar-modalE");
    const modalE=document.querySelector("#modalE");
    btnAbrirModalE.addEventListener("click",()=>{
        modalE.showModal();
    })

    btnCerrarModalE.addEventListener("click",()=>{
        modalE.close();
    })
</script>
<script>
    const btn = document.querySelector('#menu-btn');
    const menu = document.querySelector('#sidemenu');
    btn.addEventListener('click', e =>{
        menu.classList.toggle("menu-expanded");
        menu.classList.toggle("menu-collapsed");

        document.querySelector('body').classList.toggle('body-expanded');
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
    if (e.which==2 || e.which==3) {
        return false;
    }
}
}
if (document.layers) {
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown = disableNS;
} 
else {
document.onmouseup = disableNS;
document.oncontextmenu = disableIE;
}
document.oncontextmenu=new Function("return false");

</script>
<script>
    onkeydown = e => {
let tecla = e.which || e.keyCode;

// Evaluar si se ha presionado la tecla Ctrl:
if ( e.ctrlKey ) {
// Evitar el comportamiento por defecto del nevagador:
e.preventDefault();
e.stopPropagation();

// Mostrar el resultado de la combinación de las teclas:
if ( tecla === 85 )
  console.log("Ha presionado las teclas Ctrl + U");

if ( tecla === 83 )
  console.log("Ha presionado las teclas Ctrl + S");
}
}
</script>
</body>
</html>