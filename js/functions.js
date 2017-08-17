

var imagem_pequena = {h:32,l:32};

function addAnimations(sprite){
    sprite.animations.add('left', [7, 11], 2, true);
    sprite.animations.add('right', [5, 9], 2, true);
    sprite.animations.add('up', [4, 8], 2, true);
    sprite.animations.add('down',[6,10],2,true);
}

function summon (posX,posY,nome){ 
    
    //insere na posicao do tabuleiro levando em conta a numeração do tabuleiro
	var sprite = game.add.sprite(posX*32+32,posY*32+32,nome);
    
    //muda a âncora para o canto inferior direito
    sprite.anchor.set(1,1); 
     
    //cria animações para o sprite. Por enquanto só cria para spritesheets com 12 frames
    addAnimations(sprite);  
    
    //adiciona o sprite ao grupo de cartas
    cartas.add(sprite);
    
    console.log(sprite.z);
    
    //Ordena a ordem de rederização dos sprites
    cartas.sort('x');
    cartas.sort('y');
        
}

function loadAssets (){
    game.load.image('tabuleiro','assets/tabuleiro.png');
	game.load.image('joaninha','assets/teste.png');
	game.load.spritesheet('devil','assets/devil.png',32,32);
	game.load.spritesheet('mummy','assets/mumia.png',32,32);
    game.load.spritesheet('torturer','assets/torturer.png',64,64); //imagem grande
    game.load.spritesheet('banshee','assets/banshee.png',64,64); //imagem grande
    
    
}
