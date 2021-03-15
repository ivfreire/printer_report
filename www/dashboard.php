<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		redirect('index.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard - Relatórios de Impressão</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<nav role="navigation" class="navigation">
		<div class="wrapper">
			<h3>CCIFUSP</h3>
		</div>
	</nav>
	<div class="stack">
		


	</div>
</body>
</html>