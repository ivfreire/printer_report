<?php
	session_start();

	if (!isset($_SESSION['username']) || !isset($_GET['p'])) {
		header('Location: index.php');
		exit();
	}

	$printers = json_decode(file_get_contents('data/printers.json'), true);
	$printers = $printers['printers'];
	$printer;

	foreach ($printers as $_printer) {
		if ($_printer['id'] == $_GET['p']) {
			$printer = $_printer;
			break;
		}
	}

	if (!isset($printer)) {
		echo "<h1>Impressora não encontrada :/</h1>";
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
	<link rel="stylesheet" href="css/printer.css">
</head>
<body>
	<nav role="navigation" class="navigation">
		<div class="wrapper">
			<h3>CCIFUSP - <span class="name"><?php echo $printer['name']; ?></span></h3>
		</div>
	</nav>
	<div class="stack">
		
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="js/printer.js"></script>
</body>
</html>