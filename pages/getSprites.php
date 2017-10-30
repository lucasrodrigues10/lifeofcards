<?php

    //carrega uma lista com todos os arquivos e diretorios  
    $lista_sprites =  scandir('./assets/sprites');

    $resposta = array();

    
    
    foreach ($lista_sprites as $arquivo){
        
        
        //verifica se o arquivo é do tipo .png
        if(substr($arquivo,-4)==".png"){
        
            $path = './assets/sprites/'.$arquivo;
            list($width,$height) = getimagesize($path);
            $resposta += array($arquivo=>$height);
            
            
            
        
        }
    }
    
    $resposta += array($arquivo=>$height);
    
    echo json_encode($resposta);
    
    
?>