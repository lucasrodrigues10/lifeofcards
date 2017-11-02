<?php
  //Variaveis para conexao com o banco de dados
  $host = 'localhost'; //INGUAL AO ANTERIOR
  //$usuario = 'id2237061_admin';
  //$senha = 'aparecido123';
  //$database = 'id2237061_lifeofcards';

  $usuario = 'root';
  $senha = '1234';
  $database = 'life_of_cards';
        
  //Conexao com o banco de dados
  $conn = new mysqli($host,$usuario,$senha,$database);

  //Checa se tem erro
  if($conn->connect_error){
    die("Erro: " . $conn->connect_error);
  }

