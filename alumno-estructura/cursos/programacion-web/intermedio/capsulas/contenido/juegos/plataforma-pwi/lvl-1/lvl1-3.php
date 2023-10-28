<?php
session_start();
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
    header('location: ../../../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
$permiso = "capsulapago1";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 2;");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../../../../../../intermedio/capsulas/contenido/alertas/paquete_premium1.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="..//img/lgk.png" />
    <link rel="stylesheet" href="../css/phaser.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body onload="alert1()">
    <a href="../../../../../../../../rutas/ruta-pw-i.php"><button style="float: left; position: absolute; margin: 70px 0 0 10px" class="btn-b" id="btn-cerrar-modalV">
            <i class="fas fa-reply"></i>
        </button>
    </a>
    <div class="instrucciones"></div>

    <div class="titulo-gen1">
        <h2>
            ESTRUCTURA DE DIRECTORIOS
        </h2>
    </div>
    <div class="titulo-gen3">
        <h5>
            Cuando tenemos un proyecto grande con varias secciones y categorías, podemos dividir nuestro sitio en...
        </h5>
    </div>
    <div class="timer" id="timer">
        <b>Tiempo: <br />
            <p id="tiempo" style="margin: 0 0 0 0"></p>
        </b>
    </div>
    <br />
    <div class="logotipo">
        <img src="../img/koutilab.png" id="logo" alt="">
    </div>
    <script>
        function alert1() {
            Swal.fire({
                title: '¡Hola otra vez!',
                text: 'Ayuda a Koubot a recolectar estrellas y llegar a su nave espacial que contenga la respuesta correcta, pero cuidado de no tocar los obstaculos',
                imageUrl: "../img/loop.gif",
                imageHeight: 320,
                confirmButtonText: '¡Vamos!',
                confirmButtonColor: '#85c42c',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Elige la nave correcta',
                        text: 'Cuando tenemos un proyecto grande con varias secciones y categorías, podemos dividir nuestro sitio en...',
                        imageUrl: "../img/loop.gif",
                        imageHeight: 320,
                        confirmButtonText: '¡Vamos!',
                        confirmButtonColor: '#85c42c',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            iniciarTiempo();
                        }
                    });
                }
            });
        }
    </script>
    <script>
        var segundos = 120;

        let puntos = 0;

        var count = 1000;
        //Funcion que agrega el sonido al juego
        var correcto = document.createElement("audio");
        correcto.src = "../../../../../../../../../acciones/sonidos/correcto.mp3";
        var incorrecto = document.createElement("audio");
        incorrecto.src = "../../../../../../../../../../acciones/sonidos/incorrecto.mp3";

        function iniciarTiempo() {
            document.getElementById('tiempo').innerHTML = segundos + " segundos";
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
                Swal.fire({
                    title: 'Oops...',
                    text: 'Se acabó el tiempo',
                    imageUrl: "../img/loop.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
                incorrecto.play(); //agregando sonido al juego no completado
                loseText.setText("Juego terminado");
                player.setTint(0xff0000);
                player.anims.play("turn");
                gameoverSound();
                gameOver = true;
            } else {
                segundos--;
                setTimeout("iniciarTiempo()", count);
            }
        }
    </script>
    <script src="../src/phaser.min.js"></script>
    <script>
        //Configuraciones del juego
        var config = {
            type: Phaser.AUTO,
            width: 800,
            height: 580,
            physics: {
                default: "arcade",
                arcade: {
                    gravity: {
                        y: 700
                    },
                    debug: false,
                },
            },
            scene: {
                preload: preload,
                create: create,
                update: update,
            },
        };

        //Variable de puntuacion
        var score = 0;

        //Variable de texto de puntuacion
        var scoreText;
        var loseText;

        //VAriable de juego terminado
        var gameOver = false;

        //Variable de nuevo juego que autoinicia
        var game = new Phaser.Game(config);

        //Funcion que carga todos los sprites y al juego
        function preload() {
            this.load.image("sky", "../assets/space2.jpg");
            this.load.image("ground", "../assets/stone-ground.png");
            this.load.image("wall", "../assets/stone-wall.png");
            this.load.image("star", "../assets/star.png");
            this.load.image("bomb", "../assets/bomb.png");
            this.load.image("tree", "../assets/tree.png");
            this.load.image("key", "../assets/key.png");
            this.load.image("block", "../assets/block1.jpg");
            this.load.image("spikes", "../assets/spikes.png");
            this.load.image("portal", "../assets/cohete.png");
            this.load.image("respuesta", "../assets/resp6-1.png");
            this.load.image("respuesta1", "../assets/resp5-1.png");
            this.load.spritesheet("dude", "../assets/dude.png", {
                frameWidth: 32,
                frameHeight: 48,
            });
        }

        //Funcion para crear todos los sprites al juego
        function create() {
            //Creacion de sprite del entorno
            this.add.image(400, 302, "sky").setScale(1.2);
            plataforms = this.physics.add.staticGroup();
            plataforms.create(192, 564, "ground").refreshBody();
            plataforms.create(576, 564, "ground").refreshBody();
            plataforms.create(192, 21, "ground").refreshBody();
            plataforms.create(576, 21, "ground").refreshBody();
            plataforms.create(224, 404, "ground").refreshBody();
            plataforms.create(448, 404, "ground").refreshBody();
            plataforms.create(192, 149, "ground").refreshBody();
            plataforms.create(576, 276, "ground").refreshBody();
            plataforms.create(16, 356, "wall").refreshBody();
            plataforms.create(16, 5, "wall").refreshBody();
            plataforms.create(784, 388, "wall").refreshBody();
            plataforms.create(784, 5, "wall").refreshBody();
            plataforms.create(720, 532, "block");
            plataforms.create(752, 500, "block");
            plataforms.create(656, 436, "block");
            plataforms.create(177, 276, "block");
            plataforms.create(209, 276, "block");
            plataforms.create(305, 276, "block");
            plataforms.create(80, 372, "block");
            plataforms.create(48, 340, "block");
            plataforms.create(688, 244, "block");
            plataforms.create(720, 244, "block");
            plataforms.create(752, 244, "block");
            plataforms.create(592, 181, "block");
            plataforms.create(560, 181, "block");
            plataforms.create(464, 149, "block");
            plataforms.create(720, 212, "block");
            plataforms.create(752, 212, "block");
            plataforms.create(720, 180, "block");
            plataforms.create(752, 180, "block");
            spikes = this.physics.add.staticGroup();
            spikes.create(592, 540, "spikes");
            spikes.create(208, 540, "spikes");
            spikes.create(240, 540, "spikes");
            spikes.create(368, 540, "spikes");
            spikes.create(400, 540, "spikes");
            spikes.create(496, 380, "spikes");
            spikes.create(368, 380, "spikes");
            this.add.image(78, 150, "respuesta").setScale(0.17);
            this.add.image(740, 180, "respuesta1").setScale(0.17);
            // this.add.image(150, 465, "tree").setScale(0.1);

            //Creacion del sprite y fisicas del jugador
            player = this.physics.add.sprite(60, 520, "dude").setScale(0.7);
            player.setCollideWorldBounds(true);
            player.setBounce(0.1);
            this.anims.create({
                key: "left",
                frames: this.anims.generateFrameNumbers("dude", {
                    start: 0,
                    end: 3
                }),
                frameRate: 10,
                repeat: -1,
            });
            this.anims.create({
                key: "turn",
                frames: [{
                    key: "dude",
                    frame: 4
                }],
                frameRate: 20,
            });
            this.anims.create({
                key: "right",
                frames: this.anims.generateFrameNumbers("dude", {
                    start: 5,
                    end: 8
                }),
                frameRate: 10,
                repeat: -1,
            });
            this.physics.add.collider(player, plataforms);
            cursors = this.input.keyboard.createCursorKeys();

            //Creacion de las estrellas y sus fisicas
            stars = this.physics.add.group({
                key: "star",
                setXY: {
                    x: 250,
                    y: 100
                },
            });
            stars.create(305, 500, "star");
            stars.create(560, 340, "star");
            stars.create(497, 190, "star");
            stars.create(240, 340, "star");
            stars.children.iterate(function(child) {
                child.setBounceY(Phaser.Math.FloatBetween(0.4, 0.8));
            });
            this.physics.add.collider(stars, plataforms);
            this.physics.add.overlap(player, stars, collectStar, null, true);

            //Portal
            portal = this.physics.add.group({
                key: "portal",
                setXY: {
                    x: 75,
                    y: 101
                },
            });
            this.physics.add.collider(portal, plataforms);
            this.physics.add.collider(player, portal, collectKey, null, true);

            portal1 = this.physics.add.group({
                key: "portal",
                setXY: {
                    x: 740,
                    y: 101
                },
            });
            this.physics.add.collider(portal1, plataforms);
            this.physics.add.collider(player, portal1, collectKey1, null, true);

            //Creacion del puntaje del jugador
            scoreText = this.add.text(40, 40, "Estrellas: 0/5", {
                fontSize: "20px",
                fill: "white",
            });
            loseText = this.add.text(160, 100, "", {
                fontSize: "50px",
                fill: "red",
            });
            bombs = this.physics.add.group();

            //Creacion de las bombas y sus fisicas
            this.physics.add.collider(bombs, plataforms);
            this.physics.add.collider(player, bombs, hitBomb, null, true);
            this.physics.add.collider(player, spikes, hitBomb, null, true);
        }

        //Funcion para actualizar el juego todo el tiempo
        function update() {
            //Termina el juego una vez el jugador pierda
            if (gameOver) {
                this.physics.pause();
                return
            }

            //Actualizacion de ubicacion del jugador conforme presiona las teclas
            if (cursors.left.isDown) {
                player.setVelocityX(-160);
                player.anims.play("left", true);
            } else if (cursors.right.isDown) {
                player.setVelocityX(160);
                player.anims.play("right", true);
            } else {
                player.setVelocityX(0);
                player.anims.play("turn");
            }
            if (cursors.space.isDown && player.body.touching.down) {
                player.setVelocityY(-330);
                jumpSound();
            }
        }

        //Funcion de recoleccion de estrellas
        function collectStar(player, star) {
            star.disableBody(true, true);
            score += 1;

            colectSound();

            //Actualizar puntuacion
            scoreText.setText("Estrellas: " + score + "/5");



            //Cuando las estrellas se acaban, reaparecen mas estrellas y se agrega una bomba
            // if (stars.countActive(true) === 0) {
            //     stars.children.iterate(function (child) {
            //         child.enableBody(true, child.x, 0, true, true);
            //     });
            //     var x =
            //         player.x < 400
            //             ? Phaser.Math.Between(400, 800)
            //             : Phaser.Math.Between(0, 400);
            //     var bomb = bombs.create(x, 16, "bomb");
            //     bomb.setBounce(1);
            //     bomb.setCollideWorldBounds(true);
            //     bomb.setVelocity(Phaser.Math.Between(-200, 200), 20);
            // }
        }

        function collectKey(player, portal1) {
            portal1.disableBody(true, true);
            alertQuestion();
            count = 10000000000;
        }

        function collectKey1(player, portal) {
            portal.disableBody(true, true);
            alertWin();
            count = 10000000000;
        }

        //Funcion para acabar el juego si el jugador choca con una bomba
        function hitBomb(player, bombs) {
            loseText.setText("Juego terminado");
            player.setTint(0xff0000);
            player.anims.play("turn");
            gameoverSound();
            setTimeout(() => {
                console.log(alertLose());
            }, 600);
            gameOver = true;
            count = 10000000000;
        }

        function alertLose() {
            Swal.fire({
                title: 'Oops...',
                text: 'El juego ha terminado, tu puntuación es: ' + score,
                imageUrl: "../img/loop.gif",
                imageHeight: 350,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        }

        //Funcion que envia los datos de estrellas a la base de datos
        function alertWin() {
            estrellas = score * 3;
            Swal.fire({
                title: '¡Genial!',
                text: 'Has completado el capitulo 1 de las aventuras de Koubot con 6 puntos y ' + score + ' estrellas de 5',
                imageUrl: "../img/Thumbs-Up.gif",
                imageHeight: 350,
                confirmButtonText: 'Continuar',
                confirmButtonColor: '#85c42c',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        text: 'Consigue la siguiente capsula premium para seguir con la aventura',
                        imageUrl: "../img/Thumbs-Up.gif",
                        imageHeight: 350,
                        confirmButtonText: '¡Vamos!',
                        confirmButtonColor: '#85c42c',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../acciones/insertar_ep1.php?id_capsula=' + 1 + '&id_curso=' + 2 + '&estrellas=' + estrellas;
                        }
                    });
                }
            });
            correcto.play(); //agregando sonido al juego completado
        }

        //Funcion que envia los datos de estrellas a la base de datos pero sin trofeos
        function alertQuestion() {
            estrellas = score * 3;
            Swal.fire({
                title: '¡Buen intento!',
                text: 'Esa no es la respuesta, pero haz completado el capitulo 1 de las aventuras de Koubot con ' + score + ' estrellas de 5, consigue las siguientes capsulas premium para seguir con la aventura',
                imageUrl: "../img/loop.gif",
                imageHeight: 350,
                confirmButtonText: '¡Vamos!',
                confirmButtonColor: '#85c42c',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../acciones/insertar_ep1.php?id_capsula=' + 1 + '&id_curso=' + 2 + '&estrellas=' + estrellas;
                }
            });
        }

        function jumpSound() {
            const music = new Audio('../assets/jump.mp3');
            music.play();
            music.volume -= 0.9;
            music.loop = false;
        }

        function colectSound() {
            const music = new Audio('../assets/colect.mp3');
            music.play();
            music.volume -= 0.5;
            music.loop = false;
        }

        function gameoverSound() {
            const music = new Audio('../assets/endagame.mp3');
            music.play();
            music.volume -= 0.5;
            music.loop = false;
        }

        function activarLogro() {
            const div = "<div class='logro'><b>Logro<br /><p></p></b></div>";
            document.documentElement.innerHTML = div;
            // document.write('<div class="logro"><b>Logro<br /><p></p></b></div>');
        }

        // const music = new Audio('assets/8bit.mp3');
        // music.play();
        // music.loop =true;
        // music.volume -= 0.8;
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</body>

</html>