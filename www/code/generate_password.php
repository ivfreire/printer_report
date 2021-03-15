<?php
	$hash = "Insira uma senha";

	if (isset($_GET['password'])) {
		$password = $_GET['password'];
		$hash = hash('sha256', $password);
	}

	echo $hash;
?>