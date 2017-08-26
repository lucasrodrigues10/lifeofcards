<?php
	$manutencao = 1;
	if($manutencao){
		echo "Site em manutencao";		
	}else{
		header("Location: pages/login.html");
	}
?>
