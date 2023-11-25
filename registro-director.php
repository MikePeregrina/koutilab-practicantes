<?php
session_start();

if (isset($_POST['iniciar_sesion'])) {
    $alert = '';
    if (empty($_POST['usuario']) || empty($_POST['contrasena'])) {
        $alert = '<div class="alert alert-danger" role="alert">
            Ingrese su usuario y su contraseña
            </div>';
    } else {
        require_once "acciones/conexion.php";
        $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
        $password = mysqli_real_escape_string($conexion, $_POST['contrasena']);
        $contrasena = md5(mysqli_real_escape_string($conexion, $_POST['contrasena']));

        //Validar inicio de sesión de un admin principal
        $query_validar_admin = mysqli_query($conexion, "SELECT * FROM admin WHERE usuario = '$user'");
        $result_validar_admin = mysqli_fetch_array($query_validar_admin);

        //Validar inicio de sesión de un admin secundario
        $query_validar_admin_secundario = mysqli_query($conexion, "SELECT * FROM admin_secundario WHERE usuario = '$user'");
        $result_validar_admin_secundario = mysqli_fetch_array($query_validar_admin_secundario);

        //Validar inicio de sesión de un alumno de primaria
        $query_validar_alumno_primaria = mysqli_query($conexion, "SELECT * FROM alumnos_primaria WHERE usuario = '$user'");
        $result_validar_alumno_primaria = mysqli_fetch_array($query_validar_alumno_primaria);

        //Validar inicio de sesión de un docente de primaria
        $query_validar_docente_primaria = mysqli_query($conexion, "SELECT * FROM docentes_primaria WHERE usuario = '$user'");
        $result_validar_docente_primaria = mysqli_fetch_array($query_validar_docente_primaria);

        //Validar inicio de sesión de un director de primaria
        $query_validar_director_primaria = mysqli_query($conexion, "SELECT * FROM directores_primaria WHERE usuario = '$user'");
        $result_validar_director_primaria = mysqli_fetch_array($query_validar_director_primaria);

        //Validar inicio de sesión de un alumno de secundaria
        $query_validar_alumno_secundaria = mysqli_query($conexion, "SELECT * FROM alumnos_secundaria WHERE usuario = '$user'");
        $result_validar_alumno_secundaria = mysqli_fetch_array($query_validar_alumno_secundaria);

        //Validar inicio de sesión de un docente de secundaria
        $query_validar_docente_secundaria = mysqli_query($conexion, "SELECT * FROM docentes_secundaria WHERE usuario = '$user'");
        $result_validar_docente_secundaria = mysqli_fetch_array($query_validar_docente_secundaria);

        //Validar inicio de sesión de un director de secundaria
        $query_validar_director_secundaria = mysqli_query($conexion, "SELECT * FROM directores_secundaria WHERE usuario = '$user'");
        $result_validar_director_secundaria = mysqli_fetch_array($query_validar_director_secundaria);

        //Validar inicio de sesión de un alumno de preparatoria
        $query_validar_alumno_preparatoria = mysqli_query($conexion, "SELECT * FROM alumnos_preparatoria WHERE usuario = '$user'");
        $result_validar_alumno_preparatoria = mysqli_fetch_array($query_validar_alumno_preparatoria);

        //Validar inicio de sesión de un docente de preparatoria
        $query_validar_docente_preparatoria = mysqli_query($conexion, "SELECT * FROM docentes_preparatoria WHERE usuario = '$user'");
        $result_validar_docente_preparatoria = mysqli_fetch_array($query_validar_docente_preparatoria);

        //Validar inicio de sesión de un director de preparatoria
        $query_validar_director_preparatoria = mysqli_query($conexion, "SELECT * FROM directores_preparatoria WHERE usuario = '$user'");
        $result_validar_director_preparatoria = mysqli_fetch_array($query_validar_director_preparatoria);

        //Validar inicio de sesión de un alumno de universidad
        $query_validar_alumno_universidad = mysqli_query($conexion, "SELECT * FROM alumnos_universidad WHERE usuario = '$user'");
        $result_validar_alumno_universidad = mysqli_fetch_array($query_validar_alumno_universidad);

        //Validar inicio de sesión de un docente de universidad
        $query_validar_docente_universidad = mysqli_query($conexion, "SELECT * FROM docentes_universidad WHERE usuario = '$user'");
        $result_validar_docente_universidad = mysqli_fetch_array($query_validar_docente_universidad);

        //Validar inicio de sesión de un director de universidad
        $query_validar_director_universidad = mysqli_query($conexion, "SELECT * FROM directores_universidad WHERE usuario = '$user'");
        $result_validar_director_universidad = mysqli_fetch_array($query_validar_director_universidad);

        //Validar inicio de sesión de un alumno de personal
        $query_validar_alumno_personal = mysqli_query($conexion, "SELECT * FROM alumnos_personal WHERE usuario = '$user'");
        $result_validar_alumno_personal = mysqli_fetch_array($query_validar_alumno_personal);

        //Validar inicio de sesión de un docente de personal
        $query_validar_docente_personal = mysqli_query($conexion, "SELECT * FROM docentes_personal WHERE usuario = '$user'");
        $result_validar_docente_personal = mysqli_fetch_array($query_validar_docente_personal);

        //Validar inicio de sesión de un director de personal
        $query_validar_director_personal = mysqli_query($conexion, "SELECT * FROM directores_personal WHERE usuario = '$user'");
        $result_validar_director_personal = mysqli_fetch_array($query_validar_director_personal);

        //Validar inicio de sesión de director institucional
        $query_validar_director_institucional = mysqli_query($conexion, "SELECT * FROM director_institucional WHERE usuario = '$user'");
        $result_validar_director_institucional = mysqli_fetch_array($query_validar_director_institucional);

        //Validar inicio de sesión de cuentas temporales
        $query_validar_temp_account = mysqli_query($conexion, "SELECT * FROM temp_account WHERE username = '$user'");
        $result_validar_temp_account = mysqli_fetch_array($query_validar_temp_account);

        if ($result_validar_admin > 0) {
            $query_admin = mysqli_query($conexion, "SELECT * FROM admin WHERE usuario = '$user' AND contrasena = '$contrasena'");
            $resultado_admin = mysqli_num_rows($query_admin);
            if ($resultado_admin > 0) {
                $dato_admin = mysqli_fetch_array($query_admin);
                $_SESSION['active'] = true;
                $_SESSION['rol'] = 1;
                $_SESSION['id_admin'] = $dato_admin['id_admin'];
                $_SESSION['nombre'] = $dato_admin['nombre'];
                $_SESSION['user'] = $dato_admin['usuario'];
                header('location: admin/dashboard.php');
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                 Usuario o contraseña incorrecta
                 </div>';
                session_destroy();
            }
        } else if ($result_validar_admin_secundario > 0) {
            $query_admin_secundario = mysqli_query($conexion, "SELECT * FROM admin_secundario WHERE usuario = '$user' AND contrasena = '$contrasena'");
            $resultado_admin_secundario = mysqli_num_rows($query_admin_secundario);
            if ($resultado_admin_secundario > 0) {
                $dato_admin_secundario = mysqli_fetch_array($query_admin_secundario);
                $_SESSION['active'] = true;
                $_SESSION['rol'] = 2;
                $_SESSION['id_admin_secundario'] = $dato_admin_secundario['id_admin_secundario'];
                $_SESSION['nombre'] = $dato_admin_secundario['nombre'];
                $_SESSION['user'] = $dato_admin_secundario['usuario'];
                header('location: adminsecundario/dashboard.php');
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                 Usuario o contraseña incorrecta
                 </div>';
                session_destroy();
            }
        } else if ($result_validar_alumno_primaria > 0) {
            $query_alumno = mysqli_query($conexion, "SELECT * FROM alumnos_primaria WHERE usuario = '$user' AND contrasena = '$contrasena'");
            $resultado_alumno = mysqli_num_rows($query_alumno);
            if ($resultado_alumno > 0) {
                $dato_alumno = mysqli_fetch_array($query_alumno);
                $_SESSION['active'] = true;
                $_SESSION['rol'] = 3;
                $_SESSION['id_alumno_primaria'] = $dato_alumno['id_alumno'];
                $_SESSION['nombre'] = $dato_alumno['nombre'];
                $_SESSION['user'] = $dato_alumno['usuario'];
                $_SESSION['id_escuela'] = $dato_alumno['id_escuela'];
                /*AÑADIENDO NUEVA CONEXIÓN */
                $id_usuario = $_SESSION['id_alumno_primaria'];
                $query_insert_conexion = mysqli_query($conexion, "INSERT INTO conexiones(tipo, id_usuario) values ('alumno_primaria', $id_usuario)");
                //Contador de conexiones
                $user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM alumnos_primaria WHERE id_alumno = $id_usuario"));
                $cont = intval($user['conexiones'] + 1);
                $id_escuela = $user['id_escuela'];
                $query_insert_visita = mysqli_query($conexion, "INSERT INTO visitas(tipo, id_escuela) values ('alumno', $id_escuela)");
                $sql_cont = "UPDATE `alumnos_primaria` SET `conexiones`= '$cont'  WHERE id_alumno = '$id_usuario'";
                $query_cont = mysqli_query($conexion, $sql_cont);
                /*FIN NUEVA CONEXIÓN */
                header('location: alumno/primaria/perfil.php');
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrecta
                 </div>';
                session_destroy();
            }
        } else if ($result_validar_docente_primaria > 0) {
            $query_docente = mysqli_query($conexion, "SELECT * FROM docentes_primaria WHERE usuario = '$user' AND contrasena = '$contrasena'");
            $resultado_docente = mysqli_num_rows($query_docente);
            if ($resultado_docente > 0) {
                $dato_docente = mysqli_fetch_array($query_docente);
                $_SESSION['active'] = true;
                $_SESSION['rol'] = 4;
                $_SESSION['id_docente_primaria'] = $dato_docente['id_docente'];
                $_SESSION['nombre'] = $dato_docente['nombre'];
                $_SESSION['user'] = $dato_docente['usuario'];
                /*AÑADIENDO NUEVA CONEXIÓN */
                $id_usuario = $_SESSION['id_docente_primaria'];
                $query_insert_conexion = mysqli_query($conexion, "INSERT INTO conexiones(tipo, id_usuario) values ('docente_primaria', $id_usuario)");
                //Contador de conexiones
                $user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM docentes_primaria WHERE id_docente = $id_usuario"));
                $cont = intval($user['conexiones'] + 1);
                $id_escuela = $user['id_escuela'];
                $query_insert_visita = mysqli_query($conexion, "INSERT INTO visitas(tipo, id_escuela) values ('docente', $id_escuela)");
                $sql_cont = "UPDATE `docentes_primaria` SET `conexiones`= '$cont'  WHERE id_docente = '$id_usuario'";
                $query_cont = mysqli_query($conexion, $sql_cont);
                /*FIN NUEVA CONEXIÓN */
                header('location: docente/dashboard.php');
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrecta
                 </div>';
                session_destroy();
            }
        } else if ($result_validar_director_primaria > 0) {
            $query_director = mysqli_query($conexion, "SELECT * FROM directores_primaria WHERE usuario = '$user' AND contrasena = '$contrasena'");
            $resultado_director = mysqli_num_rows($query_director);
            if ($resultado_director > 0) {
                $dato_director = mysqli_fetch_array($query_director);
                $_SESSION['active'] = true;
                $_SESSION['rol'] = 5;
                $_SESSION['id_director_primaria'] = $dato_director['id_director'];
                $_SESSION['nombre'] = $dato_director['nombre'];
                $_SESSION['user'] = $dato_director['usuario'];
                header('location: director/primaria/dashboard.php');
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrecta
                 </div>';
                session_destroy();
            }
        } else if ($result_validar_alumno_secundaria > 0) {
            $query_alumno = mysqli_query($conexion, "SELECT * FROM alumnos_secundaria WHERE usuario = '$user' AND contrasena = '$contrasena'");
            $resultado_alumno = mysqli_num_rows($query_alumno);
            if ($resultado_alumno > 0) {
                $dato_alumno = mysqli_fetch_array($query_alumno);
                $_SESSION['active'] = true;
                $_SESSION['rol'] = 6;
                $_SESSION['id_alumno_secundaria'] = $dato_alumno['id_alumno'];
                $_SESSION['nombre'] = $dato_alumno['nombre'];
                $_SESSION['user'] = $dato_alumno['usuario'];
                $_SESSION['id_escuela'] = $dato_alumno['id_escuela'];
                /*AÑADIENDO NUEVA CONEXIÓN */
                $id_usuario = $_SESSION['id_alumno_secundaria'];
                $query_insert_conexion = mysqli_query($conexion, "INSERT INTO conexiones(tipo, id_usuario) values ('alumno_secundaria', $id_usuario)");
                //Contador de conexiones
                $user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM alumnos_secundaria WHERE id_alumno = $id_usuario"));
                $cont = intval($user['conexiones'] + 1);
                $id_escuela = $user['id_escuela'];
                $query_insert_visita = mysqli_query($conexion, "INSERT INTO visitas(tipo, id_escuela) values ('alumno', $id_escuela)");
                $sql_cont = "UPDATE `alumnos_secundaria` SET `conexiones`= '$cont'  WHERE id_alumno = '$id_usuario'";
                $query_cont = mysqli_query($conexion, $sql_cont);
                /*FIN NUEVA CONEXIÓN */
                header('location: alumno/secundaria/perfil.php');
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrecta
                 </div>';
                session_destroy();
            }
        } else if ($result_validar_docente_secundaria > 0) {
            $query_docente = mysqli_query($conexion, "SELECT * FROM docentes_secundaria WHERE usuario = '$user' AND contrasena = '$contrasena'");
            $resultado_docente = mysqli_num_rows($query_docente);
            if ($resultado_docente > 0) {
                $dato_docente = mysqli_fetch_array($query_docente);
                $_SESSION['active'] = true;
                $_SESSION['rol'] = 7;
                $_SESSION['id_docente_secundaria'] = $dato_docente['id_docente'];
                $_SESSION['nombre'] = $dato_docente['nombre'];
                $_SESSION['user'] = $dato_docente['usuario'];
                /*AÑADIENDO NUEVA CONEXIÓN */
                $id_usuario = $_SESSION['id_docente_secundaria'];
                $query_insert_conexion = mysqli_query($conexion, "INSERT INTO conexiones(tipo, id_usuario) values ('docente_secundaria', $id_usuario)");
                //Contador de conexiones
                $user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM docentes_secundaria WHERE id_docente = $id_usuario"));
                $cont = intval($user['conexiones'] + 1);
                $id_escuela = $user['id_escuela'];
                $query_insert_visita = mysqli_query($conexion, "INSERT INTO visitas(tipo, id_escuela) values ('docente', $id_escuela)");
                $sql_cont = "UPDATE `docentes_secundaria` SET `conexiones`= '$cont'  WHERE id_docente = '$id_usuario'";
                $query_cont = mysqli_query($conexion, $sql_cont);
                /*FIN NUEVA CONEXIÓN */
                header('location: docente-secundaria/dashboard.php');
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrecta
                 </div>';
                session_destroy();
            }
        } else if ($result_validar_director_secundaria > 0) {
            $query_director = mysqli_query($conexion, "SELECT * FROM directores_secundaria WHERE usuario = '$user' AND contrasena = '$contrasena'");
            $resultado_director = mysqli_num_rows($query_director);
            if ($resultado_director > 0) {
                $dato_director = mysqli_fetch_array($query_director);
                $_SESSION['active'] = true;
                $_SESSION['rol'] = 8;
                $_SESSION['id_director_secundaria'] = $dato_director['id_director'];
                $_SESSION['nombre'] = $dato_director['nombre'];
                $_SESSION['user'] = $dato_director['usuario'];
                header('location: director/secundaria/dashboard.php');
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrecta
                 </div>';
                session_destroy();
            }
        } else if ($result_validar_alumno_preparatoria > 0) {
            $query_alumno = mysqli_query($conexion, "SELECT * FROM alumnos_preparatoria WHERE usuario = '$user' AND contrasena = '$contrasena'");
            $resultado_alumno = mysqli_num_rows($query_alumno);
            if ($resultado_alumno > 0) {
                $dato_alumno = mysqli_fetch_array($query_alumno);
                $_SESSION['active'] = true;
                $_SESSION['rol'] = 9;
                $_SESSION['id_alumno_preparatoria'] = $dato_alumno['id_alumno'];
                $_SESSION['nombre'] = $dato_alumno['nombre'];
                $_SESSION['user'] = $dato_alumno['usuario'];
                $_SESSION['id_escuela'] = $dato_alumno['id_escuela'];
                /*AÑADIENDO NUEVA CONEXIÓN */
                $id_usuario = $_SESSION['id_alumno_preparatoria'];
                $query_insert_conexion = mysqli_query($conexion, "INSERT INTO conexiones(tipo, id_usuario) values ('alumno_preparatoria', $id_usuario)");
                //Contador de conexiones
                $user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM alumnos_preparatoria WHERE id_alumno = $id_usuario"));
                $cont = intval($user['conexiones'] + 1);
                $id_escuela = $user['id_escuela'];
                $query_insert_visita = mysqli_query($conexion, "INSERT INTO visitas(tipo, id_escuela) values ('alumno', $id_escuela)");
                $sql_cont = "UPDATE `alumnos_preparatoria` SET `conexiones`= '$cont'  WHERE id_alumno = '$id_usuario'";
                $query_cont = mysqli_query($conexion, $sql_cont);
                /*FIN NUEVA CONEXIÓN */
                header('location: alumno/preparatoria/perfil.php');
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrecta
                 </div>';
                session_destroy();
            }
        } else if ($result_validar_docente_preparatoria > 0) {
            $query_docente = mysqli_query($conexion, "SELECT * FROM docentes_preparatoria WHERE usuario = '$user' AND contrasena = '$contrasena'");
            $resultado_docente = mysqli_num_rows($query_docente);
            if ($resultado_docente > 0) {
                $dato_docente = mysqli_fetch_array($query_docente);
                $_SESSION['active'] = true;
                $_SESSION['rol'] = 10;
                $_SESSION['id_docente_preparatoria'] = $dato_docente['id_docente'];
                $_SESSION['nombre'] = $dato_docente['nombre'];
                $_SESSION['user'] = $dato_docente['usuario'];
                /*AÑADIENDO NUEVA CONEXIÓN */
                $id_usuario = $_SESSION['id_docente_preparatoria'];
                $query_insert_conexion = mysqli_query($conexion, "INSERT INTO conexiones(tipo, id_usuario) values ('docente_preparatoria', $id_usuario)");
                //Contador de conexiones
                $user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM docentes_preparatoria WHERE id_docente = $id_usuario"));
                $cont = intval($user['conexiones'] + 1);
                $id_escuela = $user['id_escuela'];
                $query_insert_visita = mysqli_query($conexion, "INSERT INTO visitas(tipo, id_escuela) values ('docente', $id_escuela)");
                $sql_cont = "UPDATE `docentes_preparatoria` SET `conexiones`= '$cont'  WHERE id_docente = '$id_usuario'";
                $query_cont = mysqli_query($conexion, $sql_cont);
                /*FIN NUEVA CONEXIÓN */
                header('location: docente-preparatoria/dashboard.php');
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrecta
                 </div>';
                session_destroy();
            }
        } else if ($result_validar_director_preparatoria > 0) {
            $query_director = mysqli_query($conexion, "SELECT * FROM directores_preparatoria WHERE usuario = '$user' AND contrasena = '$contrasena'");
            $resultado_director = mysqli_num_rows($query_director);
            if ($resultado_director > 0) {
                $dato_director = mysqli_fetch_array($query_director);
                $_SESSION['active'] = true;
                $_SESSION['rol'] = 11;
                $_SESSION['id_director_preparatoria'] = $dato_director['id_director'];
                $_SESSION['nombre'] = $dato_director['nombre'];
                $_SESSION['user'] = $dato_director['usuario'];
                header('location: director/preparatoria/dashboard.php');
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrecta
                 </div>';
                session_destroy();
            }
        } else if ($result_validar_alumno_universidad > 0) {
            $query_alumno = mysqli_query($conexion, "SELECT * FROM alumnos_universidad WHERE usuario = '$user' AND contrasena = '$contrasena'");
            $resultado_alumno = mysqli_num_rows($query_alumno);
            if ($resultado_alumno > 0) {
                $dato_alumno = mysqli_fetch_array($query_alumno);
                $_SESSION['active'] = true;
                $_SESSION['rol'] = 12;
                $_SESSION['id_alumno_universidad'] = $dato_alumno['id_alumno'];
                $_SESSION['nombre'] = $dato_alumno['nombre'];
                $_SESSION['user'] = $dato_alumno['usuario'];
                $_SESSION['id_escuela'] = $dato_alumno['id_escuela'];
                /*AÑADIENDO NUEVA CONEXIÓN */
                $id_usuario = $_SESSION['id_alumno_universidad'];
                $query_insert_conexion = mysqli_query($conexion, "INSERT INTO conexiones(tipo, id_usuario) values ('alumno_universidad', $id_usuario)");
                //Contador de conexiones
                $user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM alumnos_universidad WHERE id_alumno = $id_usuario"));
                $cont = intval($user['conexiones'] + 1);
                $id_escuela = $user['id_escuela'];
                $query_insert_visita = mysqli_query($conexion, "INSERT INTO visitas(tipo, id_escuela) values ('alumno', $id_escuela)");
                $sql_cont = "UPDATE `alumnos_universidad` SET `conexiones`= '$cont'  WHERE id_alumno = '$id_usuario'";
                $query_cont = mysqli_query($conexion, $sql_cont);
                /*FIN NUEVA CONEXIÓN */
                header('location: alumno/universidad/perfil.php');
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrecta
                 </div>';
                session_destroy();
            }
        } else if ($result_validar_docente_universidad > 0) {
            $query_docente = mysqli_query($conexion, "SELECT * FROM docentes_universidad WHERE usuario = '$user' AND contrasena = '$contrasena'");
            $resultado_docente = mysqli_num_rows($query_docente);
            if ($resultado_docente > 0) {
                $dato_docente = mysqli_fetch_array($query_docente);
                $_SESSION['active'] = true;
                $_SESSION['rol'] = 13;
                $_SESSION['id_docente_universidad'] = $dato_docente['id_docente'];
                $_SESSION['nombre'] = $dato_docente['nombre'];
                $_SESSION['user'] = $dato_docente['usuario'];
                /*AÑADIENDO NUEVA CONEXIÓN */
                $id_usuario = $_SESSION['id_docente_universidad'];
                $query_insert_conexion = mysqli_query($conexion, "INSERT INTO conexiones(tipo, id_usuario) values ('docente_universidad', $id_usuario)");
                //Contador de conexiones
                $user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM docentes_universidad WHERE id_docente = $id_usuario"));
                $cont = intval($user['conexiones'] + 1);
                $id_escuela = $user['id_escuela'];
                $query_insert_visita = mysqli_query($conexion, "INSERT INTO visitas(tipo, id_escuela) values ('docente', $id_escuela)");
                $sql_cont = "UPDATE `docentes_universidad` SET `conexiones`= '$cont'  WHERE id_docente = '$id_usuario'";
                $query_cont = mysqli_query($conexion, $sql_cont);
                /*FIN NUEVA CONEXIÓN */
                header('location: docente-universidad/dashboard.php');
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrecta
                 </div>';
                session_destroy();
            }
        } else if ($result_validar_director_universidad > 0) {
            $query_director = mysqli_query($conexion, "SELECT * FROM directores_universidad WHERE usuario = '$user' AND contrasena = '$contrasena'");
            $resultado_director = mysqli_num_rows($query_director);
            if ($resultado_director > 0) {
                $dato_director = mysqli_fetch_array($query_director);
                $_SESSION['active'] = true;
                $_SESSION['rol'] = 14;
                $_SESSION['id_director_universidad'] = $dato_director['id_director'];
                $_SESSION['nombre'] = $dato_director['nombre'];
                $_SESSION['user'] = $dato_director['usuario'];
                header('location: director/universidad/dashboard.php');
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrecta
                 </div>';
                session_destroy();
            }
        } else if ($result_validar_alumno_personal > 0) {
            $query_alumno = mysqli_query($conexion, "SELECT * FROM alumnos_personal WHERE usuario = '$user' AND contrasena = '$contrasena'");
            $resultado_alumno = mysqli_num_rows($query_alumno);
            if ($resultado_alumno > 0) {
                $dato_alumno = mysqli_fetch_array($query_alumno);
                $_SESSION['active'] = true;
                $_SESSION['rol'] = 15;
                $_SESSION['id_alumno_personal'] = $dato_alumno['id_alumno'];
                $_SESSION['nombre'] = $dato_alumno['nombre'];
                $_SESSION['user'] = $dato_alumno['usuario'];
                /*AÑADIENDO NUEVA CONEXIÓN */
                $id_usuario = $_SESSION['id_alumno_personal'];
                $query_insert_conexion = mysqli_query($conexion, "INSERT INTO conexiones(tipo, id_usuario) values ('alumno_personal', $id_usuario)");
                //Contador de conexiones
                $user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM alumnos_personal WHERE id_alumno = $id_usuario"));
                $cont = intval($user['conexiones'] + 1);
                $sql_cont = "UPDATE `alumnos_personal` SET `conexiones`= '$cont'  WHERE id_alumno = '$id_usuario'";
                $query_cont = mysqli_query($conexion, $sql_cont);
                /*FIN NUEVA CONEXIÓN */
                header('location: alumno/personal/perfil.php');
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrecta
                 </div>';
                session_destroy();
            }
        } else if ($result_validar_docente_personal > 0) {
            $query_docente = mysqli_query($conexion, "SELECT * FROM docentes_personal WHERE usuario = '$user' AND contrasena = '$contrasena'");
            $resultado_docente = mysqli_num_rows($query_docente);
            if ($resultado_docente > 0) {
                $dato_docente = mysqli_fetch_array($query_docente);
                $_SESSION['active'] = true;
                $_SESSION['rol'] = 16;
                $_SESSION['id_docente_personal'] = $dato_docente['id_docente'];
                $_SESSION['nombre'] = $dato_docente['nombre'];
                $_SESSION['user'] = $dato_docente['usuario'];
                /*AÑADIENDO NUEVA CONEXIÓN */
                $id_usuario = $_SESSION['id_docente_personal'];
                $query_insert_conexion = mysqli_query($conexion, "INSERT INTO conexiones(tipo, id_usuario) values ('docente_personal', $id_usuario)");
                /*FIN NUEVA CONEXIÓN */
                header('location: docente-personal/dashboard.php');
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrecta
                 </div>';
                session_destroy();
            }
        } else if ($result_validar_director_personal > 0) {
            $query_director = mysqli_query($conexion, "SELECT * FROM directores_personal WHERE usuario = '$user' AND contrasena = '$contrasena'");
            $resultado_director = mysqli_num_rows($query_director);
            if ($resultado_director > 0) {
                $dato_director = mysqli_fetch_array($query_director);
                $_SESSION['active'] = true;
                $_SESSION['rol'] = 17;
                $_SESSION['id_director_personal'] = $dato_director['id_director'];
                $_SESSION['nombre'] = $dato_director['nombre'];
                $_SESSION['user'] = $dato_director['usuario'];
                header('location: director/perfil.php');
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrecta
                 </div>';
                session_destroy();
            }
        } else if ($result_validar_director_institucional > 0) {
            $query_director_inst = mysqli_query($conexion, "SELECT * FROM director_institucional WHERE usuario = '$user' AND contrasena = '$contrasena'");
            $resultado_director_inst = mysqli_num_rows($query_director_inst);
            if ($resultado_director_inst > 0) {
                $dato_director = mysqli_fetch_array($query_director_inst);
                $_SESSION['active'] = true;
                $_SESSION['rol'] = 18;
                $_SESSION['id_director'] = $dato_director['id_director'];
                $_SESSION['nombre'] = $dato_director['nombre'];
                $_SESSION['user'] = $dato_director['usuario'];
                header('location: Director-institucional/dashboard.php');
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrecta
                 </div>';
                session_destroy();
            }
        } else if ($result_validar_temp_account > 0) {
            $query_temp_account = mysqli_query($conexion, "SELECT * FROM temp_account WHERE username = '$user' AND password = '$contrasena' ");
            $resultado_temp_account = mysqli_num_rows($query_temp_account);
            if ($resultado_temp_account > 0) {

                $temp_account = mysqli_fetch_array($query_temp_account);

                if ($temp_account['status'] == 0) {
                    $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                            Cuenta vencida
                     </div>';
                    session_destroy();
                } else {
                    $_SESSION['active'] = true;
                    $_SESSION['rol'] = 19;
                    $_SESSION['id'] = $temp_account['id'];
                    $_SESSION['nombre'] = $temp_account['nombre'];
                    $_SESSION['username'] = $temp_account['username'];
                    $_SESSION['fechaRegistro'] = $temp_account['fechaRegistro'];
                    header('location: alumno/institucional/perfil.php');
                }
            } else {
                $alert = '<div style="color: red; margin-left: 80px;" class="alert alert-danger" role="alert">
                Usuario o contraseña incorrecta
                </div>';
                session_destroy();
            }
        }
    }
}
// }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="acciones/img/lgk.png">
    <link rel="stylesheet" href="acciones/css/indexL.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/23412c6a8d.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script>
        if (/Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            window.location = "bloqueo.html";
        }
    </script> -->
</head>

<!-- Registro para prepa, uni, docente y personal -->

<body onload="recuperarDatos()">
    <i id="abrir" onclick="abrirMenu();" class="fas fa-bars"></i>
    <div class="nav" id="nav">
        <p class="btn-nav" onclick="login();">Conoce Koutilab</p>
        <p class="btn-nav" onclick="paquetes();">Adquiere un paquete</p>
        <p class="btn-nav" id="prueba" onclick="prueba();">Prueba gratuita</p>
        <i id="cerrar" onclick="cerrarMenu();" class="fas fa-times"></i>
    </div>
    <div class="container">
        <div class="info-box">
            <div class="titl-info">
                <p>Bienvenido a</p>
            </div>
            <div class="logop">
                <img src="acciones/img/benvenida.png" alt="KOUTILAB">
            </div>
            <div class="separacion">
                <div class="linea"></div>
            </div>
            <div class="separacion">
                <div class="txt-info">
                    <p>La <b>PLATAFORMA EDUCATIVA</b> especializada en <b>CODING</b> para instituciones, escuelas y usuarios</p>
                </div>
            </div>
        </div>
        <div class="form-box">
            <!-- <form action="" id="Ingresar" class="input-group" method="POST">
                <div class="form-group">
                    <br>
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <input type="text" id="usuario_inicio" onkeyup="agregarArrobaInicio()" name="usuario" class="input-field" placeholder="Nombre de usuario" value="<?php if (isset($user)) echo $user; ?>" required>
                </div>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fas fa-user-lock"></i>
                    </div>
                    <input type="password" id="contrasena_inicio" name="contrasena" class="input-field password1" value="<?php if (isset($password)) echo $password; ?>" placeholder="Contraseña" required>
                    <span class="fa fa-fw fa-eye password-icon show-password1"></span>

                </div>
                <div class="alert alert-danger text-center d-none" id="alerta" role="alert">

                </div>
                <?php // echo isset($alert) ? $alert : ''; 
                ?>

                <input type="checkbox" id="checkbox" class="check-box" style="scale: 90%;"><span style="margin: 0 0 -10px 0;">Recordar contraseña</span>

                <a href="recuperar-contrasena.php" class="remember">Olvidé mi contraseña</a>

                <button type="submit" name="iniciar_sesion" class="submit-btn" style="margin: -2px 0 0 50px;">Acceder</button>
            </form> -->
            <div class="reg">
                <p>Registrarse</p>
            </div>
            <p></p>
            <div class="pasos">
                <div class="line"></div>
                <div class="circle">
                    <p>1</p>
                </div>
                <div class="circle">
                    <div class="circle-white">
                        <p style="color: #000000;">2</p>
                    </div>
                </div>
                <div class="circle">
                    <p>3</p>
                </div>
            </div>
            <p class="preg">Ingresa los datos requeridos</p>
            <form action="" method="POST" id="Registrarse" class="input-group1">
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <input type="text" id="nombre_registar" name="nombre_registrar" class="input-field2" placeholder="Nombre(s)" onkeyup="generarNombreUsuario();" required>
                </div>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <input type="text" id="apellidop_registrar" name="apellidop_registrar" class="input-field2" placeholder="Apellido paterno" onkeyup="generarNombreUsuario();" required>
                </div>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <input type="text" id="apellidom_registrar" name="apellidom_registrar" class="input-field2" placeholder="Apellido materno" onkeyup="generarNombreUsuario();" required>
                </div>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <input type="text" id="usuario_registrar" name="usuario_registrar" class="input-field2" placeholder="@usuario" readonly required>
                </div>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <input type="email" id="email_registrar" name="email_registrar" class="input-field2" placeholder="Correo electrónico" required>
                </div>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <select id="tipo_registrar" name="tipo_registrar" class="select-field" required>
                        <option value="..." disabled selected>Modelo de licencia</option>
                        <option value="Licencia">Licencia</option>
                        <option value="Freemium">Freemium</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fas fa-user-lock"></i>
                    </div>
                    <input type="password" id="contrasena_registrar" name="contrasena_registrar" class="input-field2 password3" placeholder="Contraseña" required>
                    <span class="fa fa-fw fa-eye password-icon show-password3" style="margin: -27px 25px 0 0;"></span>
                </div>
                <div class="form-group" style="margin-bottom: 5px;">
                    <div class="input-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <input type="password" id="clave_registrar" name="clave_registrar" class="input-field2 password4" placeholder="Clave" required>
                    <span class="fa fa-fw fa-eye password-icon show-password4" style="margin: -27px 25px 0 0;"></span>

                </div>

                <input type="checkbox" class="check-box1" required><span>Acepto los <a class="term" href="./acciones/pdf/Términos y condiciones_KoutiLab.pdf" target="_blank">términos y condiciones</a></span>

                <div class="sub-btn" style="margin: -10px 0 0 0;">
                    <button type="submit" name="registrar_usuario" class="submit-btn" style="scale: 70%;">Registrarse</button>
                </div>
            </form>
        </div>
    </div>
    <div class="footer-logo">
        <img src="img/koutilab.png" alt="">
    </div>

    <script>
        var ul = document.getElementById('nav');
        var cerrar = document.getElementById('cerrar');
        var abrir = document.getElementById('abrir');

        function abrirMenu() {
            ul.style.cssText = "left: 0;"
        }

        function cerrarMenu() {
            ul.style.cssText = "left: -100%;"
        }

        function login() {
            window.location.href = "./conoce-koutilab.php";
        }

        function prueba() {
            window.location.href = "./alumno-estructura/prueba/rutas/ruta-prueba.php";
        }

        function paquetes() {
            window.location.href = "./paquetes/adquirir-paquete.php";
        }
    </script>

    <script>
        function redirigir() {
            window.location.href = './cuenta-creada.php'
        }
    </script>

    <?php
    function eliminar_tildes($cadena)
    {
        //Ahora reemplazamos las letras
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );

        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena
        );

        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena
        );

        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena
        );

        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena
        );

        $cadena = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $cadena
        );

        return $cadena;
    }

    if (isset($_POST['registrar_usuario']) && !empty($_POST['clave_registrar'])) {
        require_once "acciones/conexion.php";

        $nombre_registrar = $_POST['nombre_registrar'];
        $apellidop_registrar = $_POST['apellidop_registrar'];
        $apellidom_registrar = $_POST['apellidom_registrar'];
        $usuario_registrar = $_POST['usuario_registrar'];
        $contrasena_registrar = md5($_POST['contrasena_registrar']);
        $contrasena_correo = $_POST['contrasena_registrar'];
        $clave_registrar = $_POST['clave_registrar'];
        $email_registrar = $_POST['email_registrar'];
        $tipo_registrar = $_POST['tipo_registrar'];

        //Hace mayusculas todos los nombres y elimina acentos, ñ, etc
        $nombre_registrar = strtoupper(eliminar_tildes($nombre_registrar));
        $apellidop_registrar = strtoupper(eliminar_tildes($apellidop_registrar));
        $apellidom_registrar = strtoupper(eliminar_tildes($apellidom_registrar));

        //Validar inicio de sesión de un admin principal
        $query_validar_admin = mysqli_query($conexion, "SELECT * FROM admin WHERE usuario = '$usuario_registrar'");
        $result_validar_admin = mysqli_fetch_array($query_validar_admin);

        //Validar inicio de sesión de un admin secundario
        $query_validar_admin_secundario = mysqli_query($conexion, "SELECT * FROM admin_secundario WHERE usuario = '$usuario_registrar'");
        $result_validar_admin_secundario = mysqli_fetch_array($query_validar_admin_secundario);

        //Validar inicio de sesión de un alumno de primaria
        $query_validar_alumno_primaria = mysqli_query($conexion, "SELECT * FROM alumnos_primaria WHERE usuario = '$usuario_registrar'");
        $result_validar_alumno_primaria = mysqli_fetch_array($query_validar_alumno_primaria);

        //Validar inicio de sesión de un docente de primaria
        $query_validar_docente_primaria = mysqli_query($conexion, "SELECT * FROM docentes_primaria WHERE usuario = '$usuario_registrar'");
        $result_validar_docente_primaria = mysqli_fetch_array($query_validar_docente_primaria);

        //Validar inicio de sesión de un director de primaria
        $query_validar_director_primaria = mysqli_query($conexion, "SELECT * FROM directores_primaria WHERE usuario = '$usuario_registrar'");
        $result_validar_director_primaria = mysqli_fetch_array($query_validar_director_primaria);

        //Validar inicio de sesión de un alumno de secundaria
        $query_validar_alumno_secundaria = mysqli_query($conexion, "SELECT * FROM alumnos_secundaria WHERE usuario = '$usuario_registrar'");
        $result_validar_alumno_secundaria = mysqli_fetch_array($query_validar_alumno_secundaria);

        //Validar inicio de sesión de un docente de secundaria
        $query_validar_docente_secundaria = mysqli_query($conexion, "SELECT * FROM docentes_secundaria WHERE usuario = '$usuario_registrar'");
        $result_validar_docente_secundaria = mysqli_fetch_array($query_validar_docente_secundaria);

        //Validar inicio de sesión de un director de secundaria
        $query_validar_director_secundaria = mysqli_query($conexion, "SELECT * FROM directores_secundaria WHERE usuario = '$usuario_registrar'");
        $result_validar_director_secundaria = mysqli_fetch_array($query_validar_director_secundaria);

        //Validar inicio de sesión de un alumno de preparatoria
        $query_validar_alumno_preparatoria = mysqli_query($conexion, "SELECT * FROM alumnos_preparatoria WHERE usuario = '$usuario_registrar'");
        $result_validar_alumno_preparatoria = mysqli_fetch_array($query_validar_alumno_preparatoria);

        //Validar inicio de sesión de un docente de preparatoria
        $query_validar_docente_preparatoria = mysqli_query($conexion, "SELECT * FROM docentes_preparatoria WHERE usuario = '$usuario_registrar'");
        $result_validar_docente_preparatoria = mysqli_fetch_array($query_validar_docente_preparatoria);

        //Validar inicio de sesión de un director de preparatoria
        $query_validar_director_preparatoria = mysqli_query($conexion, "SELECT * FROM directores_preparatoria WHERE usuario = '$usuario_registrar'");
        $result_validar_director_preparatoria = mysqli_fetch_array($query_validar_director_preparatoria);

        //Validar inicio de sesión de un alumno de universidad
        $query_validar_alumno_universidad = mysqli_query($conexion, "SELECT * FROM alumnos_universidad WHERE usuario = '$usuario_registrar'");
        $result_validar_alumno_universidad = mysqli_fetch_array($query_validar_alumno_universidad);

        //Validar inicio de sesión de un docente de universidad
        $query_validar_docente_universidad = mysqli_query($conexion, "SELECT * FROM docentes_universidad WHERE usuario = '$usuario_registrar'");
        $result_validar_docente_universidad = mysqli_fetch_array($query_validar_docente_universidad);

        //Validar inicio de sesión de un director de universidad
        $query_validar_director_universidad = mysqli_query($conexion, "SELECT * FROM directores_universidad WHERE usuario = '$usuario_registrar'");
        $result_validar_director_universidad = mysqli_fetch_array($query_validar_director_universidad);

        //Validar inicio de sesión de un alumno de personal
        $query_validar_alumno_personal = mysqli_query($conexion, "SELECT * FROM alumnos_personal WHERE usuario = '$usuario_registrar'");
        $result_validar_alumno_personal = mysqli_fetch_array($query_validar_alumno_personal);

        //Validar inicio de sesión de un alumno de institucional (temporal)
        $query_validar_alumno_institucional = mysqli_query($conexion, "SELECT * FROM temp_account WHERE username = '$usuario_registrar'");
        $result_validar_alumno_institucional = mysqli_fetch_array($query_validar_alumno_institucional);

        //Validar inicio de sesión de un director de institucional
        $query_validar_director_instituacional = mysqli_query($conexion, "SELECT * FROM director_institucional WHERE usuario = '$usuario_registrar'");
        $result_validar_director_institucional = mysqli_fetch_array($query_validar_director_instituacional);

        //Validar si correo ingresado ya existe 

        //Validar inicio de sesión de un admin

        //Validar inicio de sesión de un alumno de primaria
        $query_validar_alumno_primaria_correo = mysqli_query($conexion, "SELECT * FROM alumnos_primaria WHERE email = '$email_registrar'");
        $result_validar_alumno_primaria_correo = mysqli_fetch_array($query_validar_alumno_primaria_correo);

        //Validar inicio de sesión de un docente de primaria
        $query_validar_docente_primaria_correo = mysqli_query($conexion, "SELECT * FROM docentes_primaria WHERE email = '$email_registrar'");
        $result_validar_docente_primaria_correo = mysqli_fetch_array($query_validar_docente_primaria_correo);

        //Validar inicio de sesión de un director de primaria
        $query_validar_director_primaria_correo = mysqli_query($conexion, "SELECT * FROM directores_primaria WHERE email = '$email_registrar'");
        $result_validar_director_primaria_correo = mysqli_fetch_array($query_validar_director_primaria_correo);

        //Validar inicio de sesión de un alumno de secundaria
        $query_validar_alumno_secundaria_correo = mysqli_query($conexion, "SELECT * FROM alumnos_secundaria WHERE email = '$email_registrar'");
        $result_validar_alumno_secundaria_correo = mysqli_fetch_array($query_validar_alumno_secundaria_correo);

        //Validar inicio de sesión de un docente de secundaria
        $query_validar_docente_secundaria_correo = mysqli_query($conexion, "SELECT * FROM docentes_secundaria WHERE email = '$email_registrar'");
        $result_validar_docente_secundaria_correo = mysqli_fetch_array($query_validar_docente_secundaria_correo);

        //Validar inicio de sesión de un director de secundaria
        $query_validar_director_secundaria_correo = mysqli_query($conexion, "SELECT * FROM directores_secundaria WHERE email = '$email_registrar'");
        $result_validar_director_secundaria_correo = mysqli_fetch_array($query_validar_director_secundaria_correo);

        //Validar inicio de sesión de un alumno de preparatoria
        $query_validar_alumno_preparatoria_correo = mysqli_query($conexion, "SELECT * FROM alumnos_preparatoria WHERE email = '$email_registrar'");
        $result_validar_alumno_preparatoria_correo = mysqli_fetch_array($query_validar_alumno_preparatoria_correo);

        //Validar inicio de sesión de un docente de preparatoria
        $query_validar_docente_preparatoria_correo = mysqli_query($conexion, "SELECT * FROM docentes_preparatoria WHERE email = '$email_registrar'");
        $result_validar_docente_preparatoria_correo = mysqli_fetch_array($query_validar_docente_preparatoria_correo);

        //Validar inicio de sesión de un director de preparatoria
        $query_validar_director_preparatoria_correo = mysqli_query($conexion, "SELECT * FROM directores_preparatoria WHERE email = '$email_registrar'");
        $result_validar_director_preparatoria_correo = mysqli_fetch_array($query_validar_director_preparatoria_correo);

        //Validar inicio de sesión de un alumno de universidad
        $query_validar_alumno_universidad_correo = mysqli_query($conexion, "SELECT * FROM alumnos_universidad WHERE email = '$email_registrar'");
        $result_validar_alumno_universidad_correo = mysqli_fetch_array($query_validar_alumno_universidad_correo);

        //Validar inicio de sesión de un docente de universidad
        $query_validar_docente_universidad_correo = mysqli_query($conexion, "SELECT * FROM docentes_universidad WHERE email = '$email_registrar'");
        $result_validar_docente_universidad_correo = mysqli_fetch_array($query_validar_docente_universidad_correo);

        //Validar inicio de sesión de un director de universidad
        $query_validar_director_universidad_correo = mysqli_query($conexion, "SELECT * FROM directores_universidad WHERE email = '$email_registrar'");
        $result_validar_director_universidad_correo = mysqli_fetch_array($query_validar_director_universidad_correo);

        //Validar inicio de sesión de un alumno de personal
        $query_validar_alumno_personal_correo = mysqli_query($conexion, "SELECT * FROM alumnos_personal WHERE email = '$email_registrar'");
        $result_validar_alumno_personal_correo = mysqli_fetch_array($query_validar_alumno_personal_correo);

        //Validar inicio de sesión de un alumno de institucional (temporal)
        $query_validar_alumno_institucional_correo = mysqli_query($conexion, "SELECT * FROM temp_account WHERE email = '$email_registrar'");
        $result_validar_alumno_institucional_correo = mysqli_fetch_array($query_validar_alumno_institucional_correo);

        //Validar inicio de sesión de un director de institucional
        $query_validar_director_instituacional_correo = mysqli_query($conexion, "SELECT * FROM director_institucional WHERE email = '$email_registrar'");
        $result_validar_director_institucional_correo = mysqli_fetch_array($query_validar_director_instituacional_correo);

        //Validar inicio de sesión de un directores licencia y freemium
        $query_validar_director_instituacional_correo = mysqli_query($conexion, "SELECT * FROM directores WHERE email = '$email_registrar'");
        $result_validar_director_institucional_correo = mysqli_fetch_array($query_validar_director_instituacional_correo);

        //Validar creacion para cuenta temporal 
        //validar la clave del paquete en todos los paquetes que existan
        //si existe entonces genera el usuario y contraseña en la tabla temp_account con los respectivos datos
        //posteriormente llenar la relacion de cuenta temporal con director llamada UserDirector solo con el id_de la cuenta temporal y del director al que pertenece la clave del paquete

        //si no encuentra una clave registrada en la tabla de paquetes_director entonces mandar alerta clave no valida


        //Buscar si la clave pertenece a un alumno
        $query_clave_alumno = mysqli_query($conexion, "SELECT * FROM escuelas WHERE clave_alumno = '$clave_registrar'");
        $result_clave_alumno = mysqli_fetch_array($query_clave_alumno);
        $data_alumno = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM escuelas WHERE clave_alumno = '$clave_registrar'"));
        if (isset($data_alumno['id_escuela'])) {
            $id_escuela_alumno = $data_alumno['id_escuela'];
        }
        if (isset($data_alumno['nivel_educativo'])) {
            $nivel_educativo_alumno = $data_alumno['nivel_educativo'];
        }

        //Buscar si la clave pertenece a un docente
        $query_clave_docente = mysqli_query($conexion, "SELECT * FROM escuelas WHERE clave_docente = '$clave_registrar'");
        $result_clave_docente = mysqli_fetch_array($query_clave_docente);
        $data_docente = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM escuelas WHERE clave_docente = '$clave_registrar'"));
        if (isset($data_docente['id_escuela'])) {
            $id_escuela_docente = $data_docente['id_escuela'];
        }
        if (isset($data_docente['nivel_educativo'])) {
            $nivel_educativo_docente = $data_docente['nivel_educativo'];
        }

        //Buscar si la clave pertenece a un director
        $query_clave_director = mysqli_query($conexion, "SELECT * FROM escuelas WHERE clave_director = '$clave_registrar'");
        $result_clave_director = mysqli_fetch_array($query_clave_director);
        $data_director = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM escuelas WHERE clave_director = '$clave_registrar'"));
        if (isset($data_director['id_escuela'])) {
            $id_escuela_director = $data_director['id_escuela'];
        }
        if (isset($data_director['nivel_educativo'])) {
            $nivel_educativo_director = $data_director['nivel_educativo'];
        }

        //Validar creacion para cuenta temporal 
        //validar la clave del paquete en todos los paquetes que existan
        //si existe entonces genera el usuario y contraseña en la tabla temp_account con los respectivos datos
        //posteriormente llenar la relacion de cuenta temporal con director llamada UserDirector solo con el id_de la cuenta temporal y del director al que pertenece la clave del paquete

        //si no encuentra una clave registrada en la tabla de paquetes_director entonces mandar alerta clave no valida

        //Buscar si la clave pertenece a un paquete de director institucional
        $query_clave_paquete_director = mysqli_query($conexion, "SELECT di.id_director, pd.clave, pd.cupo FROM paquete_director pd JOIN director_institucional di ON pd.id_director = di.id_director WHERE pd.clave = '$clave_registrar'");
        $result_clave_paquete_director = mysqli_fetch_array($query_clave_paquete_director);
        $data_paquete_director = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT di.id_director, pd.clave, pd.cupo FROM paquete_director pd JOIN director_institucional di ON pd.id_director = di.id_director WHERE pd.clave = '$clave_registrar'"));
        if (isset($data_paquete_director['id_escuela'])) {
            $id_escuela_director_institucional = $data_paquete_director['id_escuela'];
        }
        if (isset($data_paquete_director['cupo'])) {
            $cupos_paquete_director = $data_paquete_director['cupo'];
        }
        if (isset($data_paquete_director['id_director'])) {
            $id_director_institucional = $data_paquete_director['id_director'];
        }

        if ($result_validar_admin > 0 || $result_validar_admin_secundario > 0  || $result_validar_alumno_primaria > 0 || $result_validar_docente_primaria > 0 || $result_validar_director_primaria > 0 || $result_validar_alumno_secundaria > 0 || $result_validar_docente_secundaria > 0 || $result_validar_director_secundaria > 0 || $result_validar_alumno_preparatoria > 0 || $result_validar_docente_preparatoria > 0 || $result_validar_director_preparatoria > 0 || $result_validar_alumno_universidad > 0 || $result_validar_docente_universidad > 0 || $result_validar_director_universidad > 0 || $result_validar_alumno_personal > 0 || $result_validar_alumno_institucional > 0 || $result_validar_director_institucional > 0) {
            echo
            "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: 'Usuario ya existente',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.reload();
          }
        });
      </script>
        ";
        } else if ($result_validar_alumno_primaria_correo > 0 || $result_validar_docente_primaria_correo > 0 || $result_validar_director_primaria_correo > 0 || $result_validar_alumno_secundaria_correo > 0 || $result_validar_docente_secundaria_correo > 0 || $result_validar_director_secundaria_correo > 0 || $result_validar_alumno_preparatoria_correo > 0 || $result_validar_docente_preparatoria_correo > 0 || $result_validar_director_preparatoria_correo > 0 || $result_validar_alumno_universidad_correo > 0 || $result_validar_docente_universidad_correo > 0 || $result_validar_director_universidad_correo > 0 || $result_validar_alumno_personal_correo > 0 || $result_validar_alumno_institucional_correo > 0 || $result_validar_director_institucional_correo > 0) {
            echo
            "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: 'Correo ya utilizado en otro usuario',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.reload();
          }
        });
      </script>
        ";
        } else {

            // Consulta para verificar la clave en tabla_claves
            $query_tabla_claves = "SELECT * FROM tabla_claves WHERE clave = '$clave_registrar' AND usos_restantes > 0";
            $result_tabla_claves = $conexion->query($query_tabla_claves);

            // Consulta para verificar la clave en escuelas (tipo_modelo = 2)
            $query_escuelas = "SELECT * FROM escuelas WHERE (clave_alumno = '$clave_registrar' OR clave_docente = '$clave_registrar' OR clave_director = '$clave_registrar') AND tipo_modelo = 2";
            $result_escuelas = $conexion->query($query_escuelas);

            if ($result_tabla_claves->num_rows > 0 || $result_escuelas->num_rows > 0) {
                $rowresult_tabla_claves = $result_tabla_claves->fetch_assoc();
                $rowresult_escuelas = $result_escuelas->fetch_assoc();
                $fecha_expiracion = $rowresult_tabla_claves["fecha_expiracion"];
                $usos_restantes = $rowresult_tabla_claves['usos_restantes'];
                $tipo_modelo = $rowresult_escuelas['tipo_modelo'];

                // Verificar si todavía hay días disponibles
                $fecha_actual = date("Y-m-d"); // Obtener la fecha actual en el formato de la base de datos

                if ($fecha_actual <= $fecha_expiracion || $result_escuelas->num_rows > 0) {
                    if ($result_clave_alumno > 0 && $nivel_educativo_alumno == 'Primaria') {
                        $query_insert_alumno = mysqli_query($conexion, "INSERT INTO alumnos_primaria(nombre, apellidop, apellidom, usuario, contrasena, clave, clave_secreta, id_escuela, image, fondo) values ('$nombre_registrar', '$apellidop_registrar', '$apellidom_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', '$clave_secreta', $id_escuela_alumno, 'Mascota-Aerobot-01.png', 'portada-1.png')");

                        if ($query_insert_alumno) {

                            if ($usos_restantes > 0 && $tipo_modelo == 1) {
                                // Es una licencia, puedes restar un uso a la clave
                                $update_query = "UPDATE tabla_claves SET usos_restantes = usos_restantes - 1 WHERE clave = '$clave_registrar'";
                                $conexion->query($update_query);
                            }

                            include('envio-correo.php');
                            echo "
                            <script>
                                redirigir();
                            </script>
                            ";

                            //                 echo
                            //                 "
                            //   <script>
                            //   Swal.fire({
                            //       title: '¡Excelente!',
                            //       text: 'Registro de alumno exitoso',
                            //       icon: 'success',
                            //       confirmButtonColor: '#3085d6',
                            //       confirmButtonText: 'Aceptar',
                            //     }).then((result) => {
                            //       if (result.isConfirmed) {
                            //           window.location.href = 'cuenta-creada.php';
                            //       }
                            //     });
                            //   </>
                            //     ";
                        } else {
                            echo
                            "
              <script>
              Swal.fire({
                  title: '¡Advertencia!',
                  text: '¡Algo salió mal!',
                  icon: 'info',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Reintentar',
                }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.reload();
                  }
                });
              </script>
                ";
                        }
                    } else if ($result_clave_alumno > 0 && $nivel_educativo_alumno == 'Secundaria') {
                        $query_insert_alumno = mysqli_query($conexion, "INSERT INTO alumnos_secundaria(nombre, apellidop, apellidom, usuario, contrasena, clave, clave_secreta, id_escuela, image, fondo) values ('$nombre_registrar', '$apellidop_registrar', '$apellidom_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', '$clave_secreta', $id_escuela_alumno, 'Mascota-Aerobot-01.png', 'portada-1.png')");
                        if ($query_insert_alumno) {
                            if ($usos_restantes > 0 && $tipo_modelo == 1) {
                                // Es una licencia, puedes restar un uso a la clave
                                $update_query = "UPDATE tabla_claves SET usos_restantes = usos_restantes - 1 WHERE clave = '$clave_registrar'";
                                $conexion->query($update_query);
                            }
                            include('envio-correo.php');
                            echo "
                            <script>
                                redirigir();
                            </script>
                            ";

                            //                 echo
                            //                 "
                            //   <script>
                            //   Swal.fire({
                            //       title: '¡Excelente!',
                            //       text: 'Registro de alumno exitoso',
                            //       icon: 'success',
                            //       confirmButtonColor: '#3085d6',
                            //       confirmButtonText: 'Aceptar',
                            //     }).then((result) => {
                            //       if (result.isConfirmed) {
                            //           window.location.href = 'index.php';
                            //       }
                            //     });
                            //   </script>
                            //     ";
                        } else {
                            echo
                            "
              <script>
              Swal.fire({
                  title: '¡Advertencia!',
                  text: '¡Algo salió mal!',
                  icon: 'info',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Reintentar',
                }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = 'index.php';
                  }
                });
              </script>
                ";
                        }
                    } else if ($result_clave_alumno > 0 && $nivel_educativo_alumno == 'Preparatoria') {
                        $query_insert_alumno = mysqli_query($conexion, "INSERT INTO alumnos_preparatoria(nombre, usuario, contrasena, clave, id_escuela, email, image, fondo) values ('$nombre_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', $id_escuela_alumno, '$email_registrar', 'Mascota-Aerobot-01.png', 'portada-1.png')");
                        if ($query_insert_alumno) {
                            if ($usos_restantes > 0 && $tipo_modelo == 1) {
                                // Es una licencia, puedes restar un uso a la clave
                                $update_query = "UPDATE tabla_claves SET usos_restantes = usos_restantes - 1 WHERE clave = '$clave_registrar'";
                                $conexion->query($update_query);
                            }

                            include('envio-correo.php');

                            echo
                            "
              <script>
              Swal.fire({
                  title: '¡Excelente!',
                  text: 'Registro de alumno exitoso',
                  icon: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Aceptar',
                }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = 'index.php';
                  }
                });
              </script>
                ";
                        } else {

                            echo
                            "
              <script>
              Swal.fire({
                  title: '¡Advertencia!',
                  text: '¡Algo salió mal!',
                  icon: 'info',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Reintentar',
                }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = 'index.php';
                  }
                });
              </script>
                ";
                        }
                    } else if ($result_clave_alumno > 0 && $nivel_educativo_alumno == 'Universidad') {
                        $query_insert_alumno = mysqli_query($conexion, "INSERT INTO alumnos_universidad(nombre, usuario, contrasena, clave, id_escuela, email, image, fondo) values ('$nombre_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', $id_escuela_alumno, '$email_registrar', 'Mascota-Aerobot-01.png', 'portada-1.png')");
                        if ($query_insert_alumno) {
                            if ($usos_restantes > 0 && $tipo_modelo == 1) {
                                // Es una licencia, puedes restar un uso a la clave
                                $update_query = "UPDATE tabla_claves SET usos_restantes = usos_restantes - 1 WHERE clave = '$clave_registrar'";
                                $conexion->query($update_query);
                            }

                            include('envio-correo.php');

                            echo
                            "
              <script>
              Swal.fire({
                  title: '¡Excelente!',
                  text: 'Registro de alumno exitoso',
                  icon: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Aceptar',
                }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = 'index.php';
                  }
                });
              </script>
                ";
                        } else {
                            echo
                            "
              <script>
              Swal.fire({
                  title: '¡Advertencia!',
                  text: '¡Algo salió mal!',
                  icon: 'info',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Reintentar',
                }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = 'index.php';
                  }
                });
              </script>
                ";
                        }
                    }
                } else {
                    echo "
            <script>
            Swal.fire({
                title: '¡Error!',
                text: 'No se cumplen las condiciones para el registro',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
            </script>
            ";
                }
            } else if ($result_clave_docente > 0 && $nivel_educativo_docente == 'Primaria') {
                $query_insert_docente = mysqli_query($conexion, "INSERT INTO docentes_primaria(nombre, usuario, contrasena, clave, id_escuela, email) values ('$nombre_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', $id_escuela_docente, '$email_registrar')");
                if ($query_insert_docente) {

                    include('envio-correo.php');

                    echo
                    "
      <script>
      Swal.fire({
          title: '¡Excelente!',
          text: 'Registro de docente exitoso',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
        ";
                } else {
                    echo
                    "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: '¡Algo salió mal!',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
        ";
                }
            } else if ($result_clave_docente > 0 && $nivel_educativo_docente == 'Secundaria') {
                $query_insert_docente = mysqli_query($conexion, "INSERT INTO docentes_secundaria(nombre, usuario, contrasena, clave, id_escuela, email) values ('$nombre_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', $id_escuela_docente, '$email_registrar')");
                if ($query_insert_docente) {

                    include('envio-correo.php');

                    echo
                    "
      <script>
      Swal.fire({
          title: '¡Excelente!',
          text: 'Registro de docente exitoso',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
        ";
                } else {
                    echo
                    "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: '¡Algo salió mal!',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
        ";
                }
            } else if ($result_clave_docente > 0 && $nivel_educativo_docente == 'Preparatoria') {
                $query_insert_docente = mysqli_query($conexion, "INSERT INTO docentes_preparatoria(nombre, usuario, contrasena, clave, id_escuela, email) values ('$nombre_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', $id_escuela_docente, '$email_registrar')");
                if ($query_insert_docente) {

                    include('envio-correo.php');

                    echo
                    "
      <script>
      Swal.fire({
          title: '¡Excelente!',
          text: 'Registro de docente exitoso',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
        ";
                } else {
                    echo
                    "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: '¡Algo salió mal!',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
        ";
                }
            } else if ($result_clave_docente > 0 && $nivel_educativo_docente == 'Universidad') {
                $query_insert_docente = mysqli_query($conexion, "INSERT INTO docentes_universidad(nombre, usuario, contrasena, clave, id_escuela, email) values ('$nombre_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', $id_escuela_docente, '$email_registrar')");
                if ($query_insert_docente) {

                    include('envio-correo.php');

                    echo
                    "
      <script>
      Swal.fire({
          title: '¡Excelente!',
          text: 'Registro de docente exitoso',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
        ";
                } else {
                    echo
                    "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: '¡Algo salió mal!',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
        ";
                }
            } else if ($result_clave_director > 0 && $nivel_educativo_director == 'Primaria') {
                $query_insert_director = mysqli_query($conexion, "INSERT INTO directores(nombre, apellidop, apellidom, usuario, contrasena, clave, email, image, id_escuela, tipo) values ('$nombre_registrar', '$apellidop_registrar', '$apellidom_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', '$email_registrar', 'Director Primaria - 2023.11.23 - 10.05.00pm.jpg', '$id_escuela_director', '$tipo_registrar')");
                // $query_insert_director = mysqli_query($conexion, "INSERT INTO directores_primaria(nombre, usuario, contrasena, clave, id_escuela, email) values ('$nombre_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', $id_escuela_director, '$email_registrar')");
                if ($query_insert_director) {

                    include('envio-correo.php');
                    echo "
                            <script>
                                redirigir();
                            </script>
                            ";

                    //                 echo
                    //                 "
                    //   <script>
                    //   Swal.fire({
                    //       title: '¡Excelente!',
                    //       text: 'Registro de director exitoso',
                    //       icon: 'success',
                    //       confirmButtonColor: '#3085d6',
                    //       confirmButtonText: 'Aceptar',
                    //     }).then((result) => {
                    //       if (result.isConfirmed) {
                    //           window.location.href = 'index.php';
                    //       }
                    //     });
                    //   </script>
                    //     ";
                } else {
                    echo
                    "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: '¡Algo salió mal!',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
        ";
                }
            } else if ($result_clave_director > 0 && $nivel_educativo_director == 'Secundaria') {
                $query_insert_director = mysqli_query($conexion, "INSERT INTO directores(nombre, apellidop, apellidom, usuario, contrasena, clave, email, image, id_escuela, tipo) values ('$nombre_registrar', '$apellidop_registrar', '$apellidom_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', '$email_registrar', 'Director Primaria - 2023.11.23 - 10.05.00pm.jpg', '$id_escuela_director', '$tipo_registrar')");
                // $query_insert_director = mysqli_query($conexion, "INSERT INTO directores_secundaria(nombre, usuario, contrasena, clave, id_escuela, email) values ('$nombre_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', $id_escuela_director, '$email_registrar')");
                if ($query_insert_director) {

                    include('envio-correo.php');
                    echo "
                    <script>
                        redirigir();
                    </script>
                    ";
                    //                 echo
                    //                 "
                    //   <script>
                    //   Swal.fire({
                    //       title: '¡Excelente!',
                    //       text: 'Registro de director exitoso',
                    //       icon: 'success',
                    //       confirmButtonColor: '#3085d6',
                    //       confirmButtonText: 'Aceptar',
                    //     }).then((result) => {
                    //       if (result.isConfirmed) {
                    //           window.location.href = 'index.php';
                    //       }
                    //     });
                    //   </script>
                    //     ";
                } else {
                    echo
                    "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: '¡Algo salió mal!',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
        ";
                }
            } else if ($result_clave_director > 0 && $nivel_educativo_director == 'Preparatoria') {
                $query_insert_director = mysqli_query($conexion, "INSERT INTO directores(nombre, apellidop, apellidom, usuario, contrasena, clave, email, image, id_escuela, tipo) values ('$nombre_registrar', '$apellidop_registrar', '$apellidom_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', '$email_registrar', 'Director Primaria - 2023.11.23 - 10.05.00pm.jpg', '$id_escuela_director', '$tipo_registrar')");
                // $query_insert_director = mysqli_query($conexion, "INSERT INTO directores_preparatoria(nombre, usuario, contrasena, clave, id_escuela, email) values ('$nombre_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', $id_escuela_director, '$email_registrar')");
                if ($query_insert_director) {

                    include('envio-correo.php');
                    echo "
                    <script>
                        redirigir();
                    </script>
                    ";
                    //                 echo
                    //                 "
                    //   <script>
                    //   Swal.fire({
                    //       title: '¡Excelente!',
                    //       text: 'Registro de director exitoso',
                    //       icon: 'success',
                    //       confirmButtonColor: '#3085d6',
                    //       confirmButtonText: 'Aceptar',
                    //     }).then((result) => {
                    //       if (result.isConfirmed) {
                    //           window.location.href = 'index.php';
                    //       }
                    //     });
                    //   </script>
                    //     ";
                } else {
                    echo
                    "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: '¡Algo salió mal!',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
        ";
                }
            } else if ($result_clave_director > 0 && $nivel_educativo_director == 'Universidad') {
                $query_insert_director = mysqli_query($conexion, "INSERT INTO directores(nombre, apellidop, apellidom, usuario, contrasena, clave, email, image, id_escuela, tipo) values ('$nombre_registrar', '$apellidop_registrar', '$apellidom_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', '$email_registrar', 'Director Primaria - 2023.11.23 - 10.05.00pm.jpg', '$id_escuela_director', '$tipo_registrar')");
                // $query_insert_director = mysqli_query($conexion, "INSERT INTO directores_universidad(nombre, usuario, contrasena, clave, id_escuela, email) values ('$nombre_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', $id_escuela_director, '$email_registrar')");
                if ($query_insert_director) {

                    include('envio-correo.php');
                    echo "
                    <script>
                        redirigir();
                    </script>
                    ";
                    //                 echo
                    //                 "
                    //   <script>
                    //   Swal.fire({
                    //       title: '¡Excelente!',
                    //       text: 'Registro de director exitoso',
                    //       icon: 'success',
                    //       confirmButtonColor: '#3085d6',
                    //       confirmButtonText: 'Aceptar',
                    //     }).then((result) => {
                    //       if (result.isConfirmed) {
                    //           window.location.href = 'index.php';
                    //       }
                    //     });
                    //   </script>
                    //     ";
                } else {
                    echo
                    "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: '¡Algo salió mal!',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
        ";
                }
            } else if ($result_clave_director > 0 && $tipo_modelo == 'Licencia' or $tipo_modelo == 'Freemium') {
                $query_insert_director = mysqli_query($conexion, "INSERT INTO directores(nombre, apellidop, apellidom, usuario, contrasena, clave, email, image, id_escuela, tipo) values ('$nombre_registrar', '$apellidop_registrar', '$apellidom_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', '$email_registrar', 'Director Primaria - 2023.11.23 - 10.05.00pm.jpg', '$id_escuela_director', '$tipo_registrar')");
                if ($query_insert_director) {

                    include('envio-correo.php');
                    echo "
                    <script>
                        redirigir();
                    </script>
                    ";
                    // echo
                    // "
                    // <script>
                    // Swal.fire({
                    //     title: '¡Excelente!',
                    //     text: 'Registro de director exitoso',
                    //     icon: 'success',
                    //     confirmButtonColor: '#3085d6',
                    //     confirmButtonText: 'Aceptar',
                    //     }).then((result) => {
                    //     if (result.isConfirmed) {
                    //         window.location.href = 'index.php';
                    //     }
                    //     });
                    // </script>
                    //     ";
                } else {
                    echo
                    "
                    <script>
                    Swal.fire({
                        title: '¡Advertencia!',
                        text: '¡Algo salió mal!',
                        icon: 'info',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Reintentar',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'index.php';
                        }
                        });
                    </script>
                        ";
                }
            } else if ($result_clave_director > 0 && $nivel_educativo_director == 'Institucion') {
                $query_insert_director = mysqli_query($conexion, "INSERT INTO directores(nombre, apellidop, apellidom, usuario, contrasena, clave, email, image, id_escuela, tipo) values ('$nombre_registrar', '$apellidop_registrar', '$apellidom_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', '$email_registrar', 'Director Primaria - 2023.11.23 - 10.05.00pm.jpg', '$id_escuela_director', '$tipo_registrar')");
                // $query_insert_director = mysqli_query($conexion, "INSERT INTO director_institucional(nombre, usuario, contrasena, clave, id_escuela, email) values ('$nombre_registrar', '$usuario_registrar', '$contrasena_registrar', '$clave_registrar', $id_escuela_director, '$email_registrar')");
                if ($query_insert_director) {

                    include('envio-correo.php');
                    echo "
                    <script>
                        redirigir();
                    </script>
                    ";
                    //                 echo
                    //                 "
                    //   <script>
                    //   Swal.fire({
                    //       title: '¡Excelente!',
                    //       text: 'Registro de director exitoso',
                    //       icon: 'success',
                    //       confirmButtonColor: '#3085d6',
                    //       confirmButtonText: 'Aceptar',
                    //     }).then((result) => {
                    //       if (result.isConfirmed) {
                    //           window.location.href = 'index.php';
                    //       }
                    //     });
                    //   </script>
                    //     ";
                } else {
                    echo
                    "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: '¡Algo salió mal!',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
        ";
                }  // if (isset($data_paquete_director['id_escuela'])) {
                //     $id_escuela_director_institucional = $data_paquete_director['id_escuela'];
                // }
                // if (isset($data_paquete_director['cupo'])) {
                //     $cupos_paquete_director = $data_paquete_director['cupo'];
                //id_director_institucional }
            } else if ($result_clave_paquete_director > 0) {
                //Consulta para obtener total de cupos utilizados del paquete comprado por director institucional
                $consulta_cupos = mysqli_query($conexion, "SELECT SUM(id_director) AS total_cupos FROM userdirector WHERE id_director = $id_director_institucional");
                $resultadoCupos = mysqli_fetch_assoc($consulta_cupos);
                $cuposOcupados = $resultadoCupos['total_cupos'];

                if ($cuposOcupados == $cupos_paquete_director) {
                    echo
                    "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: '¡Cupos agotados para esta clave!',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Ir a inicio',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
         ";
                }

                $query_insert_alumno_institucional = mysqli_query($conexion, "INSERT INTO temp_account(nombre, clave, email, username, password, image, fondo, id_escuela) values ('$nombre_registrar', '$clave_registrar', '$email_registrar','$usuario_registrar', '$contrasena_registrar', 'Mascota-Aerobot-01.png', 'portada-1.png', $id_director_institucional)");
                $consulta_id_alumno_institucional = mysqli_query($conexion, "SELECT id FROM temp_account WHERE username = '$usuario_registrar'");
                $resultado_id_alumno_institucional = mysqli_fetch_assoc($consulta_id_alumno_institucional);
                $id_alumno_institucional = $resultado_id_alumno_institucional['id'];
                $query_insert_alumno_director_institucional = mysqli_query($conexion, "INSERT INTO userdirector(id, id_director) values ($id_alumno_institucional, $id_director_institucional)");
                if ($query_insert_alumno_institucional && $query_insert_alumno_director_institucional) {

                    include('envio-correo.php');

                    echo
                    "
      <script>
      Swal.fire({
          title: '¡Excelente!',
          text: 'Registro de cuenta exitosa',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
        ";
                } else {
                    echo
                    "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: '¡Algo salió mal!',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
        ";
                }
            } else {
                echo "
                <script>
                Swal.fire({
                    title: '¡Error!',
                    text: 'No se cumplen las condiciones para el registro',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
                </script>
                ";
            }
        }
    } else if (isset($_POST['registrar_usuario']) && empty($_POST['clave_registrar'])) {

        require_once "acciones/conexion.php";

        $nombre_registrar = $_POST['nombre_registrar'];
        $usuario_registrar = $_POST['usuario_registrar'];
        $contrasena_registrar = md5($_POST['contrasena_registrar']);
        $contrasena_correo = $_POST['contrasena_registrar'];
        $email_registrar = $_POST['email_registrar'];

        //Validar inicio de sesión de un admin principal
        $query_validar_admin = mysqli_query($conexion, "SELECT * FROM admin WHERE usuario = '$usuario_registrar'");
        $result_validar_admin = mysqli_fetch_array($query_validar_admin);


        //Validar inicio de sesión de un admin secundario
        $query_validar_admin_secundario = mysqli_query($conexion, "SELECT * FROM admin_secundario WHERE usuario = '$usuario_registrar'");
        $result_validar_admin_secundario = mysqli_fetch_array($query_validar_admin_secundario);

        //Validar inicio de sesión de un alumno de primaria
        $query_validar_alumno_primaria = mysqli_query($conexion, "SELECT * FROM alumnos_primaria WHERE usuario = '$usuario_registrar'");
        $result_validar_alumno_primaria = mysqli_fetch_array($query_validar_alumno_primaria);

        //Validar inicio de sesión de un docente de primaria
        $query_validar_docente_primaria = mysqli_query($conexion, "SELECT * FROM docentes_primaria WHERE usuario = '$usuario_registrar'");
        $result_validar_docente_primaria = mysqli_fetch_array($query_validar_docente_primaria);

        //Validar inicio de sesión de un director de primaria
        $query_validar_director_primaria = mysqli_query($conexion, "SELECT * FROM directores_primaria WHERE usuario = '$usuario_registrar'");
        $result_validar_director_primaria = mysqli_fetch_array($query_validar_director_primaria);

        //Validar inicio de sesión de un alumno de secundaria
        $query_validar_alumno_secundaria = mysqli_query($conexion, "SELECT * FROM alumnos_secundaria WHERE usuario = '$usuario_registrar'");
        $result_validar_alumno_secundaria = mysqli_fetch_array($query_validar_alumno_secundaria);

        //Validar inicio de sesión de un docente de secundaria
        $query_validar_docente_secundaria = mysqli_query($conexion, "SELECT * FROM docentes_secundaria WHERE usuario = '$usuario_registrar'");
        $result_validar_docente_secundaria = mysqli_fetch_array($query_validar_docente_secundaria);

        //Validar inicio de sesión de un director de secundaria
        $query_validar_director_secundaria = mysqli_query($conexion, "SELECT * FROM directores_secundaria WHERE usuario = '$usuario_registrar'");
        $result_validar_director_secundaria = mysqli_fetch_array($query_validar_director_secundaria);

        //Validar inicio de sesión de un alumno de preparatoria
        $query_validar_alumno_preparatoria = mysqli_query($conexion, "SELECT * FROM alumnos_preparatoria WHERE usuario = '$usuario_registrar'");
        $result_validar_alumno_preparatoria = mysqli_fetch_array($query_validar_alumno_preparatoria);

        //Validar inicio de sesión de un docente de preparatoria
        $query_validar_docente_preparatoria = mysqli_query($conexion, "SELECT * FROM docentes_preparatoria WHERE usuario = '$usuario_registrar'");
        $result_validar_docente_preparatoria = mysqli_fetch_array($query_validar_docente_preparatoria);

        //Validar inicio de sesión de un director de preparatoria
        $query_validar_director_preparatoria = mysqli_query($conexion, "SELECT * FROM directores_preparatoria WHERE usuario = '$usuario_registrar'");
        $result_validar_director_preparatoria = mysqli_fetch_array($query_validar_director_preparatoria);

        //Validar inicio de sesión de un alumno de universidad
        $query_validar_alumno_universidad = mysqli_query($conexion, "SELECT * FROM alumnos_universidad WHERE usuario = '$usuario_registrar'");
        $result_validar_alumno_universidad = mysqli_fetch_array($query_validar_alumno_universidad);

        //Validar inicio de sesión de un docente de universidad
        $query_validar_docente_universidad = mysqli_query($conexion, "SELECT * FROM docentes_universidad WHERE usuario = '$usuario_registrar'");
        $result_validar_docente_universidad = mysqli_fetch_array($query_validar_docente_universidad);

        //Validar inicio de sesión de un director de universidad
        $query_validar_director_universidad = mysqli_query($conexion, "SELECT * FROM directores_universidad WHERE usuario = '$usuario_registrar'");
        $result_validar_director_universidad = mysqli_fetch_array($query_validar_director_universidad);

        //Validar inicio de sesión de un alumno de personal
        $query_validar_alumno_personal = mysqli_query($conexion, "SELECT * FROM alumnos_personal WHERE usuario = '$usuario_registrar'");
        $result_validar_alumno_personal = mysqli_fetch_array($query_validar_alumno_personal);

        //Validar inicio de sesión de un alumno de institucional (temporal)
        $query_validar_alumno_institucional = mysqli_query($conexion, "SELECT * FROM temp_account WHERE username = '$usuario_registrar'");
        $result_validar_alumno_institucional = mysqli_fetch_array($query_validar_alumno_institucional);

        //Validar inicio de sesión de un director de institucional
        $query_validar_director_instituacional = mysqli_query($conexion, "SELECT * FROM director_institucional WHERE usuario = '$usuario_registrar'");
        $result_validar_director_institucional = mysqli_fetch_array($query_validar_director_instituacional);

        if ($result_validar_admin > 0 || $result_validar_admin_secundario > 0 || $result_validar_alumno_primaria > 0 || $result_validar_docente_primaria > 0 || $result_validar_director_primaria > 0 || $result_validar_alumno_secundaria > 0 || $result_validar_docente_secundaria > 0 || $result_validar_director_secundaria > 0 || $result_validar_alumno_preparatoria > 0 || $result_validar_docente_preparatoria > 0 || $result_validar_director_preparatoria > 0 || $result_validar_alumno_universidad > 0 || $result_validar_docente_universidad > 0 || $result_validar_director_universidad > 0 || $result_validar_alumno_personal > 0 || $result_validar_alumno_institucional > 0 || $result_validar_director_institucional > 0) {
            echo
            "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: 'Usuario ya existente',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
        ";
        } else {

            $query_insert_alumno = mysqli_query($conexion, "INSERT INTO alumnos_personal(nombre, usuario, contrasena, email, image, fondo) values ('$nombre_registrar', '$usuario_registrar', '$contrasena_registrar', '$email_registrar', 'Mascota-Aerobot-01.png', 'portada-1.png')");
            if ($query_insert_alumno) {

                include('envio-correo.php');

                echo
                "
      <script>
      Swal.fire({
          title: '¡Excelente!',
          text: 'Registro de alumno exitoso',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
        ";
            } else {
                echo
                "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: '¡Algo salió mal!',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
        });
      </script>
        ";
            }
        }
    }
    ?>

    <script>
        function generarNombreUsuario() {
            var nombre = document.getElementById("nombre_registar").value;
            var apellidop = document.getElementById("apellidop_registrar").value;
            var apellidom = document.getElementById("apellidom_registrar").value;

            min = Math.ceil(1000);
            max = Math.floor(9999);

            var usuario = nombre + apellidop.charAt(0) + apellidom.charAt(0) + Math.floor(Math.random() * (1 + max - min) + min);

            usuario = usuario.split(" ").join("");

            usuario = usuario.normalize('NFD').replace(/[\u0300-\u036f]/g, "");

            // document.getElementById("usuario_registrar").innerHTML = usuario;
            var user = document.getElementById("usuario_registrar");
            user.value = "@" + usuario;
        }
    </script>

    <script>
        function agregarArroba() {
            var input = document.getElementById("usuario_registrar");
            if (!input.value.startsWith("@")) {
                input.value = "@" + input.value;
            }
        }
    </script>

    <script>
        function agregarArrobaInicio() {
            var input = document.getElementById("usuario_inicio");
            if (!input.value.startsWith("@")) {
                input.value = "@" + input.value;
            }
        }
    </script>

    <script>
        // Guarda los datos del formulario en una cookie
        function guardarDatos() {
            var usuario_inicio = document.getElementById("usuario_inicio").value;
            var contrasena_inicio = document.getElementById("contrasena_inicio").value;
            document.cookie = "usuario_inicio=" + usuario_inicio + "; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
            document.cookie = "contrasena_inicio=" + contrasena_inicio + "; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
        }

        function off() {
            console.log("Reinicio")
            var usuario_inicio = '';
            var contrasena_inicio = '';
            document.cookie = "usuario_inicio=" + usuario_inicio + "; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
            document.cookie = "contrasena_inicio=" + contrasena_inicio + "; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
        }

        var checkbox = document.getElementById('checkbox');

        checkbox.addEventListener("change", comprueba, false);

        // Función para establecer el valor de una cookie
        function setCookie(name, value) {
            document.cookie = `${name}=${value}; path=/;`;
        }

        function comprueba() {
            if (checkbox.checked) {
                guardarDatos();
                setCookie('checkbox', true);
            } else {
                off();
            }
        }
    </script>

    <script>
        // Recupera los datos del formulario de la cookie
        function recuperarDatos() {
            var cookieData = document.cookie;
            if (cookieData) {
                var cookies = cookieData.split("; ");
                for (var i = 0; i < cookies.length; i++) {
                    var parts = cookies[i].split("=");
                    var name = parts[0];
                    var value = decodeURIComponent(parts[1]);
                    if (name == "usuario_inicio") {
                        document.getElementById("usuario_inicio").value = value;
                    } else if (name == "contrasena_inicio") {
                        document.getElementById("contrasena_inicio").value = value;
                    }
                }
            }
        }
    </script>

    <script>
        // Función para obtener el valor de una cookie
        function getCookie(name) {
            const cookieArray = document.cookie.split("; ");
            for (let i = 0; i < cookieArray.length; i++) {
                const cookie = cookieArray[i].split("=");
                if (cookie[0] === name) {
                    return cookie[1];
                }
            }
            return "";
        }
    </script>

    <script>
        // EVITAR REENVIO DE DATOS.
        if (window.history.replaceState) { // verificamos disponibilidad
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script>
        window.addEventListener("load", function() {

            // icono para mostrar contraseña
            showPassword1 = document.querySelector('.show-password1');
            showPassword1.addEventListener('click', () => {

                // elementos input de tipo clave
                password1 = document.querySelector('.password1');

                if (password1.type === "text") {
                    password1.type = "password"
                    showPassword1.classList.remove('fa-eye-slash');
                } else {
                    password1.type = "text"
                    showPassword1.classList.toggle("fa-eye-slash");
                }

            })

        });
    </script>
    <script>
        window.addEventListener("load", function() {

            // icono para mostrar contraseña
            showPassword2 = document.querySelector('.show-password2');
            showPassword2.addEventListener('click', () => {

                // elementos input de tipo clave
                password2 = document.querySelector('.password2');

                if (password2.type === "text") {
                    password2.type = "password"
                    showPassword2.classList.remove('fa-eye-slash');
                } else {
                    password2.type = "text"
                    showPassword2.classList.toggle("fa-eye-slash");
                }

            })

        });
    </script>

    <script>
        window.addEventListener("load", function() {

            // icono para mostrar contraseña
            showPassword3 = document.querySelector('.show-password3');
            showPassword3.addEventListener('click', () => {

                // elementos input de tipo clave
                password3 = document.querySelector('.password3');

                if (password3.type === "text") {
                    password3.type = "password"
                    showPassword3.classList.remove('fa-eye-slash');
                } else {
                    password3.type = "text"
                    showPassword3.classList.toggle("fa-eye-slash");
                }

            })

        });
    </script>

    <script>
        window.addEventListener("load", function() {

            // icono para mostrar contraseña
            showPassword4 = document.querySelector('.show-password4');
            showPassword4.addEventListener('click', () => {

                // elementos input de tipo clave
                password4 = document.querySelector('.password4');

                if (password4.type === "text") {
                    password4.type = "password"
                    showPassword4.classList.remove('fa-eye-slash');
                } else {
                    password4.type = "text"
                    showPassword4.classList.toggle("fa-eye-slash");
                }

            })

        });
    </script>

    <script>
        var x = document.getElementById("Ingresar");
        var y = document.getElementById("Registrarse");
        var z = document.getElementById("elegir");

        function Registrarse() {
            x.style.left = "-450px"
            y.style.left = "50px"
            z.style.left = "120px"
        }

        function Ingresar() {
            x.style.left = "50px"
            y.style.left = "450px"
            z.style.left = "0px"
        }
    </script>

</body>

</html>