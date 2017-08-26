<?php
	/*Esse código adiciona as informações de registro no banco de dados e em seguida envia um email para confirmar o e-mail*/
	print("Hello World3");
	
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];
	$_SESSION['email'] = $_POST['email'];
	
	$username = $mysqli->escape_string($_POST['username']);
	$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));

	$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
	$email = $mysqli->escape_string($_POST['email']);
	
	$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error);
	if($result->num_rows>0){
		$_SESSION['message'] = 'Já existe usuário com esse email';
		header("location: error.php");
	}else{
		$sql = "INSERT INTO users (username, password, hash, email) " 
            . "VALUES ('$username','$password','$hash','$email')";
	}
	/*
	if($mysqli->query($sql)){
		
		$_SESSION['active'] = 0;
		$_SESSION['logged_in'] = true;
		$_SESSION['message'] = "Email de confirmação enviado para $email. Por favor, verificar clicando no link do email."
		$to = $email;
		$subject = 'Life Of Cards - Verificação de Conta';
		
		$message_body = "
		Obrigado por se inscrever!

		Por favor, clique no link a seguir para ativar a sua conta:

		http://lifeofcards.site11.com/php/verify.php?email='.$email.'&hash='.$hash; 
		"
		mail( $to, $subject, $message_body );
		
		header("location: profile.php");
	}else{
		$_SESSION['message'] = 'Registro Falhou!';
		header("location: error.php");
	}
	*/
?>