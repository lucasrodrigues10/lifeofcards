<?php
	//conexao com o banco de dados 
	
	$dbserver 			= "localhost";
	$dbusername 		= "id2237061_admin";
	$dbpassword 		= "shrekislove";
	$db 				= "id2237061_lifeofcards";

	$conexao = new mysqli($dbserver,$dbusername,$dbpassword,$db, 3306);
	if($conexao->connect_error){
		die("Conexao com o banco de dados falhou: " . $conexao->connect_error);
	}else{
		$query = "SELECT nome,separador,descricao,manutencao FROM config";
		$result = mysqli_query($conexao,$query);
		$row = mysqli_fetch_assoc($result);

		//variaveis
		$title 				= $row['nome'];
		$seperator 			= $row['separador'];
		$description 		= $row['descricao'];
		$manutencao 		= $row['manutencao'];
	}
	
?>