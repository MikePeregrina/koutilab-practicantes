<?php
include('../acciones/conexion.php');
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
            <form style="box-shadow: none;">
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
                    <div class="input-box">
                        <span class="details">Clave director:</span>
                        <input type="text" id="clave_director" name="clave_director" required readonly>
                    </div>
                    <div class="input-box">
                        <span class="details"></span> <br>
                        <button type="button" class="btn-grd1" onclick="copyToClipBoard1()">Copiar clave director</button>
                    </div>
                    <div class="input-box">
                        <span class="details">Clave docente:</span>
                        <input type="text" id="clave_docente" name="clave_docente" required readonly>
                    </div>
                    <div class="input-box">
                        <span class="details"></span> <br>
                        <button type="button" class="btn-grd1" onclick="copyToClipBoard2()">Copiar clave docente</button>
                    </div>
                    <div class="input-box">
                        <span class="details">Clave alumnos:</span>
                        <input type="text" id="clave_alumno" name="clave_alumno" required readonly>
                    </div>
                    <div class="input-box">
                        <span class="details"></span> <br>
                        <button type="button" class="btn-grd1" onclick="copyToClipBoard3()">Copiar clave alumno</button>
                    </div>
                    <input type="hidden" name="id_admin" id="id_admin" placeholder="Nombre" value="1">
                    <input type="hidden" name="tipo_modelo" id="tipo_modelo" placeholder="Nombre" value="2">

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
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('form').submit(function(e) {
                e.preventDefault(); // Evitar el envío del formulario por defecto

                // Obtener datos del formulario
                var nombre_escuela = $('#nombre_escuela').val();
                var cct = $('#cct').val();
                var nombre_director = $('#nombre_director').val();
                var nivel_educativo = $('#nivel_educativo').val();
                var tipo_escuela = $('#tipo_escuela').val();
                var clave_alumno = $('#clave_alumno').val();
                var clave_docente = $('#clave_docente').val();
                var clave_director = $('#clave_director').val();
                var pais = $('#pais').val();
                var estado = $('#estado').val();
                var calle = $('#calle').val();
                var num_exterior = $('#num_exterior').val();
                var codigo_postal = $('#codigo_postal').val();
                var id_admin = $('#id_admin').val();
                var tipo_modelo = $('#tipo_modelo').val();

                // Enviar datos mediante AJAX
                $.ajax({
                    type: 'POST',
                    url: 'acciones/insertar_escuela.php', 
                    data: {
                        nombre_escuela: nombre_escuela,
                        cct: cct,
                        nombre_director: nombre_director,
                        nivel_educativo: nivel_educativo,
                        tipo_escuela: tipo_escuela,
                        clave_alumno: clave_alumno,
                        clave_docente: clave_docente,
                        clave_director: clave_director,
                        pais: pais,
                        estado: estado,
                        calle: calle,
                        num_exterior: num_exterior,
                        codigo_postal: codigo_postal,
                        id_admin: id_admin,
                        tipo_modelo: tipo_modelo
                    },
                    success: function(response) {
                        // Manejar la respuesta
                        if (response === 'success') {
                            // Mostrar alerta de registro exitoso
                            Swal.fire('¡Registro exitoso!', '', 'success');
                            // Puedes redirigir a otra página aquí si es necesario
                        } else {
                            // Mostrar alerta de error
                            Swal.fire('Algo salió mal', 'Ha ocurrido un error al registrar la escuela.', 'error');
                        }
                    },
                    error: function() {
                        // Manejar errores de la petición AJAX
                        Swal.fire('Error', 'Ha ocurrido un error al procesar la solicitud.', 'error');
                    }
                });
            });
        });
    </script>

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