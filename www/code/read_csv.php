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

	$data = array();
	$data["users"] = array();
	$data["total"] = 0;
	$data["print_jobs"] = 0;
	$data["copy_jobs"] = 0;
	$data["scan_jobs"] = 0;

	while(($row = fgetcsv($handle, 0, ",")) !== FALSE) {
		$row = mb_convert_encoding($row, "UTF-8", "UTF-16");

		if (!isset($data["users"][$row[3]])) {
			$data["users"][$row[3]] = array();
			$data["users"][$row[3]]["total"] = 0;
			$data["users"][$row[3]]["mono"] = 0;
			$data["users"][$row[3]]["color"] = 0;
			$data["users"][$row[3]]["duplex"] = 0;
			$data["users"][$row[3]]["print_jobs"] = 0;
			$data["users"][$row[3]]["copy_jobs"] = 0;
		}

		if (strcmp($row[2], "Print Job") == 0 || strcmp($row[2], "Copy Job") == 0) {
			$data["total"] += (int)$row[15] * (int)$row[16];

			$data["users"][$row[3]]["total"] += (int)$row[15] * (int)$row[16];
			if (strcmp($row[18], "Mono") == 0) $data["users"][$row[3]]["mono"] += (int)$row[15] * (int)$row[16];
			if (strcmp($row[18], "Color") == 0) $data["users"][$row[3]]["color"] += (int)$row[15] * (int)$row[16];
			if (strcmp($row[24], "On") == 0) $data["users"][$row[3]]["duplex"] += (int)$row[15] * (int)$row[16];
			if (strcmp($row[2], "Print Job") == 0) { 
				$data["print_jobs"] += 1;
				$data["users"][$row[3]]["print_jobs"] += 1;
			}
			if (strcmp($row[2], "Copy Job") == 0) {
				$data["copy_jobs"] += 1;
				$data["users"][$row[3]]["print_jobs"] += 1;
			}
		}
		if (strcmp($row[2], "Scan Job") == 0) {
			$data["scan_jobs"] += 1;
			$data["users"][$row[3]]["scan_jobs"] += 1;
		}
	}

	echo json_encode($data);

	fclose($handle);
?>