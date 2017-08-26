<?php

/*

  $usuario = "root";

  $senha = "123";

*/



  $host = 'localhost'; 

  $usuario = 'id2237061_admin';

  $senha = 'aparecido123';

  $database = 'id2237061_lifeofcards';

  $conn = new mysqli($host,$usuario,$senha,$database);



  if($conn->connect_error){

    die("Erro: " . $conn->connect_error);

  }

?>