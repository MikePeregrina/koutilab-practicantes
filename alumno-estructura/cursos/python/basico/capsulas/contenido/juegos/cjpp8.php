<?php
session_start();
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
 if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
     header('location: ../../../../../../../../../acciones/cerrarsesion.php');
 }
 include "../../../../../../../acciones/conexion.php";
 $id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
 $permiso = "capsulapago8";
 $sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 4;");
$existe = mysqli_fetch_all($sql);
 if (empty($existe)) {
    header("Location:  ../../../../basico/capsulas/contenido/alertas/paquete_premium8.php");
 }
?>
<!DOCTYPE html>
<html>
<!-- 
    
		Manual de cambios para el crucigrama por pasos:
		1. Realizar el dibujo o diagrama de como va a quedar la matriz del crucigrama 
			(Ejemplo: una matriz de 3x5 o del tamaño necesario)
		2. Agregar las palabras necesarias a la matriz, definiendo asi si son verticales u orizontales para 
			posteriormente generar su enunciado y colorcarlo en su lugar
		3. Generar la matriz del tamaño que se haya definido, si es de 3x5 son tres filas por 5 casillas que 
			lleva cada fila
		4. Desactivar con el Style cada casilla que no se va a ocupar
		5. Cambiar el maximo de filas y el maximo de columnas en la primera condicional for, para deshabilitar 
			las casillas que no se ocupan 
		6. Generar las palabras en la matriz ubicando letra por letra con el codigo mencionado
			por ejemplo: var palabra1_letra1 = document.getElementById("fila1C1"); y asi letra por letra
			con todas las palabras
		7. Posteriormente, habilitar las casillas necesarias para editar quitando el readOnly, por ejemplo:
			palabra1_letra1.readOnly =false; y asi con todas las letras y palabras necesarias
		8. Cabiar el maximo de filas y columnas que en la segunda condicinal for, esto para pintar de color azul
			las nuevas palabras que hayamos definido antes 
		9. Generar palabra por palabra sumando todas las letras que la conforman, al incio de la funcion verificar,
			por ejemplo: palabra1 = palabra1_letra1.value + palabra1_letra2.value + palabra1_letra3.value;
			y asi con todas las palabras necesarias
		10. Modificar la condicional siguiente para que la suma de las palabras sean igual al enunciado que se definio,
			por ejemplo: if(palabra1.toLowerCase()=="body" && palabra2.toLowerCase()=="input") { }
			y asi ir agregando las demas palabras dentro del crucigrama
		11. Modificar la serie de if que siguen despues de ese agregando las palabras que haya definido, esto 
			para identificar si estan vacias
		12. (Opcional) Modificar el corrector de palabras, en caso de que la palabra 1 este mal pero contenga 
			una letra de la palabra 2 que este bien, entonces indicar dentro de la condicional que letra es para que
			el corrector lo agregue por si solo.
		13. Modificar la posicion de los numeros conforme sea la necesidad del crucigrama, ya sea arriba si la palabra 
			es vertical o a la izquierda si la palabra es horizontal, esto se hace atraves del css modificando los
			margin.
	 -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../../../../../../img/lgk.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../../css/css-juegos/crucigrama.css" />
</head>

<body onload="iniciarTiempo();">
    <div class="timer" id="timer">
        <b style="margin-top: 10px">Tiempo: <br />
            <p id="tiempo"></p>
        </b>
    </div>
    <!-- Titulo general -->
    <div class="titulo-gen">
        <h4 class="titulo" style="margin-left: 0px"><b>FUNCION INPUT()</b></h4>
    </div>

    <!-- Alerta -->
    <div id="mensaje" style="position: absolute"></div>

    <!-- Contenido donde está el crucigrama y las frases que desacriben la palabra buscada -->
    <section>

        <div class="cont-st">
            <a href="../../../../../../rutas/ruta-pw-b.php">
                <button class="btn-b">
                    <i class="fas fa-reply"></i>
                </button>
            </a>
            <h6 class="titulo"><b>Busca la palabra que describe el texto</b></h6>
        </div>
        <br />
        <div class="mjuego">
            <!-- Apartado donde van las frases a buscar por el usuario -->
            <div class="words">
                <table>
                    <tr>
                        <b class="tituloH">Horizontales:</b>
                        <td>
                            <div class="horizontal">
                                1.Conjunto de líneas de código que realizan una tarea específica y
                                 pueden tomar “Argumentos” para diferentes “Parámetros” que modifiquen 
                                 su funcionamiento y los datos de salida.
                                <br /><br />
                                2.Es un lenguaje de alto nivel de programación interpretado cuya filosofía hace hincapié en la legibilidad de su código
                                <br /><br />
                                3.Es una interfaz de usuario que funciona a través de instrucciones o comandos,
                                 no cuenta con una interfaz gráfica para su funcionamiento.
                                <br /><br />
                                4.Funciona para posibilitar la entrada por texto por parte del usuario del programa,
                                 es decir, Python lee e imprime o ejecuta el texto que se le otorge en la función
                                <br /><br />
                                <b style="" class="tituloV">Verticales:</b>
                                <div class="vertical">
                                    1.Son las reglas que definen las combinaciones de símbolos que se consideran
                                     declaraciones o expresiones correctamente estructuradas en ese lenguaje
                                </div>
                            </div>
                        </td>

                        <td></td>
                    </tr>
                </table>
            </div>

            <div class="linea"></div>

            <!-- Apartado del crucigrama junto con sus casillas -->
            <div class="crucigrama" style="" >
                <div class="numero1" style="margin: -300px 0 20px -480px;">1.</div>
                <div class="numero2" style="margin: -100px 0 20px -280px;">2.</div>
                <div class="numero1-1" style="margin: 220px 0 20px -80px;">3.</div>
                <div class="numero2-2" style="margin: 320px 0 20px -340px;">4.</div>
                <div class="numero3-3" style="margin: -500px 0 20px 30px;">1.</div>
                <table id="crucigrama">
                    <tr>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila1C1" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila1C2" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila1C3" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila1C4" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila1C5" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila1C6"  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila1C7" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila1C8" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila1C9" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila1C10" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila2C1" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila2C2" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila2C3" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila2C4" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila2C5" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila2C6" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila2C7" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila2C8" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila2C9" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                "  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila2C10" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila3C1" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila3C2" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila3C3" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila3C4" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila3C5" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila3C6"  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila3C7" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila3C8" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila3C9" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila3C10" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                "  />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila4C1" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila4C2" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila4C3" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila4C4"  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila4C5"  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila4C6"  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila4C7"  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila4C8"  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila4C9" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila4C10" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                "  />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C1" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C2" style="
                                border-style: none;
                                background-color: rgba(255, 255, 255, 0);
                            " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C3" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C4" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C5" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C6"  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C7" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C8" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C9" style="
                                border-style: none;
                                background-color: rgba(255, 255, 255, 0);
                            " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C10" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                "  />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila6C1" style="
                                border-style: none;
                                background-color: rgba(255, 255, 255, 0);
                            " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila6C2" style="
                                border-style: none;
                                background-color: rgba(255, 255, 255, 0);
                            " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila6C3" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila6C4" style="
                                border-style: none;
                                background-color: rgba(255, 255, 255, 0);
                            " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila6C5" style="
                                border-style: none;
                                background-color: rgba(255, 255, 255, 0);
                            " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila6C6"  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila6C7" style="
                                border-style: none;
                                background-color: rgba(255, 255, 255, 0);
                            " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila6C8" style="
                                border-style: none;
                                background-color: rgba(255, 255, 255, 0);
                            " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila6C9" style="
                                border-style: none;
                                background-color: rgba(255, 255, 255, 0);
                            " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila6C10" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                "  />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila7C1" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila7C2" style="
                                border-style: none;
                                background-color: rgba(255, 255, 255, 0);
                            " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila7C3" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                "  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila7C4" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila7C5" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                "  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila7C6" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila7C7" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila7C8" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila7C9" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila7C10" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila8C1" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila8C2" style="
                                border-style: none;
                                background-color: rgba(255, 255, 255, 0);
                            " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila8C3" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila8C4" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila8C5" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila8C6"  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila8C7"  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila8C8"  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila8C9"  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila8C10" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                "  />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila9C1" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila9C2" style="
                                border-style: none;
                                background-color: rgba(255, 255, 255, 0);
                            " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila9C3" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                "  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila9C4" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila9C5" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                "  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila9C6" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila9C7" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                "  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila9C8" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                "  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila9C9" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                "  />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila9C10" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                "  />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- boton de verificar respuestas -->
        <div class="btn-v">
            <button class="verificar" onClick="verificar()">
                Comprobar respuestas
            </button>
        </div>
    </section>

    <!-- CAMBIOS -->
    <footer class="footerimga">
        <div class="imagen-footer">
            <img src="../../img/img-juegos/benvenida.png" alt="No-image">
        </div>
    </footer>
    <!-- FIN CAMBIOS -->

    <script>
        var segundos = 240;
        let puntos = 0;

        //Funcion que agrega el sonido al juego
        var correcto = document.createElement("audio");
        correcto.src = "../../../../../../../acciones/sonidos/correcto.mp3";
        var incorrecto = document.createElement("audio");
        incorrecto.src = "../../../../../../../acciones/sonidos/incorrecto.mp3";

        function iniciarTiempo() {
            document.getElementById("tiempo").innerHTML =
                segundos + " segundos";
            if (segundos <= 60) {
                var div = document.getElementById("timer");
                div.style.cssText = " animation-name: animation1; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
            }
            if (segundos <= 30) {
                var div = document.getElementById("timer");
                div.style.cssText = "animation-name: animation2; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
            }
            if (segundos <= 10) {
                var div = document.getElementById("timer");
                div.style.cssText = "animation-name: animation2; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
            }
            if (segundos == 0) {
                Swal.fire({
                    title: "Oops...",
                    text: "¡Verifica tu respuesta!",
                    imageUrl: "../../img/img-juegos/loop.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
                incorrecto.play();
            } else {
                segundos--;
                setTimeout("iniciarTiempo()", 1000);
            }
        }
    </script>

    <script>
        // Deshabilitar todas las casillas
        for (fila = 1; fila <= 9; fila++) {
            for (columna = 1; columna <= 10; columna++) {
                document.getElementById(
                    "fila" + fila + "C" + columna
                ).readOnly = true;
            }
        }

        //Palabra funcion
        var palabra1_letra1 = document.getElementById("fila2C2");
        var palabra1_letra2 = document.getElementById("fila2C3");
        var palabra1_letra3 = document.getElementById("fila2C4");
        var palabra1_letra4 = document.getElementById("fila2C5");
        var palabra1_letra5 = document.getElementById("fila2C6");
        var palabra1_letra6 = document.getElementById("fila2C7");
        var palabra1_letra7 = document.getElementById("fila2C8");

        //Palabra python
        var palabra2_letra1 = document.getElementById("fila4C4");
        var palabra2_letra2 = document.getElementById("fila4C5");
        var palabra2_letra3 = document.getElementById("fila4C6");
        var palabra2_letra4 = document.getElementById("fila4C7");
        var palabra2_letra5 = document.getElementById("fila4C8");
        var palabra2_letra6 = document.getElementById("fila4C9");
        //Palabra consola
        var palabra3_letra1 = document.getElementById("fila8C3");
        var palabra3_letra2 = document.getElementById("fila8C4");
        var palabra3_letra3 = document.getElementById("fila8C5");
        var palabra3_letra4 = document.getElementById("fila8C6");
        var palabra3_letra5 = document.getElementById("fila8C7");
        var palabra3_letra6 = document.getElementById("fila8C8");
        var palabra3_letra7 = document.getElementById("fila8C9");
        //Palabra sintaxis
        var palabra4_letra1 = document.getElementById("fila1C6");
        var palabra4_letra2 = document.getElementById("fila2C6");
        var palabra4_letra3 = document.getElementById("fila3C6");
        var palabra4_letra4 = document.getElementById("fila4C6");
        var palabra4_letra5 = document.getElementById("fila5C6");
        var palabra4_letra6 = document.getElementById("fila6C6");
        var palabra4_letra7 = document.getElementById("fila7C6");
        var palabra4_letra8 = document.getElementById("fila8C6");

        //Palabra input
        var palabra5_letra1 = document.getElementById("fila7C6");
        var palabra5_letra2 = document.getElementById("fila7C7");
        var palabra5_letra3 = document.getElementById("fila7C8");
        var palabra5_letra4 = document.getElementById("fila7C9");
        var palabra5_letra5 = document.getElementById("fila7C10");
        //Habilitar las casillas necesarias (horizontales)
        palabra2_letra1.readOnly = false;
        palabra2_letra2.readOnly = false;
        palabra2_letra3.readOnly = false;
        palabra2_letra4.readOnly = false;
        palabra2_letra5.readOnly = false;
        palabra2_letra6.readOnly = false;


        palabra5_letra1.readOnly = false;
        palabra5_letra2.readOnly = false;
        palabra5_letra3.readOnly = false;
        palabra5_letra4.readOnly = false;
        palabra5_letra5.readOnly = false;


        palabra4_letra1.readOnly = false;
        palabra4_letra2.readOnly = false;
        palabra4_letra3.readOnly = false;
        palabra4_letra4.readOnly = false;
        palabra4_letra5.readOnly = false;
        palabra4_letra6.readOnly = false;
        palabra4_letra7.readOnly = false;
        palabra4_letra8.readOnly = false;

        //Habilitar las casillas necesarias (verticales)
        palabra3_letra1.readOnly = false;
        palabra3_letra2.readOnly = false;
        palabra3_letra3.readOnly = false;
        palabra3_letra4.readOnly = false;
        palabra3_letra5.readOnly = false;
        palabra3_letra6.readOnly = false;
        palabra3_letra7.readOnly = false;

        palabra1_letra1.readOnly = false;
        palabra1_letra2.readOnly = false;
        palabra1_letra3.readOnly = false;
        palabra1_letra4.readOnly = false;
        palabra1_letra5.readOnly = false;
        palabra1_letra6.readOnly = false;
        palabra1_letra7.readOnly = false;

        for (fila = 1; fila <= 9; fila++) {
            for (columna = 1; columna <= 10; columna++) {
                if (
                    document.getElementById("fila" + fila + "C" + columna)
                    .readOnly == false
                ) {
                    document.getElementById(
                        "fila" + fila + "C" + columna
                    ).style.backgroundColor = "rgba(61, 172, 244)";
                }
            }
        }

        //Mensaje de verificar respuesta en caso de haber respuestas erroneas
        var errorActivo = 0;

        function error() {
            Swal.fire({
                title: "Verifica tus respuestas",
                text: "Corrige tus respuestas antes de que termine el tiempo",
                icon: "info",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continuar",
            });
            errorActivo = 1;
        }

        //Esta funcion es para ejecutarse cada 5 segundos en caso de haber errores
        setInterval("ocultarError()", 5000);

        function ocultarError() {
            if (errorActivo == 1) {
                document.getElementById("mensaje").innerHTML = "";
                document.getElementById("mensaje").className = "";
                errorActivo = 0;
            }
        }

        //Verificar las palabras por casillas sumando sus letras y formar la palabra
        function verificar() {
            document.getElementById("mensaje").innerHTML = "";
            palabra1 =
                palabra1_letra1.value +
                palabra1_letra2.value +
                palabra1_letra3.value +
                palabra1_letra4.value +
                palabra1_letra5.value +
                palabra1_letra6.value +
                palabra1_letra7.value ;
            palabra2 =
                palabra2_letra1.value +
                palabra2_letra2.value +
                palabra2_letra3.value +
                palabra2_letra4.value +
                palabra2_letra5.value +
                palabra2_letra6.value ;
            palabra3 =
                palabra3_letra1.value +
                palabra3_letra2.value +
                palabra3_letra3.value +
                palabra3_letra4.value +
                palabra3_letra5.value +
                palabra3_letra6.value +
                palabra3_letra7.value ;
            palabra4 =
                palabra4_letra1.value +
                palabra4_letra2.value +
                palabra4_letra3.value +
                palabra4_letra4.value +
                palabra4_letra5.value +
                palabra4_letra6.value +
                palabra4_letra7.value +
                palabra4_letra8.value ;
            palabra5 =
                palabra5_letra1.value +
                palabra5_letra2.value +
                palabra5_letra3.value +
                palabra5_letra4.value +
                palabra5_letra5.value ;

            //Condicional para regresar que las repuestas sean correctas, en caso de no serlo, regresará error en la palabra que este mal
            if (
                palabra1.toLowerCase() == "funcion" &&
                palabra2.toLowerCase() == "python" &&
                palabra3.toLowerCase() == "consola" &&
                palabra4.toLowerCase() == "sintaxis" &&
                palabra5.toLowerCase() == "input"
            ) {
                Swal.fire({
                    title: "¡Bien hecho!",
                    text: "¡Puntuación guardada con éxito!",
                    imageUrl: "../../img/img-juegos/Thumbs-Up.gif",
                    imageHeight: 350,
                    backdrop: `
					rgba(0,143,255,0.6)
					url("../../img/img-juegos/fondo.gif")
					`,
                    confirmButtonColor: "#a14cd9",
                    confirmButtonText: "Aceptar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        <a href="../../../../../../rutas/ruta-py-b-<?php echo $rol;?>.php">
                    }
                });
                correcto.play(); //agregando sonido al juego completado
            } else {
                if (palabra1.toLowerCase() != "funcion") {
                    palabra1_letra1.value = "";
                    palabra1_letra2.value = "";
                    palabra1_letra3.value = "";
                    palabra1_letra4.value = "";
                    palabra1_letra5.value = "";
                    palabra1_letra6.value = "";
                    palabra1_letra7.value = "";
                    error();
                }

                if (palabra2.toLowerCase() != "python") {
                    palabra2_letra1.value = "";
                    palabra2_letra2.value = "";
                    palabra2_letra3.value = "";
                    palabra2_letra4.value = "";
                    palabra2_letra5.value = "";
                    palabra2_letra6.value = "";
                    error();
                }

                if (palabra3.toLowerCase() != "consola") {
                    palabra3_letra1.value = "";
                    palabra3_letra2.value = "";
                    palabra3_letra3.value = "";
                    palabra3_letra4.value = "";
                    palabra3_letra5.value = "";
                    palabra3_letra6.value = "";
                    palabra3_letra7.value = "";
                    error();
                }

                if (palabra4.toLowerCase() != "sintaxis") {
                    palabra4_letra1.value = "";
                    palabra4_letra2.value = "";
                    palabra4_letra3.value = "";
                    palabra4_letra4.value = "";
                    palabra4_letra5.value = "";
                    palabra4_letra6.value = "";
                    palabra4_letra7.value = "";
                    palabra4_letra8.value = "";
                    error();
                }

                if (palabra5.toLowerCase() != "input") {
                    palabra5_letra1.value = "";
                    palabra5_letra2.value = "";
                    palabra5_letra3.value = "";
                    palabra5_letra4.value = "";
                    palabra5_letra5.value = "";
                    error();
                }

                //Corrector de palabras agregando la letra que estaba bien de las que palabras ya agregadas
                if (palabra1.toLowerCase() == "funcion") {
                    palabra1_letra5.value = "i";
                }

                if (palabra2.toLowerCase() == "python") {
                    palabra2_letra3.value = "t";
                }

                if (palabra3.toLowerCase() == "consola") {
                    palabra3_letra4.value = "s";
                }

                if (palabra4.toLowerCase() == "sintaxis") {
                    palabra4_letra2.value = "i";
                    palabra4_letra4.value = "t";
                    palabra4_letra7.value = "i";
                    palabra4_letra8.value = "s";
                }

                if (palabra5.toLowerCase() == "input") {
                    palabra5_letra1.value = "i";
                }
            }
        }
    </script>

    <script>
        function habilitarMovimiento() {
            var inputs = document.querySelectorAll("#crucigrama input");

            for (var i = 0; i < inputs.length; i++) {
                inputs[i].addEventListener("input", function(e) {
                    var maxLength = parseInt(
                        e.target.getAttribute("maxlength")
                    );
                    var currentLength = e.target.value.length;

                    if (currentLength >= maxLength) {
                        // Mover el enfoque al siguiente input en la dirección elegida
                        var nextInput = getNextInput(e.target);

                        if (nextInput) {
                            nextInput.focus();
                        }
                    }
                });
            }

            function getNextInput(currentInput) {
                var tdParent = currentInput.parentElement;
                var trParent = tdParent.parentElement;
                var tdIndex = Array.prototype.indexOf.call(
                    trParent.children,
                    tdParent
                );
                var trIndex = Array.prototype.indexOf.call(
                    trParent.parentElement.children,
                    trParent
                );
                var direction = getMovementDirection(currentInput);

                if (direction === "horizontal") {
                    // Mover horizontalmente
                    return getNextHorizontalInput(
                        trParent,
                        tdIndex,
                        direction,
                        currentInput
                    );
                } else if (direction === "vertical") {
                    // Mover verticalmente
                    return getNextVerticalInput(
                        trParent,
                        tdIndex,
                        direction,
                        currentInput
                    );
                }

                return null;
            }

            function getMovementDirection(currentInput) {
                var tdParent = currentInput.parentElement;
                var trParent = tdParent.parentElement;
                var tdIndex = Array.prototype.indexOf.call(
                    trParent.children,
                    tdParent
                );
                var trIndex = Array.prototype.indexOf.call(
                    trParent.parentElement.children,
                    trParent
                );

                // Verificar si hay inputs disponibles en la misma fila (horizontal)
                for (
                    var i = tdIndex + 1; i < trParent.children.length; i++
                ) {
                    var input = trParent.children[i].querySelector("input");
                    if (
                        !input.disabled &&
                        !input.value &&
                        !input.readOnly
                    ) {
                        return "horizontal";
                    }
                }

                // Verificar si hay inputs disponibles en la misma columna (vertical)
                for (
                    var i = trIndex + 1; i < trParent.parentElement.children.length; i++
                ) {
                    var input =
                        trParent.parentElement.children[i].children[
                            tdIndex
                        ].querySelector("input");
                    if (
                        !input.disabled &&
                        !input.value &&
                        !input.readOnly
                    ) {
                        return "vertical";
                    }
                }

                return "";
            }

            function getNextHorizontalInput(
                trParent,
                tdIndex,
                direction,
                currentInput
            ) {
                // Mover horizontalmente
                if (direction === "horizontal") {
                    for (
                        var i = tdIndex + 1; i < trParent.children.length; i++
                    ) {
                        var nextInput =
                            trParent.children[i].querySelector("input");
                        if (
                            !nextInput.disabled &&
                            !nextInput.value &&
                            !nextInput.readOnly
                        ) {
                            return nextInput;
                        }
                    }
                }

                return null;
            }

            function getNextVerticalInput(
                trParent,
                tdIndex,
                direction,
                currentInput
            ) {
                // Mover verticalmente
                var trIndex = Array.prototype.indexOf.call(
                    trParent.parentElement.children,
                    trParent
                );

                for (
                    var i = trIndex + 1; i < trParent.parentElement.children.length; i++
                ) {
                    var nextInput =
                        trParent.parentElement.children[i].children[
                            tdIndex
                        ].querySelector("input");
                    if (
                        !nextInput.disabled &&
                        !nextInput.value &&
                        !nextInput.readOnly
                    ) {
                        return nextInput;
                    }
                }

                return null;
            }
        }

        habilitarMovimiento();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>