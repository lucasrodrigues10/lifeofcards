var game = new Phaser.Game(448, 448, Phaser.AUTO, 'center', { preload: preload, create: create, update: update},false,false);  
    



function  preload () {
    loadAssets(); //carrega os assets necessários    
    

    
}

function create (){
    
   
    
    
    //jogo se torna responsivo de acordo com o tamanho da tela do browser
    deixaResponsivo();
    window.addEventListener("resize",deixaResponsivo);
    
   
    
    //inicializa fisica. necessario para fazer as unidades se movimentar
	game.physics.startSystem(Phaser.Physics.ARCADE);
    
    jogo = game.add.sprite( 0 ,0, 'tabuleiro');
    
    
    movimentacao = game.add.group(); // grupo para movimentação das unidades
    movimentacao.visible = false;
    
    
    
    unidades = game.add.group(); //grupo para renderizar a "layer" das cartas no tabuleiro
    unidades.enableBody = true;
    
    
    //vincula todos os sprites ao tabuleiro
    jogo.addChild(movimentacao);
    jogo.addChild(unidades);
    
    
    
    summon(8,8,'ferumbras');
    
    
    unidades.callAll('animations.play','animations','right'); 
    
    
    
   
	
		
	
}

function update (){
    
}
    
    