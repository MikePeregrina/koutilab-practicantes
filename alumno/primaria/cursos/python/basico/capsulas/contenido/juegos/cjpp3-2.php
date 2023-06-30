<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SLIDE PUZZLE</title>
    <link rel="stylesheet" href="../../css/css-juegos/slide.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body onload="alert1()">
	<div class="titulo-gen">
		<h2 class="titulo"><b>OPERADORES DE PERTENENCIA</b></h2>
	</div>

	<div class="timer" id="timer">
		<b>Tiempo: <br>
			<p id="tiempo" style="margin: 0 0 0 0;"></p>
		</b>
	</div>
    
    <div class="contenido">
		<a href="../../../../../../rutas/ruta-pw-b.php"><button style="float: left; position: absolute; margin: 10px 0 0 10px;" class="btn-b" id="btn-cerrar-modalV">
			<i class="fas fa-reply"></i></button>
		</a>

		<!-- Titulo secundario -->
		<h4 class="titulo"><b>Desliza las tarjetas haciendo click en ellas para desplazarlas y descubrir la imagen real</b></h4>
		<br>

		<div class="slide-contenedor">
			<div id="puzzle_container" style="width: 412px; height: 412px;">
				<div class="puzzle_block" style="width: 103px; height: 103px;"><img src="img/lvl2/img1.png" class="contenedor-img" alt=""></div>
				<div class="puzzle_block" style="width: 103px; height: 103px;"><img src="img/lvl2/img2.png" class="contenedor-img" alt=""></div>
				<div class="puzzle_block" style="width: 103px; height: 103px;"><img src="img/lvl2/img3.png" class="contenedor-img" alt=""></div>
				<div class="puzzle_block" style="width: 103px; height: 103px;"><img src="img/lvl2/img4.png" class="contenedor-img" alt=""></div>
				<div class="puzzle_block" style="width: 103px; height: 103px;"><img src="img/lvl2/img5.png" class="contenedor-img" alt=""></div>
				<div class="puzzle_block" style="width: 103px; height: 103px;"><img src="img/lvl2/img6.png" class="contenedor-img" alt=""></div>
				<div class="puzzle_block" style="width: 103px; height: 103px;"><img src="img/lvl2/img7.png" class="contenedor-img" alt=""></div>
				<div class="puzzle_block" style="width: 103px; height: 103px;"><img src="img/lvl2/img8.png" class="contenedor-img" alt=""></div>
				<div class="puzzle_block" style="width: 103px; height: 103px;"><img src="img/lvl2/img9.png" class="contenedor-img" alt=""></div>
				<div class="puzzle_block" style="width: 103px; height: 103px;"><img src="img/lvl2/img10.png" class="contenedor-img" alt=""></div>
				<div class="puzzle_block" style="width: 103px; height: 103px;"><img src="img/lvl2/img11.png" class="contenedor-img" alt=""></div>
				<div class="puzzle_block" style="width: 103px; height: 103px;"><img src="img/lvl2/img12.png" class="contenedor-img" alt=""></div>
				<div class="puzzle_block" style="width: 103px; height: 103px;"><img src="img/lvl2/img13.png" class="contenedor-img" alt=""></div>
				<div class="puzzle_block" style="width: 103px; height: 103px;"><img src="img/lvl2/img14.png" class="contenedor-img" alt=""></div>
				<div class="puzzle_block" style="width: 103px; height: 103px;"><img src="img/lvl2/img15.png" class="contenedor-img" alt=""></div>
			</div>
		</div>

		<!-- <div id="difficulty_container">
			<div class="difficulty_button active">EASY</div>
			<div class="difficulty_button">MEDIUM</div>
			<div class="difficulty_button">HARD</div>
		</div> -->
	</div>
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<script>
		function alert1() {
			Swal.fire({
				title: '¡Oh no!',
				text: 'Kobot ha perdido el orden de sus fotos, ¿Podrías ayudarlo a ordenalas?',
				imageUrl: "img/loop.gif",
				imageHeight: 320,
				confirmButtonText: 'Siguiente',
				confirmButtonColor: '#85c42c',
			}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire({
					title: 'La imagen se debe ver así',
					text: '¡Hazlo antes de que termine el tiempo!',
					imageUrl: "img/IS.PNG",
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
	   var segundos = 240;
let puntos = 0;
var count = 1000;
//Agregando animacion a el timer
function iniciarTiempo() {
    document.getElementById("tiempo").innerHTML =
        segundos + " segundos";
    if (segundos <= 60) {
        var div = document.getElementById("timer");
        div.style.cssText = "animation-name: animation1; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
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
                text: "Se acabó el tiempo",
                imageUrl: "img/loop.gif",
                imageHeight: 350,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
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
	<script>
		const GameDifficulty=[20,50,70];
		class Game{
			difficulty;//difficulty based on GameDifficulty array
			cols=4;//how many colomns
			rows=4;//how many rows
			count;//cols*rows
			blocks;//the html elements with className="puzzle_block"
			emptyBlockCoords=[3,3];//the coordinates of the empty block
			indexes=[];//keeps track of the order of the blocks
	
			constructor(difficultyLevel=1){
				this.difficulty=GameDifficulty[difficultyLevel-1];
				this.count=this.cols*this.rows;
				this.blocks=document.getElementsByClassName("puzzle_block");//grab the blocks
				this.init();
			}
	
			init(){//position each block in its proper position
				for(let y=0;y<this.rows;y++){
					for(let x=0;x<this.cols;x++){
						let blockIdx=x+y*this.cols;
						if(blockIdx+1>=this.count)break;
						let block=this.blocks[blockIdx];
						this.positionBlockAtCoord(blockIdx,x,y);
						block.addEventListener('click',(e)=>this.onClickOnBlock(blockIdx));
						this.indexes.push(blockIdx);
					}
				}
				this.indexes.push(this.count-1);
				this.randomize(this.difficulty);
			}
	
			randomize(iterationCount){//move a random block (x iterationCount)
				for(let i=0;i<iterationCount;i++){
					let randomBlockIdx=Math.floor(Math.random()*(this.count-1));
					let moved=this.moveBlock(randomBlockIdx);
					if(!moved)i--;
				}
			}
	
			moveBlock(blockIdx){//moves a block and return true if the block has moved
				let block=this.blocks[blockIdx];
				let blockCoords=this.canMoveBlock(block);
				if(blockCoords!=null){
					this.positionBlockAtCoord(blockIdx,this.emptyBlockCoords[0],this.emptyBlockCoords[1]);
					this.indexes[this.emptyBlockCoords[0]+this.emptyBlockCoords[1]*this.cols]=this.indexes[blockCoords[0]+blockCoords[1]*this.cols];
					this.emptyBlockCoords[0]=blockCoords[0];
					this.emptyBlockCoords[1]=blockCoords[1];
					return true;
				}
				return false;
			}
			canMoveBlock(block){//return the block coordinates if he can move else return null
				let blockPos=[parseInt(block.style.left),parseInt(block.style.top)];
				let blockWidth=block.clientWidth;
				let blockCoords=[blockPos[0]/blockWidth,blockPos[1]/blockWidth];
				let diff=[Math.abs(blockCoords[0]-this.emptyBlockCoords[0]),Math.abs(blockCoords[1]-this.emptyBlockCoords[1])];
				let canMove=(diff[0]==1&&diff[1]==0)||(diff[0]==0&&diff[1]==1);
				if(canMove)return blockCoords;
				else return null;
			}
	
			positionBlockAtCoord(blockIdx,x,y){//position the block at a certain coordinates
				let block=this.blocks[blockIdx];
				block.style.left=(x*block.clientWidth)+"px";
				block.style.top=(y*block.clientWidth)+"px";
			}
	
			onClickOnBlock(blockIdx){//try move block and check if puzzle was solved
				if(this.moveBlock(blockIdx)){
					if(this.checkPuzzleSolved()){
						setTimeout(() => {
							Swal.fire({
								title: '¡Muy bien!',
								text: 'Ahora pasemos al siguiente nivel',
								imageUrl: "img/Thumbs-Up.gif",
								imageHeight: 350,
								backdrop: `
								rgba(0,143,255,0.6)
								url("img/fondo.gif")`,
								confirmButtonColor: '#a14cd9',
								confirmButtonText: '¡Vamos!',
							}).then((result) => {
								if (result.isConfirmed) {
									window.location.href = 'cjpp3-3.php';
								}
							})
						}, "800");
					}
				}
			}
	
			checkPuzzleSolved(){//return if puzzle was solved
				for(let i=0;i<this.indexes.length;i++){
					//console.log(this.indexes[i],i);
					if(i==this.emptyBlockCoords[0]+this.emptyBlockCoords[1]*this.cols)continue;
					if(this.indexes[i]!=i)return false;
				}
				return true;
			}
	
			setDifficulty(difficultyLevel){//set difficulty
				this.difficulty=GameDifficulty[difficultyLevel-1];
				this.randomize(this.difficulty);
			}
	
		}
	
		var game=new Game(1);//instantiate a new Game
	
	
		//taking care of the difficulty buttons
		var difficulty_buttons=Array.from(document.getElementsByClassName("difficulty_button"));
		difficulty_buttons.forEach((elem,idx)=>{
			elem.addEventListener('click',(e)=>{
				difficulty_buttons[GameDifficulty.indexOf(game.difficulty)].classList.remove("active");
				elem.classList.add("active");
				game.setDifficulty(idx+1);
			});
		});
	</script>
</body>
</html>