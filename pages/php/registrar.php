<?php
  session_start();
  include "db.php";

  $usuario = $_POST['usuario'];
  $senha = $_POST['senha'];
  $email = $_POST['email'];

  $situacaoE = ""; //erro de email
  $situacaoU = ""; //erro de usuario igual
  $situacao = ""; //erros gerais
  $situacao = ""; //erro email
  
  /* Procura se já tem um usuário idêntico */
  $query = "SELECT * FROM Usuario WHERE Login = '$usuario'";
  $result = $conn->query($query);
  $row = $result->fetch_assoc();
  if($result->num_rows > 0){//se encontrar um usuario igual
    $situacaoU = "Usuario já Registrado";
  }

  /* Procura se já tem um email idêntico */
  $query = "SELECT * FROM Usuario WHERE Email = '$email'";
  $result = $conn->query($query);
  $row = $result->fetch_assoc();
  if($result->num_rows > 0){ //se encontrar um email igual
  	$situacaoE = "Email já Registrado";
  } 
  
  if(($situacaoE === "") && ($situacaoU === "")){//insere se nao tiver iguais
    $query = "INSERT INTO Usuario (Login,Senha,Email) VALUES ('$usuario','$senha','$email');";
    if($conn->query($query)){
    /* Email para informar o registro*/
		$subject = 'Life of Cards - Registrado com sucesso';
		$message = 
		'Bem vindo, '. $usuario .'!' . "\r\n" .
		'O seu registro foi realizado com sucesso. ' . "\r\n";
		$headers = 'From: lifeofcards@lifeofcards.site11.com' . "\r\n" .
	    'Reply-To: webgame10@outlook.com' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();
		$envio = mail($email, $subject, $message, $headers);
		if($envio)
			$situacaoM = "sucesso";
		else
			$situacaoM = "erro";
    $query = "SELECT * FROM Usuario WHERE Login = '$usuario' AND Senha = '$senha'";
		$result = $conn->query($query);		
		$row = $result->fetch_assoc();
		$_SESSION["id"] = $row["IDusuario"];
      $situacao = "Registrado com sucesso! ID: ". $row["IDusuario"] ." ";
      ?>
        <script> //location.replace("../main.php"); </script>
      <?php
    } else {
      $situacao = "Não foi registrado";
    }
  }

  $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  </head>
  <body>
    <h1>Geral:<?=$situacao?></h1>
    <h1>Usuario igual:<?=$situacaoU?></h1>
    <h1>Email igual:<?=$situacaoE?></h1>
    <h1>Envio de email:<?=$situacaoM?></h1>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>