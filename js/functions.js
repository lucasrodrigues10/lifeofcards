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

//cria os sprites de animações
function addAnimations(sprite){
    var key = sprite.key; //nome da textura utilizada
    var frameSpeed;      
  
    //  Define as animações dos sprites baseando-se no tamanha do arquivo do spritesheet. Imagens com 
    //  menos de 768 pixels possuem 12 frames de animação. Já imagens com mais de 1152 pixels possuem 36 frames.
    
    if (game.cache.getImage(key).width <= 768){
        
        frameSpeed = 3;
        
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

var numLinhas = 12;
var numColunas = 12;
var margemLateral = 1;
var margemVertical = 1;

var spriteSelecionado;
//criando um vetor 12x12 pra guardar as referencias dos sprites
var tabuleiro = new Array (12);
for (i=0;i<12;i++)
	tabuleiro[i] = new Array (12);


//função para criar sprites de maneira mais rápida
function summon (linhaTabuleiro,colTabuleiro,nome){ 
    posX = linhaTabuleiro*32+31;
    posY = colTabuleiro*32+31;
    
	
	
	
    //insere na posicao do tabuleiro levando em conta a numeração do tabuleiro
	var sprite = game.add.sprite(posX,posY,nome);
	
	//adicionando informações da posição do sprite para facilatar posteriores funções
	sprite.linha = linhaTabuleiro;
	sprite.coluna = colTabuleiro;
	
    atualizaPosicao(posX,posY,sprite);
    
    //criando resposta ao clique
    sprite.inputEnabled = true;
    sprite.hitArea = new Phaser.Rectangle(-32,-32,32,32); 
    sprite.events.onInputDown.add(criaMovimentacao2,this); 
    
    //habilitando fisica para movimentar os sprites
    game.physics.arcade.enable(sprite);
    
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

function foraDoMapa (posX,posY){
    if ((posX < margemLateral*32) || (posX >= (margemLateral+numColunas)*32) ||
        (posY < margemVertical*32) || (posY >= (margemVertical+numLinhas)*32))
        return true;
    else 
        return false;
}

function dentroDoMapa (posX,posY){
    return !(foraDoMapa(posX,posY));
}


function move (sprite){
    console.log("moveu");
    //desabilita o input pro usuario não fazer m*rda
    game.input.enabled = false;
    
    //remove a posicao anterior na matriz
    removePosicao(spriteSelecionado.x,spriteSelecionado.y);
	
	
	
	 
	
    
    //move o objeto
    game.physics.arcade.moveToObject(spriteSelecionado,sprite,60,600);
    
    
    
    
     //função para para o sprite quando ele chega ao destin
    game.time.events.add(600, function () {
        
        //corrige erro de precisão ao movimentar (pergunta se nao entender)
        spriteSelecionado.x = Math.ceil(sprite.x/32)*32-1;
        spriteSelecionado.y = Math.ceil(sprite.y/32)*32-1;
        
        console.log(sprite.x,sprite.y);
        spriteSelecionado.body.velocity.x = 0;
        spriteSelecionado.body.velocity.y = 0;
        
        movimentacao.removeAll(true);           //elimina quadrados antigos
        game.input.enabled = true;
        
        //atualiza a posição do sprite movimentado na matriz.
        atualizaPosicao(spriteSelecionado.x,spriteSelecionado.y,null);
        
        console.log("terminou de mover");
        
    
    }, this);
	
	
    
}

function moveSec (sprite){
    
    move(sprite.anterior);
    game.time.events.onComplete.add(function(){
        game.time.events.removeAll();
        move(sprite);
        console.log("move pela segunda vez");
        
    })
    
	
}
 
function encontraUnidade (posX,posY){
	//transforma a coordenada em pixels para posição do tabuleiro 
	linha = (posX-31)/32;
	coluna = (posY-31)/32
	
	
	if (linha>=margemLateral && coluna>=margemLateral)  //evita possiveis erros de indices
	var casa = tabuleiro[linha-1][coluna-1];
   if (casa !=null) //casa ocupada por uma unidade
	   return casa;
	else
		return null; //casa livre
}



function criaMovimentacao (sprite){
    spriteSelecionado = sprite; //atualiza a variavel global que guarda o ultimo sprite a ser clicado
    posX = sprite.x;
    posY = sprite.y;
    movimentacao.callAll('kill'); //remove os quadrados antigos
    var quadrados =[];
    quadrados.push(game.add.sprite(posX,posY-32,'quadrado'));       //pra cima
    quadrados.push(game.add.sprite(posX+32,posY-32,'quadrado'));    //pra cima e pra direita
    quadrados.push(game.add.sprite(posX+32,posY,'quadrado'));       //pra direita
    quadrados.push(game.add.sprite(posX+32,posY+32,'quadrado'));    //pra baixo e pra direita
    quadrados.push(game.add.sprite(posX,posY+32,'quadrado'));       //pra baixo
    quadrados.push(game.add.sprite(posX-32,posY+32,'quadrado'));    //pra baixo e pra esquerda
    quadrados.push(game.add.sprite(posX-32,posY,'quadrado'));       //pra esquerda
    quadrados.push(game.add.sprite(posX-32,posY-32,'quadrado'));    //pra cima e pra esquerda
    
    
    
    //adiciona os quadrados de movimento ao grupo
    movimentacao.addMultiple(quadrados);            
 
    
    
    movimentacao.children.forEach(function(quadrado){   
        quadrado.anchor.setTo(1,1);                             //muda âncora dos quadrados azuis
        quadrado.inputEnabled = true;
        if (encontraUnidade(quadrado.x,quadrado.y)!=null)
            //remove um quadrado se já há uma unidade nele
            quadrado.destroy();
        
    })
    movimentacao.visible = true;
    
    movimentacao.onChildInputDown.add(this.move,this);
}



//alternativa para a primeira funcção de movimentar
function criaMovimentacao2 (sprite){
    var quadrados = [];
    var quadSecundarios = [];
    
    spriteSelecionado = sprite;
    movimentacao.removeAll(true);
  
    posX = sprite.x;
    posY = sprite.y;
    
    //criando os quatro primeiros tiles de movimentação
    if (posicaoValida(posX,posY-32))
    quadrados.push(game.add.sprite(posX,posY-32,'quadrado'));   //cima
    if (posicaoValida(posX+32,posY))                    
    quadrados.push(game.add.sprite(posX+32,posY,'quadrado'));   //direita
    if (posicaoValida(posX,posY+32))
    quadrados.push(game.add.sprite(posX,posY+32,'quadrado'));   //baixo
    if (posicaoValida(posX-32,posY))
    quadrados.push(game.add.sprite(posX-32,posY,'quadrado'));   //pra esquerda

    //adiciona os quadrados de movimento ao grupo
    movimentacao.addMultiple(quadrados);
    
    movimentacao.children.forEach(function(quadrado){
        quadrado.anchor.set(1,1);
		quadrado.events.onInputDown.add(move,this);
        posX = quadrado.x;
        posY = quadrado.y;
		console.log(posX,posY);
        
        //cria os próximos tiles de movimentação
        if (posicaoValida(posX,posY-32))
            quadSecundarios.push(game.add.sprite(posX,posY-32,'quadrado'));   //cima
        if (posicaoValida(posX+32,posY))
            quadSecundarios.push(game.add.sprite(posX+32,posY,'quadrado'));   //direita
        if (posicaoValida(posX,posY+32))
            quadSecundarios.push(game.add.sprite(posX,posY+32,'quadrado'));   //baixo
        if (posicaoValida(posX-32,posY))
            quadSecundarios.push(game.add.sprite(posX-32,posY,'quadrado'));   //pra esquerda}
      
            
			
		quadSecundarios.forEach(function(quadradoSecundario){
            if (quadradoSecundario.anterior == null)
			quadradoSecundario.anterior = quadrado; //cada quadrado secundario guarda um referencia do quadrado orirginal que o gerou
			quadradoSecundario.anchor.set(1,1);
			quadradoSecundario.inputEnabled = true;
			quadradoSecundario.events.onInputDown.add(moveSec,this);
			
		});
        
		movimentacao.addMultiple(quadSecundarios);
		
        quadrado.inputEnabled = true;
    });
    
    
    
	

	
	
	movimentacao.visible = true;
}

//função que atualiza a variavel global "tabuleiro"
function atualizaPosicao (posX,posY,sprite){
    linha = (posX-31)/32-1;     
    coluna = (posY-31)/32-1;
    
    //mande 'null' como paramentro para atualizar a posicao do sprite clicado
    if (sprite==null)
        tabuleiro[linha][coluna] = spriteSelecionado;          
    else 
        tabuleiro[linha][coluna] = sprite;      
    

    
    
    
}

//
function removePosicao (posX,posY){
    linha = (posX-31)/32-1;     
    coluna = (posY-31)/32-1;
    tabuleiro[linha][coluna] = null;
    console.log(linha,coluna);
}

function posicaoValida(posX,posY){
    if (encontraUnidade(posX,posY)== null && dentroDoMapa(posX,posY))
        return true;
    else
        return false;
} 
