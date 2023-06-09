<?php
  include('conexion.php');

  $id_Admin= $_POST['admin'];
  $NombreEsc= $_POST['NombreEsc'];
  $CCT= $_POST['CCT'];
  $Director= $_POST['Direc'];
  $Calle= $_POST['calle'];
  $N_Exterior= $_POST['numero'];
  $Colonia= $_POST['colonia'];
  $Estado= $_POST['estado'];
  $CP= $_POST['codigo'];
  $T_Docentes= $_POST['TD'];
  $T_Alumnos= $_POST['TA'];
  $Nivel_Educativo= $_POST['nivel'];
  $ClaveDirector= $_POST['Clave1'];
  $ClaveProfesor= $_POST['Clave2'];
  $ClaveAlumno= $_POST['Clave3'];
  
  echo $id_Admin;

  $insertar = mysqli_query($conexion, "INSERT INTO Escuelas(NombreEsc, id_Admin, CCT,Director, ClaveDirector, ClaveProfesor, ClaveAlumno,Calle,N_Exterior,Colonia,Estado,CP,NumeroAlum,Numeroprofes,Nivel_Educativo)VALUES('$NombreEsc','$id_Admin','$CCT','$Director','$ClaveDirector','$ClaveProfesor','$ClaveAlumno','$Calle','$N_Exterior','$Colonia','$Estado','$CP','$T_Alumnos','$T_Docentes','$Nivel_Educativo')");

  if($insertar){
    header("location:../admin/escuelas.php");
  }

  mysqli_close($conexion);
?>