<?php
  include('conexionPro.php');

  $MateriaG= $_POST['MateriaG'];
  $NivelG= $_POST['pais'];
  $GradoG= $_POST['ciudad'];
  $CursosG= $_POST['cursos'];
  $id_Profe= $_POST['id_Profe'];
  

  $insertar = mysqli_query($conexion, "INSERT INTO Grupos(MateriaG, GradoG, NivelG, CursosG, id_Profe)VALUES('$MateriaG','$GradoG','$NivelG','$CursosG','$id_Profe')");

  if($insertar){
    header("location:../koutilab/docente/Dashboard.php");
  }

  mysqli_close($conexion);
?>