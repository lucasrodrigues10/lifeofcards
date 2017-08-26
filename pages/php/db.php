<?php
/*
  $usuario = "root";
  $senha = "123";
*/

  $host = 'localhost'; 
  $user = 'id2237061_admin';
  $pass = 'aparecido123';
  $db = 'id2237061_lifeofcards';
  $conn = new mysqli($host,$usuario,$senha,$database);

  if($conn->connect_error){
    die("Erro: " . $conn->connect_error);
  }
?>