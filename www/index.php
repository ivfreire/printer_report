<?php
	session_start();	// Inicia sessão do usuário

	// Verifica se é um POST request
	if (isset($_POST['username']) && isset($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$userlist = file('data/users.txt');
		foreach($userlist as $user) {
			$user_bits = explode('|', $user);
			if (strcmp($user_bits[0], $username) == 0) {
				if (strcmp(hash('sha256', $password), $user_bits[1]) == 0) {
					$_SESSION['username'] = $user_bits[0];
					$_SESSION['name'] = $user_bits[2];
					header('Location: dashboard.php');
					exit();
				}
				break;
			}
		}

		header('Location: index.php');
		exit();
	}

	if (isset($_SESSION['username'])) {
		header('Location: dashboard.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CCIFUSP - Relatórios de Impressão</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
	<nav role="navigation" class="navigation">
		<div class="wrapper">
			<h3>CCIFUSP</h3>
		</div>
	</nav>
	<div class="stack">
		<div class="element">
			<div class="wrapper">
				<div class="panel">
					<div class="content">
						<div class="left">
							<div class="logo">
								<img class="logo" src="images/ifusp.png" alt="logo do ifusp">
							</div>
							<div class="text">
								<h2>Relatórios de Impressão</h2>
								<p>Ferramenta web para visualizar trabalhos de impressão e cópias das impressoras e scanners do Instituto de Física da USP.</p>
							</div>
						</div>
						<div class="right">
							<div class="login box">
								<form method="POST" action="index.php">
									<h1>Login</h1><br>
									<p>Utilize seu usuário e senha para acessar o painel</p><br>
									<input type="text" name="username" placeholder="Usuário">
									<input type="password" name="password" placeholder="Senha">
									<button>Entrar</button><br><br>
									<p>Caso tenha esquecido seu usuário ou senha entre em contato com o CCIFUSP.</p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="bottom-bar">
		<div class="wrapper">
			<div class="info">
				<p>Desenvolvido pelo CCIFUSP<br>São Paulo - 2021</p>
			</div>
		</div>
	</div>
</body>
</html>