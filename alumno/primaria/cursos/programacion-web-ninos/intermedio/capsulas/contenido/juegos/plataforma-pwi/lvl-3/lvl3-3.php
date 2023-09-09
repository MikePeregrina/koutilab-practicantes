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
    <a href="../../../../../../../../rutas/ruta-pw-i.php"><button style="float: left; position: absolute; margin: 70px 0 0 10px" class="btn-b" id="btn-cerrar-modalV">
            <i class="fas fa-reply"></i>
        </button>
    </a>
    <div class="instrucciones"></div>
    <div class="titulo-gen1">
        <h2 class="titulo">
            PSEUDO CLASES
        </h2>
    </div>
    <div class="titulo-gen3">
        <h5>
            Son las pseudo clases que nos permiten insertar contenido después y antes del contenido del elemento al que lo apliquemos a través de la propiedad “content“
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
                        text: 'Son las pseudo clases que nos permiten insertar contenido después y antes del contenido del elemento al que lo apliquemos a través de la propiedad “content“',
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
                        y: 600
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
            this.load.image("respuesta", "../assets/resp4-3.png");
            this.load.image("respuesta1", "../assets/resp3-3.png");
            this.load.image("cloud", "../assets/cloud.png")
            this.load.image("cloud-blue", "../assets/cloud-blue.png");
            this.load.spritesheet("dude", "../assets/dude.png", {
                frameWidth: 32,
                frameHeight: 48,
            });
        }

        //Funcion para crear todos los sprites al juego
        function create() {
            //Creacion de sprite del entorno
            this.add.image(400, 335, "sky").setScale(1.2);
            plataforms = this.physics.add.staticGroup();
            plataforms.create(48, 564, "block");
            plataforms.create(80, 564, "block");
            plataforms.create(350, 300, "block");
            plataforms.create(382, 300, "block");
            plataforms.create(414, 300, "block");
            plataforms.create(700, 100, "block");
            plataforms.create(668, 100, "block");
            plataforms.create(732, 100, "block");
            plataforms.create(700, 550, "block");
            plataforms.create(668, 550, "block");
            plataforms.create(732, 550, "block");
            this.add.image(350, 310, "cloud-blue").setScale(0.11);
            this.add.image(405, 315, "cloud-blue").setScale(0.13);
            this.add.image(668, 108, "cloud-blue").setScale(0.11);
            this.add.image(728, 115, "cloud-blue").setScale(0.13);
            this.add.image(668, 558, "cloud-blue").setScale(0.11);
            this.add.image(728, 565, "cloud-blue").setScale(0.13);
            plataforms.create(240, 540, "cloud");
            plataforms.create(410, 500, "cloud");
            plataforms.create(590, 460, "cloud");
            plataforms.create(750, 390, "cloud");
            plataforms.create(590, 320, "cloud");
            plataforms.create(200, 340, "cloud");
            plataforms.create(80, 300, "cloud");
            plataforms.create(30, 420, "cloud");
            plataforms.create(30, 230, "cloud");
            plataforms.create(100, 150, "cloud");
            plataforms.create(30, 80, "cloud");
            plataforms.create(300, 120, "cloud");
            plataforms.create(500, 100, "cloud");
            this.add.image(720, 15, "respuesta").setScale(0.17);
            this.add.image(720, 460, "respuesta1").setScale(0.17);
            spikes = this.physics.add.staticGroup();
            spikes.create(-224, 690, "spikes");
            spikes.create(-192, 690, "spikes");
            spikes.create(-160, 690, "spikes");
            spikes.create(-128, 690, "spikes");
            spikes.create(-96, 690, "spikes");
            spikes.create(-64, 690, "spikes");
            spikes.create(-32, 690, "spikes");
            spikes.create(0, 690, "spikes");
            spikes.create(32, 690, "spikes");
            spikes.create(64, 690, "spikes");
            spikes.create(96, 690, "spikes");
            spikes.create(128, 690, "spikes");
            spikes.create(160, 690, "spikes");
            spikes.create(192, 690, "spikes");
            spikes.create(224, 690, "spikes");
            spikes.create(256, 690, "spikes");
            spikes.create(288, 690, "spikes");
            spikes.create(320, 690, "spikes");
            spikes.create(352, 690, "spikes");
            spikes.create(384, 690, "spikes");
            spikes.create(416, 690, "spikes");
            spikes.create(448, 690, "spikes");
            spikes.create(480, 690, "spikes");
            spikes.create(512, 690, "spikes");
            spikes.create(544, 690, "spikes");
            spikes.create(576, 690, "spikes");
            spikes.create(608, 690, "spikes");
            spikes.create(640, 690, "spikes");
            spikes.create(672, 690, "spikes");
            spikes.create(704, 690, "spikes");
            spikes.create(736, 690, "spikes");
            spikes.create(768, 690, "spikes");
            spikes.create(800, 690, "spikes");
            spikes.create(832, 690, "spikes");
            spikes.create(864, 690, "spikes");
            spikes.create(896, 690, "spikes");
            spikes.create(928, 690, "spikes");
            spikes.create(960, 690, "spikes");
            spikes.create(992, 690, "spikes");

            //Creacion del sprite y fisicas del jugador
            player = this.physics.add.sprite(60, 520, "dude").setScale(0.7);
            player.setCollideWorldBounds(false);
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
                    x: 25,
                    y: 20
                },
            });
            stars.create(32, 350, "star");
            stars.create(500, 45, "star");
            stars.create(590, 190, "star");
            stars.create(383, 200, "star");
            stars.children.iterate(function(child) {
                child.setBounceY(Phaser.Math.FloatBetween(1, 0.8));
            });
            this.physics.add.collider(stars, plataforms);
            this.physics.add.overlap(player, stars, collectStar, null, true);

            //Portal
            portal = this.physics.add.group({
                key: "portal",
                setXY: {
                    x: 720,
                    y: 53
                },
            });
            this.physics.add.collider(portal, plataforms);
            this.physics.add.collider(player, portal, collectKey, null, true);

            //Portal
            portal1 = this.physics.add.group({
                key: "portal",
                setXY: {
                    x: 720,
                    y: 500
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

        function alertWin() {
            estrellas = score * 3;
            Swal.fire({
                title: '¡Perfecto!',
                text: 'Has completado el capitulo 3 de las aventuras de Koubot con 6 puntos y ' + score + ' estrellas de 5',
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
                            window.location.href = '../acciones/insertar_ep1.php?id_capsula=' + 3 + '&id_curso=' + 14 + '&estrellas=' + estrellas;
                        }
                    });
                }
            });
            correcto.play(); //agregando sonido al juego completado
        }

        function alertQuestion() {
            estrellas = score * 3;
            Swal.fire({
                title: '¡Buen intento!',
                text: 'Esa no es la respuesta, pero haz completado el capitulo 3 de las aventuras de Koubot con ' + score + ' estrellas de 5, consigue las siguientes capsulas premium para seguir con la aventura',
                imageUrl: "../img/loop.gif",
                imageHeight: 350,
                confirmButtonText: '¡Vamos!',
                confirmButtonColor: '#85c42c',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../acciones/insertar_ep1.php?id_capsula=' + 3 + '&id_curso=' + 14 + '&estrellas=' + estrellas;
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