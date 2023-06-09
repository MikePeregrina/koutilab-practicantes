<?php
$html = "";
if ($_POST["paiselegido"]=='Primaria') {
    $html = '
    <option value="">Seleccione..</option>
    <option value="Primero">Primero</option>
    <option value="Segundo">Segundo</option>
    <option value="Tercero">Tercero</option>
    <option value="Cuarto">Cuarto</option>
    <option value="Quinto">Quinto</option>
    <option value="Sexto">Sexto</option>
    ';  
}
if ($_POST["paiselegido"]=='Secundaria') {
    $html = '
    <option value="">Seleccione..</option>
    <option value="Primero">Primero</option>
    <option value="Segundo">Segundo</option>
    <option value="Tercero">Tercero</option>
    ';  
}
if ($_POST["paiselegido"]=='Preparatoria') {
    $html = '
    <option value="">Seleccione..</option>
    <option value="Primero">Primero</option>
    <option value="Segundo">Segundo</option>
    <option value="Tercero">Tercero</option>
    '; 
}
echo $html; 
?>