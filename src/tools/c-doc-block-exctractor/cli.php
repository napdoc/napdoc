#!/usr/bin/env php
<?php

require_once "/opt/nap-software/napphp/src/__loadAsClass.php";

$index = require __DIR__."/src/index.php";

$results = $index(file_get_contents($argv[1]));
$vals = [];

foreach ($results as $result) {
	list($success, $value) = $result;

	//fwrite(STDERR, "\n");

	if ($success === "error") {

		foreach ($value as $error) {
			fwrite(STDERR, "    $error\n");
		}

	} else {
		$vals[] = $value;
	}
}

echo json_encode($vals, JSON_PRETTY_PRINT);
