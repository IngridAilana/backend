<?php 
	//tudo que for cadastrado no site vem pra cá

	include_once('config.php');
	
	$nome = $_POST["nome"];
	$dt_nasc = $_POST['dt_nasc'];
	$nome_mae = $_POST['nome_mae'];
	$cpf = $_POST['CPF'];
	$celular = $_POST['celular'];
	$telfixo = $_POST['telfixo'];
	$endereco = $_POST['endereco'];
	$login = $_POST['login'];
	$senha = $_POST['senha'];

	//
	$result = mysqli_query($conexao, "INSERT INTO usuarios (ID_USU, NOME_USU, DT_NASC, NOME_MAE, CPF, CEL_USU, TELFIXO, ENDERECO, LOGIN_USU, SENHA_USU, ID_PERFIL, STATUS_ID)
	 VALUES (null, '$nome', '$dt_nasc', '$nome_mae', '$cpf', '$celular', '$telfixo', '$endereco', '$login', '$senha', 'C', 'A')");
	
	header("location: loginusu.php");
 ?>