<?php
  include "db.php";
  include "gerar_senha.php";
  $email = $_POST['email'];
  $query = "SELECT * FROM Usuario WHERE Email = '$email'";
  $result = $conn->query($query);
  $row = $result->fetch_assoc();

  if($result->num_rows > 0){
  	/*Gera senha*/
  	$novaSenha = geraSenha(6, false, true);
  	/* Altera senha */
  	$sql = "UPDATE Usuario SET Senha='$novaSenha' WHERE Email = '$email'";
  	if( $conn->query($sql) ){
  		/* Email para informar a senha se mudança funcionar*/
		$subject = 'Life of Cards - Senha alterada com sucesso';
		$message = 
		'Pessoa linda,' . "\r\n" .
		'A sua senha foi alterada para: ' . $novaSenha . "\r\n";
		$headers = 'From: lifeofcards@lifeofcards.site11.com' . "\r\n" .
	    'Reply-To: webgame10@outlook.com' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();
		$envio = mail($email, $subject, $message, $headers);
		if($envio)
			echo "Email enviado";
		else
			echo "Email não enviado";
	}
  }	else {
  	echo "Email não encontrado";
  }
?>