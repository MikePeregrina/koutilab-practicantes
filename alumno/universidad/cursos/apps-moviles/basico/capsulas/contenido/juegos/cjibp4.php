<?php
session_start();
$id_user = $_SESSION['id_alumno_universidad'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_universidad'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_universidad'];
$permiso = "capsulapago2";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_universidad c INNER JOIN detalle_capsulas_pago_universidad d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 13");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../../../../basico/capsulas/contenido/alertas/paquete_premium4.php");
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
    <link rel="stylesheet" href="../../css/css-juegos/crucigrama02.css" />
</head>

<body onload="iniciarTiempo();">
    <!-- CAMBIOS -->
    <div class="timer" id="timer">
        <b>Tiempo: <br>
            <p id="tiempo" style="margin: 0 0 0 0;"></p>
        </b>
    </div>

    <!-- Titulo general -->
    <div class="titulo-gen">
        <h2 class="titulo"><b>SISTEMAS OPERATIVOS</b></h2>
    </div>

    <!-- Alerta -->
    <div id="mensaje" style="position: absolute"></div>


    <!-- Contenido donde está el crucigrama y las frases que desacriben la palabra buscada -->
    <section>

        <div class="cont-st">
            <a href="../../../../../../rutas/ruta-in-b.php">
                <button class="btn-b">
                    <i class="fas fa-reply"></i>
                </button>
            </a>
            <h6 class="titulo"><b>Busca la palabra que describe el texto</b></h6>
        </div>
        <!--FIN CAMBIOS -->
        <div class="mjuego">
            <!-- Apartado donde van las frases a buscar por el usuario -->
            <div class="words">
                <table>
                    <tr>

                        <td>
                            <div class="horizontal">
                                <b class="tituloV">Horizontales:</b>
                                <br>
                                1. Conjunto de pasos lógicos escritos en un lenguaje de programación
                                que nos permite realizar una tarea específica
                                <br /><br />
                                2. Sistema operativo que su icono mas conocido es un pinguino
                                <br /><br />
                                3. La primera version de este sistema operativo se lanzo en 1985.
                                <br /><br />
                                4. Es un conjunto de elementos físicos y lógicos capaz de guardar y procesar información
                                <br /><br />
                                <b style="margin-left: 66px" class="tituloV">Verticales:</b>
                                <div class="vertical">
                                    1. Windows es un sistema ____________.

                                </div>
                        </td>

                        <td></td>
                    </tr>
                </table>
            </div>


            <!-- Apartado del crucigrama junto con sus casillas -->
            <div class="crucigrama">
                <div class="numero1">1.</div>
                <div class="numero1-1">1.</div>
                <div class="numero2-2">2.</div>
                <div class="numero3-3">3.</div>
                <div class="numero2">4.</div>
                <table id="crucigrama">
                    <tr>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila1C1" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila1C2" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila1C3" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila1C4" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila1C5" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila1C6" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila1C7" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila1C8" />
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
                            <input class="casilla" type="text" maxlength="1" id="fila2C2" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila2C3" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila2C4" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila2C5" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila2C6" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila2C7" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila2C8" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila2C9" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
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
                            <input class="casilla" type="text" maxlength="1" id="fila3C2" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila3C3" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila3C4" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila3C5" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila3C6" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila3C7" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila3C8" />
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
                                " />
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
                            <input class="casilla" type="text" maxlength="1" id="fila4C4" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila4C5" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila4C6" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila4C7" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila4C8" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila4C9" style=" border-style: none;
                                 background-color: rgba(255, 255, 255, 0); " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila4C10" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C1" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C2" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C3" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C4" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C5" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C6" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C7" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C8" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C9" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila5C10" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
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
                            <input class="casilla" type="text" maxlength="1" id="fila6C6" />
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
                                " />
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
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila7C4" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila7C5" />
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
                            <input class="casilla" type="text" maxlength="1" id="fila7C10" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
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
                            <input class="casilla" type="text" maxlength="1" id="fila8C3" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila8C4" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila8C5" style="
                                border-style: none;
                                background-color: rgba(255, 255, 255, 0);
                            " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila8C6" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila8C7" style="
                                border-style: none;
                                background-color: rgba(255, 255, 255, 0);
                            " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila8C8" style="
                                border-style: none;
                                background-color: rgba(255, 255, 255, 0);
                            " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila8C9" style="
                                border-style: none;
                                background-color: rgba(255, 255, 255, 0);
                            " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila8C10" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
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
                                " />
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
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila9C6" />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila9C7" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila9C8" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila9C9" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                        <td>
                            <input class="casilla" type="text" maxlength="1" id="fila9C10" style="
                                    border-style: none;
                                    background-color: rgba(255, 255, 255, 0);
                                " />
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- boton de verificar respuestas -->
        </div>

        <!-- boton de verificar respuestas -->
        <button class="verificar" onClick="verificar()">
            Comprobar respuestas
        </button>
        </div>
    </section>

    <!-- CAMBIOS -->
    <footer class="footerimga">
        <div class="imagen-footer">
            <img src="../../img/img_juegos/benvenida.png" alt="No-image">
        </div>
    </footer>
    <!-- FIN CAMBIOS -->
    <script>
        //Se esta llamando los sonidos de la carpeta "sonidos"
        var correcto = document.createElement("audio");
        correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
        var incorrecto = document.createElement("audio");
        incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

        var segundos = 65; //240
        let puntos = 0;

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
                div.style.cssText = "animation-name: animation3; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
            }
            if (segundos == 0) {
                var xmlhttp = new XMLHttpRequest();

                var param =
                    "score=" +
                    0 +
                    "&validar=" +
                    "incorrecto" +
                    "&permiso=" +
                    9 +
                    "&id_curso=" +
                    1; //cancatenation
                Swal.fire({
                    title: "Oops...",
                    text: "¡Verifica tu respuesta!",
                    imageUrl: "../../img/img_juegos/loop.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
                incorrecto.play(); //adjuntando sonido del juego no completado
                xmlhttp.open(
                    "POST",
                    "../../acciones/insertar_cp9.php",
                    true
                );
                xmlhttp.setRequestHeader(
                    "Content-Type",
                    "application/x-www-form-urlencoded"
                );
                xmlhttp.send(param);
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

        //Palabra Windows
        var palabra1_letra1 = document.getElementById("fila1C2");
        var palabra1_letra2 = document.getElementById("fila1C3");
        var palabra1_letra3 = document.getElementById("fila1C4");
        var palabra1_letra4 = document.getElementById("fila1C5");
        var palabra1_letra5 = document.getElementById("fila1C6");
        var palabra1_letra6 = document.getElementById("fila1C7");
        var palabra1_letra7 = document.getElementById("fila1C8");

        //Palabra Operativo
        var palabra2_letra1 = document.getElementById("fila1C6");
        var palabra2_letra2 = document.getElementById("fila2C6");
        var palabra2_letra3 = document.getElementById("fila3C6");
        var palabra2_letra4 = document.getElementById("fila4C6");
        var palabra2_letra5 = document.getElementById("fila5C6");
        var palabra2_letra6 = document.getElementById("fila6C6");
        var palabra2_letra7 = document.getElementById("fila7C6");
        var palabra2_letra8 = document.getElementById("fila8C6");
        var palabra2_letra9 = document.getElementById("fila9C6");

        //Palabra Sistema
        var palabra3_letra1 = document.getElementById("fila3C2");
        var palabra3_letra2 = document.getElementById("fila3C3");
        var palabra3_letra3 = document.getElementById("fila3C4");
        var palabra3_letra4 = document.getElementById("fila3C5");
        var palabra3_letra5 = document.getElementById("fila3C6");
        var palabra3_letra6 = document.getElementById("fila3C7");
        var palabra3_letra7 = document.getElementById("fila3C8");

        //Palabra Linux
        var palabra4_letra1 = document.getElementById("fila7C5");
        var palabra4_letra2 = document.getElementById("fila7C6");
        var palabra4_letra3 = document.getElementById("fila7C7");
        var palabra4_letra4 = document.getElementById("fila7C8");
        var palabra4_letra5 = document.getElementById("fila7C9");


        //Palabra Programas
        var palabra5_letra1 = document.getElementById("fila5C1");
        var palabra5_letra2 = document.getElementById("fila5C2");
        var palabra5_letra3 = document.getElementById("fila5C3");
        var palabra5_letra4 = document.getElementById("fila5C4");
        var palabra5_letra5 = document.getElementById("fila5C5");
        var palabra5_letra6 = document.getElementById("fila5C6");
        var palabra5_letra7 = document.getElementById("fila5C7");
        var palabra5_letra8 = document.getElementById("fila5C8");
        var palabra5_letra9 = document.getElementById("fila5C9");

        //Habilitar las casillas necesarias (horizontales)
        palabra2_letra1.readOnly = false;
        palabra2_letra2.readOnly = false;
        palabra2_letra3.readOnly = false;
        palabra2_letra4.readOnly = false;
        palabra2_letra5.readOnly = false;
        palabra2_letra6.readOnly = false;
        palabra2_letra7.readOnly = false;
        palabra2_letra8.readOnly = false;
        palabra2_letra9.readOnly = false;



        palabra5_letra1.readOnly = false;
        palabra5_letra2.readOnly = false;
        palabra5_letra3.readOnly = false;
        palabra5_letra4.readOnly = false;
        palabra5_letra5.readOnly = false;
        palabra5_letra6.readOnly = false;
        palabra5_letra7.readOnly = false;
        palabra5_letra8.readOnly = false;
        palabra5_letra9.readOnly = false;

        palabra4_letra1.readOnly = false;
        palabra4_letra2.readOnly = false;
        palabra4_letra3.readOnly = false;
        palabra4_letra4.readOnly = false;
        palabra4_letra5.readOnly = false;


        palabra3_letra1.readOnly = false;
        palabra3_letra2.readOnly = false;
        palabra3_letra3.readOnly = false;
        palabra3_letra4.readOnly = false;
        palabra3_letra5.readOnly = false;
        palabra3_letra6.readOnly = false;
        palabra3_letra7.readOnly = false;



        //Habilitar las casillas necesarias (verticales)

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
                palabra1_letra7.value;

            palabra2 =
                palabra2_letra1.value +
                palabra2_letra2.value +
                palabra2_letra3.value +
                palabra2_letra4.value +
                palabra2_letra5.value +
                palabra2_letra6.value +
                palabra2_letra7.value +
                palabra2_letra8.value +
                palabra2_letra9.value;
            palabra3 =
                palabra3_letra1.value +
                palabra3_letra2.value +
                palabra3_letra3.value +
                palabra3_letra4.value +
                palabra3_letra5.value +
                palabra3_letra6.value +
                palabra3_letra7.value;
            palabra4 =
                palabra4_letra1.value +
                palabra4_letra2.value +
                palabra4_letra3.value +
                palabra4_letra4.value +
                palabra4_letra5.value;
            palabra5 =
                palabra5_letra1.value +
                palabra5_letra2.value +
                palabra5_letra3.value +
                palabra5_letra4.value +
                palabra5_letra5.value +
                palabra5_letra6.value +
                palabra5_letra7.value +
                palabra5_letra8.value +
                palabra5_letra9.value;

            //Condicional para regresar que las repuestas sean correctas, en caso de no serlo, regresará error en la palabra que este mal
            if (
                palabra1.toLowerCase() == "windows" &&
                palabra2.toLowerCase() == "operativo" &&
                palabra3.toLowerCase() == "sistema" &&
                palabra4.toLowerCase() == "linux" &&
                palabra5.toLowerCase() == "programas"
            ) {
                var xmlhttp = new XMLHttpRequest();

                var param =
                    "score=" +
                    10 +
                    "&validar=" +
                    "correcto" +
                    "&permiso=" +
                    9 +
                    "&id_curso=" +
                    1; //cancatenation

                xmlhttp.onreadystatechange = function() {
                    Swal.fire({
                        title: "¡Bien hecho!",
                        text: "¡Puntuación guardada con éxito!",
                        imageUrl: "../../img/img_juegos/Thumbs-Up.gif",
                        imageHeight: 350,
                        backdrop: `
            rgba(0,143,255,0.6)
            url("../../img/img_juegos/fondo.gif")
            `,
                        confirmButtonColor: "#a14cd9",
                        confirmButtonText: "Aceptar",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../../../../../../rutas/ruta-in-b.php';
                        }
                    });
                };
                correcto.play(); //agregando sonido al juego completado
                xmlhttp.open(
                    "POST",
                    "../../acciones/insertar_cp9.php",
                    true
                );
                xmlhttp.setRequestHeader(
                    "Content-Type",
                    "application/x-www-form-urlencoded"
                );
                xmlhttp.send(param);
            } else {
                if (palabra1.toLowerCase() != "windows") {
                    palabra1_letra1.value = "";
                    palabra1_letra2.value = "";
                    palabra1_letra3.value = "";
                    palabra1_letra4.value = "";
                    palabra1_letra5.value = "";
                    palabra1_letra6.value = "";
                    palabra1_letra7.value = "";

                    error();
                }

                if (palabra2.toLowerCase() != "operativo") {
                    palabra2_letra1.value = "";
                    palabra2_letra2.value = "";
                    palabra2_letra3.value = "";
                    palabra2_letra4.value = "";
                    palabra2_letra5.value = "";
                    palabra2_letra6.value = "";
                    palabra2_letra7.value = "";
                    palabra2_letra8.value = "";
                    palabra2_letra9.value = "";
                    error();
                }

                if (palabra3.toLowerCase() != "sistema") {
                    palabra3_letra1.value = "";
                    palabra3_letra2.value = "";
                    palabra3_letra3.value = "";
                    palabra3_letra4.value = "";
                    palabra3_letra5.value = "";
                    palabra3_letra6.value = "";
                    palabra3_letra7.value = "";
                    error();
                }

                if (palabra4.toLowerCase() != "linux") {
                    palabra4_letra1.value = "";
                    palabra4_letra2.value = "";
                    palabra4_letra3.value = "";
                    palabra4_letra4.value = "";
                    palabra4_letra5.value = "";
                    error();
                }

                if (palabra5.toLowerCase() != "programas") {
                    palabra5_letra1.value = "";
                    palabra5_letra2.value = "";
                    palabra5_letra3.value = "";
                    palabra5_letra4.value = "";
                    palabra5_letra5.value = "";
                    palabra5_letra6.value = "";
                    palabra5_letra7.value = "";
                    palabra5_letra8.value = "";
                    palabra5_letra9.value = "";
                    error();
                }

                //Corrector de palabras agregando la letra que estaba bien de las que palabras ya agregadas
                if (palabra1.toLowerCase() == "windows") {
                    palabra1_letra5.value = "o";

                }

                if (palabra2.toLowerCase() == "operativo") {
                    palabra1_letra5.value = "o";
                    palabra3_letra5.value = "e";
                    palabra5_letra6.value = "a";
                    palabra4_letra2.value = "i";
                }

                if (palabra3.toLowerCase() == "sistema") {
                    palabra2_letra3.value = "e";
                }

                if (palabra4.toLowerCase() == "linux") {
                    palabra2_letra7.value = "i";
                }

                if (palabra5.toLowerCase() == "programas") {
                    palabra2_letra5.value = "a";
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