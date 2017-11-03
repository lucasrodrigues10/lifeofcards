//carregador de assets
function loadAssets (){ 
    
    var arquivo = [];
    
    var contexto = this;
    
    game.load.image('tabuleiro','assets/tabuleiro.png');
    game.load.image('quadrado','assets/quadrado.png');
    
    
    
    
    //perguntando pro servidor quais são os arquivos que estão na pasta de spritesheets
    $.ajax({
        url: "getSprites.php",
        type: "post",
        context: contexto,
        dataType: "json",
        async:false,
        success: function(result){
            
            for(var key in result){
                tamanhoFrame = result[key];
                
                nomeArquivo = key;
                
                nomeTextura = nomeArquivo.replace(".png",""); //nome da textura do phaser é nome do arquivo sem o '.png' no fim
                

                game.load.spritesheet(nomeTextura, 'assets/sprites/'+nomeArquivo, tamanhoFrame, tamanhoFrame);  

                
                listaSprites.push(nomeTextura);
        
            }
        }
            
    })
    
}


function exibeSprites(){
    var coluna = 1;
    var linha = 1;
    
    for (var i = 0;i<listaSprites.length;i++){
        console.log(coluna,linha);
        
        summon(linha,coluna,listaSprites[i]);
        linha++;
        if (i%12==0 && i!=0){
            linha = 1;
            coluna += 2;
        }
        
        
    }
    
    
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

function deixaResponsivo(){
    //faz o canvas se ajustar ao tamanho da tela (responsivo)
    
    game.scale.scaleMode = Phaser.ScaleManager.aspectRatio;
	game.scale.pageAlignVertically = true;
	game.scale.pageAlignHorizontally = true;
	game.scale.setShowAll();
	game.scale.refresh();
}

var numLinhas = 12;
var numColunas = 12;
var margemLateral = 1;
var margemVertical = 1  ;

var listaSprites = [];
var jogo; //referencia para o sprite do tabuleiro
var spriteSelecionado;

var listaSprites = [];
//criando um vetor 12x12 pra guardar as referencias dos sprites
var tabuleiro = new Array (12);
for (i=0;i<12;i++)
	tabuleiro[i] = new Array (12);


//função para criar sprites de maneira mais rápida
function summon (linhaTabuleiro,colTabuleiro,nome){ 
    var posX = linhaTabuleiro*32+31;
    var posY = colTabuleiro*32+31;
    
	
	if (posicaoValida(posX,posY)){
        
     
        var sprite = game.add.sprite(posX,posY,nome);

        //adicionando informações da posição do sprite para facilatar posteriores funções
        sprite.linha = linhaTabuleiro;
        sprite.coluna = colTabuleiro;

        atualizaPosicao(posX,posY,sprite);

        //criando resposta ao clique
        sprite.inputEnabled = true;
        sprite.hitArea = new Phaser.Rectangle(-32,-32,32,32); 
        sprite.events.onInputDown.add(criaMovimentacao,this); 

        //habilitando fisica para movimentar os sprites
        game.physics.arcade.enable(sprite);

        //muda a âncora para o canto inferior direito
        sprite.anchor.set(1,1); 

        //cria animações para o sprite.
        addAnimations(sprite);  

        //adiciona o sprite ao grupo de unidades
        unidades.add(sprite);
        
        
        //insere na posicao do tabuleiro levando em conta a numeração do tabuleiro
        var defesa = game.make.text(sprite.x,sprite.y-26,'D:'+6,{font:'8px Arial',fill: "#FF0000"});
        var ataque = game.make.text(sprite.x-15,sprite.y-26,'A:'+3,{font:'8px Arial',fill:"#43d637"});
        
        defesa.fontWeight = 'bold';
        defesa.anchor.x = 0.9;
        defesa.anchor.y = 0.7;
        defesa.stroke = '#000000';
        defesa.strokeThickness = 4;
        
        ataque.fontWeight = 'bold';
        ataque.anchor.x = 1;
        ataque.anchor.y = 0.7;
        ataque.stroke = '#000000';
        ataque.strokeThickness = 4;
        
        textoAtk.add(defesa);
        textoDef.add(ataque);
        
        ataque.unidade = sprite;
        defesa.unidade = sprite;
       
        
    } else 
        console.log("posição inválida");
    
        
}


function move (sprite){
    //desabilita o input pro usuario não fazer m*rda
    game.input.enabled = false;
    
    //remove a posicao anterior na matriz
    removePosicao(spriteSelecionado.x,spriteSelecionado.y);
	
	
	
	 
	
    
    //move o objeto
    game.physics.arcade.moveToObject(spriteSelecionado,sprite,60,600);
    
    defineDirecao(spriteSelecionado);
    
    
    
    
     //função para para o sprite quando ele chega ao destin
    game.time.events.add(600, function () {
        
        //corrige erro de precisão ao movimentar 
        spriteSelecionado.x = Math.ceil(sprite.x/32)*32-1;
        spriteSelecionado.y = Math.ceil(sprite.y/32)*32-1;
        
        
        spriteSelecionado.body.velocity.x = 0;
        spriteSelecionado.body.velocity.y = 0;
         
        //Ordena a ordem de rederização dos sprites
        unidades.sort('x');
        unidades.sort('y');
        
        movimentacao.removeAll(true);           //elimina quadrados antigos
        game.input.enabled = true;
        
        //atualiza a posição do sprite movimentado na matriz.
        atualizaPosicao(spriteSelecionado.x,spriteSelecionado.y,null);
               
    
    }, this);
	
	
    
}

function moveSec (sprite){
    
    move(sprite.anterior);
    game.time.events.onComplete.add(function(){
        game.time.events.removeAll();
        move(sprite);
        
    })
    
	
}

function criaMovimentacao (sprite){
    
    
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
	
    console.clear();
    console.log(spriteSelecionado.key);
	
	
}

//função que atualiza a variavel global "tabuleiro"
function atualizaPosicao (posX,posY,sprite){
    var linha = (posX-31)/32-1;     
    var coluna = (posY-31)/32-1;
    
    //mande 'null' como paramentro para atualizar a posicao do sprite clicado
    if (sprite==null)
        tabuleiro[linha][coluna] = spriteSelecionado;          
    else 
        tabuleiro[linha][coluna] = sprite;      
    

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

function removePosicao (posX,posY){
    var linha = (posX-31)/32-1;     
    var coluna = (posY-31)/32-1;
    tabuleiro[linha][coluna] = null;
    console.log(linha,coluna);
}

function encontraUnidade (posX,posY){
	//transforma a coordenada em pixels para posição do tabuleiro 
	var linha = (posX-31)/32;
	var coluna = (posY-31)/32
	
	
	if (dentroDoMapa(posX,posY))                   //evita possiveis erros de indices
	   var casa = tabuleiro[linha-1][coluna-1];
   if (casa !=null) //casa ocupada por uma unidade
	   return casa;
	else
		return null; //casa livre (ou a posição fornecida está fora do mapa)
}

function posicaoValida(posX,posY){
    if (encontraUnidade(posX,posY)== null && dentroDoMapa(posX,posY))
        return true;
    else
        return false;
} 

//encontra a direção em que o sprite está se movendo
function defineDirecao(sprite){
    if (sprite.body.velocity.x > 0.1)           //OBS: coloquei 0.1 porque com 0 dava errado
        sprite.direcao = "right";
    if (sprite.body.velocity.x < -0.1 )
        sprite.direcao =  "left";
    if (sprite.body.velocity.y < -0.1 )
        sprite.direcao = "up"; 
    if (sprite.body.velocity.y > 0.1 )
        sprite.direcao = "down";
    spriteSelecionado.animations.play(spriteSelecionado.direcao);
}


function mostraSprites(){
    
    //textos removidos parafacilitar visualizacao dos sprites
    textoAtk.visible=false;
    textoDef.visible=false;
    
    coluna = 1;
    linha = 1;

    for (var i=0; i<listaSprites.length;i++){  
        summon(linha,coluna,listaSprites[i]);
        
        if (i%11==0 && i!=0){
            coluna +=1;
            linha = 1;
        }
        summon(linha,coluna,listaSprites[i]);      //tem summon duas vezes porque não sei programar   
        
        linha++;
       
                
        
    }
}

function atualizaTexto(){
    textoAtk.forEachAlive(function(texto){
        texto.x = texto.unidade.x-15;
        texto.y = texto.unidade.y-26;
    })
    textoDef.forEachAlive(function(texto){
        texto.x = texto.unidade.x;
        texto.y = texto.unidade.y-26;

    })
}