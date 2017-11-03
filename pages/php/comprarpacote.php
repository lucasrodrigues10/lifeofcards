<?php
include "db.php";

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
		
        $nome = ($_POST["nome"]);  
        $idu = ($_POST["id"]); 
        //echo $nome.'  ' ; echo $idu;
				  
        $query = "SELECT * FROM Pacote WHERE Nome = '$nome'";
			 $result = $conn->query($query);
			  $row = $result->fetch_assoc();
				  $id = $row["IDpacote"];
//verificar preco e moedas aqui tambem
		$query = "SELECT Moedas FROM UsuarioNoJogo WHERE IDusuario = '$idu'";
			 $result = $conn->query($query);
			  $row = $result->fetch_assoc();
				  $moedas = $row["Moedas"];
				  
		$query = "SELECT * FROM Loja WHERE IDproduto = '$id'";
			 $result = $conn->query($query);
			  while($row = $result->fetch_assoc()){
				$preco = $row["Preço"];
				$promo = $row["IDpromocao"];
			  }
			  
		 $query = "SELECT * FROM Promoção WHERE IDpromoção = '$promo'";
			 $result = $conn->query($query);
			  $row = $result->fetch_assoc();
				  $valor = $row["Valor"];
				  
				  $preco = $preco * $valor;
			
			$qnt = 1;
		if($moedas>$preco)
		{
			$moedas = $moedas - $preco;
          $query = "SELECT * FROM Cartas WHERE IDpacote= '$id'";   
            $result = $conn->query($query);
            
			if ($result->num_rows > 0) {
			  while($row = $result->fetch_assoc())
			  {
				$idc = $row["IDcarta"];
				$query = "SELECT * FROM Cartas_Usuario WHERE IDcarta= '$idc' AND IDusuario= '$idu'";   
				$result2 = $conn->query($query);
				if($result2->num_rows > 0){
					while ($row = $result2->fetch_assoc()) 
					{
						$carta = $row["IDcarta"];
						$usuario = $row["IDusuario"];
						$qtde = $row["Qtde"];
						$qtde = $qtde + $qnt;
						
						$query = "UPDATE Cartas_Usuario
						SET Qtde = '$qtde'
						WHERE IDusuario = '$usuario' AND
						IDcarta = '$carta';";  
						
						$result3 = $conn->query($query);
					}
				}
				else
				{
					$query = "INSERT INTO Cartas_Usuario
					VALUES ('$idu','$idc','$qnt')";
					$result3 = $conn->query($query);
				}
			  }
			}
			$query = "UPDATE UsuarioNoJogo
						SET Moedas = '$moedas'
						WHERE IDusuario = '$idu';";  
						
			$result = $conn->query($query);
		}
}
?>