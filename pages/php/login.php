<?php
	/* Checa se o usuário e a senha conferem no banco de dados */

	$email = mysqli->escape_string($_POST['email']);
	$result = mysqli->query("SELECT * FROM users WHERE email='$email'");

	if($result->num_rows == 0){
		$_SESSION['message'] = "Email não existe!";
		header("location: error.php");
	}
	else{
		$user = $result -> fetch_assoc();

		if(password_verify($_POST['password'], $user['password'])){
			$_SESSION['email'] = $user['email'];
			$_SESSION['password'] = $user['password'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['active'] = $user['active'];

			$_SESSION['logged_in'] = true;

			header("location: profile.php");
		}
		else{
			$_SESSION['message'] = "Você digitou a senha errada, digite novamente";
			header("location: error.php");
		}
	}

?>