<?php
	if (!isset($_GET['p'])) {
		echo "<h1>Impressora não encontrada!</h1>";
		exit();
	}

	$printers = json_decode(file_get_contents('../data/printers.json'), true);
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

	$handle = fopen('../'.$printer['data'], 'r');

	while(($row = fgetcsv($handle, 0, ",")) !== FALSE) {
		$row = mb_convert_encoding($row, "UTF-8", "UTF-16");
		// Código aqui
	}

	echo $printer['name'];

	fclose($handle);
?>