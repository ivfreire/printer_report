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
	<link rel="stylesheet" href="css/dashboard.css">
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
						<h2>Impressoras</h2>
					</div>
					<div class="content">
						<ul id="printers">
							<li class="title">
								<div class='name'><span>Nome</span></div>
								<div class='local'><span>Local</span></div>
								<div class='description'><span>Descrição</span></div>
							</li>
							<?php
								$printers = json_decode(file_get_contents('data/printers.json'), true);
								$printers = $printers['printers'];
								foreach ($printers as $printer) {
									echo "
										<a href='printer.php?p=".$printer['id']."'>
											<li>
												<div class='name'><span>".$printer['name']."</span></div>
												<div class='local'><span>".$printer['local']."</span></div>
												<div class='description'><span>".$printer['description']."</span></div>
											</li>
										</a>
									";
								}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>