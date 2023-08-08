<?php
session_start();
$id_user = $_SESSION['id_alumno_universidad'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_universidad'])) {
	header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_universidad'];
$permiso = "capsula15";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_universidad c INNER JOIN detalle_capsulas_universidad d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 6");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
	header("Location: ../../../../avanzado/capsulas/acciones/capsulas.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 16;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_universidad WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 6");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_universidad WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 6");
$resultadoIntentos = mysqli_fetch_assoc($consultaIntentos);
if (isset($resultadoIntentos['intentos'])) {
	$totalIntentos = $resultadoIntentos['intentos'];
	if ($totalIntentos == 2 && $result_sql_permisos == 0) {
		$puntosGanados = 8;
	} else if ($totalIntentos == 3 && $result_sql_permisos == 0) {
		$puntosGanados = 6;
	} else if ($totalIntentos > 3 && $result_sql_permisos == 0) {
		$puntosGanados = 0;
	} else {
		$puntosGanados = 0;
	}
} else {
	$puntosGanados = 10;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Maze</title>
	<link rel="shortcut icon" href="../../../../../../img/lgk.png" />
	<link rel="stylesheet" href="../../css/css-juegos/laberinto.css">
	<link rel="stylesheet" href="../../css/footer.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
	<!-- Timer -->
	<div class="timer" id="timer">
		<b>Tiempo: <br>
			<p id="tiempo" style="margin: 0 0 0 0;"></p>
		</b>
	</div>

	<!-- Titulo general -->
	<div class="titulo-gen">
		<h2 class="titulo"><b>TRABAJANDO CON ARCHIVOS</b></h2>
	</div>

	<section>
		<div class="cont-st">
			<a href="../../../../../../rutas/ruta-py-a.php">
				<button class="btn-b">
					<i class="fas fa-reply"></i>
				</button>
			</a>
			<h5 class="titulo"><b>Usa las flechas para ayudar a Koubot a llegar hasta su cohete espacial</b></h5>
		</div>

		<div id="page">

			<div id="Message-Container">
				<div id="message">
					<p id="moves"></p>
				</div>
			</div>

			<br>
			<div id="menu" style="margin-top: -500px; position: absolute;">
				<div class="custom-select">
					<select id="diffSelect">
						<option value="10">Easy</option>
						<option value="15">Medium</option>
						<option value="25">Hard</option>
						<option value="38">Extreme</option>
					</select>
				</div>
				<input id="startMazeBtn" type="button" onclick="makeMaze()" value="Start" />
			</div>

			<div class="maze-contenedor">
				<div id="view">
					<div id="mazeContainer">
						<canvas id="mazeCanvas" class="border" height="1100" width="1100" style="background-color: rgba(61, 171, 244, 0.5)"></canvas>
					</div>
				</div>
			</div>

			<!-- <p id="instructions">Use arrow keys to move the key to the house!</p> -->

		</div>
	</section>
	<footer class="footerimga">
		<div class="imagen-footer">
			<img src="../../img/benvenida.png" alt="No-image">
		</div>
	</footer>




	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.18/jquery.touchSwipe.min.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<script>
		Swal.fire({
			title: '¡Oh no!',
			text: 'Koubot se ha perdido y necesita llegar hasta su cohete espacial, ¿Podrías ayudarlo a llegar hasta el?',
			imageUrl: "../../img/img-juegos/loop.gif",
			imageHeight: 320,
			confirmButtonText: '¡Vamos!',
			confirmButtonColor: '#85c42c',
		}).then((result) => {
			if (result.isConfirmed) {
				iniciarTiempo();
			}
		});
	</script>
	<script>
		var segundos = 240;
		let puntos = 0;

		//Funcion que agrega el sonido al juego
		var Correcto = document.createElement("audio");
		Correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
		var Incorrecto = document.createElement("audio");
		Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

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
				var xmlhttp = new XMLHttpRequest();

				var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 16 + "&id_curso=" + 6; //cancatenation
				Swal.fire({
					title: 'Oops...',
					text: '¡Verifica tu respuesta!',
					imageUrl: "../../img/img-juegos/loop.gif",
					imageHeight: 350,
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.reload();
					}
				});
				Incorrecto.play(); //agregando sonido al juego no completado
				xmlhttp.open("POST", "../../acciones/insertar_pd16.php", true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send(param);
			} else {
				segundos--;
				setTimeout("iniciarTiempo()", 1000);
			}
		}
	</script>
	<script>
		function rand(max) {
			return Math.floor(Math.random() * max);
		}

		function shuffle(a) {
			for (let i = a.length - 1; i > 0; i--) {
				const j = Math.floor(Math.random() * (i + 1));
				[a[i], a[j]] = [a[j], a[i]];
			}
			return a;
		}

		function changeBrightness(factor, sprite) {
			var virtCanvas = document.createElement("canvas");
			virtCanvas.width = 500;
			virtCanvas.height = 500;
			var context = virtCanvas.getContext("2d");
			context.drawImage(sprite, 0, 0, 500, 500);

			var imgData = context.getImageData(0, 0, 500, 500);

			for (let i = 0; i < imgData.data.length; i += 4) {
				imgData.data[i] = imgData.data[i] * factor;
				imgData.data[i + 1] = imgData.data[i + 1] * factor;
				imgData.data[i + 2] = imgData.data[i + 2] * factor;
			}
			context.putImageData(imgData, 0, 0);

			var spriteOutput = new Image();
			spriteOutput.src = virtCanvas.toDataURL();
			virtCanvas.remove();
			return spriteOutput;
		}

		function displayVictoryMess(moves) {
			document.getElementById("moves").innerHTML = moves;
			toggleVisablity("Message-Container");
			var puntos = <?php echo $puntosGanados; ?>

			var xmlhttp = new XMLHttpRequest();
			var param = "score=" + 10 + "&validar=" + 'correcto' + "&permiso=" + 16 + "&id_curso=" + 6; //cancatenation
			xmlhttp.open("POST", "../../acciones/insertar_pd16.php", true);
			xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xmlhttp.send(param);
			Swal.fire({
				title: '¡Muy bien!',
				text: "¡Buen trabajo! Obtienes " + puntos + " puntos de logros",
				imageUrl: "../../img/img-juegos/Thumbs-Up.gif",
				imageHeight: 350,
				backdrop: `
			rgba(0,143,255,0.6)
			url("../../img/img-juegos/fondo.gif")`,
				confirmButtonColor: '#a14cd9',
				confirmButtonText: '¡Vamos!',
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = '../../../../../../rutas/ruta-py-a.php';
				}
			})
			Correcto.play(); //agregando sonido al juego completado
		}

		function toggleVisablity(id) {
			if (document.getElementById(id).style.visibility == "visible") {
				document.getElementById(id).style.visibility = "hidden";
			} else {
				document.getElementById(id).style.visibility = "visible";
			}
		}

		function Maze(Width, Height) {
			var mazeMap;
			var width = Width;
			var height = Height;
			var startCoord, endCoord;
			var dirs = ["n", "s", "e", "w"];
			var modDir = {
				n: {
					y: -1,
					x: 0,
					o: "s"
				},
				s: {
					y: 1,
					x: 0,
					o: "n"
				},
				e: {
					y: 0,
					x: 1,
					o: "w"
				},
				w: {
					y: 0,
					x: -1,
					o: "e"
				}
			};

			this.map = function() {
				return mazeMap;
			};
			this.startCoord = function() {
				return startCoord;
			};
			this.endCoord = function() {
				return endCoord;
			};

			function genMap() {
				mazeMap = new Array(height);
				for (y = 0; y < height; y++) {
					mazeMap[y] = new Array(width);
					for (x = 0; x < width; ++x) {
						mazeMap[y][x] = {
							n: false,
							s: false,
							e: false,
							w: false,
							visited: false,
							priorPos: null
						};
					}
				}
			}

			function defineMaze() {
				var isComp = false;
				var move = false;
				var cellsVisited = 1;
				var numLoops = 0;
				var maxLoops = 0;
				var pos = {
					x: 0,
					y: 0
				};
				var numCells = width * height;
				while (!isComp) {
					move = false;
					mazeMap[pos.x][pos.y].visited = true;

					if (numLoops >= maxLoops) {
						shuffle(dirs);
						maxLoops = Math.round(rand(height / 8));
						numLoops = 0;
					}
					numLoops++;
					for (index = 0; index < dirs.length; index++) {
						var direction = dirs[index];
						var nx = pos.x + modDir[direction].x;
						var ny = pos.y + modDir[direction].y;

						if (nx >= 0 && nx < width && ny >= 0 && ny < height) {
							//Check if the tile is already visited
							if (!mazeMap[nx][ny].visited) {
								//Carve through walls from this tile to next
								mazeMap[pos.x][pos.y][direction] = true;
								mazeMap[nx][ny][modDir[direction].o] = true;

								//Set Currentcell as next cells Prior visited
								mazeMap[nx][ny].priorPos = pos;
								//Update Cell position to newly visited location
								pos = {
									x: nx,
									y: ny
								};
								cellsVisited++;
								//Recursively call this method on the next tile
								move = true;
								break;
							}
						}
					}

					if (!move) {
						//  If it failed to find a direction,
						//  move the current position back to the prior cell and Recall the method.
						pos = mazeMap[pos.x][pos.y].priorPos;
					}
					if (numCells == cellsVisited) {
						isComp = true;
					}
				}
			}

			function defineStartEnd() {
				switch (rand(4)) {
					case 0:
						startCoord = {
							x: 0,
							y: 0
						};
						endCoord = {
							x: height - 1,
							y: width - 1
						};
						break;
					case 1:
						startCoord = {
							x: 0,
							y: width - 1
						};
						endCoord = {
							x: height - 1,
							y: 0
						};
						break;
					case 2:
						startCoord = {
							x: height - 1,
							y: 0
						};
						endCoord = {
							x: 0,
							y: width - 1
						};
						break;
					case 3:
						startCoord = {
							x: height - 1,
							y: width - 1
						};
						endCoord = {
							x: 0,
							y: 0
						};
						break;
				}
			}

			genMap();
			defineStartEnd();
			defineMaze();
		}

		function DrawMaze(Maze, ctx, cellsize, endSprite = null) {
			var map = Maze.map();
			var cellSize = cellsize;
			var drawEndMethod;
			ctx.lineWidth = cellSize / 40;

			this.redrawMaze = function(size) {
				cellSize = size;
				ctx.lineWidth = cellSize / 50;
				drawMap();
				drawEndMethod();
			};

			function drawCell(xCord, yCord, cell) {
				var x = xCord * cellSize;
				var y = yCord * cellSize;

				if (cell.n == false) {
					ctx.beginPath();
					ctx.moveTo(x, y);
					ctx.lineTo(x + cellSize, y);
					ctx.stroke();
				}
				if (cell.s === false) {
					ctx.beginPath();
					ctx.moveTo(x, y + cellSize);
					ctx.lineTo(x + cellSize, y + cellSize);
					ctx.stroke();
				}
				if (cell.e === false) {
					ctx.beginPath();
					ctx.moveTo(x + cellSize, y);
					ctx.lineTo(x + cellSize, y + cellSize);
					ctx.stroke();
				}
				if (cell.w === false) {
					ctx.beginPath();
					ctx.moveTo(x, y);
					ctx.lineTo(x, y + cellSize);
					ctx.stroke();
				}
			}

			function drawMap() {
				for (x = 0; x < map.length; x++) {
					for (y = 0; y < map[x].length; y++) {
						drawCell(x, y, map[x][y]);
					}
				}
			}

			function drawEndFlag() {
				var coord = Maze.endCoord();
				var gridSize = 4;
				var fraction = cellSize / gridSize - 2;
				var colorSwap = true;
				for (let y = 0; y < gridSize; y++) {
					if (gridSize % 2 == 0) {
						colorSwap = !colorSwap;
					}
					for (let x = 0; x < gridSize; x++) {
						ctx.beginPath();
						ctx.rect(
							coord.x * cellSize + x * fraction + 4.5,
							coord.y * cellSize + y * fraction + 4.5,
							fraction,
							fraction
						);
						if (colorSwap) {
							ctx.fillStyle = "rgba(0, 0, 0, 0.8)";
						} else {
							ctx.fillStyle = "rgba(255, 255, 255, 0.8)";
						}
						ctx.fill();
						colorSwap = !colorSwap;
					}
				}
			}

			function drawEndSprite() {
				var offsetLeft = cellSize / 50;
				var offsetRight = cellSize / 25;
				var coord = Maze.endCoord();
				ctx.drawImage(
					endSprite,
					2,
					2,
					endSprite.width,
					endSprite.height,
					coord.x * cellSize + offsetLeft,
					coord.y * cellSize + offsetLeft,
					cellSize - offsetRight,
					cellSize - offsetRight
				);
			}

			function clear() {
				var canvasSize = cellSize * map.length;
				ctx.clearRect(0, 0, canvasSize, canvasSize);
			}

			if (endSprite != null) {
				drawEndMethod = drawEndSprite;
			} else {
				drawEndMethod = drawEndFlag;
			}
			clear();
			drawMap();
			drawEndMethod();
		}

		function Player(maze, c, _cellsize, onComplete, sprite = null) {
			var ctx = c.getContext("2d");
			var drawSprite;
			var moves = 0;
			drawSprite = drawSpriteCircle;
			if (sprite != null) {
				drawSprite = drawSpriteImg;
			}
			var player = this;
			var map = maze.map();
			var cellCoords = {
				x: maze.startCoord().x,
				y: maze.startCoord().y
			};
			var cellSize = _cellsize;
			var halfCellSize = cellSize / 2;

			this.redrawPlayer = function(_cellsize) {
				cellSize = _cellsize;
				drawSpriteImg(cellCoords);
			};

			function drawSpriteCircle(coord) {
				ctx.beginPath();
				ctx.fillStyle = "yellow";
				ctx.arc(
					(coord.x + 1) * cellSize - halfCellSize,
					(coord.y + 1) * cellSize - halfCellSize,
					halfCellSize - 2,
					0,
					2 * Math.PI
				);
				ctx.fill();
				if (coord.x === maze.endCoord().x && coord.y === maze.endCoord().y) {
					onComplete(moves);
					player.unbindKeyDown();
				}
			}

			function drawSpriteImg(coord) {
				var offsetLeft = cellSize / 50;
				var offsetRight = cellSize / 25;
				ctx.drawImage(
					sprite,
					0,
					0,
					sprite.width,
					sprite.height,
					coord.x * cellSize + offsetLeft,
					coord.y * cellSize + offsetLeft,
					cellSize - offsetRight,
					cellSize - offsetRight
				);
				if (coord.x === maze.endCoord().x && coord.y === maze.endCoord().y) {
					onComplete(moves);
					player.unbindKeyDown();
				}
			}

			function removeSprite(coord) {
				var offsetLeft = cellSize / 50;
				var offsetRight = cellSize / 25;
				ctx.clearRect(
					coord.x * cellSize + offsetLeft,
					coord.y * cellSize + offsetLeft,
					cellSize - offsetRight,
					cellSize - offsetRight
				);
			}

			function check(e) {
				var cell = map[cellCoords.x][cellCoords.y];
				moves++;
				switch (e.keyCode) {
					case 65:
					case 37: // west
						if (cell.w == true) {
							removeSprite(cellCoords);
							cellCoords = {
								x: cellCoords.x - 1,
								y: cellCoords.y
							};
							drawSprite(cellCoords);
						}
						break;
					case 87:
					case 38: // north
						if (cell.n == true) {
							removeSprite(cellCoords);
							cellCoords = {
								x: cellCoords.x,
								y: cellCoords.y - 1
							};
							drawSprite(cellCoords);
						}
						break;
					case 68:
					case 39: // east
						if (cell.e == true) {
							removeSprite(cellCoords);
							cellCoords = {
								x: cellCoords.x + 1,
								y: cellCoords.y
							};
							drawSprite(cellCoords);
						}
						break;
					case 83:
					case 40: // south
						if (cell.s == true) {
							removeSprite(cellCoords);
							cellCoords = {
								x: cellCoords.x,
								y: cellCoords.y + 1
							};
							drawSprite(cellCoords);
						}
						break;
				}
			}

			this.bindKeyDown = function() {
				window.addEventListener("keydown", check, false);

				$("#view").swipe({
					swipe: function(
						event,
						direction,
						distance,
						duration,
						fingerCount,
						fingerData
					) {
						console.log(direction);
						switch (direction) {
							case "up":
								check({
									keyCode: 38
								});
								break;
							case "down":
								check({
									keyCode: 40
								});
								break;
							case "left":
								check({
									keyCode: 37
								});
								break;
							case "right":
								check({
									keyCode: 39
								});
								break;
						}
					},
					threshold: 0
				});
			};

			this.unbindKeyDown = function() {
				window.removeEventListener("keydown", check, false);
				$("#view").swipe("destroy");
			};

			drawSprite(maze.startCoord());

			this.bindKeyDown();
		}

		var mazeCanvas = document.getElementById("mazeCanvas");
		var ctx = mazeCanvas.getContext("2d");
		var sprite;
		var finishSprite;
		var maze, draw, player;
		var cellSize;
		var difficulty;
		// sprite.src = 'media/sprite.png';

		window.onload = function() {
			let viewWidth = $("#view").width();
			let viewHeight = $("#view").height();
			if (viewHeight < viewWidth) {
				ctx.canvas.width = viewHeight - viewHeight / 100;
				ctx.canvas.height = viewHeight - viewHeight / 100;
			} else {
				ctx.canvas.width = viewWidth - viewWidth / 100;
				ctx.canvas.height = viewWidth - viewWidth / 100;
			}

			//Load and edit sprites
			var completeOne = false;
			var completeTwo = false;
			var isComplete = () => {
				if (completeOne === true && completeTwo === true) {
					console.log("Runs");
					setTimeout(function() {
						makeMaze();
					}, 500);
				}
			};
			sprite = new Image();
			sprite.src =
				"../../img/img-juegos/mascota-1.png" +
				"?" +
				new Date().getTime();
			sprite.setAttribute("crossOrigin", " ");
			sprite.onload = function() {
				sprite = changeBrightness(1.2, sprite);
				completeOne = true;
				console.log(completeOne);
				isComplete();
			};

			finishSprite = new Image();
			finishSprite.src = "../../img/img-juegos/cohete.png" +
				"?" +
				new Date().getTime();
			finishSprite.setAttribute("crossOrigin", " ");
			finishSprite.onload = function() {
				finishSprite = changeBrightness(1.1, finishSprite);
				completeTwo = true;
				console.log(completeTwo);
				isComplete();
			};

		};

		window.onresize = function() {
			let viewWidth = $("#view").width();
			let viewHeight = $("#view").height();
			if (viewHeight < viewWidth) {
				ctx.canvas.width = viewHeight - viewHeight / 100;
				ctx.canvas.height = viewHeight - viewHeight / 100;
			} else {
				ctx.canvas.width = viewWidth - viewWidth / 100;
				ctx.canvas.height = viewWidth - viewWidth / 100;
			}
			cellSize = mazeCanvas.width / difficulty;
			if (player != null) {
				draw.redrawMaze(cellSize);
				player.redrawPlayer(cellSize);
			}
		};

		function makeMaze() {
			if (player != undefined) {
				player.unbindKeyDown();
				player = null;
			}
			var e = document.getElementById("diffSelect");
			difficulty = e.options[e.selectedIndex].value;
			cellSize = mazeCanvas.width / difficulty;
			maze = new Maze(difficulty, difficulty);
			draw = new DrawMaze(maze, ctx, cellSize, finishSprite);
			player = new Player(maze, mazeCanvas, cellSize, displayVictoryMess, sprite);
			if (document.getElementById("mazeContainer").style.opacity < "100") {
				document.getElementById("mazeContainer").style.opacity = "100";
			}
		}
	</script>
</body>

</html>