<?php 
	//aqui faz a -> conexão <-  com o bd

	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '1234567');
	define('DB_NAME', 'mydb');

	//vai fazer a conexão com banco com as informações de cima, se der errado 'die' se der certo 'conexão bem sucedida'
	$conexao = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	date_default_timezone_set('America/Sao_Paulo'); 

	 if ($conexao=== false) {
	 	die("Erro: Não foi possivel conectar ao Banco de Dados" . mysqli_connect_error());
	 }
	 
 ?>