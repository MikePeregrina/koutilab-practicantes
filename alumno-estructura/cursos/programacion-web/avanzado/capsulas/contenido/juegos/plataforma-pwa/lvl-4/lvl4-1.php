<?php
session_start();
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
    header('location: ../../../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
$permiso = "capsulapago4";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_preparatoria c INNER JOIN detalle_capsulas_pago_preparatoria d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 3;");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../../../../../../avanzado/capsulas/contenido/alertas/paquete_premium4.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png" />
    <link rel="stylesheet" href="../css/phaser.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body onload="alert1()">
    <a href="#" onclick="history.back(); return false;"><button style="float: left; position: absolute; margin: 70px 0 0 10px" class="btn-b">
            <i class="fas fa-reply"></i>
        </button>
    </a>
    <div class="instrucciones"></div>

    <div class="titulo-gen1">
        <h2>FUNCIONES</h2>
    </div>
    <div class="titulo-gen3">
        <h5>
            En PHP, ¿Cómo se le llama al conjuto de instrucciones que se pueden llamar varias veces en un programa?
        </h5>
    </div>

    <div class="timer" id="timer">
        <b>Tiempo: <br />
            <p id="tiempo" style="margin: 0 0 0 0"></p>
        </b>
    </div>
    <br />
    <div class="logotipo">
        <img src="../img/koutilab.png" id="logo" alt="" />
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
                        text: 'En PHP, ¿Cómo se le llama al conjuto de instrucciones que se pueden llamar varias veces en un programa?',
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
        correcto.src = "../../../../../../../../../../acciones/sonidos/correcto.mp3";
        var incorrecto = document.createElement("audio");
        incorrecto.src = "../../../../../../../../../../acciones/sonidos/incorrecto.mp3";

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
                Swal.fire({
                    title: "Oops...",
                    text: "Se acabó el tiempo",
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
                        y: -100
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
        var powerText;

        //Salto
        var jumpV = 80;

        //Variable de juego terminado
        var gameOver = false;

        //Variable de nuevo juego que autoinicia
        var game = new Phaser.Game(config);

        //Funcion que carga todos los sprites y al juego
        function preload() {
            this.load.image("sky", "../assets/space-moon.png");
            this.load.image("ground", "../assets/stone-ground.png");
            this.load.image("wall", "../assets/stone-wall.png");
            this.load.image("star", "../assets/star-i.png");
            this.load.image("bomb", "../assets/bomb.png");
            this.load.image("block", "../assets/block1.jpg");
            this.load.image("spikes", "../assets/spikes.png");
            this.load.image("portal", "../assets/cohete-i.png");
            this.load.image("key", "../assets/key-i.png");
            this.load.image("power", "../assets/poweUp.png");
            this.load.image("moon-stone", "../assets/moon-stone-i.png");
            this.load.image("moon-label", "../assets/moon-label.png");
            this.load.image("respuesta", "../assets/resp1-4.png");
            this.load.image("respuesta1", "../assets/resp2-4.png");
            this.load.spritesheet("dude", "../assets/dude-i.png", {
                frameWidth: 32,
                frameHeight: 48,
            });

            this.load.spritesheet("fire", "../assets/fire-map.png", {
                frameWidth: 50,
                frameHeight: 50,
            });
        }

        //Funcion para crear todos los sprites al juego
        function create() {
            //Creacion de sprite del entorno
            this.add.image(400, 302, "sky").setScale(0.6);
            plataforms = this.physics.add.staticGroup();
            plataforms.create(300, 80, "moon-stone");
            plataforms.create(500, 80, "moon-stone");

            plataforms.create(400, 170, "moon-stone");
            plataforms.create(400, 300, "moon-stone");

            plataforms.create(100, 250, "moon-stone");
            plataforms.create(700, 250, "moon-stone");
            plataforms.create(600, 400, "moon-stone");
            plataforms.create(200, 400, "moon-stone");

            plataforms.create(740, 80, "moon-label");
            plataforms.create(60, 80, "moon-label");

            plataforms.create(460, 480, "moon-label");
            plataforms.create(340, 480, "moon-label");

            spikes = this.physics.add.staticGroup();
            spikes.create(-224, -100, "spikes");
            spikes.create(-192, -100, "spikes");
            spikes.create(-160, -100, "spikes");
            spikes.create(-128, -100, "spikes");
            spikes.create(-96, -100, "spikes");
            spikes.create(-64, -100, "spikes");
            spikes.create(-32, -100, "spikes");
            spikes.create(0, -100, "spikes");
            spikes.create(32, -100, "spikes");
            spikes.create(64, -100, "spikes");
            spikes.create(96, -100, "spikes");
            spikes.create(128, -100, "spikes");
            spikes.create(160, -100, "spikes");
            spikes.create(192, -100, "spikes");
            spikes.create(224, -100, "spikes");
            spikes.create(256, -100, "spikes");
            spikes.create(288, -100, "spikes");
            spikes.create(320, -100, "spikes");
            spikes.create(352, -100, "spikes");
            spikes.create(384, -100, "spikes");
            spikes.create(416, -100, "spikes");
            spikes.create(448, -100, "spikes");
            spikes.create(480, -100, "spikes");
            spikes.create(512, -100, "spikes");
            spikes.create(544, -100, "spikes");
            spikes.create(576, -100, "spikes");
            spikes.create(608, -100, "spikes");
            spikes.create(640, -100, "spikes");
            spikes.create(672, -100, "spikes");
            spikes.create(704, -100, "spikes");
            spikes.create(736, -100, "spikes");
            spikes.create(768, -100, "spikes");
            spikes.create(800, -100, "spikes");
            spikes.create(832, -100, "spikes");
            spikes.create(864, -100, "spikes");
            spikes.create(896, -100, "spikes");
            spikes.create(928, -100, "spikes");
            spikes.create(960, -100, "spikes");
            spikes.create(992, -100, "spikes");
            this.add.image(340, 445, "respuesta").setScale(0.17);
            this.add.image(460, 445, "respuesta1").setScale(0.17);

            //Creacion del sprite y fisicas del jugador
            player = this.physics.add.sprite(740, 120, "dude").setScale(0.5);

            player.setCollideWorldBounds(false);
            player.setBounce(0.1);
            this.anims.create({
                key: "left",
                frames: this.anims.generateFrameNumbers("dude", {
                    start: 0,
                    end: 3,
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
                    end: 8,
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
                    x: 600,
                    y: 500
                },
            });
            stars.create(100, 400, "star");
            stars.create(400, 220, "star");
            stars.create(200, 500, "star");
            stars.create(700, 400, "star");
            stars.children.iterate(function(child) {
                child.setBounceY(Phaser.Math.FloatBetween(0.4, 0.8));
            });
            this.physics.add.collider(stars, plataforms);
            this.physics.add.overlap(
                player,
                stars,
                collectStar,
                null,
                true
            );

            //Portal
            portal = this.physics.add.group();
            this.physics.add.collider(portal, plataforms);
            this.physics.add.collider(
                player,
                portal,
                collectKey,
                null,
                true
            );

            portal1 = this.physics.add.group();
            this.physics.add.collider(portal1, plataforms);
            this.physics.add.collider(
                player,
                portal1,
                collectKey1,
                null,
                true
            );

            key = this.physics.add.group({
                key: "key",
                setXY: {
                    x: 400,
                    y: 340
                },
            });
            this.physics.add.collider(key, plataforms);
            this.physics.add.collider(
                player,
                key,
                collectKey2,
                null,
                true
            );

            power = this.physics.add.group({
                key: "power",
                setXY: {
                    x: 60,
                    y: 140
                },
            });
            this.physics.add.collider(power, plataforms);
            this.physics.add.collider(
                player,
                power,
                collectKey3,
                null,
                true
            );

            //Creacion del puntaje del jugador
            scoreText = this.add.text(40, 40, "Estrellas: 0/5", {
                fontSize: "20px",
                fill: "white",
            });
            loseText = this.add.text(160, 100, "", {
                fontSize: "50px",
                fill: "red",
            });
            powerText = this.add.text(480, 40, "Potenciador de salto: ✘", {
                fontSize: "20px",
                fill: "white",
            });

            //Creacion de las bombas y sus fisicas
            bombs = this.physics.add.group();
            this.physics.add.collider(bombs, plataforms);
            this.physics.add.collider(player, bombs, hitBomb, null, true);
            this.physics.add.collider(player, spikes, hitBomb, null, true);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 200, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 6000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 300, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 8000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 500, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 9000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 400, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 11000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 300, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 12000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 200, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 13000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 500, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 15000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 300, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 17000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 100, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 19000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 250, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 20000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 350, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 24000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 400, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 26000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 300, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 28000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 400, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 30000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 200, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 36000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 300, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 38000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 500, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 39000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 400, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 41000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 300, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 42000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 200, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 43000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 500, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 45000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 300, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 47000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 100, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 49000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 250, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 50000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 350, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 54000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 400, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 56000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 300, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 58000);

            setTimeout(() => {
                fire = this.physics.add.sprite(0, 400, "fire");
                this.anims.create({
                    key: "fire-a",
                    frames: this.anims.generateFrameNumbers("fire", {
                        start: 0,
                        end: 5,
                    }),
                    frameRate: 10,
                    repeat: -1,
                });
                fire.anims.play("fire-a");
                fire.setVelocityX(400);
                fire.setVelocityY(100);
                this.physics.add.collider(
                    player,
                    fire,
                    hitBomb,
                    null,
                    true
                );
            }, 60000);
        }

        //Funcion para actualizar el juego todo el tiempo
        function update() {
            //Termina el juego una vez el jugador pierda
            if (gameOver) {
                this.physics.pause();
                return;
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
            if (cursors.space.isDown && player.body.touching.up) {
                player.setVelocityY(jumpV);
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
        }

        function collectKey(player, portal) {
            portal.disableBody(true, true);
            alertWin();
            count = 10000000000;
        }

        function collectKey1(player, portal1) {
            portal1.disableBody(true, true);
            alertQuestion();
            count = 10000000000;
        }

        function collectKey2(player, key) {
            key.disableBody(true, true);
            var portals = portal.create(340, 540, "portal");
            var portals1 = portal1.create(460, 540, "portal");
        }

        function collectKey3(player, power) {
            power.disableBody(true, true);
            jumpV = 150;
            powerText.setText("Potenciador de salto: ✔");
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
                title: "Oops...",
                text: "El juego ha terminado, tu puntuación es: " + score,
                imageUrl: "../img/loop.gif",
                imageHeight: 350,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        }

        function alertWin() {
            estrellas = score * 3;
            Swal.fire({
                title: "¡Perfecto!",
                text: "Has completado el capitulo 4 de las aventuras de Koubot con 10 puntos y " +
                    score +
                    " estrellas de 5",
                imageUrl: "../img/Thumbs-Up.gif",
                imageHeight: 350,
                confirmButtonText: "Continuar",
                confirmButtonColor: "#85c42c",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        text: "Consigue la siguiente capsula premium para seguir con la aventura",
                        imageUrl: "../img/Thumbs-Up.gif",
                        imageHeight: 350,
                        confirmButtonText: "¡Vamos!",
                        confirmButtonColor: "#85c42c",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../acciones/insertar_ep1.php?id_capsula=' + 4 + '&id_curso=' + 3 + '&estrellas=' + estrellas;
                        }
                    });
                }
            });
            correcto.play(); //agregando sonido al juego completado
        }

        function alertQuestion() {
            Swal.fire({
                title: "¡Oh no!",
                text: "Esa no es la respuesta, pero por 8 puntos vamos a intentarlo nuevamente con otra pregunta",
                imageUrl: "../img/loop.gif",
                imageHeight: 350,
                confirmButtonText: "¡Vamos!",
                confirmButtonColor: "#85c42c",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "lvl4-2.php";
                }
            });
        }

        function jumpSound() {
            const music = new Audio("../assets/jump.mp3");
            music.play();
            music.volume -= 0.9;
            music.loop = false;
        }

        function colectSound() {
            const music = new Audio("../assets/colect.mp3");
            music.play();
            music.volume -= 0.5;
            music.loop = false;
        }

        function gameoverSound() {
            const music = new Audio("../assets/endagame.mp3");
            music.play();
            music.volume -= 0.5;
            music.loop = false;
        }
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</body>

</html>