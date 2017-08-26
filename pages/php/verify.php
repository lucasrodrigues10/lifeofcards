<?php 
	/*Verifica o e-mail do novo usuário*/
	
	require 'db.php';
	session_start();

	if( isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) ){

		$email = $mysqli->escape_string($_GET['email']);
		$hash = $mysqli->escape_string($_GET['hash']);

		$result = $mysqli->query("SELECT * FROM users WHERE email='$email' AND hash='$hash' AND active='0'");

		if($result->num_rows == 0){
			$_SESSION['message'] = "A conta já está ativa.";
			header("location: error.php");
		}
		else{
			$_SESSION['message'] = "A conta foi ativada com sucesso!";
			$mysqli->query("UPDATE users SET active='1' WHERE email='$email'") or die(mysqli->error);
			$_SESSION['active'] = 1;

			header("location: success.php");
		}
	}
	else{
		$_SESSION['message'] = "Parâmetros invalidos para verificação de conta."
		header("location: error.php");
	}
?>