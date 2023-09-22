<?php
	// tela de login pra adm
	session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Entrar como Adm </title>
	<link rel="stylesheet" type="text/css" href="estilologin.css">
</head>
<body>
<div id="corpo-form" >
	<h1> Login como Administrator </h1>

	<?php 
	if (isset($_SESSION['mensagem'])) {
		echo $_SESSION['mensagem'];
		unset($_SESSION['mensagem']);
	}
	 ?>
	 
 	<form method="POST" action="verificacao.php">
		<input type="text" name="login" placeholder="Login" > 		
		<input type="password" name="senha" placeholder="Senha" > 
		<input type="submit" name="Entrar"> 
		<a href="formulario.html"> Cadastro <b>apenas</b> para Administratores. </a>
		</form>
</div>

</body>
</html>