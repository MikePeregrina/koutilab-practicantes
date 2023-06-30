<?php 
session_start();
$id_user = $_SESSION['id_alumno_primaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_primaria'])) {
    header('location: ../../../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_primaria'];
$permiso = "capsulapago4";
$sql = mysqli_query($conexion, "SELECT c., d. FROM capsulas_pago_primaria c INNER JOIN detalle_capsulas_pago_primaria d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 2;");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../../../../../alertas/paquete_premium4.php");
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
    <a href="../../../../../../../../rutas/ruta-pw-i.php"><button
            style="float: left; position: absolute; margin: 70px 0 0 10px" class="btn-b" id="btn-cerrar-modalV">
            <i class="fas fa-reply"></i>
        </button>
    </a>
    <div class="instrucciones"></div>
    <div class="titulo-gen1">
        <h2>
            Capitulo 4: Cruzando el muro
        </h2>
    </div>
    <div class="titulo-gen3">
        <h5>
            Es la propiedad que controla el orden en el que aparecen en el contenedor flexible los objetos que creamos        
        </h5>
    </div>
    <div class="timer" id="timer">
        <b>Tiempo: <br />
            <p id="tiempo" style="margin: 0 0 0 0"></p>
        </b>
    </div>
    <br/>
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
                        text: 'Es la propiedad que controla el orden en el que aparecen en el contenedor flexible los objetos que creamos',
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
                div.style.cssText = "animation-name: animation1; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
            }
            if (segundos <= 30) {
                var div = document.getElementById("timer");
                div.style.cssText = "animation-name: animation2; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
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
                incorrecto.play();
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
                    gravity: { y: 600 },
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
            this.load.image("respuesta", "../assets/resp2-4.png");
            this.load.image("respuesta1", "../assets/resp1-4.png");
            this.load.image("cloud", "../assets/cloud.png")
            this.load.image("cloud-blue", "../assets/cloud-blue.png");
            this.load.image("label", "../assets/label.jpg");
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
            plataforms.create(400, 388, "wall");
            plataforms.create(400, 310, "wall");
            // plataforms.create(400, 356, "ground");
            plataforms.create(20, 560, "block");
            plataforms.create(52, 560, "block");
            plataforms.create(780, 560, "block");
            plataforms.create(748, 560, "block");
            plataforms.create(716, 560, "block");
            plataforms.create(780, 400, "block");
            plataforms.create(748, 400, "block");
            plataforms.create(716, 400, "block");
            plataforms.create(368, 126, "label");
            plataforms.create(432, 126, "label");
            
            this.add.image(36, 570, "cloud-blue").setScale(0.12);
            this.add.image(720, 570, "cloud-blue").setScale(0.11);
            this.add.image(780, 570, "cloud-blue").setScale(0.13);
            this.add.image(720, 410, "cloud-blue").setScale(0.11);
            this.add.image(780, 410, "cloud-blue").setScale(0.13);
            plataforms.create(160, 520, "cloud").setScale(1);
            plataforms.create(270, 470, "cloud").setScale(1);
            plataforms.create(355, 410, "cloud").setScale(1);
            plataforms.create(205, 360, "cloud").setScale(1);
            plataforms.create(70, 320, "cloud").setScale(1);
            plataforms.create(20, 250, "cloud").setScale(1);
            plataforms.create(130, 180, "cloud").setScale(1);
            plataforms.create(20, 120, "cloud").setScale(1);
            plataforms.create(250, 120, "cloud").setScale(1);
            plataforms.create(370, 260, "cloud").setScale(1);
            plataforms.create(650, 200, "cloud").setScale(1);
            plataforms.create(450, 300, "cloud").setScale(1);
            plataforms.create(550, 520, "cloud").setScale(1);
            plataforms.create(635, 460, "cloud").setScale(1);
            plataforms.create(450, 580, "cloud").setScale(1);

            this.add.image(745, 310, "respuesta").setScale(0.17);
            this.add.image(745, 470, "respuesta1").setScale(0.17);

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

            // spikes.create(336, 412, "spikes");
            // spikes.create(464, 412, "spikes");

            //Creacion del sprite y fisicas del jugador
            player = this.physics.add.sprite(35, 520, "dude").setScale(0.6);
            player.setCollideWorldBounds(false);
            player.setBounce(0.1);
            this.anims.create({
                key: "left",
                frames: this.anims.generateFrameNumbers("dude", { start: 0, end: 3 }),
                frameRate: 10,
                repeat: -1,
            });
            this.anims.create({
                key: "turn",
                frames: [{ key: "dude", frame: 4 }],
                frameRate: 20,
            });
            this.anims.create({
                key: "right",
                frames: this.anims.generateFrameNumbers("dude", { start: 5, end: 8 }),
                frameRate: 10,
                repeat: -1,
            });
            this.physics.add.collider(player, plataforms);
            cursors = this.input.keyboard.createCursorKeys();

            //Creacion de las estrellas y sus fisicas
            stars = this.physics.add.group({
                key: "star",
                setXY: { x: 20, y: 60 },
            });
            stars.create(368, 200, "star");
            stars.create(650, -600, "star");
            stars.create(450, 500, "star");
            stars.create(400, 40, "star");
            stars.children.iterate(function (child) {
                child.setBounceY(Phaser.Math.FloatBetween(1, 0.8));
            });
            this.physics.add.collider(stars, plataforms);
            this.physics.add.overlap(player, stars, collectStar, null, true);

            //Portal
            portal = this.physics.add.group({
                key: "portal",
                setXY: { x: 747, y: 512 },
            });
            this.physics.add.collider(portal, plataforms);
            this.physics.add.collider(player, portal, collectKey, null, true);

            portal1 = this.physics.add.group({
                key: "portal",
                setXY: { x: 747, y: 350 },
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

            // var bomb = bombs.create(200, 50, "bomb");
            // var bomb1 = bombs.create(500, 50, "bomb");
            // bomb.setBounce(1);
            // bomb.setCollideWorldBounds(true);
            // bomb.setVelocity(Phaser.Math.Between(-200, 200), 20);
            // bomb1.setBounce(1);
            // bomb1.setCollideWorldBounds(true);
            // bomb1.setVelocity(Phaser.Math.Between(-200, 200), 20);
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
                player.setVelocityY(-300);
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

        function collectKey(player, portal,) {
            portal.disableBody(true, true);
            alertWin();
            count = 10000000000;
        }

        function collectKey1(player, portal1,) {
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
            Swal.fire({
                title: '¡Perfecto!',
                text: 'Has completado el capitulo 4 de las aventuras de Koubot con 10 puntos y ' + score + ' estrellas de 5',
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
                            window.location.href = '../../../../../../../../rutas/ruta-pw-i.php';
                        }
                    });
                }
            });
            correcto.play(); //agregando sonido al juego completado
        }

        function alertQuestion() {
            Swal.fire({
                title: '¡Oh no!',
                text: 'Esa no es la respuesta, pero por 8 puntos vamos a intentarlo nuevamente con otra pregunta',
                imageUrl: "../img/loop.gif",
                imageHeight: 350,
                confirmButtonText: '¡Vamos!',
                confirmButtonColor: '#85c42c',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'lvl4-2.php';
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

        // const music = new Audio('../assets/8bit.mp3');
        // music.play();
        // music.loop =true;
        // music.volume -= 0.8;
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</body>

</html>