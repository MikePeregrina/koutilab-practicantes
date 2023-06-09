<?php

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula1 = "capsula1";
$sql_capsula1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula1' AND d.id_curso = 6");
$existe_capsula1 = mysqli_num_rows($sql_capsula1);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula2 = "capsula2";
$sql_capsula2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula2' AND d.id_curso = 6");
$existe_capsula2 = mysqli_num_rows($sql_capsula2);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula3 = "capsula3";
$sql_capsula3 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula3' AND d.id_curso = 6");
$existe_capsula3 = mysqli_num_rows($sql_capsula3);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula4 = "capsula4";
$sql_capsula4 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula4' AND d.id_curso = 6");
$existe_capsula4 = mysqli_num_rows($sql_capsula4);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula5 = "capsula5";
$sql_capsula5 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula5' AND d.id_curso = 6");
$existe_capsula5 = mysqli_num_rows($sql_capsula5);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula6 = "capsula6";
$sql_capsula6 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula6' AND d.id_curso = 6");
$existe_capsula6 = mysqli_num_rows($sql_capsula6);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula7 = "capsula7";
$sql_capsula7 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula7' AND d.id_curso = 6");
$existe_capsula7 = mysqli_num_rows($sql_capsula7);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula8 = "capsula8";
$sql_capsula8 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula8' AND d.id_curso = 6");
$existe_capsula8 = mysqli_num_rows($sql_capsula8);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula9 = "capsula9";
$sql_capsula9 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula9' AND d.id_curso = 6");
$existe_capsula9 = mysqli_num_rows($sql_capsula9);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula10 = "capsula10";
$sql_capsula10 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula10' AND d.id_curso = 6");
$existe_capsula10 = mysqli_num_rows($sql_capsula10);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula11 = "capsula11";
$sql_capsula11 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula11' AND d.id_curso = 6");
$existe_capsula11 = mysqli_num_rows($sql_capsula11);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula12 = "capsula12";
$sql_capsula12 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula12' AND d.id_curso = 6");
$existe_capsula12 = mysqli_num_rows($sql_capsula12);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula13 = "capsula13";
$sql_capsula13 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula13' AND d.id_curso = 6");
$existe_capsula13 = mysqli_num_rows($sql_capsula13);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula14 = "capsula14";
$sql_capsula14 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula14' AND d.id_curso = 6");
$existe_capsula14 = mysqli_num_rows($sql_capsula14);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula15 = "capsula15";
$sql_capsula15 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula15' AND d.id_curso = 6");
$existe_capsula15 = mysqli_num_rows($sql_capsula15);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula16 = "capsula16";
$sql_capsula16 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula16' AND d.id_curso = 6");
$existe_capsula16 = mysqli_num_rows($sql_capsula16);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula17 = "capsula17";
$sql_capsula17 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula17' AND d.id_curso = 6");
$existe_capsula17 = mysqli_num_rows($sql_capsula17);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula18 = "capsula18";
$sql_capsula18 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula18' AND d.id_curso = 6");
$existe_capsula18 = mysqli_num_rows($sql_capsula18);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula19 = "capsula19";
$sql_capsula19 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula19' AND d.id_curso = 6");
$existe_capsula19 = mysqli_num_rows($sql_capsula19);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula20 = "capsula20";
$sql_capsula20 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula20' AND d.id_curso = 6");
$existe_capsula20 = mysqli_num_rows($sql_capsula20);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula21 = "capsula21";
$sql_capsula21 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula21' AND d.id_curso = 6");
$existe_capsula21 = mysqli_num_rows($sql_capsula21);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula22 = "capsula22";
$sql_capsula22 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula22' AND d.id_curso = 6");
$existe_capsula22 = mysqli_num_rows($sql_capsula22);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula23 = "capsula23";
$sql_capsula23 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula23' AND d.id_curso = 6");
$existe_capsula23 = mysqli_num_rows($sql_capsula23);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula24 = "capsula24";
$sql_capsula24 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula24' AND d.id_curso = 6");
$existe_capsula24 = mysqli_num_rows($sql_capsula24);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula25 = "capsula25";
$sql_capsula25 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula25' AND d.id_curso = 6");
$existe_capsula25 = mysqli_num_rows($sql_capsula25);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula26 = "capsula26";
$sql_capsula26 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula26' AND d.id_curso = 6");
$existe_capsula26 = mysqli_num_rows($sql_capsula26);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula27 = "capsula27";
$sql_capsula27 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula27' AND d.id_curso = 6");
$existe_capsula27 = mysqli_num_rows($sql_capsula27);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula28 = "capsula28";
$sql_capsula28 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula28' AND d.id_curso = 6");
$existe_capsula28 = mysqli_num_rows($sql_capsula28);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula29 = "capsula29";
$sql_capsula29 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula29' AND d.id_curso = 6");
$existe_capsula29 = mysqli_num_rows($sql_capsula29);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula30 = "capsula30";
$sql_capsula30 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula30' AND d.id_curso = 6");
$existe_capsula30 = mysqli_num_rows($sql_capsula30);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula31 = "capsula31";
$sql_capsula31 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula31' AND d.id_curso = 6");
$existe_capsula31 = mysqli_num_rows($sql_capsula31);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula32 = "capsula32";
$sql_capsula32 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula32' AND d.id_curso = 6");
$existe_capsula32 = mysqli_num_rows($sql_capsula32);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula33 = "capsula33";
$sql_capsula33 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula33' AND d.id_curso = 6");
$existe_capsula33 = mysqli_num_rows($sql_capsula33);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula34 = "capsula34";
$sql_capsula34 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula34' AND d.id_curso = 6");
$existe_capsula34 = mysqli_num_rows($sql_capsula34);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula35 = "capsula35";
$sql_capsula35 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula35' AND d.id_curso = 6");
$existe_capsula35 = mysqli_num_rows($sql_capsula35);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula36 = "capsula36";
$sql_capsula36 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula36' AND d.id_curso = 6");
$existe_capsula36 = mysqli_num_rows($sql_capsula36);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula37 = "capsula37";
$sql_capsula37 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula37' AND d.id_curso = 6");
$existe_capsula37 = mysqli_num_rows($sql_capsula37);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula38 = "capsula38";
$sql_capsula38 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula38' AND d.id_curso = 6");
$existe_capsula38 = mysqli_num_rows($sql_capsula38);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula39 = "capsula39";
$sql_capsula39 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula39' AND d.id_curso = 6");
$existe_capsula39 = mysqli_num_rows($sql_capsula39);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula40 = "capsula40";
$sql_capsula40 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula40' AND d.id_curso = 6");
$existe_capsula40 = mysqli_num_rows($sql_capsula40);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula41 = "capsula41";
$sql_capsula41 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula41' AND d.id_curso = 6");
$existe_capsula41 = mysqli_num_rows($sql_capsula41);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula42 = "capsula42";
$sql_capsula42 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula42' AND d.id_curso = 6");
$existe_capsula42 = mysqli_num_rows($sql_capsula42);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula43 = "capsula43";
$sql_capsula43 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula43' AND d.id_curso = 6");
$existe_capsula43 = mysqli_num_rows($sql_capsula43);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula44 = "capsula44";
$sql_capsula44 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula44' AND d.id_curso = 6");
$existe_capsula44 = mysqli_num_rows($sql_capsula44);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula45 = "capsula45";
$sql_capsula45 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula45' AND d.id_curso = 6");
$existe_capsula45 = mysqli_num_rows($sql_capsula45);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula46 = "capsula46";
$sql_capsula46 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula46' AND d.id_curso = 6");
$existe_capsula46 = mysqli_num_rows($sql_capsula46);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula47 = "capsula47";
$sql_capsula47 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula47' AND d.id_curso = 6");
$existe_capsula47 = mysqli_num_rows($sql_capsula47);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula48 = "capsula48";
$sql_capsula48 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula48' AND d.id_curso = 6");
$existe_capsula48 = mysqli_num_rows($sql_capsula48);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula49 = "capsula49";
$sql_capsula49 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula49' AND d.id_curso = 6");
$existe_capsula49 = mysqli_num_rows($sql_capsula49);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula50 = "capsula50";
$sql_capsula50 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula50' AND d.id_curso = 6");
$existe_capsula50 = mysqli_num_rows($sql_capsula50);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula51 = "capsula51";
$sql_capsula51 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula51' AND d.id_curso = 6");
$existe_capsula51 = mysqli_num_rows($sql_capsula51);

//Verificar si capsula esta completada para mostrar sin opacidad la cápsula
$capsula52 = "capsula52";
$sql_capsula52 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula52' AND d.id_curso = 6");
$existe_capsula52 = mysqli_num_rows($sql_capsula52);
