<?php
	session_start();
	$manutencao = 0;
	if($manutencao){
		echo "Site em manutencao";		
	}else{
		if (empty($_SESSION["id"])) {
        	header("Location: pages/login.php");
    	}   else{
    		header("Location: pages/main.php");
    	}
	}
?>
