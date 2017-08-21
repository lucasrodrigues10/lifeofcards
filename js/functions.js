

//cria os sprites de animações
function addAnimations(sprite){
    var key = sprite.key; //nome da textura utilizada
    var frameSpeed;      
  
    //  Define as animações dos sprites baseando-se no tamanha do arquivo do spritesheet. Imagens com 
    //  menos de 768 pixels possuem 12 frames de animação. Já imagens com mais de 1152 pixels possuem 36 frames.
    
    if (game.cache.getImage(key).width <= 768){
        
        frameSpeed = 2;
        
        walkUp = [4,8];     
        walkRight = [5,9];
        walkDown = [6,10];            
        walkLeft = [7,11];
                  
    } else if (game.cache.getImage(key).width >= 1152){
        
        frameSpeed = 6;
        
        walkUp = [4,8,12,16,20,24,28];
        walkRight = [5,9,13,17,21,25,29];
        walkDown = [6,10,14,18,22,26,30];
        walkLeft = [7,11,15,19,23,27,31];
          
    }

    sprite.animations.add('up',  walkUp, frameSpeed, true);
    sprite.animations.add('right',walkRight, frameSpeed, true);
    sprite.animations.add('down', walkDown,frameSpeed,true);
    sprite.animations.add('left',walkLeft, frameSpeed, true);
}

function summon (linhaTabuleiro,colTabuleiro,nome){ 
    posX = linhaTabuleiro*32+31;
    posY = colTabuleiro*32+31;
    
    //insere na posicao do tabuleiro levando em conta a numeração do tabuleiro
	var sprite = game.add.sprite(posX,posY,nome);
    
   
    
    //muda a âncora para o canto inferior direito
    sprite.anchor.set(1,1); 
       
    //cria animações para o sprite.
    addAnimations(sprite);  
    
    //adiciona o sprite ao grupo de unidades
    unidades.add(sprite);
    
    
    //Ordena a ordem de rederização dos sprites
    unidades.sort('x');
    unidades.sort('y');
        
}

//carregador de assets
function loadAssets (){ 
    
    game.load.image('tabuleiro','assets/tabuleiro.png');
    game.load.image('quadrado','assets/quadrado.png');
	game.load.spritesheet('devil','assets/devil.png',32,32);
	game.load.spritesheet('mummy','assets/mumia.png',32,32);
    game.load.spritesheet('torturer','assets/torturer.png',64,64); //imagem grande
    game.load.spritesheet('banshee','assets/banshee.png',64,64); //imagem grande
    game.load.spritesheet('ferumbras','assets/ferumbras.png',64,64); //imagem grande e com 36 frames
    
    
}





/* REESCREVER
function move(posX,posY,numCasas,dir){  
    var sprite = encontraSprite(posX,posY);
    switch (dir) {
        case 'up':
            sprite.animations.play('up');
            break;
        case 'right':
            sprite.animations.play('right');
            break;
        case 'down':
            sprite.animations.play()
            break;
        case 'left':
            break;
            
    }
    
}

*/

// 

function

function encontraSprite (posX,posY){ 
         
    var resultado = unidades.getAll('x',posX); //filtra pela posição X
    for (i=0;i<resultado.length;i++)            //faz a segundo busca, filtrando agora pela posição Y
        if (resultado[i].y == posY)
            return resultado[i];            
          
}

//encontra a casa correspondente no tabuleiro com o click do mouse
function encontraCasa(pointer){
    posX = Math.ceil(pointer.x/32)*32;  //GoHorse magnífico    
    posY = Math.ceil(pointer.y/32)*32;
    
    encontraSprite(posX,posY);
}

