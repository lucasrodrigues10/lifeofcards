<?php
	$manutencao = 0;
	if($manutencao){
		echo "Site em manutencao";		
	}else{
		header("Location: pages/login.php");
	}
?>
