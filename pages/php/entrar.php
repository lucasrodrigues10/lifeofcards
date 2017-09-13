<?php
	include "db.php";
	session_start();

	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];

	$query = "SELECT * FROM Usuario WHERE Login = '$usuario' AND Senha = '$senha'";
	$result = $conn->query($query);

	if($result->num_rows > 0){
		$row = $result->fetch_assoc();
		$_SESSION["id"] = $row["IDusuario"];
		?>
		 <script> location.replace("../main.php"); </script>
		<?php

	}else{
		echo "Nao achou";
	}

	$conn->close();

?>