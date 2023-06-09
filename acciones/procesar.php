<?php
    
    include("conexionPro.php");

    $UsuarioN= $_POST["nickname"];
    $contrasena= $_POST["password"];
    $nivel=$_POST['clave'];

  if ($nivel == 'Admin23') {
    $resultado = mysqli_query($conexion,"SELECT * FROM  Administrador WHERE UsuarioA = '$UsuarioN' AND ContrasenaA= '$contrasena'");

    $fila = mysqli_num_rows($resultado);

    if($fila >0){
      session_start();
      $_SESSION['admin'] = $UsuarioN;
      header("location:../koutilab/admin/Dashboard.php");
    }else{
      echo '<script language="javascript">alert("El Usuario y/o contraseña son Incorrectos");window.location.href="../index.php"</script>';
      exit;
    }
    mysqli_free_result($resultado);
    mysqli_close();
  }else{
    echo '<script language="javascript">alert("CLAVE DE ACCESO INCORRECTA :(");window.location.href="../koutilab/index.php"</script>';
  }if ($nivel == 'Direct23') {
    $resultado = mysqli_query($conexion,"SELECT * FROM  Directores WHERE UsuarioD = '$UsuarioN' AND ContrasenaD= '$contrasena'");

    $fila = mysqli_num_rows($resultado);

    if($fila >0){
      session_start();
      $_SESSION['directores'] = $UsuarioN;
      header("location:../koutilab/director/Dashboard.php");
    }else{
      echo '<script language="javascript">alert("El Usuario y/o contraseña son Incorrectos");window.location.href="../index.php"</script>';
      exit;
    }
    mysqli_free_result($resultado);
    mysqli_close();
  }else{
    echo '<script language="javascript">alert("CLAVE DE ACCESO INCORRECTA :(");window.location.href="../index.php"</script>';
  }if ($nivel == "Profe23") {
    $resultado = mysqli_query($conexion,"SELECT * FROM  Docentes WHERE UsuarioP = '$UsuarioN' AND ContrasenaP= '$contrasena'");

    $fila = mysqli_num_rows($resultado);

    if($fila >0){
      session_start();
      $_SESSION['profesores'] = $UsuarioN;
      header("location:../koutilab/docente/Dashboard.php");
    }else{
      echo '<script language="javascript">alert("El Usuario y/o contraseña son Incorrectos");window.location.href="../index.php"</script>';
      exit;
    }
    mysqli_free_result($resultado);
    mysqli_close();
  }else{
    echo '<script language="javascript">alert("CLAVE DE ACCESO INCORRECTA :(");window.location.href="../index.php"</script>';
  }if ($nivel == 'Alumno23') {
    $resultado = mysqli_query($conexion,"SELECT * FROM  Alumnos WHERE UsuarioAlu = '$UsuarioN' AND ContrasenaAlu= '$contrasena'");

    $fila = mysqli_num_rows($resultado);

    if($fila >0){
      session_start();
      $_SESSION['alumnos'] = $UsuarioN;
      header("Location: alumno/Perfil.php");
    }else{
      echo '<script language="javascript">alert("El Usuario y/o contraseña son Incorrectos");window.location.href="../index.php"</script>';
      exit;
    }
    mysqli_free_result($resultado);
    mysqli_close();
  }else{
    echo '<script language="javascript">alert("CLAVE DE ACCESO INCORRECTA :(");window.location.href="../index.php"</script>';
  }

$error;