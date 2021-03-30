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
			<h3>CCIFUSP</h3>
		</div>
	</nav>
	<div class="stack">
		<div class="element">
			<div class="wrapper">
				<div class="panel">
					<div class="title">
						<h1>Dashboard</h1>
					</div>
					<div class="content">
						<h3><?php echo $printer['name']; ?></h3>
					</div>
				</div>
			</div>
		</div>
		<div class="element" style="padding-top: 0;">
			<div class="wrapper">
				<div class="panel">
					<div class="title">
						<h3>Total</h3><br>
					</div>
					<div class="content">
						<div class="info" id="general-info">
							<div class="item" id="total_sheets">
								<div class="title"><span>FOLHAS UTILIZADAS</span></div>
								<div class="content"><h2>0</h2></div>
								<div class="bottom"><span>FOLHAS</span></div>
							</div>
							<div class="item" id="total_prints">
								<div class="title"><span>IMPRESSÕES</span></div>
								<div class="content"><h2>0</h2></div>
								<div class="bottom"><span>PÁGINAS</span></div>
							</div>
							<div class="item" id="total_copies">
								<div class="title"><span>CÓPIAS</span></div>
								<div class="content"><h2>0</h2></div>
								<div class="bottom"><span>PÁGINAS</span></div>
							</div>
							<div class="item" id="total_scans">
								<div class="title"><span><i>SCANS</i></span></div>
								<div class="content"><h2>0</h2></div>
								<div class="bottom"><span>PÁGINAS</span></div>
							</div>
						</div>
						<div class="plots" id="general-info">
							<div class="plot">
								<div class="title"><span>FOLHAS IMPRESSAS POR USUÁRIO</span></div>
								<div class="content">
									<div class="plot-holder" id="users">
										<div class="canvas">
											<canvas>This browser does not support canvas tag.</canvas>
										</div>
									</div>
								</div>
							</div>
							<div class="plot">
								<div class="title"><span>HISTÓRICO</span></div>
								<div class="content">
									<div class="plot-holder" id="history">
										<div class="canvas">
											<canvas>This browser does not support canvas tag.</canvas>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
	<script src="js/printer.js"></script>
</body>
</html>