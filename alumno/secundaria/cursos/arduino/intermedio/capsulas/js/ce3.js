var question = document.getElementById("question");
var div = document.querySelectorAll("#div2");
var submit = document.getElementById("submit");
var next = document.getElementById("next");
var start = document.getElementById("start");
var div1 = document.getElementById("div1");
var error = document.getElementById("error");
var inform = document.getElementById("inform");
var save = document.getElementById("save");

//fetch API then create the quiz
function fetchQuiz() {
    fetch('../../js/ce3.json')
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            let i = 0;
            var score = 0;

            //create the questions and choices
            function create() {
                question.innerHTML = data[i].question;
                const array = [data[i].correctAnswer,
                data[i].incorrectAnswers[0],
                data[i].incorrectAnswers[1],
                data[i].incorrectAnswers[2]];
                shuffle(array);
                for (let j = 0; j < div.length; j++) {
                    var id = document.createAttribute("id");
                    var draggable = document.createAttribute("draggable");
                    var ondragstart = document.createAttribute("ondragstart");
                    id.value = j;
                    draggable.value = "true";
                    ondragstart.value = "drag(event)";
                    var p = document.createElement("p");
                    p.setAttributeNode(id);
                    p.setAttributeNode(draggable);
                    p.setAttributeNode(ondragstart);
                    p.innerText = array[j];
                    div[j].appendChild(p);
                }
            }

            //remove the questions and choices
            function remove() {
                if (div1.hasChildNodes()) {
                    div1.removeChild(div1.children[0]);
                }
                for (let j = 0; j < div.length; j++) {
                    if (div[j].hasChildNodes()) {
                        div[j].removeChild(div[j].children[0]);
                    }
                }
            }

            //submit answer button
            submit.addEventListener("click", () => {
                if (div1.hasChildNodes()) {
                    const answer = div1.children;
                    if (answer[0].innerText == data[i].correctAnswer) {
                        score++;
                        Swal.fire(
                            'Buen trabajo',
                            '¡Respuesta correcta!',
                            'success'
                        )
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '¡No has seleccionado una respuesta!',
                    })
                }
                document.getElementById("score").innerHTML = score + "/" + (i + 1);
                submit.style.display = "none";
                next.style.display = "inline";
            });

            //next question button
            next.addEventListener("click", () => {
                i++;
                if (i >= 4) {
                    inform.style.display = "block";
                    save.style.display = "inline";
                    next.style.display = "none";
                    div1.style.display = "none";
                    question.style.display = "none";
                    for (let j = 0; j < div.length; j++) {
                        div[j].style.display = "none";
                    }
                    inform.innerHTML = "¡Felicidades! Obtuviste " + score + " puntos. Vuelva a cargar nuevas preguntas.";
                } else {
                    submit.style.display = "inline";
                    next.style.display = "none";
                    remove();
                    create();
                }
            });

            //start quiz button
            start.addEventListener("click", () => {
                submit.style.display = "inline";
                question.style.display = "block";
                div1.style.display = "block";
                for (let j = 0; j < div.length; j++) {
                    div[j].style.display = "block";
                }
                inform.style.display = "none";
                start.style.display = "none";
                create();
            });

            //save score button
            save.addEventListener("click", () => {
                var xmlhttp = new XMLHttpRequest();
                var param = "score=" + score + "&validar=" + 'correcto' + "&permiso=" + 23 + "&id_curso=" + 8; //cancatenation

                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        Swal.fire({
                            title: '+' + score + ' puntos',
                            text: '¡Puntuación guardada con éxito!',
                            imageUrl: "../../../../../../img/Thumbs-Up.gif",
                            imageHeight: 350,
                            backdrop: `
                    rgba(0,143,255,0.6)
                    url("../../../../../../img/fondo-estrellas.jpeg")
                    `,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar',
                        }).then((result) => {
                            window.location.href = '../../../../../../rutas/ruta-py-i.php';
                        });
                    }
                }
                xmlhttp.open("POST", "../../acciones/insertar_pd23.php", true);
                xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlhttp.send(param);
            });
        })
        .catch(() => {
            error.innerHTML = "No puedo cargar preguntas";
        });
}

fetchQuiz();

//drag and drop api
function allowDrop(ev) {
    ev.preventDefault();
}
function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}
function drop(ev) {
    ev.preventDefault();
    if (ev.target.tagName == "P") { return; }
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
}

//shuffle the choices
function shuffle(array) {
    let currentIndex = array.length, randomIndex;

    while (currentIndex != 0) {
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex--;

        [array[currentIndex], array[randomIndex]] = [array[randomIndex], array[currentIndex]];
    }

    return array;
}