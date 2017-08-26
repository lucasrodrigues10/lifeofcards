<?php
	/*Esse arquivo permite a conexão com o banco de dados*/

	/*Variáveis para a conexão*/
	$host = 'localhost'; 
	$user = 'id2237061_admin';
	$pass = 'aparecido123';
	$db = 'id2237061_lifeofcards';
	/*Faz a conexão*/
	$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
?>