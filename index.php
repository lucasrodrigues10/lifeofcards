<?php
	require_once("system/config.php"); //include, mas não carrega a página se falhar

	if($manutencao){
		echo "Site em manutencao";		
	}else{
		header("Location: pages/login.html");
	}
?>
