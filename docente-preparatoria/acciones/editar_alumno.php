<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png">
    <link rel="stylesheet" href="../css/alumnos.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bulma.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-image: url(../img/bg1.png); padding-top: 0px; padding-bottom: 100px;">

    <?php
    require "../../acciones/conexion.php";
    session_start();
    $id_user = $_SESSION['id_docente_preparatoria'];

    if (!empty($_POST)) {
        $alert = "";
        if (empty($_POST['nombre']) || empty($_POST['nivel_educativo']) || empty($_POST['grado_escolar'])) {
            $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
        } else {
            $idalumno = $_GET['id'];
            $usuario = $_POST['usuario'];
            $contrasena = md5($_POST['contrasena']);
            $nombre = $_POST['nombre'];
            $niveleducativo = $_POST['nivel_educativo'];
            $gradoescolar = $_POST['grado_escolar'];
            $nombregrupo = $_POST['nombre_grupo'];
            $sql_update = mysqli_query($conexion, "UPDATE alumnos SET nombre = '$nombre', usuario = '$usuario', contrasena = '$contrasena', nivel_educativo = '$niveleducativo' , grado_escolar = '$gradoescolar', nombre_grupo = '$nombregrupo' WHERE id_alumno = $idalumno");
            $alert = '<div class="alert alert-success" role="alert">Alumno actualizado</div>';
        }
    }



    // Mostrar Datos

    if (empty($_REQUEST['id'])) {
        header("Location: ../../docente/alumnos.php");
    }

    $idalumno = $_REQUEST['id'];
    $sql = mysqli_query($conexion, "SELECT * FROM alumnos WHERE id_alumno = '$idalumno'");
    $result_sql = mysqli_num_rows($sql);
    //Seleccionar nombre del grupo
    $query = "SELECT nombre_grupo FROM grupos WHERE id_docente = $id_user";
    $result = $conexion->query($query);
    if ($result->num_rows > 0) {
        $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    if ($result_sql == 0) {
        header("Location: ../../docente/alumnos.php");
    } else {
        if ($data = mysqli_fetch_array($sql)) {
            $idalumno = $data['id_alumno'];
            $usuario = $data['usuario'];
            $contrasena = $data['contrasena'];
            $nombre = $data['nombre'];
            $niveleducativo = $data['nivel_educativo'];
            $gradoescolar = $data['grado_escolar'];
            $nombregrupo = $data['nombre_grupo'];
        }
    }
    ?>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="container1">
                <div class="board" style="padding: 10px; margin-left: 7px; text-align:center; width: 98%;">
                    <h3 class="i-name">Editar alumno</h3>
                </div>
                <form class="" action="" method="post">

                    <div class="user-details1">

                        <?php echo isset($alert) ? $alert : ''; ?>
                        <input type="hidden" name="id" value="<?php echo $idalumno; ?>">

                        <div class="input-box1">
                            <span class="details">Usuario</span>
                            <input type="text" name="usuario" id="usuario" value="<?php echo $usuario; ?>" required readonly>
                        </div>

                        <div class="campo">
                            <label for="password">Contraseña:</label>
                            <input type="password" name="contrasena" id="password">
                            <span class="fa fa-fw fa-eye password-icon show-password1" style="margin-right: 160px; margin-top: -230px; background: #ffffff00;"></span>
                        </div>

                        <div class="input-box1">
                            <span class="details">Nombre</span>
                            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required readonly>
                        </div>

                        <div class="input-box1">
                            <span class="details">Nivel educativo</span>
                            <input type="text" name="nivel_educativo" id="nivel_educativo" value="<?php echo $niveleducativo; ?>" required readonly>

                        </div>

                        <div class="input-box1">
                            <span class="details">Grado escolar: </span>
                            <select style="height: 44px;" name="grado_escolar" type="select" required>
                                <option><?php echo $gradoescolar; ?></option>
                                <option value="1°">1°</option>
                                <option value="2°">2°</option>
                                <option value="3°">3°</option>
                                <option value="4°">4°</option>
                                <option value="5°">5°</option>
                                <option value="6°">6°</option>
                            </select>
                        </div>

                        <div class="input-box1">
                            <span class="details">Nombre del grupo: </span>
                            <select style="height: 44px;" type="select" name="nombre_grupo" required>
                                <option><?php echo $nombregrupo; ?></option>
                                <?php
                                foreach ($options as $option) {
                                ?>
                                    <option><?php echo $option['nombre_grupo']; ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                    </div>

                    <br>
                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                    <a href="../alumnos.php" class="btn btn-danger">Atrás</a>
                </form>

            </div>

        </div>
    </div>
    <script>
        document.querySelector('.campo span').addEventListener('click', e => {
            const passwordInput = document.querySelector('#password');
            if (e.target.classList.contains('show')) {
                e.target.classList.remove('show');
                e.target.textContent = '';
                passwordInput.type = 'text';
            } else {
                e.target.classList.add('show');
                e.target.textContent = '';
                passwordInput.type = 'password';
            }
        });
    </script>
</body>