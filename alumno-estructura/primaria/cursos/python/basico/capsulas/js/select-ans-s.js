/* Ambos */
let preguntas_aleatorias = true;
let mostrar_pantalla_juego_términado = true;
let reiniciar_puntos_al_reiniciar_el_juego = true;
//sirve para que al inicial la pagina que cargen las preguntas guardadas en el archivo json
function iniciar() {
    base_preguntas = readText("../../js/base-preguntas-2.json");
    interprete_bp = JSON.parse(base_preguntas);
    escogerPreguntaAleatoria();
};

let pregunta;
let posibles_respuestas;
btn_correspondiente = [
    select_id("btn1"),
    select_id("btn2"),
    select_id("btn3"),
    select_id("btn4")
];
let npreguntas = [];

let preguntas_hechas = 0;
let preguntas_correctas = 0;

function escogerPreguntaAleatoria() {
    let n;
    if (preguntas_aleatorias) {
        n = Math.floor(Math.random() * interprete_bp.length);
    } else {
        n = 0;
    }

    while (npreguntas.includes(n)) {
        n++;
        if (n >= interprete_bp.length) {
            n = 0;
        }
        if (npreguntas.length == interprete_bp.length) {
            //Aquí es donde el juego se reinicia
            if (mostrar_pantalla_juego_términado) {
                swal.fire({
                    title: "Juego finalizado",
                    text:
                        "Puntuación: " + preguntas_correctas + "/" + "10",//preguntas_hechas
                    icon: "success",
                    confirmButtonText: '¡Genial!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        alertExcelent();
                    }
                });
            }
            if (reiniciar_puntos_al_reiniciar_el_juego) {
                preguntas_correctas = 0
                preguntas_hechas = 0
            }
            npreguntas = [];
        }
    }
    npreguntas.push(n);
    preguntas_hechas++;

    escogerPregunta(n);
}


function escogerPregunta(n) {
    pregunta = interprete_bp[n];
    select_id("categoria").innerHTML = pregunta.categoria;
    select_id("pregunta").innerHTML = pregunta.pregunta;
    select_id("numero").innerHTML = n;
    let pc = preguntas_correctas;
    if (preguntas_hechas > 1) {
        select_id("puntaje").innerHTML = pc + "/" + "10";
    } else {
        select_id("puntaje").innerHTML = "";
    }

    style("imagen").objectFit = pregunta.objectFit;
    desordenarRespuestas(pregunta);
    if (pregunta.imagen) {
        select_id("imagen").setAttribute("src", pregunta.imagen);
        style("imagen").height = "200px";
        style("imagen").width = "100%";
    } else {
        style("imagen").height = "0px";
        style("imagen").width = "0px";
        setTimeout(() => {
            select_id("imagen").setAttribute("src", "");
        }, 500);
    }
}

function desordenarRespuestas(pregunta) {
    posibles_respuestas = [
        pregunta.respuesta,
        pregunta.incorrecta1,
        pregunta.incorrecta2,
        pregunta.incorrecta3,
    ];
    posibles_respuestas.sort(() => Math.random() - 0.5);

    select_id("btn1").innerHTML = posibles_respuestas[0];
    select_id("btn2").innerHTML = posibles_respuestas[1];
    select_id("btn3").innerHTML = posibles_respuestas[2];
    select_id("btn4").innerHTML = posibles_respuestas[3];
}

let suspender_botones = false;

function oprimir_btn(i) {
    if (suspender_botones) {
        return;
    }
    suspender_botones = true;
    if (posibles_respuestas[i] == pregunta.respuesta) {
        preguntas_correctas++;
        btn_correspondiente[i].style.background = "#85c42caf";
    } else {
        btn_correspondiente[i].style.background = "red";
    }
    for (let j = 0; j < 4; j++) {
        if (posibles_respuestas[j] == pregunta.respuesta) {
            btn_correspondiente[j].style.background = "#85c42caf";
            break;
        }
    }
    setTimeout(() => {
        reiniciar();
        suspender_botones = false;
    }, 1000);
}

// let p = prompt("numero")

function reiniciar() {
    for (const btn of btn_correspondiente) {
        btn.style.background = "rgba(61, 172, 244, 0.7)";
    }
    escogerPreguntaAleatoria();
}
//sirve para seleccionar un objeto segun su ID
function select_id(id) {
    return document.getElementById(id);
}
//sirve para seleccionar el estilo segun su ID
function style(id) {
    return select_id(id).style;
}
//sirve para leer rutas de texto local que en este caso serian las preguntas que estan en el archivo "base-preguntas.json"
function readText(ruta_local) {
    var texto = null;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", ruta_local, false);
    xmlhttp.send();
    if (xmlhttp.status == 200) {
        texto = xmlhttp.responseText;
    }
    return texto;
}
/* Ambos */

