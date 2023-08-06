<?php
session_start();
$id_user = $_SESSION['id_admin'];
if (empty($_SESSION['active']) || empty($_SESSION['id_admin'])) {
    header('location: ../acciones/cerrarsesion.php');
}
include('../../acciones/conexion.php');

$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM admin WHERE id_admin = $id_user"));

// Obtenemos el país del resultado de la consulta
$pais = $user['pais'];

// Definimos los estados de México y Perú en dos arreglos asociativos
$estados_mexico = array(
    "Aguascalientes", "Baja California", "Baja California Sur", "Campeche", "Ciudad de Mexico",
    "Coahuila", "Colima", "Chiapas", "Chihuahua", "Durango", "Guanajuato", "Guerrero",
    "Hidalgo", "Jalisco", "México", "Michoacán", "Morelos", "Nayarit", "Nuevo León", "Oaxaca",
    "Puebla", "Querétaro", "Quintana Roo", "San Luis Potosí", "Sinaloa", "Sonora", "Tabasco",
    "Tamaulipas", "Tlaxcala", "Veracruz", "Yucatán", "Zacatecas"
);

$estados_peru = array(
    "Amazonas", "Áncash", "Apurímac", "Arequipa", "Ayacucho", "Cajamarca", "Callao", "Cusco",
    "Huancavelica", "Huánuco", "Ica", "Junín", "La Libertad", "Lambayeque", "Lima", "Loreto",
    "Madre de Dios", "Moquegua", "Pasco", "Piura", "Puno", "San Martín", "Tacna", "Tumbes", "Ucayali"
);

// Obtenemos los estados disponibles dependiendo del país
$estados_disponibles = array();

if ($pais === "México") {
    $estados_disponibles = $estados_mexico;
} elseif ($pais === "Perú") {
    $estados_disponibles = $estados_peru;
}

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png">
    <link rel="stylesheet" href="../css/escuelas.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bulma.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    require "../../acciones/conexion.php";

    if (!empty($_POST)) {
        $alert = "";
        if (empty($_POST['nombre_escuela']) || empty($_POST['cct']) || empty($_POST['nombre_director'])) {
            $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
        } else {
            $idescuela = $_GET['id'];
            $nombre_escuela = $_POST['nombre_escuela'];
            $cct = $_POST['cct'];
            $nombre_director = $_POST['nombre_director'];
            $calle = $_POST['calle'];
            $num_exterior = $_POST['num_exterior'];
            $colonia = $_POST['colonia'];
            $estado = $_POST['estado'];
            $pais = $_POST['pais'];
            $codigo_postal = $_POST['codigo_postal'];
            $nivel_educativo = $_POST['nivel_educativo'];
            $autorizacion = $_POST['autorizacion'];
            $id_user = $_SESSION['id_admin'];
            $sql_update = mysqli_query($conexion, "INSERT INTO escuelas(nombre_escuela, cct, nombre_director, calle, num_exterior, estado, codigo_postal, nivel_educativo, pais, autorizacion, id_admin) VALUES ('$nombre_escuela', '$cct', '$nombre_director', '$calle', '$num_exterior', '$estado', '$codigo_postal', '$nivel_educativo', '$pais', '$autorizacion', '$id_user')");
            $alert = '<div class="alert alert-success" role="alert">Escuela registrada</div>';
        }
    }

    // Mostrar Datos

    if (empty($_REQUEST['id'])) {
        header("Location: ../../admin/preregistrar.php");
    }
    $sql = mysqli_query($conexion, "SELECT * FROM formulario");
    $result_sql = mysqli_num_rows($sql);

    if ($result_sql == 0) {
        header("Location: ../../admin/preregistrar.php");
    } else {
        if ($data = mysqli_fetch_array($sql)) {
            $nombre_escuela = $data['nombre_e'];
            $cct = $data['clave'];
            $nombre_director = $data['nombre_r'];
            $calle = $data['calle'];
            $num_exterior = $data['num_exterior'];
            $colonia = $data['colonia'];
            $estado = $data['estado'];
            $pais = $data['pais'];
            $codigo_postal = $data['codigo_postal'];
            $nivel_educativo = $data['grado'];
            $autorizacion = $user['nombre'];
            $id_user = $user['id_admin'];
        }
    }
    ?>

    <div class="containers">
        <h1>Registrar Escuela</h1>
    </div>
    <section>
        <div class="contenedor-emergente">
            <form class="" action="" method="post" style="box-shadow: none;">
                <div class="user-details">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="input-box">
                        <span class="details">Escuela</span>
                        <input type="text" name="nombre_escuela" id="nombre_escuela" value="<?php echo $nombre_escuela; ?>" required>
                    </div>
                    <div class="input-box">
                        <span class="details">CCT</span>
                        <input type="text" name="cct" id="cct" value="<?php echo $cct; ?>" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Director</span>
                        <input type="text" name="nombre_director" id="nombre_director" value="<?php echo $nombre_director; ?>" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Nivel educativo</span>
                        <select style="height: 44px;" name="nivel_educativo" type="select" required>
                            <?php
                            echo '<option value="' . $nivel_educativo . '">' . $nivel_educativo . '</option>';

                            ?>
                            <option value="Primaria">Primaria</option>
                            <option value="Secundaria">Secundaria</option>
                            <option value="Preparatoria">Preparatoria</option>
                            <option value="Primaria - Secundaria">Primaria - Secundaria</option>
                            <option value="Secundaria - Preparatoria">Secundaria - Preparatoria</option>
                            <option value="Todos">Los tres niveles</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">País</span>
                        <select style="height: 44px;" name="pais" type="select" required>
                            <?php
                            echo '<option value="' . $pais . '">' . $pais . '</option>';

                            ?>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Estado</span>
                        <select style="height: 44px;" name="estado" type="select" required>
                            <?php
                            echo '<option value="' . $estado . '">' . $estado . '</option>';

                            ?>
                            <option><?php echo $estado; ?></option>
                            <?php
                            foreach ($estados_disponibles as $estado) {
                                echo '<option value="' . $estado . '">' . $estado . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-box" style="margin-top: 17px;">
                        <span class="details">Colonia</span>
                        <input type="text" name="colonia" id="colonia" value="<?php echo $colonia; ?>" required>
                    </div>
                    <div class="input-box" style="margin-top: 17px;">
                        <span class="details">Calle</span>
                        <input type="text" name="calle" id="calle" value="<?php echo $calle; ?>" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Número exterior</span>
                        <input type="text" name="num_exterior" id="num_exterior" value="<?php echo $num_exterior; ?>" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Código Postal</span>
                        <input type="text" name="codigo_postal" id="codigo_postal" value="<?php echo $codigo_postal; ?>" required>
                    </div>
                    <input type="hidden" name="autorizacion" placeholder="Nombre" value="<?php echo $user['nombre'] ?>">

                </div>
                <br>
                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                <a href="../pre-registros.php" class="btn btn-danger">Atrás</a>
            </form>
        </div>
    </section>

</body>