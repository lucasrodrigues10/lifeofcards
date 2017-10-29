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
    
    /*
    summon(1,1,'mummy');
    summon(2,5,'banshee');
    summon(3,5,'torturer');
    summon(2,4,'banshee');
    summon(2,6,'torturer');
    summon(3,6,'torturer');
    summon(8,8,'ferumbras');
    summon(1,2,'demon_skeleton');
    summon(2,2,'undead_dragon');
    summon(3,3,'lost_soul');
    summon(1,5,'green_djin');
    summon(6,6,'orc_leader');
    summon(7,7,'constrictor');
    */
    
    unidades.callAll('animations.play','animations','right'); 
    
    
    
   
	
		
	
}

function update (){
    
}
    
    