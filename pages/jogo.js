var game = new Phaser.Game(416, 448-64, Phaser.AUTO, 'center', { preload: preload, create: create, update: update},false,false);  
    



function  preload () {
    loadAssets(); //carrega os assets necessários    
    

    
}

function create (){
    
    jogador1= {
        vida:25,
        cartas:0,
        cartasDeck:0
    }
    jogador2 = {
        vida:25,
        cartas:0,
        cartasDeck:0
    }
    
    //jogo se torna responsivo de acordo com o tamanho da tela do browser
    deixaResponsivo();
    window.addEventListener("resize",deixaResponsivo);
    
   
    
    //inicializa fisica. necessario para fazer as unidades se movimentar
	game.physics.startSystem(Phaser.Physics.ARCADE);
    
    jogo = game.add.sprite( 0 ,32, 'tabuleiro');
    
    textoAtk = game.add.group(); //grupo para renderizar as informaçoes das cartas no tabuleiro
    textoAtk.visible = true;
    
    textoDef = game.add.group(); //grupo para renderizar as informaçoes das cartas no tabuleiro
    textoDef.visible = true;
    
    criaRelogio();
    
    grupoSummon = game.add.group(); // cria tiles para summonar
    
    marcadores = game.add.group();
    marcadores.setAll('alpha',0.5);
    
    marcadoresInimigo = game.add.group();
    marcadoresInimigo.setAll('alpha',0.5);
    
    movimentacao = game.add.group(); // grupo para movimentação das unidades
    movimentacao.visible = false;
    
    
    unidades = game.add.group(); //grupo para renderizar a "layer" das cartas no tabuleiro
    unidades.enableBody = true;
    
    grupoLuta = game.add.group(); //grupo para os icones de luta
    
    
    //vincula todos os sprites ao tabuleiro
    jogo.addChild(marcadoresInimigo);
    jogo.addChild(marcadores);
    jogo.addChild(grupoSummon);
    jogo.addChild(movimentacao);
    jogo.addChild(unidades);
    
    
    
    unidades.callAll('animations.play','animations','down'); 

    summon(3,1,'lost_soul');
    summon(4,1,'ferumbras');
    turno = 2;
    summon(2,1,'devil');
    
    
    

   
	
	desenhaInterface();	
    
    //atualiza os marcadores pela primeira vez.
    if (turno==1){           
        marcadoresInimigo.visible = false;
        marcadores.visible = true;
    }
    else if(turno==2){             
        marcadoresInimigo.visible = true;
        marcadores.visible = false;
    }

}

function update (){
    
    atualizaTexto();
    atualizaMarcadores();
    
    
}
    
    