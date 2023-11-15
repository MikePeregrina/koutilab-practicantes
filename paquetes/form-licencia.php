<?php
include('../acciones/conexion.php');
$precio = $_POST['precio'];
$modelo = $_POST['modelo'];
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png">
    <link rel="stylesheet" href="css/editar.css">
    <link rel="stylesheet" href="css/footer.css">
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

    <div class="containers">
        <h1>Registrar escuela</h1>
    </div>


    <section>
        <div class="contenedor-emergente">
            <form action="pasarela/orderPasarela.php" method="post" style="box-shadow: none;">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Nombre escuela</span>
                        <input type="text" name="nombre_escuela" id="nombre_escuela" required>
                    </div>
                    <div class="input-box">
                        <span class="details">CCT</span>
                        <input onkeydown="generarClaves()" type="text" name="cct" id="cct" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Director</span>
                        <input type="text" name="nombre_director" id="nombre_director" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Nivel educativo</span>
                        <select style="height: 44px;" name="nivel_educativo" id="nivel_educativo" type="select" required>
                            <option value="Primaria">Primaria</option>
                            <option value="Secundaria">Secundaria</option>
                            <option value="Preparatoria">Preparatoria</option>
                            <option value="Universidad">Universidad</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Tipo de escuela</span>
                        <select style="height: 44px;" name="tipo_escuela" id="tipo_escuela" type="select" required>
                            <option value="1">Federal</option>
                            <option value="2">Privada</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">País</span>
                        <select style="height: 44px;" name="pais" id="pais" type="select" required>
                            <option value="Estados Unidos">Estados Unidos</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="México">México</option>
                            <option value="Perú">Perú</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Estado</span>
                        <input type="text" name="estado" id="estado" required>
                    </div>
                    <div class="input-box" style="margin-top: 12px;">
                        <span class="details">Calle</span>
                        <input type="text" name="calle" id="calle" required>
                    </div>
                    <div class="input-box" style="margin-top: 12px;">
                        <span class="details">Número exterior</span>
                        <input type="text" name="num_exterior" id="num_exterior" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Código Postal</span>
                        <input type="text" name="codigo_postal" id="codigo_postal" required>
                    </div>
                    <input type="hidden" id="clave_director" name="clave_director" required readonly>
                    <input type="hidden" id="clave_docente" name="clave_docente" required readonly>
                    <input type="hidden" id="clave_alumno" name="clave_alumno" required readonly>
                    <input type="hidden" name="id_admin" id="id_admin" value="1">
                    <input type="hidden" name="precio" id="precio" value="<?php echo $precio; ?>">
                    <input type="hidden" name="modelo" id="modelo" value="<?php echo $modelo; ?>">
                    <input type="hidden" name="tipo_modelo" id="tipo_modelo" value="2">

                </div>
                <br>
                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                <a href="adquirir-paquete.php" class="btn btn-danger">Atrás</a>
            </form>
        </div>

    </section>
    <footer class="footerimga">
        <div class="imagen-footer">
            <img src="../img/benvenida.png">
        </div>
    </footer>

    <script>
        function copyToClipBoard1() {
            var content = document.getElementById('clave_director');
            content.select();
            document.execCommand('copy');
        }
    </script>

    <script>
        function copyToClipBoard2() {
            var content = document.getElementById('clave_docente');
            content.select();
            document.execCommand('copy');
        }
    </script>

    <script>
        function copyToClipBoard3() {
            var content = document.getElementById('clave_alumno');
            content.select();
            document.execCommand('copy');
        }
    </script>

    <script>
        /* Función para generar clave para alumno */
        function generarClaveAlumno() {
            var pass = "";
            var str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            for (let i = 1; i <= 8; i++) {
                var char = Math.floor(Math.random() * str.length + 1);
                pass += str.charAt(char);
            }
            return pass;
        }
        /* Función para generar clave para docente*/
        function generarClaveDocente() {
            var pass = "";
            var str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            for (let i = 1; i <= 8; i++) {
                var char = Math.floor(Math.random() * str.length + 1);
                pass += str.charAt(char);
            }
            return pass;
        }
        /* Función para generar clave para  director*/
        function generarClaveDirector() {
            var pass = "";
            var str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            for (let i = 1; i <= 8; i++) {
                var char = Math.floor(Math.random() * str.length + 1);
                pass += str.charAt(char);
            }
            return pass;
        }

        function generarClaves() {
            var cct = document.getElementById("cct").value;
            var prefijo;
            prefijo = cct.substr(0, 3);
            document.getElementById("clave_alumno").value = prefijo.toUpperCase() + generarClaveAlumno();
            document.getElementById("clave_docente").value = prefijo.toUpperCase() + generarClaveDocente();
            document.getElementById("clave_director").value = prefijo.toUpperCase() + generarClaveDirector();
        }
    </script>

</body>