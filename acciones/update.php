<?php
	
	include('conexion.php');
	
	$id_Escu= $_POST['id'];
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
    
    $insertar = mysqli_query($conexion,"UPDATE Escuelas SET NombreEsc='$NombreEsc', CCT='$CCT', Director='$Director', ClaveDirector='$ClaveDirector', ClaveProfesor='$ClaveProfesor', ClaveAlumno='$ClaveAlumno', Calle='$Calle',N_Exterior='$N_Exterior',Colonia='$Colonia',Estado='$Estado',CP='$CP', NumeroAlum='$T_Alumnos',Numeroprofes='$T_Docentes',Nivel_Educativo='$Nivel_Educativo' WHERE id_Escu = '$id_Escu'");
	
	if($insertar){
    header("location: ../Koutilab/admin/escuelas.php");
  }

  mysqli_close($conexion);
	
?>