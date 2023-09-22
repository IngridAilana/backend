<?php
	//tela de login para  usuarios
	session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Entrar </title>
	<link rel="stylesheet" type="text/css" href="estilologin.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
	integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>

	<header>
		
		<nav>
		<a href="loginadm.php" > Logar como Adm </a>
		<a href	="modelo.html"> Modelo de Dados </a>
		<a href= "queries.html"> Queries </a>
		</nav>
	</header>
<div id="corpo-form" >
	<h1> Login como Usuário Comum </h1>

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
		<a href="formulario.html"> Ainda não possui login? <strong> Cadastre-se Aqui </strong> </a>
		</form>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"> 
</script>
</body>
</html>