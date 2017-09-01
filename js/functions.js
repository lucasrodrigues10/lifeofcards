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
	
    tabuleiro[linhaTabuleiro][colTabuleiro] = sprite; 
    //criando resposta ao clique
    sprite.inputEnabled = true;
    sprite.hitArea = new Phaser.Rectangle(-32,-32,32,32); 
    sprite.events.onInputDown.add(criaMovimentacao2,this); 
    
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
		
	//posição antiga do sprite deve ficar livre na matriz 'tabuleiro'
	tabuleiro[spriteSelecionado.linha][spriteSelecionado.coluna] = null;
	
	//atualiza a posição do sprite movimentado na matriz. 
	
    
    //move o objeto
    game.physics.arcade.moveToObject(spriteSelecionado,sprite,60,600);
    
    //função para para o sprite quando ele chega ao destino
    game.time.events.add(600, function () {
        
        //corrige erro de precisão ao movimentar (pergunta se nao entender)
        spriteSelecionado.x = Math.ceil(sprite.x/32)*32-1;
        spriteSelecionado.y = Math.ceil(sprite.y/32)*32-1;
        
        console.log(sprite.x,sprite.y);
        spriteSelecionado.body.velocity.x = 0;
        spriteSelecionado.body.velocity.y = 0;
        
        movimentacao.removeAll(true);           //elimina quadrados antigos
        game.input.enabled = true;
    }, this);
	
	//atualiza a posição do sprite movimentado na matriz.
	tabuleiro[(spriteSelecionado.x-31)/32][(spriteSelecionado.y-31)/32];
   
}

function moveSec (sprite){
	console.log("moveu na diagonal?");
}
 
function encontraUnidade (posX,posY){
	//transforma a coordenada em pixels para posição do tabuleiro 
	linha = (posX-31)/32;
	coluna = (posY-31)/32
	
	
	
	var casa = tabuleiro[linha][coluna];
   if (casa !=null) //casa ocupada por uma unidade
	   return casa;
	else
		return null; //casa livre
}



function criaMovimentacao (sprite){
    spriteSelecionado = sprite;
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
            quadrado.kill();
        
    })
    movimentacao.visible = true;
    
    movimentacao.onChildInputDown.add(this.move,this);
}

//alternativa para a primeira funcção de movimentar
function criaMovimentacao2 (sprite,count){
    var quadrados = [];
    var quadSecundarios = [];
    
    spriteSelecionado = sprite;
    movimentacao.removeAll(true);
  
    posX = sprite.x;
    posY = sprite.y;
    
    //criando os quatro primeiros tiles de movimentação
    quadrados.push(game.add.sprite(posX,posY-32,'quadrado'));   //cima
    quadrados.push(game.add.sprite(posX+32,posY,'quadrado'));   //direita
    quadrados.push(game.add.sprite(posX,posY+32,'quadrado'));   //baixo
    quadrados.push(game.add.sprite(posX-32,posY,'quadrado'));   //pra esquerda

    //adiciona os quadrados de movimento ao grupo
    movimentacao.addMultiple(quadrados);
    //movimentacao.onChildInputDown.add(move,this);
    movimentacao.children.forEach(function(quadrado){
		quadrado.events.onInputDown.add(move,this);
        posX = quadrado.x;
        posY = quadrado.y;
		console.log(posX,posY);
        if (encontraUnidade(posX,posY)!=null)
            //remove um quadrado se já há uma unidade nele
            quadrado.destroy();
        else {
            //cria os próximos tiles
			if (encontraUnidade(posX,posY-32)==null)
            quadSecundarios.push(game.add.sprite(posX,posY-32,'quadrado'));   //cima
            if (encontraUnidade(posX+32,posY)==null)
			quadSecundarios.push(game.add.sprite(posX+32,posY,'quadrado'));   //direita
			if (encontraUnidade(posX,posY+32)==null)
            quadSecundarios.push(game.add.sprite(posX,posY+32,'quadrado'));   //baixo
			if (encontraUnidade(posX-32,posY)==null)
            quadSecundarios.push(game.add.sprite(posX-32,posY,'quadrado'));   //pra esquerda
        }
			
		quadSecundarios.forEach(function(quadradoSecundario){
			quadradoSecundario.anterior = quadrado; //cada quadrado secundario guarda um referencia do quadrado orirginal que o gerou
			quadradoSecundario.anchor.set(1,1);
			quadradoSecundario.inputEnabled = true;
			quadradoSecundario.events.onInputDown.add(moveSec,this);
			
		});
        
		movimentacao.addMultiple(quadSecundarios);
		//muda âncora dos quadrados azuis
        quadrado.inputEnabled = true;
    });
    
    
    
	for (i=0;i<quadrados.length;i++){
		quadrados[i].anchor.set(1,1); // mudando a âncora de todos os quadrados
		if (encontraUnidade(quadrados[i].x,quadrados[i].y)!=null)
			quadrados[i]=null;//quadrados.splice(i, 1); //removendo quadrados que possam sobre unidades
		//console.log(quadrados[i].x);
	}
	
	movimentacao.visible = true;
}