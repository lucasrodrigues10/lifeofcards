<?php

include "db.php";

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
		
        $nome = ($_POST["nome"]);    
        $id = ($_POST["id"]);
        
        echo $nome.'  ' ;
        echo $id;
    
 
          $query = "UPDATE UsuarioNoJogo
            SET `img_avatar.arquivo` = '$nome'
            WHERE IDusuario = '$id';
            ";
            
            $result = $conn->query($query);
       
}
?>

      
