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
	$data["totals"] = array(0, 0, 0);	// Print, Copy, Scan
	$data["jobs"] = array(0, 0, 0);		// Print, Copy, Scan
	$data["timeline"] = array();		// Print, Copy, Scan

	while(($row = fgetcsv($handle, 0, ",")) !== FALSE) {
		$row = mb_convert_encoding($row, "UTF-8", "UTF-16");
		$date = explode(" ", $row[5])[0];

		if (!isset($data["timeline"][$date])) $data["timeline"][$date] = array(0, 0, 0);
		if (!isset($data["users"][$row[3]])) {
			$data["users"][$row[3]] = array();
			$data["users"][$row[3]]["mono"] = 0;
			$data["users"][$row[3]]["duplex"] = 0;
			$data["users"][$row[3]]["totals"] = array(0, 0, 0);	// Print, Copy, Scan
			$data["users"][$row[3]]["jobs"] = array(0, 0, 0);	// Print, Copy, Scan
		}

		if (strcmp($row[2], "Print Job") == 0 || strcmp($row[2], "Copy Job") == 0 || strcmp($row[2], "Scan Job") == 0) {
			if (strcmp($row[18], "Mono") == 0) $data["users"][$row[3]]["mono"] += (int)$row[15] * (int)$row[16];
			if (strcmp($row[24], "On") == 0) $data["users"][$row[3]]["duplex"] += (int)$row[15] * (int)$row[16];

			if (strcmp($row[2], "Print Job") == 0) {
				$data["users"][$row[3]]["totals"][0] += (int)$row[15] * (int)$row[16];
				$data["totals"][0] += (int)$row[15] * (int)$row[16];
				$data["jobs"][0] += 1;
				$data["users"][$row[3]]["jobs"][0] += 1;
				$data["timeline"][$date][0] += (int)$row[15] * (int)$row[16];
			}
			if (strcmp($row[2], "Copy Job") == 0) {
				$data["users"][$row[3]]["totals"][1] += (int)$row[15] * (int)$row[16];
				$data["totals"][1] += (int)$row[15] * (int)$row[16];
				$data["jobs"][1] += 1;
				$data["users"][$row[3]]["jobs"][1] += 1;
				$data["timeline"][$date][1] += (int)$row[15] * (int)$row[16];
			}
		}

		if (strcmp($row[2], "Scan Job") == 0) {
			$data["users"][$row[3]]["totals"][2] += (int)$row[15] * (int)$row[16];
			$data["totals"][2] += (int)$row[15] * (int)$row[16];
			$data["jobs"][2] += 1;
			$data["users"][$row[3]]["jobs"][2] += 1;
			$data["timeline"][$date][2] += (int)$row[15] * (int)$row[16];
		}
	}

	echo json_encode($data);

	fclose($handle);
?>