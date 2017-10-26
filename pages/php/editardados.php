<?php

include "db.php";

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $idade = ($_POST["idade"]);
				
        $local = ($_POST["local"]);
        
        $sexo = ($_POST["sexo"]);
        
        $id = ($_POST["id"]);
        
        echo $idade.'  ' ;
        echo $local.'  ' ;
        echo $sexo.'  ' ;
        echo $id;
    
    if ( empty($idade) AND empty($local) AND empty($sexo)) {
          
    } 
    
    else
       {
          $query = "UPDATE Usuario
            SET Nascimento = '$idade',
                Endereço = '$local',
                Sexo = '$sexo'
            WHERE IDusuario = '$id';
            ";
            
            $result = $conn->query($query);
        }
}
?>
