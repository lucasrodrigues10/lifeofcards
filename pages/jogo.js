console.log($(window).width()); 
console.log($(window).height());


var gameOptions = {
/*
    gameWidth: (Math.trunc($(window).width()*window.devicePixelRatio)),
    gameHeight: (Math.trunc($(window).height()*window.devicePixelRatio)),
*/
    gameWidth: 1800,
    gameHeight: 900,
	
    cardSheetWidth: 334,
    cardSheetHeight: 440,
    cardScale: 0.3	
}

var game = new Phaser.Game(gameOptions.gameWidth, gameOptions.gameHeight, Phaser.AUTO, '', { preload: preload, create: create, update: update });
//980, 1415

function preload( ) {

    game.load.image('board', 'assets/board.jpg');
    game.load.image('blackCube', 'assets/cube.png');
    game.load.image('whiteCube', 'assets/whiteCube.png');
    game.load.image('borderCube', 'assets/borderCube.png');
    //game.load.image('borderCube2', 'assets/borderCube2.png');
	game.load.image('bg', 'assets/bg.png');

    // Chess pieces
    game.load.image('black_knight', 'assets/chessPieces/black_knight.png'); 
	game.load.image('black_bishop', 'assets/chessPieces/black_bishop.png');
    game.load.image('black_king', 'assets/chessPieces/black_king.png');   
    game.load.image('black_pawn', 'assets/chessPieces/black_pawn.png');
    game.load.image('black_queen', 'assets/chessPieces/black_queen.png');
    game.load.image('black_tower', 'assets/chessPieces/black_tower.png');
    game.load.image('white_bishop', 'assets/chessPieces/white_bishop.png');
    game.load.image('white_knight', 'assets/chessPieces/white_knight.png');
    game.load.image('white_king', 'assets/chessPieces/white_king.png');
    game.load.image('white_pawn', 'assets/chessPieces/white_pawn.png');
    game.load.image('white_queen', 'assets/chessPieces/white_queen.png');
    game.load.image('white_tower', 'assets/chessPieces/white_tower.png');
	
	// Cards
	game.load.image('card', '../img/carta.jpg');
	game.load.spritesheet("cards", "assets/cards.png", gameOptions.cardSheetWidth, gameOptions.cardSheetHeight);

	game.scale.scaleMode = Phaser.ScaleManager.aspectRatio;
	game.scale.pageAlignVertically = true;
	game.scale.pageAlignHorizontally = true;
	game.scale.setShowAll();
	game.scale.refresh();
}
	var board       = 'undefined';
	var pieces      = 'undefined';
	var cubes       = 'undefined';
	var player      = 'undefined';
	var platforms   = 'undefined';
	var cursors     = 'undefined';
	var rect        = 'undefined';
	var gameover 	= null;
	var win 		= null;
	var arrayCubes  = {};
	var piecesByPos = {};
	var positions = [];
	var cards = {};
	var cardsInGame = [];
	var color = {
		color1: 0,
		color2: 0,
		color3: 0,
	}

    var initPosBoardX = 441;
    var initPosBoardY = 390;
    //Piece width and height
    var pieceWidth = 130;
    var pieceHeight = 130;
	var cardHeight = 130;
	var cardWidth = 130;
    // Type of cubes
    //var cubeType = { 0: 'blackCube', 1: 'whiteCube' };
    var cubeType2 = { 0: 'borderCube', 1: 'borderCube2' };
	var letterACode = 97;
    var position;
	var arrayPosition = [1,2,3,4,5];
	var cardsPlayed = 0;
	
function create( ) {
    game.physics.startSystem(Phaser.Physics.ARCADE);
    bg = game.add.sprite(0, 0, 'bg');
	bg.scale.setTo(1.0, 1.0);
    var boardImage = game.cache.getImage('board');

    board = game.add.sprite(game.world.centerX - (boardImage.width/2)*1.0, game.world.centerY - (boardImage.height/2)*1.0, 'board'); //game.world.centerY - (boardImage.height/2)*1.0
    board.scale.setTo(1.0, 1.0);
	
	// Print board
    cubes = game.add.group();
    for( var x = 0; x <= 6; x++ ){
        for( var y = 0; y <= 4; y++ ){
            currentCube = (x + y) % 2;
            // Add position property to cubes
            var yPos = arrayPosition[y];
            position = String.fromCharCode(letterACode+x) + yPos;
            arrayCubes[position] = cubes.create(initPosBoardX+(x*pieceWidth), initPosBoardY-267+(y*pieceHeight),cubeType2[0]);//cubeType[currentCube]);
            arrayCubes[position].width=135;
			arrayCubes[position].height=135;
			arrayCubes[position].pos = position;
			arrayCubes[position].posx = String.fromCharCode(letterACode+x);
			arrayCubes[position].posy = yPos;
            arrayCubes[position].inputEnabled = true;
        }
    }
	
	deck = Phaser.ArrayUtils.numberArray(0, 51);
	//console.log(deck);
	Phaser.ArrayUtils.shuffle(deck);
	
    //Print pieces
    var piece;

    pieces = game.add.group(); //Create pieces group
    //Add all pieces to group
	piecesByPos['a3'] = pieces.create(441, 383, 'card');
	piecesByPos['a3'].currentPos = 'a3';
	piecesByPos['a3'].width = cardWidth;
	piecesByPos['a3'].height = cardHeight;
	piecesByPos['a3'].atk = 10;
	piecesByPos['a3'].def = 10;
	piecesByPos['a3'].leader = true;
	piecesByPos['a3'].enemy = false;
	piecesByPos['a3'].events.onInputDown.add(possiblePositions, this);
	piecesByPos['a3'].events.onInputUp.add(possiblePositions2, this);
	piecesByPos['a3'].events.onDragStop.add(possiblePositions2, this);
	
	piecesByPos['g3'] = pieces.create(1221, 383, 'black_knight');
	piecesByPos['g3'].currentPos = 'g3';
	piecesByPos['g3'].width = cardWidth;
	piecesByPos['g3'].height = cardHeight;
	piecesByPos['g3'].atk = 5;
	piecesByPos['g3'].def = 8;
	piecesByPos['g3'].leader = true;
	piecesByPos['g3'].enemy = true;
	piecesByPos['g3'].events.onInputDown.add(possiblePositions, this);
	piecesByPos['g3'].events.onInputUp.add(possiblePositions2, this);
	piecesByPos['g3'].events.onDragStop.add(possiblePositions2, this);
	
	
    // Bind callback on drag start and stop events
    pieces.children.forEach(function( piece ){
        piece.inputEnabled = true;
        piece.input.enableDrag();
        piece.events.onDragStop.add(stopDrag, this);
        piece.events.onDragStart.add(initDrag, this);
        delete piece.oldPosition;
    });

	for ( var i = 0, j = -2; i <= 4; i++, j++  ){
	makeCard(i,j);
	}
	
}
function makeCard(cardIndex, cardNumber){
	var arrayPosition = [1,2,3,4,5];
	var yPos = arrayPosition[cardNumber+2];
	piecesByPos['z'+ yPos] = pieces.create(202, game.world.centerY +cardNumber*arrayCubes['a1'].height, "cards");	
	cardsPlayed=cardsPlayed+1;
	console.log(cardsPlayed);
    pieces = game.add.group();
	piecesByPos['z'+ yPos].scale.set(gameOptions.cardScale);
	piecesByPos['z'+ yPos].frame = deck[cardIndex];
	piecesByPos['z'+ yPos].currentPos = 'z'+ yPos;
	piecesByPos['z'+ yPos].atk = Math.floor(Math.random() * 11);      // returns a number between 0 and 10
	piecesByPos['z'+ yPos].def = Math.floor(Math.random() * 11);      // returns a number between 0 and 10
	piecesByPos['z'+ yPos].leader = false;
	piecesByPos['z'+ yPos].enemy = false;
	//console.log(piecesByPos['z'+ yPos]);
    piecesByPos['z'+ yPos].inputEnabled = true;
	piecesByPos['z'+ yPos].input.enableDrag();
	piecesByPos['z'+ yPos].events.onDragStop.add(stopDrag, this);
	piecesByPos['z'+ yPos].events.onDragStart.add(initDrag, this);
	piecesByPos['z'+ yPos].events.onInputDown.add(possiblePositions, this);
	piecesByPos['z'+ yPos].events.onInputUp.add(possiblePositions2, this);
	delete piecesByPos['z'+ yPos].oldPosition;
	return piecesByPos['z'+ yPos];
}
function update( ) {
	game.scale.setShowAll();
	game.scale.refresh();
}
function isNear(currentPos,sprite){
		for( var a = -1; a <= 1; a++ )
		{
			for( var b = -1; b <= 1; b++ )
			{
				if(+currentPos.split(/(\d+)/)[0].charCodeAt(0)+a >= 97 && +currentPos.split(/(\d+)/)[0].charCodeAt(0)+a <= 103 
				&& +currentPos.split(/(\d+)/)[1]+b >= 1 && +currentPos.split(/(\d+)/)[1]+b <=5)
				position = String.fromCharCode(currentPos.split(/(\d+)/)[0].charCodeAt(0)+a) + (+currentPos.split(/(\d+)/)[1]+b);
				if(typeof position !== 'undefined'){
				//console.log(position);
				//console.log(sprite);
				var distance = game.physics.arcade.distanceBetween(sprite, arrayCubes[position]);
				//console.log(distance);
				//console.log(piecesByPos[currentPos].x );
				//console.log(arrayCubes[position].x);
					if( distance < 70 && currentPos!=position)
					{ // If drop piece on possible place
						movePiece(currentPos,position);

				//console.log(arrayCubes[position].x);
				//console.log(arrayCubes[position].y);
												
						//window.setTimeout(makeRandomMove, 350);
				// var screenDims = Utils.ScreenUtils.calculateScreenMetrics(800, 500, 1 /* LANDSCAPE */);

						//console.log('true');
						return true;
					}
				}
			}
		}	
}


function initDrag( sprite )
{
    sprite.oldPositionf = sprite.position.clone();
    var currentPos = sprite.currentPos;
	//if(typeof currentPos !== 'undefined')
	//console.log(currentPos.split(/(\d+)/));
	console.log(sprite);
	
}

function stopDrag( sprite )
{
	var currentPos = sprite.currentPos;
	
	if(typeof currentPos !== 'undefined')
	if (currentPos.split(/(\d+)/)[0] =='z'){
		//console.log('carta na mao');
		var foundPosition = summon(sprite, currentPos);
		if( !foundPosition ){
			sprite.x = sprite.oldPositionf.x;
			sprite.y = sprite.oldPositionf.y;
		}
	} else{
	var foundPosition = isNear(currentPos,sprite); 	
		
    if( !foundPosition ){
        sprite.x = sprite.oldPositionf.x;
        sprite.y = sprite.oldPositionf.y;
    }
	}
}

function findLeader(){
	for( var x = 0; x <= 6; x++ ){
        for( var y = 0; y <= 4; y++ ){
            var yPos = arrayPosition[y];
            position = String.fromCharCode(97+x) + yPos;
			if(typeof piecesByPos[position] !== 'undefined'){
				if (piecesByPos[position].leader == true && piecesByPos[position].enemy == false){
					var leaderPos=piecesByPos[position].currentPos;
					//console.log(leaderPos);
					return leaderPos;
				}
			}
		}
	}
}

function findLeaderEnemy(){
	for( var x = 0; x <= 6; x++ ){
        for( var y = 0; y <= 4; y++ ){
            var yPos = arrayPosition[y];
            position = String.fromCharCode(97+x) + yPos;
			if(typeof piecesByPos[position] !== 'undefined'){
				if (piecesByPos[position].leader == true && piecesByPos[position].enemy == true){
					var leaderPos=piecesByPos[position].currentPos;
					//console.log(leaderPos);
					return leaderPos;
				}
			}
		}
	}
}

function isNearLeader(currentPos,sprite){
	var leaderPos = findLeader();
		for( var a = -1; a <= 1; a++ )
		{
			for( var b = -1; b <= 1; b++ )
			{
				if(+leaderPos.split(/(\d+)/)[0].charCodeAt(0)+a >= 97 && +leaderPos.split(/(\d+)/)[0].charCodeAt(0)+a <= 103 
				&& +leaderPos.split(/(\d+)/)[1]+b >= 1 && +leaderPos.split(/(\d+)/)[1]+b <=5)
				position = String.fromCharCode(leaderPos.split(/(\d+)/)[0].charCodeAt(0)+a) + (+leaderPos.split(/(\d+)/)[1]+b);
				if(typeof position !== 'undefined'){
				
				var distance = game.physics.arcade.distanceBetween(sprite, arrayCubes[position]);
					//console.log(distance);
					//console.log(piecesByPos['z']);
					if( distance < 70 && leaderPos!=position && (typeof piecesByPos[position] == 'undefined' || piecesByPos[position].alive == false))
					{ // If drop piece on possible place
		console.log(leaderPos,position,currentPos);
					movePiece(currentPos,position);
				//console.log(arrayCubes[position].x);
				//console.log(arrayCubes[position].y);
												
						//window.setTimeout(makeRandomMove, 350);
						
						//console.log('true');
						return true;
					}
				}
			}
		}	
}

function summon(sprite, currentPos){
	var result = isNearLeader(currentPos, sprite);
	if(result){
		for ( var i = 1; i <= 5; i++) {
			if(typeof piecesByPos['z'+i] == 'undefined')
				makeCard(cardsPlayed,i-3);
		}
	}
	return result;
}

/**
 * Make piece movement from to ( position )
 *
 * @param from
 * @param to
 */
function movePiece( from, to ){
    if( typeof piecesByPos[to] !== 'undefined' ){ // If destination pos is not empty, battle
		if (battle(from, to)==2)
		return;
	}
    	// Set new piece position
		piecesByPos[from].x = arrayCubes[to].x;
		piecesByPos[from].y = arrayCubes[to].y;

		piecesByPos[to] = piecesByPos[from]; // Override piece position

		delete piecesByPos[from]; // Delete old reference
		piecesByPos[to].currentPos = to; 
		
		
}

function battle(from, to){

	if(piecesByPos[from].atk>=piecesByPos[to].def){
		if(piecesByPos[to].leader = true && piecesByPos[to].enemy == true)
		{
			gameover = true;
			win = true;
			checkGameOver(win);
		}
		else if(piecesByPos[to].leader = true && piecesByPos[to].enemy == false)
		{
			gameover = true;
			win = false;
			checkGameOver(win);
		}
		piecesByPos[to].destroy();
		piecesByPos[to].atk = null;
		piecesByPos[to].def = null;
		piecesByPos[to].leader = null;
		piecesByPos[to].enemy = null;
		text.destroy();
		console.log('defendente morreu');
		return 1;
	}
	else if (piecesByPos[from].atk<piecesByPos[to].def){
		if(piecesByPos[from].leader = true && piecesByPos[from].enemy == true)
		{
			gameover = true;
			win = true;
			checkGameOver(win);
		}
		else if(piecesByPos[from].leader = true && piecesByPos[from].enemy == false)
		{
			gameover = true;
			win = false;
			checkGameOver(win);
		}
		piecesByPos[from].destroy();
		piecesByPos[from].atk = null;
		piecesByPos[from].def = null;
		piecesByPos[from].leader = null;
		piecesByPos[from].enemy = null;
		text.destroy();
		console.log(piecesByPos[from]);
		console.log('atacante morreu');
		return 2;
	}
	else return;
}

function checkGameOver(win){
	if(win)
	{
		console.log("Vitoria");
	}
	else 
	{
		console.log("Derrota");
	}	
}

function possiblePositions(sprite){
	var currentPos = sprite.currentPos;
	
	if (sprite.enemy)
	{
		color.color1 = 255;
		color.color2 = 0;
	}
	else {
		color.color1 = 0;
		color.color2 = 255;
	}
	if (currentPos.split(/(\d+)/)[0] =='z'){
		currentPos = findLeader();
	}
		for( var a = -1; a <= 1; a++ )
		{
			for( var b = -1; b <= 1; b++ )
			{
				if(+currentPos.split(/(\d+)/)[0].charCodeAt(0)+a >= 97 && +currentPos.split(/(\d+)/)[0].charCodeAt(0)+a <= 103 
				&& +currentPos.split(/(\d+)/)[1]+b >= 1 && +currentPos.split(/(\d+)/)[1]+b <=5)
				{
					position = String.fromCharCode(currentPos.split(/(\d+)/)[0].charCodeAt(0)+a) + (+currentPos.split(/(\d+)/)[1]+b);
					//arrayCubes[position].alpha = 0.5;
					arrayCubes[position].tint = Phaser.Color.RGBtoString(color.color1, color.color2, color.color3, '', '0x'); 
				}
			}
		}
		text = game.add.text(sprite.x + 5, sprite.y - 90, "Atk: " + sprite.atk +"\nDef: " + sprite.def,
		{ font: "35px Arial", fill: "#0000ff",outline: "black", align: "center", });
		text.stroke = '#000000';
		text.strokeThickness = 6;
		text.fill = '#d68743';		  
}

function possiblePositions2(sprite){
		for( var a = 0; a <= 7; a++ )
		{
			for( var b = 0; b <= 7; b++ )
			{
				if(letterACode+a >= 97 && letterACode+a <= 103 
				&& b >= 1 && b <=5)
				position = String.fromCharCode(letterACode+a) + b;
				//arrayCubes[position].alpha = 1.0;
				arrayCubes[position].tint = Phaser.Color.RGBtoString(255, 255, 255, '', '0x'); 
			}
		}
		text.destroy();
}

/**
 * Make random move of computer side
 *
 */
function makeRandomMove (){
	
    var randomIndex = Math.floor(Math.random() * 8); // Select random movement
	//var randomIndex = 7;
	console.log(randomIndex);
	var possibleMoves = '';	
	var currentPos = findLeaderEnemy();
	
		for( var a = -1; a <= 1; a++ )
		{
			for( var b = -1; b <= 1; b++ )
			{
				if(+currentPos.split(/(\d+)/)[0].charCodeAt(0)+a >= 97 && +currentPos.split(/(\d+)/)[0].charCodeAt(0)+a <= 103 
				&& +currentPos.split(/(\d+)/)[1]+b >= 1 && +currentPos.split(/(\d+)/)[1]+b <=5)
				{
					position = String.fromCharCode(currentPos.split(/(\d+)/)[0].charCodeAt(0)+a) + (+currentPos.split(/(\d+)/)[1]+b);
					if(position != currentPos)
					possibleMoves = possibleMoves+position;
			
				}
			}
		}
				//console.log(possibleMoves.split(/(\d+)/)[2*randomIndex]); //.charCodeAt(0) String.fromCharCode(
				//console.log(possibleMoves.split(/(\d+)/)[2*randomIndex+1]);
				console.log(Math.floor(Math.random() * possibleMoves.length/2));
		if (randomIndex >= possibleMoves.length/2){
			randomIndex = Math.floor(Math.random() * possibleMoves.lenght/2 ); // Select random movement
			console.log(randomIndex);
			console.log("sajdnasjdaj");
		}
    var from = currentPos;
    var to = possibleMoves.split(/(\d+)/)[2*randomIndex]+possibleMoves.split(/(\d+)/)[2*randomIndex+1];
	
    movePiece(from, to);
}

/**
 * Check if sprite a overlaps sprite b
 *
 * @param spriteA
 * @param spriteB
 */
function checkOverlap(spriteA, spriteB) {

    var boundsA = spriteA.getBounds();
    var boundsB = spriteB.getBounds();

    return Phaser.Rectangle.intersects(boundsA, boundsB);

}

/**
 * Blink animation for enabled moves on board
 *
 * @param cubeSprite
 */
function animateCubes( cubeSprite )
{
    this.game.add.tween(cubeSprite)
            .to({ alpha: 0.5 }, 800, Phaser.Easing.Bounce.Out)
            .to({ alpha: 1.0 }, 800, Phaser.Easing.Bounce.Out)
            .to({ alpha: 0.5 }, 800, Phaser.Easing.Bounce.Out)
            .to({ alpha: 1.0 }, 800, Phaser.Easing.Bounce.Out)
            .start();
}