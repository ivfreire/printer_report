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
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CCIFUSP - Relatórios de Impressão</title>
	<link rel="stylesheet" href="css/style.css">
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
					<div class="left">
						<h2>Relatórios de Impressão</h2>
						<p>Relatório sobre os trabalhos de impressão e cópias das impressoras do Insituto de Física da USP. Por favor, efeture login para acessar o dashboard.</p>
					</div>
					<div class="right">
						<div class="login">
							<form method="POST" action="index.php">
								<input type="text" name="username" placeholder="Usuário">
								<input type="password" name="password" placeholder="Senha">
								<button>Entrar</button>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</body>
</html>