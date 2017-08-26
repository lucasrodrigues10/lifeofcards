<?php
	/* Irá resetar a senha do usuário que esqueceu a senha */
	require "db.php";
	session_start();

	if( $_SERVER['REQUEST_METHOD'] == 'POST'){
		$email = $mysqli->escape_string($_POST['email']);
		$result = $mysqli->query("SELECT * FROM users WHERE email = '$email'");

		if($result->num_rows == 0){
			$_SESSION['message'] = "Não existe esse email cadastrado";
			header("location: error.php");
		} else {
			$user = $result->fetch_assoc();

			$email = $user['email'];
			$hash = $user['hash'];
			$_SESSION['message'] = "Please check your email $email"
        . " for a confirmation link to complete your password reset!";

        	$to = $email;
        	$subject = "Life of Cards - Resetar Senha";
        	$message_body = '
        	Você solicitou o resete da sua senha, clique no link a seguir para confirmar:
        	http://localhost/login-system/reset.php?email='.$email.'&hash='.$hash; 
        	mail($to,$subject,$message_body);
        	header("location: success.php");
		}

	}
?>